<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Models\User;
use App\Models\Satker;
use Illuminate\Support\Carbon;

class BroadcastController extends Controller
{
    public function index()
    {
        $data['list_broadcast'] = Broadcast::all();
        return view('admin.broadcast.index', $data);
    }


    public function create()
    {
        // Ambil semua satker
        $list_satker = Satker::all();

        // Ambil semua user yang terkait dengan satker berdasarkan id_satker
        $users = User::whereIn('id_satker', $list_satker->pluck('id_satker'))->get();

        // Kirim data ke view untuk ditampilkan dalam form
        return view('admin.broadcast.create', compact('list_satker', 'users'));
    }

    public function show($id)
    {
        // Temukan broadcast berdasarkan ID
        $broadcast = Broadcast::findOrFail($id);

        // Kirim data broadcast ke view
        return view('admin.broadcast.show', compact('broadcast'));
    }


    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            // 'kode_satker' => 'required|array', // Pastikan kode_satker adalah array
            // 'kode_satker.*' => 'required|string', // Setiap elemen dalam array harus berupa string
            'tanggal' => 'required|string',
            'judul_pesan' => 'required|string',
            'message' => 'required|string', // Pastikan pesan tidak kosong dan berupa string
            // ], [
            //     'Kode_satker' => 'Kode Satker Harus DiPilih',

        ], [
            'judul_pesan.required' => 'Field Judul Pesan Harus Di Isi',
            'tanggal.required' => 'Field Tanggal Pengiriman Judul Pesan Harus Di Isi',
            'message.required' => 'Field Pesan Harus Di Isi',
        ]);

        // Ambil data dari form
        $kodeSatkers = $request->input('kode_satker');
        $pesan = $request->input('message');

        // Buat array untuk menyimpan gabungan id_satker dan id_user
        $idsArray = [];
        $satkerNamesArray = [];

        foreach ($kodeSatkers as $kodeSatker) {
            // Ambil informasi satker berdasarkan kode satker
            $satker = Satker::where('kode_satker', $kodeSatker)->first();

            // Jika data satker ditemukan
            if ($satker) {
                // Ambil semua user yang memiliki id_satker yang sesuai dengan kode satker yang dipilih
                $users = User::where('id_satker', $satker->id)->get();

                // Jika user ditemukan
                if ($users->count() > 0) {
                    foreach ($users as $user) {
                        // Gabungkan id_satker dan id_user dalam satu string
                        $idsArray[] = $satker->id;
                        $satkerNamesArray[] = $satker->nama_satker;

                        // Ambil nomor telepon pengguna
                        $phoneNumber = $user->no_hp;

                        // Kirim pesan WhatsApp
                        $this->sendWhatsAppMessage($phoneNumber, $pesan);
                    }
                } else {
                    // Jika user tidak ditemukan
                    return redirect('admin/broadcast/create')->with('error', 'User tidak ditemukan untuk Satker yang dipilih: ' . $satker->nama_satker);
                }
            } else {
                // Jika data satker tidak ditemukan
                return redirect('admin/broadcast/create')->with('error', 'Satker tidak ditemukan.');
            }
        }

        // Simpan pesan ke dalam tabel broadcast
        $broadcast = new Broadcast();
        $broadcast->judul_pesan = $request->judul_pesan; // Pastikan judul_pesan tersedia di request
        $broadcast->tanggal = $request->tanggal; // Pastikan tanggal tersedia di request
        $broadcast->ids = implode(',', $idsArray); // Simpan gabungan id_satker dan id_user dalam satu kolom
        $broadcast->pesan = $pesan;
        $broadcast->save();

        // Kembalikan pesan sukses dengan nama-nama satker
        return redirect('admin/broadcast')->with('success', 'Pesan WhatsApp berhasil dikirim ke ' . implode(', ', $satkerNamesArray));
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
                'delay' => '5-10',
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            // Tangani kesalahan di sini, Anda dapat mencatatnya atau menampilkan pesan kesalahan kepada pengguna
            // Log::error('Error sending WhatsApp message: ' . $error_msg);
        }
        curl_close($curl);

        // Jika tidak ada kesalahan, tidak perlu melakukan apa pun karena pesan sudah berhasil dikirim

        return $response; // Mengembalikan respons dari API WhatsApp
    }

    function destroy(Broadcast $broadcast)
    {
        $broadcast->delete();

        return redirect('admin/broadcast')->with('danger', 'Data Berhasil Dihapus');
    }

    // public function filter(Request $request)
    // {
    //     // Validasi input jika diperlukan
    //     $request->validate([
    //         'judul_pesan' => 'nullable|string',
    //         'tanggal' => 'nullable|date',
    //     ]);

    //     // Ambil input dari form
    //     $judul_pesan = $request->input('judul_pesan');
    //     $tanggal = $request->input('tanggal');

    //     // Filter berdasarkan judul_pesan jika ada
    //     $list_broadcast = Broadcast::query();

    //     if ($judul_pesan) {
    //         $list_broadcast->where('judul_pesan', 'like', '%' . $judul_pesan . '%');
    //     }
    //     if ($tanggal) {
    //         // Ubah format tanggal dari 'd F Y' ke 'Y-m-d' untuk pencocokan database
    //         $tanggalDatabase = Carbon::parse($tanggal)->format('d F Y');
    //         $list_broadcast->where('tanggal', $tanggalDatabase);
    //     }


    //     // Ambil hasil query
    //     $data['list_broadcast'] = $list_broadcast->get();

    //     // Kembalikan view dengan data yang sudah difilter
    //     return view('admin.broadcast.index', $data);
    // }
}
