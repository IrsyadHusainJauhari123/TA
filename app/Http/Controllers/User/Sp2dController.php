<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Satker;
use App\Models\User\Sp2d;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Sp2dController extends Controller
{
    public function index()
    {
        // Mendapatkan ID satker dari pengguna yang saat ini masuk
        $id_satker = Auth::user()->id_satker;

        // Mengambil daftar LPJ yang terkait dengan satker pengguna saat ini
        $list_sp2d = Sp2d::where('id_satker', $id_satker)
            ->where('status', 'DiProses...')
            ->get();

        return view('user.sp2d.index', compact('list_sp2d'));
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
        return view('user.sp2d.create', compact('satkers', 'users', 'pegawais'));
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
                'id_pegawai' => 'required|exists:pegawai,id',
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
            $sp2d = new Sp2d();
            $sp2d->jam_pengajuan = $validatedData['jam_pengajuan'];
            $sp2d->jam_selesai = $validatedData['jam_selesai'];
            $sp2d->status = 'DiProses...';
            $sp2d->status_ad = null;
            $sp2d->tanggal_pengajuan = Carbon::now()->format('Y-m-d');
            $sp2d->jenis_pengajuan = 'Konsultasi SP2D';
            $sp2d->id_pegawai = $validatedData['id_pegawai'];
            $sp2d->id_user = $id_user; // Sertakan nilai id_user
            $sp2d->id_satker = $id_satker; // Sertakan nilai id_satker

            // Sesuaikan dengan logika bisnis Anda untuk mengisi data yang diperlukan dari model lain seperti pegawai, satker, dll.

            // Simpan sp2d
            $sp2d->save();
            return redirect('user/sp2d')->with('success', 'Data Berhasil Di Tambah');
        }
        // return redirect()->back()->with('error', 'Tidak dapat menambahkan LPJ. Akses ditolak.');
    }

    public function show($id)
    {
        $sp2d = Sp2d::findOrFail($id);
        return view('user.sp2d.show', compact('sp2d'));
    }


    public function edit($id)
    {
        // Mengambil data LPJ berdasarkan ID
        $sp2d = Sp2d::findOrFail($id);

        // Mengambil semua data pegawai dengan jabatan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Customer Services', 'Customer Services Khusus'])->get();

        // Mengirimkan data sp2d dan pegawai ke view untuk proses edit
        return view('user.sp2d.edit', compact('sp2d', 'pegawais'));
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
            ], [
                'jam_pengajuan.required' => 'Field Nama Satker Harus Di Isi',
                'jam_selesai.required' => 'Field Kode Satker Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;

            // Temukan LPJ yang akan diperbarui
            $sp2d = Sp2d::findOrFail($id);

            // Perbarui atribut sp2d dengan data yang baru
            $sp2d->jam_pengajuan = $validatedData['jam_pengajuan'];
            $sp2d->jam_selesai = $validatedData['jam_selesai'];
            $sp2d->jenis_pengajuan = 'Konsultasi SP2D';
            $sp2d->status = 'DiProses...';
            $sp2d->status_ad = null;
            $sp2d->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $sp2d->id_pegawai = $validatedData['id_pegawai'];
            $sp2d->id_user = $id_user; // Sertakan nilai id_user
            $sp2d->id_satker = $id_satker; // Sertakan nilai id_satker

            // Simpan perubahan pada sp2d
            $sp2d->save();

            return redirect('user/sp2d')->with('success', 'Data Berhasil Di Perbarui');
        }
        // return redirect()->back()->with('error', 'Tidak dapat memperbarui LPJ. Akses ditolak.');
    }

    public function destroy($id)
    {
        // Temukan LPJ berdasarkan ID
        $sp2d = Sp2d::findOrFail($id);

        // Hapus sp2d
        $sp2d->delete();

        // Redirect dengan pesan sukses
        return redirect('user/sp2d')->with('danger', 'Data Berhasil Dihapus');
    }
}
