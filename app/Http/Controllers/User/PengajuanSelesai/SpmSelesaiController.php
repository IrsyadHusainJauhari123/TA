<?php

namespace App\Http\Controllers\User\PengajuanSelesai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Spm;
use Illuminate\Support\Facades\Auth;

class SpmSelesaiController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan LPJ yang diterima dan ditolak
        $id_satker = Auth::user()->id_satker;
        $spmDiterima = Spm::where('status', 'Di Terima')
            ->where('id_satker', $id_satker)
            ->get();

        $spmDitolak = Spm::where('status', 'Di Tolak')
            ->where('id_satker', $id_satker)
            ->get();



        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('user.pengajuanselesai.spm.index', [
            'spmDiterima' => $spmDiterima,
            'spmDitolak' => $spmDitolak
        ]);
    }
}
