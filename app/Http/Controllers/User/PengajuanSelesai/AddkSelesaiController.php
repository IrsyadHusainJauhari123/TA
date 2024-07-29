<?php

namespace App\Http\Controllers\User\PengajuanSelesai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Addk;
use Illuminate\Support\Facades\Auth;

class AddkSelesaiController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan LPJ yang diterima dan ditolak
        $id_satker = Auth::user()->id_satker;
        $addkDiterima = Addk::where('status', 'Di Terima')
            ->where('id_satker', $id_satker)
            ->get();

        $addkDitolak = Addk::where('status', 'Di Tolak')
            ->where('id_satker', $id_satker)
            ->get();



        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('user.pengajuanselesai.addk.index', [
            'addkDiterima' => $addkDiterima,
            'addkDitolak' => $addkDitolak
        ]);
    }
}
