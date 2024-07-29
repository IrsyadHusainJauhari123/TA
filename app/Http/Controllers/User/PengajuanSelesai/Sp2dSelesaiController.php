<?php

namespace App\Http\Controllers\User\PengajuanSelesai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Sp2d;
use Illuminate\Support\Facades\Auth;

class Sp2dSelesaiController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan LPJ yang diterima dan ditolak
        $id_satker = Auth::user()->id_satker;
        $sp2dDiterima = Sp2d::where('status', 'Di Terima')
            ->where('id_satker', $id_satker)
            ->get();

        $sp2dDitolak = Sp2d::where('status', 'Di Tolak')
            ->where('id_satker', $id_satker)
            ->get();



        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('user.pengajuanselesai.sp2d.index', [
            'sp2dDiterima' => $sp2dDiterima,
            'sp2dDitolak' => $sp2dDitolak
        ]);
    }
}
