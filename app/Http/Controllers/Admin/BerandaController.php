<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Lpj;
use App\Models\User\Sp2d;
use App\Models\User\Spd;
use App\Models\User\Spm;
use App\Models\User\Addk;
use Illuminate\Support\Carbon;
use App\Models\User\Khusus;
use App\Models\Satker;
use App\Models\Broadcast;
use App\Models\BlastWa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Laravel\Prompts\Key;

class BerandaController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $currentMonth1 = Carbon::now()->month;
        $currentYear1 = Carbon::now()->year;

        $addkCount = Addk::where('status_ad', 'Di Terima')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();

        $lpjCount = Lpj::where('status_ad', 'Di Terima')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();

        $spmCount = Spm::where('status_ad', 'Di Terima')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();

        $sp2dCount = Sp2d::where('status_ad', 'Di Terima')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();

        $spdCount = Spd::where('status_ad', 'Di Terima')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();

        $totalCount = $addkCount + $lpjCount + $spmCount + $sp2dCount + $spdCount;

        $satker = Satker::count();

        $khusus = khusus::where('status_ad', 'Di Terima')
            ->whereMonth('updated_at', $currentMonth)
            ->whereYear('updated_at', $currentYear)
            ->count();

        $blastwaCount = BlastWa::whereMonth('updated_at', $currentMonth1)
            ->whereYear('updated_at', $currentYear1)
            ->count();

        // Count Broadcast records updated this month and year
        $broadcastCount = Broadcast::whereMonth('updated_at', $currentMonth1)
            ->whereYear('updated_at', $currentYear1)
            ->count();

        // Calculate total count of messages sent this month
        $pesanCount = $blastwaCount + $broadcastCount;






        return view('admin.beranda.index', compact('totalCount', 'satker', 'khusus', 'pesanCount'));
    }
}
