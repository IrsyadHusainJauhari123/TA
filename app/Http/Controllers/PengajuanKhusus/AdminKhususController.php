<?php

namespace App\Http\Controllers\PengajuanKhusus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Khusus;

class AdminKhususController extends Controller
{
    public function index()
    {
        // Retrieve sp2d data with status 'DiProses...'
        $list_khususbaru = Khusus::where('status', 'DiProses...')
            ->orWhere(function ($query) {
                $query->whereDate('tanggal_pengajuan', now()->format('d F Y'))
                    ->whereTime('jam_pengajuan', '>=', '08:00:00');
            })
            ->orderBy('tanggal_pengajuan')
            ->orderBy('jam_pengajuan')
            ->get();


        // Pass LPJ data to the view for display
        return view('admin.pengajuankhusus.khususbaru.index', compact('list_khususbaru'));
    }

    public function getTotalKHUSUSProses()
    {
        $total_khusus_proses = Khusus::where('status', 'DiProses...')->count();
        return response()->json(['total_khusus_proses' => $total_khusus_proses]);
    }


    public function info($id)
    {
        // Retrieve addk data based on ID
        $khusus = Khusus::findOrFail($id);

        // Pass addk data to the view for display
        return view('admin.pengajuankhusus.khususbaru.info', compact('khusus'));
    }

    public function accept($id)
    {
        $khusus = Khusus::findOrFail($id);
        $khusus->status = 'Di Terima';
        $khusus->status_ad = 'Di Terima'; // Perbarui status_ad

        // Ambil nomor telepon dari relasi id_user
        $phoneNumber = $khusus->user->no_hp;

        // Ambil pesan dari inputan form
        $message = request()->input('balasan_wa');

        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);

        // Simpan data balasan di dalam kolom balasan_wa
        $khusus->balasan_wa = $message;

        $khusus->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect('admin/pengajuankhusus/khususbaru')->with('success', 'Pengajuan Jadwal Berhasil Di Terima');
    }

    public function reject(Request $request, $id)
    {
        // Temukan addk berdasarkan ID
        $khusus = Khusus::findOrFail($id);

        // Ubah status khusus menjadi "Ditolak"
        $khusus->status = 'Di Tolak';
        $khusus->status_ad = 'Di Tolak';
        $phoneNumber = $khusus->user->no_hp;

        // Simpan alasan penolakan ke dalam kolom balasan_wa
        $message = request()->input('balasan_wa');
        // Kirim pesan WhatsApp
        $this->sendWhatsAppMessage($phoneNumber, $message);
        // Simpan perubahan
        $khusus->balasan_wa = $message;
        $khusus->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->to('admin/pengajuankhusus/khususbaru')->with('success', 'Pengajuan Jadwal Berhasil Ditolak');
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
        $khusus = Khusus::findOrFail($id);

        if ($request->action == 'accept') {
            $khusus->status = 'Di Terima';
            $khusus->status_ad = 'Di Terima'; // Perbarui status_ad
        } elseif ($request->action == 'reject') {
            $khusus->status = 'Di Tolak';
            $khusus->status_ad = 'Di Tolak'; // Perbarui status_ad
        }

        $khusus->save();

        return redirect()->to('admin/pengajuancso/khususbaru/');
    }
}
