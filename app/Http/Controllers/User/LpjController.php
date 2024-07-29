<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User\Lpj;
use App\Models\Satker;
use App\Models\Pegawai;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class LpjController extends Controller
{
    public function index()
    {
        // Mendapatkan ID satker dari pengguna yang saat ini masuk
        $id_satker = Auth::user()->id_satker;

        // Mengambil daftar LPJ yang terkait dengan satker pengguna saat ini
        $list_lpj = Lpj::where('id_satker', $id_satker)
            ->where('status', 'DiProses...')
            ->get();

        return view('user.lpj.index', compact('list_lpj'));
    }

    public function create()
    {
        // Mengambil semua data satker
        $satkers = Satker::all();
        // Mengambil semua data user
        $users = User::all();
        // Mengambil semua data pegawai dengan jabtan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Customer Services', 'Customer Services Khusus'])->get();

        // Mengirimkan data satker, user, dan pegawai ke view
        return view('user.lpj.create', compact('satkers', 'users', 'pegawais'));
    }

    public function store(Request $request)
    {
        // Pengecekan apakah pengguna memiliki akses level satker
        if (Auth::user()->level == 'satker') {
            // Validasi data yang diterima dari formulir
            $validatedData = $request->validate([
                'jam_pengajuan' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:17:00',
                'jam_selesai' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:17:00',
                // 'tanggal_pengajuan' => 'required|date',
                'id_pegawai' => 'required',
                'tanggal_pengajuan' => 'required',
                // Sesuaikan aturan validasi dengan kebutuhan
            ], [
                'jam_pengajuan.required' => 'Field Nama Satker Harus Di Isi',
                'jam_selesai.required' => 'Field Kode Satker Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;


            // Proses penyimpanan data LPJ
            $lpj = new Lpj();
            $lpj->jam_pengajuan = $validatedData['jam_pengajuan'];
            $lpj->jam_selesai = $validatedData['jam_selesai'];
            $lpj->status = 'DiProses...';
            $lpj->status_ad = null;
            $lpj->tanggal_pengajuan = $request->tanggal_pengajuan;
            $lpj->jenis_pengajuan = 'Konsultasi LPJ';
            $lpj->id_pegawai = $validatedData['id_pegawai'];
            $lpj->id_user = $id_user; // Sertakan nilai id_user
            $lpj->id_satker = $id_satker; // Sertakan nilai id_satker

            // Sesuaikan dengan logika bisnis Anda untuk mengisi data yang diperlukan dari model lain seperti pegawai, satker, dll.

            // Simpan LPJ
            $lpj->save();
            return redirect('user/lpj')->with('success', 'Data Berhasil Di Tambah');
        }
        // return redirect()->back()->with('error', 'Tidak dapat menambahkan LPJ. Akses ditolak.');
    }

    public function show($id)
    {
        $lpj = LPJ::findOrFail($id);
        return view('user.lpj.info', compact('lpj'));
    }


    public function edit($id)
    {
        // Mengambil data LPJ berdasarkan ID
        $lpj = Lpj::findOrFail($id);

        // Mengambil semua data pegawai dengan jabatan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Customer Services', 'Customer Services Khusus'])->get();

        // Mengirimkan data LPJ dan pegawai ke view untuk proses edit
        return view('user.lpj.edit', compact('lpj', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        // Pengecekan apakah pengguna memiliki akses level satker
        if (Auth::user()->level == 'satker') {
            // Validasi data yang diterima dari formulir
            $validatedData = $request->validate([
                'jam_pengajuan' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i',
                'tanggal_pengajuan' => 'required',
                'id_pegawai' => 'required',
                // Sesuaikan aturan validasi dengan kebutuhan
            ],  [
                'jam_pengajuan.required' => 'Field Nama Satker Harus Di Isi',
                'jam_selesai.required' => 'Field Kode Satker Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;

            // Temukan LPJ yang akan diperbarui
            $lpj = Lpj::findOrFail($id);

            // Perbarui atribut LPJ dengan data yang baru
            $lpj->jam_pengajuan = $validatedData['jam_pengajuan'];
            $lpj->jam_selesai = $validatedData['jam_selesai'];
            $lpj->jenis_pengajuan = 'Konsultasi LPJ';
            $lpj->status = 'DiProses...';
            $lpj->status_ad = null;
            $lpj->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $lpj->id_pegawai = $validatedData['id_pegawai'];
            $lpj->id_user = $id_user; // Sertakan nilai id_user
            $lpj->id_satker = $id_satker; // Sertakan nilai id_satker

            // Simpan perubahan pada LPJ
            $lpj->save();

            return redirect('user/lpj')->with('success', 'Data Berhasil Di Perbarui');
        }
        // return redirect()->back()->with('error', 'Tidak dapat memperbarui LPJ. Akses ditolak.');
    }

    public function destroy($id)
    {
        // Temukan LPJ berdasarkan ID
        $lpj = LPJ::findOrFail($id);

        // Hapus LPJ
        $lpj->delete();

        // Redirect dengan pesan sukses
        return redirect('user/lpj')->with('danger', 'Data Berhasil Dihapus');
    }
}
