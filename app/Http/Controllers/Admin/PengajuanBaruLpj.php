<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Lpj;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PengajuanBaruLpj extends Controller
{
    // Method to display the list of LPJ with status 'DiProses...'
    public function index()
    {
        // Retrieve LPJ data with status 'DiProses...'
        $list_lpjbaru = Lpj::where('status', 'DiProses...')
            ->orWhere(function ($query) {
                $query->whereDate('tanggal_pengajuan', now()->format('d F Y'))
                    ->whereTime('jam_pengajuan', '>=', '08:00:00');
            })
            ->orderBy('tanggal_pengajuan')
            ->orderBy('jam_pengajuan')
            ->get();

        // Pass LPJ data to the view for display
        return view('admin.pengajuancso.barulpj.index', compact('list_lpjbaru'));
    }

    // Method to get total new submissions with status 'DiProses...'


    // Method to get total LPJ with specific status





    public function info($id)
    {
        // Retrieve LPJ data based on ID
        $lpj = Lpj::findOrFail($id);

        // Pass LPJ data to the view for display
        return view('admin.pengajuancso.barulpj.info', compact('lpj'));
    }



    public function getTotalLPJProses()
    {
        $total_lpj_proses = Lpj::where('status', 'DiProses...')->count();
        return response()->json(['total_lpj_proses' => $total_lpj_proses]);
    }



    // public function show($id)
    // {
    //     $lpj = Lpj::findOrFail($id);
    //     return view('admin.pengajuancso.barulpj.info', compact('lpj'));
    // }

    // Method to accept an LPJ
    // Method untuk menerima LPJ
    public function accept($id)
    {
        $lpj = Lpj::findOrFail($id);
        $lpj->status = 'Di Terima';
        $lpj->status_ad = 'Di Terima'; // Perbarui status_ad

        // Ambil nomor telepon dari relasi id_user
        $phoneNumber = $lpj->user->no_hp;

        // Ambil pesan dari inputan form
        $message = request()->input('balasan_wa');

        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);

        // Simpan data balasan di dalam kolom balasan_wa
        $lpj->balasan_wa = $message;

        $lpj->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect('admin/pengajuancso/barulpj')->with('success', 'Pengajuan Jadwal Diterima ');
    }

    public function reject(Request $request, $id)
    {
        // Temukan LPJ berdasarkan ID
        $lpj = Lpj::findOrFail($id);

        // Ubah status LPJ menjadi "Ditolak"
        $lpj->status = 'Di Tolak';
        $lpj->status_ad = 'Di Tolak';
        $phoneNumber = $lpj->user->no_hp;

        // Simpan alasan penolakan ke dalam kolom balasan_wa
        $message = request()->input('balasan_wa');
        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);
        // Simpan perubahan
        $lpj->balasan_wa = $message;
        $lpj->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuancso/barulpj')->with('success', 'Pengajuan Jadwal Berhasil Ditolak');
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
        $lpj = Lpj::findOrFail($id);

        if ($request->action == 'accept') {
            $lpj->status = 'Di Terima';
            $lpj->status_ad = 'Di Terima'; // Perbarui status_ad
        } elseif ($request->action == 'reject') {
            $lpj->status = 'Di Tolak';
            $lpj->status_ad = 'Di Tolak'; // Perbarui status_ad
        }

        $lpj->save();

        return redirect()->to('admin/pengajuancso/barulpj/');
    }
}
