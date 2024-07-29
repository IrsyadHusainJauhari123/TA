<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Spd;

class RiwayatSpdController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan spd yang diterima dan ditolak
        $spdDiterima = Spd::where('status', 'Di Terima')->get();
        $spdDitolak = Spd::where('status', 'Di Tolak')->get();

        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('admin.pengajuanselesai.riwayatspd.index', [
            'spdDiterima' => $spdDiterima,
            'spdDitolak' => $spdDitolak
        ]);
    }


    public function show($id)
    {
        $spd = Spd::with('pegawai')->findOrFail($id);

        return view('admin.pengajuanselesai.riwayatspd.show', compact('spd'));
    }

    public function destroy($id)
    {
        $spd = Spd::findOrFail($id);

        // Hapus spd
        $spd->delete();

        // Redirect dengan pesan sukses
        return redirect('admin/pengajuanselesai/riwayatspd')->with('danger', 'Data Berhasil Dihapus');
    }
}
