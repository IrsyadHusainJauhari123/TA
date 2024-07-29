<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satker;
use App\Models\User;
use App\Models\Blastwa;
use Illuminate\Support\Carbon;


class BlastWaController extends Controller
{
    public function index()
    {
        $data['list_blastwa'] = Blastwa::all();
        return view('admin.blastwa.index', $data);
    }

    public function create()
    {
        // Mengambil data user beserta relasinya dengan satker
        $list_data = User::whereHas('satker')->with('satker')->get();

        // Mengambil hanya kolom yang diperlukan dari satker
        $list_satker = $list_data->map(function ($user) {
            return [
                'id_satker' => $user->satker->id,
                'nama_satker' => $user->satker->nama_satker,
                'kode_satker' => $user->satker->kode_satker,
            ];
        });

        return view('admin.blastwa.create', compact('list_satker'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'kode_satker' => 'required|array', // Pastikan kode_satker adalah array
            'kode_satker.*' => 'required|string', // Setiap elemen dalam array harus berupa string
            'message' => 'required|string', // Pastikan pesan tidak kosong dan berupa string
            'judul_pesan' => 'required|string', // Validasi judul_pesan
            'tanggal' => 'required|date',
        ], [
            'kode_satker.required' => 'Kode Satker Harus DiPilih',
            'judul_pesan.required' => 'Field Judul Pesan Harus Di Isi',
            'tanggal.required' => 'Field Tanggal Pengiriman Judul Pesan Harus Di Isi',
            'message.required' => 'Field Pesan Harus Di Isi',
        ]);

        // Ambil data dari form
        $kodeSatkers = $request->input('kode_satker');
        $pesan = $request->input('message');

        // Buat array untuk menyimpan gabungan id_satker dan nama_satker
        $idsSatkerArray = [];
        $namaSatkerArray = [];

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
                        // Gabungkan id_satker dalam satu array
                        $idsSatkerArray[] = $satker->id; // Menyimpan ID satker
                        $namaSatkerArray[] = $satker->nama_satker; // Menyimpan nama satker

                        // Ambil nomor telepon pengguna
                        $phoneNumber = $user->no_hp;

                        // Kirim pesan WhatsApp
                        $this->sendWhatsAppMessage($phoneNumber, $pesan);
                    }
                } else {
                    // Jika user tidak ditemukan
                    return redirect('admin/blastwa/create')->with('error', 'User tidak ditemukan untuk Satker yang dipilih: ' . $satker->nama_satker);
                }
            } else {
                // Jika data satker tidak ditemukan
                return redirect('admin/blastwa/create')->with('error', 'Satker tidak ditemukan.');
            }
        }

        // Gabungkan semua ID satker dengan koma
        $idsSatker = implode(',', $idsSatkerArray);

        // Simpan pesan ke dalam tabel blastwa
        $blastwa = new Blastwa();
        $blastwa->judul_pesan = $request->input('judul_pesan');
        $blastwa->tanggal = $request->input('tanggal');
        $blastwa->ids = $idsSatker; // Simpan gabungan id_satker dalam satu kolom
        $blastwa->pesan = $pesan;
        $blastwa->save();

        // Kembalikan pesan sukses dengan nama Satker
        return redirect('admin/blastwa')->with('success', 'Pesan WhatsApp berhasil dikirim ke ' . implode(', ', $namaSatkerArray));
    }



    public function show($id)
    {
        // Temukan Blastwa berdasarkan ID
        $blastwa = Blastwa::findOrFail($id);

        // Kirim data Blastwa ke view
        return view('admin.blastwa.info', compact('blastwa'));
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

    function destroy(Blastwa $blastwa)
    {
        $blastwa->delete();

        return redirect('admin/blastwa')->with('danger', 'Data Berhasil Dihapus');
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
    //     $list_blastwa = Blastwa::query();

    //     if ($judul_pesan) {
    //         $list_blastwa->where('judul_pesan', 'like', '%' . $judul_pesan . '%');
    //     }
    //     if ($tanggal) {
    //         // Ubah format tanggal dari 'd F Y' ke 'Y-m-d' untuk pencocokan database
    //         $tanggalDatabase = Carbon::parse($tanggal)->format('d F Y');
    //         $list_blastwa->where('tanggal', $tanggalDatabase);
    //     }


    //     // Ambil hasil query
    //     $data['list_blastwa'] = $list_blastwa->get();

    //     // Kembalikan view dengan data yang sudah difilter
    //     return view('admin.blastwa.index', $data);
    // }
}
