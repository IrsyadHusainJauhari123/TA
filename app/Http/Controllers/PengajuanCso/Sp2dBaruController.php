<?php

namespace App\Http\Controllers\PengajuanCso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use App\Models\User\Sp2d;
use App\Models\User\Spd;

class Sp2dBaruController extends Controller
{


    public function index()
    {
        // Retrieve sp2d data with status 'DiProses...'
        $list_sp2dbaru = Sp2d::where('status', 'DiProses...')
            ->orWhere(function ($query) {
                $query->whereDate('tanggal_pengajuan', now()->format('d F Y'))
                    ->whereTime('jam_pengajuan', '>=', '08:00:00');
            })
            ->orderBy('tanggal_pengajuan')
            ->orderBy('jam_pengajuan')
            ->get();


        // Pass LPJ data to the view for display
        return view('admin.pengajuancso.barusp2d.index', compact('list_sp2dbaru'));
    }

    public function getTotalSP2DProses()
    {
        $total_sp2d_proses = Sp2d::where('status', 'DiProses...')->count();
        return response()->json(['total_sp2d_proses' => $total_sp2d_proses]);
    }

    public function info($id)
    {
        // Retrieve sp2d data based on ID
        $sp2d = Sp2d::findOrFail($id);

        // Pass sp2d data to the view for display
        return view('admin.pengajuancso.barusp2d.info', compact('sp2d'));
    }

    public function accept($id)
    {
        $sp2d = Sp2d::findOrFail($id);
        $sp2d->status = 'Di Terima';
        $sp2d->status_ad = 'Di Terima'; // Perbarui status_ad

        // Ambil nomor telepon dari relasi id_user
        $phoneNumber = $sp2d->user->no_hp;

        // Ambil pesan dari inputan form
        $message = request()->input('balasan_wa');

        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);

        // Simpan data balasan di dalam kolom balasan_wa
        $sp2d->balasan_wa = $message;

        $sp2d->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/barusp2d')->with('success', 'Pengajuan Jadwal Berhasil Di Terima');
    }

    public function reject(Request $request, $id)
    {
        // Temukan sp2d berdasarkan ID
        $sp2d = sp2d::findOrFail($id);

        // Ubah status sp2d menjadi "Ditolak"
        $sp2d->status = 'Di Tolak';
        $sp2d->status_ad = 'Di Tolak';
        $phoneNumber = $sp2d->user->no_hp;

        // Simpan alasan penolakan ke dalam kolom balasan_wa
        $message = request()->input('balasan_wa');
        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);
        // Simpan perubahan
        $sp2d->balasan_wa = $message;
        $sp2d->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/barusp2d')->with('success', 'Pengajuan Jadwal Berhasil Ditolak');
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
        $sp2d = Sp2d::findOrFail($id);

        if ($request->action == 'accept') {
            $sp2d->status = 'Di Terima';
            $sp2d->status_ad = 'Di Terima'; // Perbarui status_ad
        } elseif ($request->action == 'reject') {
            $sp2d->status = 'Di Tolak';
            $sp2d->status_ad = 'Di Tolak'; // Perbarui status_ad
        }

        $sp2d->save();

        return redirect()->to('admin/pengajuancso/barusp2d/');
    }
}
