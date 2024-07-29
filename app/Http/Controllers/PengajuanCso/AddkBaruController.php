<?php

namespace App\Http\Controllers\PengajuanCso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Addk;

class AddkBaruController extends Controller
{
    public function index()
    {
        // Retrieve addk data with status 'DiProses...'
        $list_addkbaru = Addk::where('status', 'DiProses...')
            ->orWhere(function ($query) {
                $query->whereDate('tanggal_pengajuan', now()->format('d F Y'))
                    ->whereTime('jam_pengajuan', '>=', '08:00:00');
            })
            ->orderBy('tanggal_pengajuan')
            ->orderBy('jam_pengajuan')
            ->get();


        // Pass addk data to the view for display
        return view('admin.pengajuancso.baruaddk.index', compact('list_addkbaru'));
    }

    public function getTotalADDKProses()
    {
        $total_addk_proses = Addk::where('status', 'DiProses...')->count();
        return response()->json(['total_addk_proses' => $total_addk_proses]);
    }

    public function info($id)
    {
        // Retrieve addk data based on ID
        $addk = Addk::findOrFail($id);

        // Pass addk data to the view for display
        return view('admin.pengajuancso.baruaddk.info', compact('addk'));
    }

    public function accept($id)
    {
        $addk = Addk::findOrFail($id);
        $addk->status = 'Di Terima';
        $addk->status_ad = 'Di Terima'; // Perbarui status_ad

        // Ambil nomor telepon dari relasi id_user
        $phoneNumber = $addk->user->no_hp;

        // Ambil pesan dari inputan form
        $message = request()->input('balasan_wa');

        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);

        // Simpan data balasan di dalam kolom balasan_wa
        $addk->balasan_wa = $message;

        $addk->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/baruaddk')->with('success', 'Pengajuan Jadwal Berhasil Di Terima');
    }

    public function reject(Request $request, $id)
    {
        // Temukan addk berdasarkan ID
        $addk = Addk::findOrFail($id);

        // Ubah status addk menjadi "Ditolak"
        $addk->status = 'Di Tolak';
        $addk->status_ad = 'Di Tolak';
        $phoneNumber = $addk->user->no_hp;

        // Simpan alasan penolakan ke dalam kolom balasan_wa
        $message = request()->input('balasan_wa');
        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);
        // Simpan perubahan
        $addk->balasan_wa = $message;
        $addk->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/baruaddk')->with('success', 'Pengajuan Jadwal Berhasil Ditolak');
    }


    public function sendWhatsAppMessage($phoneNumber, $message)
    {
        $token = "kQRP@#-dn5Bn!hmjyArG";
        $target = "$phoneNumber";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => $message,
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            // Handle the error here, you can log it or display an error message to the user
        }
        curl_close($curl);

        // Jika tidak ada kesalahan, tidak perlu melakukan apa pun karena pesan sudah berhasil dikirim

        return $response; // Mengembalikan respons dari API WhatsApp
    }

    public function processInfo(Request $request, $id)
    {
        $addk = Addk::findOrFail($id);

        if ($request->action == 'accept') {
            $addk->status = 'Di Terima';
            $addk->status_ad = 'Di Terima'; // Perbarui status_ad
        } elseif ($request->action == 'reject') {
            $addk->status = 'Di Tolak';
            $addk->status_ad = 'Di Tolak'; // Perbarui status_ad
        }

        $addk->save();

        return redirect()->to('admin/pengajuancso/baruaddk/');
    }
}
