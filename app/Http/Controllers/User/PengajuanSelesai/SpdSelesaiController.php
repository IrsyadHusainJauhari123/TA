<?php

namespace App\Http\Controllers\User\PengajuanSelesai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Spd;
use Illuminate\Support\Facades\Auth;

class SpdSelesaiController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan LPJ yang diterima dan ditolak
        $id_satker = Auth::user()->id_satker;
        $spdDiterima = Spd::where('status', 'Di Terima')
            ->where('id_satker', $id_satker)
            ->get();

        $spdDitolak = Spd::where('status', 'Di Tolak')
            ->where('id_satker', $id_satker)
            ->get();



        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('user.pengajuanselesai.spd.index', [
            'spdDiterima' => $spdDiterima,
            'spdDitolak' => $spdDitolak
        ]);
    }
}
