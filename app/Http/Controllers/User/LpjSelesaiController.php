<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Lpj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LpjSelesaiController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan LPJ yang diterima dan ditolak
        $id_satker = Auth::user()->id_satker;
        $lpjDiterima = Lpj::where('status', 'Di Terima')
            ->where('id_satker', $id_satker)
            ->get();

        $lpjDitolak = Lpj::where('status', 'Di Tolak')
            ->where('id_satker', $id_satker)
            ->get();


        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('user.lpjselesai.index', [
            'lpjDiterima' => $lpjDiterima,
            'lpjDitolak' => $lpjDitolak
        ]);
    }


    // public function getTotalProses()
    // {
    //     $list_total_proses = LPJ::whereIn('status', ['Di Terima', 'Di Tolak'])->count();
    //     return response()->json(['count' => $list_total_proses]);
    // }

    // public function getTotalLPJProses()
    // {
    //     $list_lpjuser_proses = LPJ::whereIn('status', ['Di Terima', 'Di Tolak'])->count();
    //     return response()->json(['count' => $list_lpjuser_proses]);
    // }

    public function getTotalProses()
    {
        $count = Lpj::where('status_ad', 'Di Terima')->count();
        return response()->json(['count' => $count]);
    }
}
