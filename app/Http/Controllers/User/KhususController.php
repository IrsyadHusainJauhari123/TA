<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satker;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\User\Khusus;
use Illuminate\Support\Facades\Auth;
use Laravel\Prompts\Key;

class KhususController extends Controller
{
    public function index()
    {
        // Mendapatkan ID satker dari pengguna yang saat ini masuk
        $id_satker = Auth::user()->id_satker;

        // Mengambil daftar LPJ yang terkait dengan satker pengguna saat ini
        $list_khusus = Khusus::where('id_satker', $id_satker)
            ->where('status', 'DiProses...')
            ->get();

        return view('user.khusus.index', compact('list_khusus'));
    }


    public function create()
    {
        // Mengambil semua data satker
        $satkers = Satker::all();
        // Mengambil semua data user
        $users = User::all();
        // Mengambil semua data pegawai dengan jabtan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Kasubag', 'Bank', 'Pdms', 'Bendahara', 'Pelaksana'])->get();

        // Mengirimkan data satker, user, dan pegawai ke view
        return view('user.khusus.create', compact('satkers', 'users', 'pegawais'));
    }

    public function store(Request $request)
    {
        // Pengecekan apakah pengguna memiliki akses level satker
        if (Auth::user()->level == 'satker') {
            // Validasi data yang diterima dari formulir
            $validatedData = $request->validate([
                'jam_pengajuan' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:17:00',
                'jam_selesai' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:17:00',
                'tanggal_pengajuan' => 'required|date',
                'id_pegawai' => 'required',
                'alasan_pengajuan' => 'required',
                // Sesuaikan aturan validasi dengan kebutuhan
            ],  [
                'jam_pengajuan.required' => 'Field Nama Satker Harus Di Isi',
                'jam_selesai.required' => 'Field Kode Satker Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
                'alasan_pengajuan.required' => 'Field Alasan Harus Di Isi',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;


            // Proses penyimpanan data LPJ
            $khusus = new Khusus();
            $khusus->jam_pengajuan = $validatedData['jam_pengajuan'];
            $khusus->jam_selesai = $validatedData['jam_selesai'];
            $khusus->status = 'DiProses...';
            $khusus->status_ad = null;
            $khusus->alasan_pengajuan = $request->alasan_pengajuan;
            $khusus->tanggal_pengajuan = $request->tanggal_pengajuan;
            $khusus->jenis_pengajuan = 'Konsultasi Pengajuan Khusus';
            $khusus->id_pegawai = $validatedData['id_pegawai'];
            $khusus->id_user = $id_user; // Sertakan nilai id_user
            $khusus->id_satker = $id_satker; // Sertakan nilai id_satker

            // Sesuaikan dengan logika bisnis Anda untuk mengisi data yang diperlukan dari model lain seperti pegawai, satker, dll.

            // Simpan khusus
            $khusus->save();
            return redirect('user/khusus')->with('success', 'Data Berhasil Di Tambah');
        }
        // return redirect()->back()->with('error', 'Tidak dapat menambahkan LPJ. Akses ditolak.');
    }

    public function show($id)
    {
        $khusus = Khusus::findOrFail($id);
        return view('user.khusus.info', compact('khusus'));
    }


    public function edit($id)
    {
        // Mengambil data LPJ berdasarkan ID
        $khusus = Khusus::findOrFail($id);

        // Mengambil semua data pegawai dengan jabatan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Kasubag', 'Bank', 'Pdms', 'Bendahara', 'Pelaksana'])->get();

        // Mengirimkan data khusus dan pegawai ke view untuk proses edit
        return view('user.khusus.edit', compact('khusus', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        // Pengecekan apakah pengguna memiliki akses level satker
        if (Auth::user()->level == 'satker') {
            // Validasi data yang diterima dari formulir
            $validatedData = $request->validate([
                'jam_pengajuan' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i',
                'tanggal_pengajuan' => 'required|date',
                'id_pegawai' => 'required',
                'alasan_pengajuan' => 'required'
                // Sesuaikan aturan validasi dengan kebutuhan
            ],  [
                'jam_pengajuan.required' => 'Field Nama Satker Harus Di Isi',
                'jam_selesai.required' => 'Field Kode Satker Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
                'alasan_pengajuan.required' => 'Field Alasan Harus Di Isi',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;

            // Temukan LPJ yang akan diperbarui
            $khusus = Khusus::findOrFail($id);

            // Perbarui atribut khusus dengan data yang baru
            $khusus->jam_pengajuan = $validatedData['jam_pengajuan'];
            $khusus->jam_selesai = $validatedData['jam_selesai'];
            $khusus->jenis_pengajuan = 'Konsultasi';
            $khusus->alasan_pengajuan = $request->alasan_pengajuan;
            $khusus->status = 'DiProses...';
            $khusus->status_ad = null;
            $khusus->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $khusus->id_pegawai = $validatedData['id_pegawai'];
            $khusus->id_user = $id_user; // Sertakan nilai id_user
            $khusus->id_satker = $id_satker; // Sertakan nilai id_satker

            // Simpan perubahan pada khusus
            $khusus->save();

            return redirect('user/khusus')->with('success', 'Data Berhasil Di Perbarui');
        }
        // return redirect()->back()->with('error', 'Tidak dapat memperbarui LPJ. Akses ditolak.');
    }

    public function destroy($id)
    {
        // Temukan LPJ berdasarkan ID
        $khusus = Khusus::findOrFail($id);

        // Hapus LPJ
        $khusus->delete();

        // Redirect dengan pesan sukses
        return redirect('user/khusus')->with('danger', 'Data Berhasil Dihapus');
    }
}
