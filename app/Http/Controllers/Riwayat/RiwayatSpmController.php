<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Spm;

class RiwayatSpmController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan spm yang diterima dan ditolak
        $spmDiterima = Spm::where('status', 'Di Terima')->get();
        $spmDitolak = Spm::where('status', 'Di Tolak')->get();

        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('admin.pengajuanselesai.riwayatspm.index', [
            'spmDiterima' => $spmDiterima,
            'spmDitolak' => $spmDitolak
        ]);
    }


    public function show($id)
    {
        $spm = Spm::with('pegawai')->findOrFail($id);

        return view('admin.pengajuanselesai.riwayatspm.show', compact('spm'));
    }

    public function destroy($id)
    {
        $spm = Spm::findOrFail($id);

        // Hapus spm
        $spm->delete();

        // Redirect dengan pesan sukses
        return redirect('admin/pengajuanselesai/riwayatspm')->with('danger', 'Data Berhasil Dihapus');
    }
}
