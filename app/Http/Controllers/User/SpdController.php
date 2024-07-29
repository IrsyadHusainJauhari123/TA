<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Satker;
use App\Models\User\Spd;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpdController extends Controller
{
    public function index()
    {
        // Mendapatkan ID satker dari pengguna yang saat ini masuk
        $id_satker = Auth::user()->id_satker;

        // Mengambil daftar LPJ yang terkait dengan satker pengguna saat ini
        $list_spd = Spd::where('id_satker', $id_satker)
            ->where('status', 'DiProses...')
            ->get();

        return view('user.spd.index', compact('list_spd'));
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
        return view('user.spd.create', compact('satkers', 'users', 'pegawais'));
    }

    public function store(Request $request)
    {
        // Pengecekan apakah pengguna memiliki akses level satker
        if (Auth::user()->level == 'satker') {
            // Validasi data yang diterima dari formulir
            $validatedData = $request->validate([
                'jam_pengajuan' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:17:00',
                'jam_selesai' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:17:00',
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

            // Periksa status pegawai yang dipilih


            // Proses penyimpanan data SPD
            $spd = new Spd();
            $spd->jam_pengajuan = $validatedData['jam_pengajuan'];
            $spd->jam_selesai = $validatedData['jam_selesai'];
            $spd->status = 'DiProses...';
            $spd->status_ad = null;
            $spd->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $spd->jenis_pengajuan = 'Konsultasi SPD';
            $spd->id_pegawai = $validatedData['id_pegawai'];
            $spd->id_user = $id_user; // Sertakan nilai id_user
            $spd->id_satker = $id_satker; // Sertakan nilai id_satker

            // Sesuaikan dengan logika bisnis Anda untuk mengisi data yang diperlukan dari model lain seperti pegawai, satker, dll.

            // Simpan SPD
            $spd->save();
            return redirect('user/spd')->with('success', 'Data Berhasil Di Tambah');
        }
        // return redirect()->back()->with('error', 'Tidak dapat menambahkan LPJ. Akses ditolak.');
    }


    public function show($id)
    {
        $spd = Spd::findOrFail($id);
        return view('user.spd.show', compact('spd'));
    }


    public function edit($id)
    {
        // Mengambil data LPJ berdasarkan ID
        $spd = Spd::findOrFail($id);

        // Mengambil semua data pegawai dengan jabatan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Customer Services', 'Customer Services Khusus'])->get();

        // Mengirimkan data spd dan pegawai ke view untuk proses edit
        return view('user.spd.edit', compact('spd', 'pegawais'));
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
                'id_pegawai' => 'required|exists:pegawai,id',
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
            $spd = Spd::findOrFail($id);

            // Perbarui atribut spd dengan data yang baru
            $spd->jam_pengajuan = $validatedData['jam_pengajuan'];
            $spd->jam_selesai = $validatedData['jam_selesai'];
            $spd->jenis_pengajuan = 'Konsultasi SPD';
            $spd->status = 'DiProses...';
            $spd->status_ad = null;
            $spd->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $spd->id_pegawai = $validatedData['id_pegawai'];
            $spd->id_user = $id_user; // Sertakan nilai id_user
            $spd->id_satker = $id_satker; // Sertakan nilai id_satker

            // Simpan perubahan pada spd
            $spd->save();

            return redirect('user/spd')->with('success', 'Data Berhasil Di Perbarui');
        }
        // return redirect()->back()->with('error', 'Tidak dapat memperbarui LPJ. Akses ditolak.');
    }

    public function destroy($id)
    {
        // Temukan LPJ berdasarkan ID
        $spd = Spd::findOrFail($id);

        // Hapus spd
        $spd->delete();

        // Redirect dengan pesan sukses
        return redirect('user/spd')->with('danger', 'Data Berhasil Dihapus');
    }
}
