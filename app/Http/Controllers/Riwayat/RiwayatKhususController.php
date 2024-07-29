<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Khusus;

class RiwayatKhususController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan khusus yang diterima dan ditolak
        $khususDiterima = khusus::where('status', 'Di Terima')->get();
        $khususDitolak = khusus::where('status', 'Di Tolak')->get();

        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('admin.pengajuankhususselesai.index', [
            'khususDiterima' => $khususDiterima,
            'khususDitolak' => $khususDitolak
        ]);
    }


    public function show($id)
    {
        $khusus = khusus::with('pegawai')->findOrFail($id);

        return view('admin.pengajuankhususselesai.show', compact('khusus'));
    }

    public function destroy($id)
    {
        $khusus = khusus::findOrFail($id);

        // Hapus khusus
        $khusus->delete();

        // Redirect dengan pesan sukses
        return redirect('admin/pengajuankhusus/khususselesai')->with('danger', 'Data Berhasil Dihapus');
    }
}
