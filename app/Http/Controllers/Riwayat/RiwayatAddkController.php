<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Addk;

class RiwayatAddkController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan addk yang diterima dan ditolak
        $addkDiterima = Addk::where('status', 'Di Terima')->get();
        $addkDitolak = Addk::where('status', 'Di Tolak')->get();

        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('admin.pengajuanselesai.riwayataddk.index', [
            'addkDiterima' => $addkDiterima,
            'addkDitolak' => $addkDitolak
        ]);
    }


    public function show($id)
    {
        $addk = Addk::with('pegawai')->findOrFail($id);

        return view('admin.pengajuanselesai.riwayataddk.show', compact('addk'));
    }

    public function destroy($id)
    {
        $addk = Addk::findOrFail($id);

        // Hapus addk
        $addk->delete();

        // Redirect dengan pesan sukses
        return redirect('admin/pengajuanselesai/riwayataddk')->with('danger', 'Data Berhasil Dihapus');
    }
}
