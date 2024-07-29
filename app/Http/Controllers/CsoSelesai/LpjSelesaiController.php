<?php

namespace App\Http\Controllers\CsoSelesai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LpjSelesaiController extends Controller
{
    public function index()
    {
        return view('admin.pengajuanselesai.lpj.index');
    }
}
