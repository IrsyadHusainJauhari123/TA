<?php

namespace App\Http\Controllers\PengajuanCso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Spd;

class SpdBaruController extends Controller
{

    public function index()
    {
        // Retrieve LPJ data with status 'DiProses...'
        $list_spdbaru = Spd::where('status', 'DiProses...')
            ->orWhere(function ($query) {
                $query->whereDate('tanggal_pengajuan', now()->format('d F Y'))
                    ->whereTime('jam_pengajuan', '>=', '08:00:00');
            })
            ->orderBy('tanggal_pengajuan')
            ->orderBy('jam_pengajuan')
            ->get();


        // Pass LPJ data to the view for display
        return view('admin.pengajuancso.baruspd.index', compact('list_spdbaru'));
    }

    public function getTotalSPDProses()
    {
        $total_spd_proses = Spd::where('status', 'DiProses...')->count();
        return response()->json(['total_spd_proses' => $total_spd_proses]);
    }

    public function info($id)
    {
        // Retrieve spd data based on ID
        $spd = Spd::findOrFail($id);

        // Pass spd data to the view for display
        return view('admin.pengajuancso.baruspd.info', compact('spd'));
    }

    public function accept($id)
    {
        $spd = Spd::findOrFail($id);
        $spd->status = 'Di Terima';
        $spd->status_ad = 'Di Terima'; // Perbarui status_ad

        // Ambil nomor telepon dari relasi id_user
        $phoneNumber = $spd->user->no_hp;

        // Ambil pesan dari inputan form
        $message = request()->input('balasan_wa');

        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);

        // Simpan data balasan di dalam kolom balasan_wa
        $spd->balasan_wa = $message;

        $spd->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/baruspd')->with('success', 'Pengajuan Jadwal Berhasil Di Terima');
    }

    public function reject(Request $request, $id)
    {
        // Temukan LPJ berdasarkan ID
        $spd = Spd::findOrFail($id);

        // Ubah status spd menjadi "Ditolak"
        $spd->status = 'Di Tolak';
        $spd->status_ad = 'Di Tolak';
        $phoneNumber = $spd->user->no_hp;

        // Simpan alasan penolakan ke dalam kolom balasan_wa
        $message = request()->input('balasan_wa');
        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);
        // Simpan perubahan
        $spd->balasan_wa = $message;
        $spd->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/baruspd')->with('success', 'Pengajuan Jadwal Berhasil Ditolak');
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
        $spd = Spd::findOrFail($id);

        if ($request->action == 'accept') {
            $spd->status = 'Di Terima';
            $spd->status_ad = 'Di Terima'; // Perbarui status_ad
        } elseif ($request->action == 'reject') {
            $spd->status = 'Di Tolak';
            $spd->status_ad = 'Di Tolak'; // Perbarui status_ad
        }

        $spd->save();

        return redirect()->to('admin/pengajuancso/baruspd/');
    }
}
