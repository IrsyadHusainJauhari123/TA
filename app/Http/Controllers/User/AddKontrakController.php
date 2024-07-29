<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Satker;
use App\Models\User\Addk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddKontrakController extends Controller
{
    public function index()
    {
        // Mendapatkan ID satker dari pengguna yang saat ini masuk
        $id_satker = Auth::user()->id_satker;

        // Mengambil daftar LPJ yang terkait dengan satker pengguna saat ini
        $list_addkontrak = Addk::where('id_satker', $id_satker)
            ->where('status', 'DiProses...')
            ->get();

        return view('user.addkontrak.index', compact('list_addkontrak'));
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
        return view('user.addkontrak.create', compact('satkers', 'users', 'pegawais'));
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
                'jam_pengajuan.required' => 'Field Jam Mulai Harus Di Isi',
                'jam_selesai.required' => 'Field Jam Selesai Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;

            // Periksa status pegawai yang dipilih


            // Proses penyimpanan data SPD
            $addk = new Addk();
            $addk->jam_pengajuan = $validatedData['jam_pengajuan'];
            $addk->jam_selesai = $validatedData['jam_selesai'];
            $addk->status = 'DiProses...';
            $addk->status_ad = null;
            $addk->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $addk->jenis_pengajuan = 'Konsultasi Addedum Kontrak';
            $addk->id_pegawai = $validatedData['id_pegawai'];
            $addk->id_user = $id_user; // Sertakan nilai id_user
            $addk->id_satker = $id_satker; // Sertakan nilai id_satker

            // Sesuaikan dengan logika bisnis Anda untuk mengisi data yang diperlukan dari model lain seperti pegawai, satker, dll.

            // Simpan addk
            $addk->save();
            return redirect('user/addk')->with('success', 'Data Berhasil Ditambah');
        }
        // return redirect()->back()->with('error', 'Tidak dapat menambahkan LPJ. Akses ditolak.');
    }


    public function show($id)
    {
        $addk = Addk::findOrFail($id);
        return view('user.addkontrak.show', compact('addk'));
    }


    public function edit($id)
    {
        // Mengambil data LPJ berdasarkan ID
        $addk = Addk::findOrFail($id);

        // Mengambil semua data pegawai dengan jabatan CSo saja
        $pegawais = Pegawai::whereIn('jabatan', ['Customer Services', 'Customer Services Khusus'])->get();

        // Mengirimkan data addk dan pegawai ke view untuk proses edit
        return view('user.addkontrak.edit', compact('addk', 'pegawais'));
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
                'jam_pengajuan.required' => 'Field Jam Mulai Harus Di Isi',
                'jam_selesai.required' => 'Field  Jam Selesai Harus Di Isi',
                'id_pegawai.required' => 'Field Pegawai Harus Di Pilih',
                'tanggal_pengajuan.required' => 'Field Tanggal  Harus Di Pilih',
            ]);

            // Dapatkan id pengguna yang saat ini masuk
            $id_user = Auth::user()->id;
            $id_satker = Auth::user()->id_satker;

            // Temukan LPJ yang akan diperbarui
            $addk = Addk::findOrFail($id);

            // Perbarui atribut addk dengan data yang baru
            $addk->jam_pengajuan = $validatedData['jam_pengajuan'];
            $addk->jam_selesai = $validatedData['jam_selesai'];
            $addk->jenis_pengajuan = 'Konsultasi Addedum Kontrak';
            $addk->status = 'DiProses...';
            $addk->status_ad = null;
            $addk->tanggal_pengajuan = $validatedData['tanggal_pengajuan'];
            $addk->id_pegawai = $validatedData['id_pegawai'];
            $addk->id_user = $id_user; // Sertakan nilai id_user
            $addk->id_satker = $id_satker; // Sertakan nilai id_satker

            // Simpan perubahan pada addk
            $addk->save();

            return redirect('user/addk')->with('success', 'Data Berhasil Di Perbarui');
        }
        // return redirect()->back()->with('error', 'Tidak dapat memperbarui LPJ. Akses ditolak.');
    }

    public function destroy($id)
    {
        // Temukan LPJ berdasarkan ID
        $addk = Addk::findOrFail($id);

        // Hapus addk
        $addk->delete();

        // Redirect dengan pesan sukses
        return redirect('user/addk')->with('danger', 'Data Berhasil Dihapus');
    }
}
