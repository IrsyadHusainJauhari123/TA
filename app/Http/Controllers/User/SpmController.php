<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Spm;
use App\Models\Satker;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SpmController extends Controller
{

    public function index()
    {
        // Mendapatkan ID satker dari pengguna yang saat ini masuk
        $id_satker = Auth::user()->id_satker;

        // Mengambil daftar LPJ yang terkait dengan satker pengguna saat ini
        $list_spm = Spm::where('id_satker', $id_satker)
            ->where('status', 'DiProses...')
            ->get();

        return view('user.spm.index', compact('list_spm'));
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
        return view('user.spm.create', compact('satkers', 'users', 'pegawais'));
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


            // Proses penyimpanan data LPJ
            $spm = new Spm();
            $spm->jam_pengajuan = $validatedData['jam_pengajuan'];
            $spm->jam_selesai = $validatedData['jam_selesai'];
            $spm->status = 'DiProses...';
            $spm->status_ad = null;
            $spm->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $spm->jenis_pengajuan = 'Konsultasi SPM';
            $spm->id_pegawai = $validatedData['id_pegawai'];
            $spm->id_user = $id_user; // Sertakan nilai id_user
            $spm->id_satker = $id_satker; // Sertakan nilai id_satker

            // Sesuaikan dengan logika bisnis Anda untuk mengisi data yang diperlukan dari model lain seperti pegawai, satker, dll.

            // Simpan spm
            $spm->save();
            return redirect('user/spm')->with('success', 'Data Berhasil Di Tambah');
        }
        // return redirect()->back()->with('error', 'Tidak dapat menambahkan LPJ. Akses ditolak.');
    }

    public function show($id)
    {
        $spm = Spm::findOrFail($id);
        return view('user.spm.show', compact('spm'));
    }


    public function edit($id)
    {
        // Mengambil data LPJ berdasarkan ID
        $spm = Spm::findOrFail($id);

        // Mengambil semua data pegawai dengan jabatan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Customer Services', 'Customer Services Khusus'])->get();

        // Mengirimkan data spm dan pegawai ke view untuk proses edit
        return view('user.spm.edit', compact('spm', 'pegawais'));
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
            $spm = Spm::findOrFail($id);

            // Perbarui atribut spm dengan data yang baru
            $spm->jam_pengajuan = $validatedData['jam_pengajuan'];
            $spm->jam_selesai = $validatedData['jam_selesai'];
            $spm->jenis_pengajuan = 'Konsultasi spm';
            $spm->status = 'DiProses...';
            $spm->status_ad = null;
            $spm->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $spm->id_pegawai = $validatedData['id_pegawai'];
            $spm->id_user = $id_user; // Sertakan nilai id_user
            $spm->id_satker = $id_satker; // Sertakan nilai id_satker

            // Simpan perubahan pada spm
            $spm->save();

            return redirect('user/spm')->with('success', 'Data Berhasil Di Perbarui');
        }
        // return redirect()->back()->with('error', 'Tidak dapat memperbarui LPJ. Akses ditolak.');
    }

    public function destroy($id)
    {
        // Temukan LPJ berdasarkan ID
        $spm = Spm::findOrFail($id);

        // Hapus spm
        $spm->delete();

        // Redirect dengan pesan sukses
        return redirect('user/spm')->with('danger', 'Data Berhasil Dihapus');
    }
}
