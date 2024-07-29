<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User\Lpj;
use Illuminate\Support\Carbon;

class RiwayatLpjController extends Controller
{

    public function index()
    {
        // Mengambil data pengajuan LPJ yang diterima dan ditolak
        $lpjDiterima = Lpj::where('status', 'Di Terima')->get();
        $lpjDitolak = Lpj::where('status', 'Di Tolak')->get();

        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('admin.pengajuanselesai.riwayatlpj.index', [
            'lpjDiterima' => $lpjDiterima,
            'lpjDitolak' => $lpjDitolak
        ]);
    }


    public function show($id)
    {
        $lpj = Lpj::with('pegawai')->findOrFail($id);

        return view('admin.pengajuanselesai.riwayatlpj.show', compact('lpj'));
    }

    public function destroy($id)
    {
        $lpj = Lpj::findOrFail($id);

        // Hapus LPJ
        $lpj->delete();

        // Redirect dengan pesan sukses
        return redirect('admin/pengajuanselesai/riwayatlpj')->with('danger', 'Data Berhasil Dihapus');
    }
}
