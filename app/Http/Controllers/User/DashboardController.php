<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Satker;
use App\Models\Calender2;
use App\Models\User\Khusus;
use Illuminate\Support\Carbon;
use App\Models\User\Lpj;
use App\Models\User\Sp2d;
use App\Models\User\Addk;
use App\Models\User\Spd;
use App\Models\User\Spm;
use App\Models\Calender1;

class DashboardController extends Controller
{

    public function index()
    {
        $list_khusus = Khusus::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $calendarData = Calender2::orderByRaw('CASE WHEN tanggal_pengajuan = ? THEN 0 ELSE 1 END', [Carbon::today()->toDateString()])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();


        return view('user.dashboard.index', compact('list_khusus', 'calendarData'));
    }

    // Controller methods
    public function getSatkerByDate2(Request $request, $tanggal_pengajuan)
    {
        // Convert date to required format
        $tanggal_pengajuan = date('d F Y', strtotime($tanggal_pengajuan));
        $calendarEntries = Calender1::where('tanggal_pengajuan', $tanggal_pengajuan)->get();

        // Initialize array to store data
        $data = [];

        // Loop through each calendar entry
        foreach ($calendarEntries as $calendarEntry) {
            // Get related LPJ data along with pegawai and satker
            $lpj = LPJ::with(['pegawai', 'satker'])->find($calendarEntry->id_lpj);
            if ($lpj) {
                $data['lpj'][] = $lpj;
            }

            // Get related SPD data
            $spd = Spd::with(['pegawai', 'satker'])->find($calendarEntry->id_spd);
            if ($spd) {
                $data['spd'][] = $spd;
            }

            $sp2d = SP2d::with(['pegawai', 'satker'])->find($calendarEntry->id_sp2d);
            if ($sp2d) {
                $data['sp2d'][] = $sp2d;
            }

            $spm = Spm::with(['pegawai', 'satker'])->find($calendarEntry->id_spm);
            if ($spm) {
                $data['spm'][] = $spm;
            }

            $addk = Addk::with(['pegawai', 'satker'])->find($calendarEntry->id_addk);
            if ($addk) {
                $data['addk'][] = $addk;
            }
        }

        // Return data in JSON format
        return response()->json($data);
    }

    public function getEventData2()
    {
        // Get calendar entries
        $calendarEntries = Calender1::all();
        $events = [];

        // Get current date and time
        $currentDateTime = date('Y-m-d H:i');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');

        // Loop through each calendar entry
        foreach ($calendarEntries as $calendarEntry) {
            $satker = Satker::find($calendarEntry->id_satker);
            $lpj = Lpj::find($calendarEntry->id_lpj);
            $addk = Addk::find($calendarEntry->id_addk);
            $spm = Spm::find($calendarEntry->id_spm);
            $spd = Spd::find($calendarEntry->id_spd);
            $sp2d = Sp2d::find($calendarEntry->id_sp2d);

            // Determine event title
            $eventTitle = $lpj ? $lpj->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '') : '';
            $eventTitle = $addk ? $addk->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '') : $eventTitle;
            $eventTitle = $spm ? $spm->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '') : $eventTitle;
            $eventTitle = $spd ? $spd->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '') : $eventTitle;
            $eventTitle = $sp2d ? $sp2d->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '') : $eventTitle;

            // Determine event color based on time
            $eventColor = $calendarEntry->color;
            $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
            $startTime = $lpj ? date('H:i', strtotime($lpj->jam_pengajuan)) : '';
            $endTime = $lpj ? date('H:i', strtotime($lpj->jam_selesai)) : '';
            $startTime = $addk ? date('H:i', strtotime($addk->jam_pengajuan)) : $startTime;
            $endTime = $addk ? date('H:i', strtotime($addk->jam_selesai)) : $endTime;
            $startTime = $spm ? date('H:i', strtotime($spm->jam_pengajuan)) : $startTime;
            $endTime = $spm ? date('H:i', strtotime($spm->jam_selesai)) : $endTime;
            $startTime = $spd ? date('H:i', strtotime($spd->jam_pengajuan)) : $startTime;
            $endTime = $spd ? date('H:i', strtotime($spd->jam_selesai)) : $endTime;
            $startTime = $sp2d ? date('H:i', strtotime($sp2d->jam_pengajuan)) : $startTime;
            $endTime = $sp2d ? date('H:i', strtotime($sp2d->jam_selesai)) : $endTime;

            if ($currentDate == $eventDate) {
                if ($currentTime >= $startTime && $currentTime <= $endTime) {
                    $eventColor = 'yellow';
                } elseif ($currentTime > $endTime) {
                    $eventColor = 'green';
                } else {
                    $eventColor = 'red';
                }
            } elseif ($currentDate < $eventDate) {
                $eventColor = 'red';
            } elseif ($currentDate > $eventDate) {
                $eventColor = 'green';
            }

            // Update color in database
            $calendarEntry->color = $eventColor;
            $calendarEntry->save();

            // Format date for calendar plugin
            $eventStartDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));

            // Add event data to events array
            $events[] = [
                'title' => $eventTitle,
                'start' => $eventStartDate,
                'color' => $eventColor,
            ];
        }

        // Return events data in JSON format
        return response()->json($events);
    }

    public function getSatkerByDate1(Request $request, $tanggal_pengajuan)
    {
        // Convert date to required format
        $tanggal_pengajuan = date('d F Y', strtotime($tanggal_pengajuan));

        // Get calendar entries
        $calendarEntries = Calender2::where('tanggal_pengajuan', $tanggal_pengajuan)->get();
        $data = [];

        // Loop through each calendar entry
        foreach ($calendarEntries as $calendarEntry) {
            $khusus = Khusus::with(['pegawai', 'satker'])->find($calendarEntry->id_khusus);
            if ($khusus) {
                $data['khusus'][] = $khusus;
            }
        }

        // Return data in JSON format
        return response()->json($data);
    }

    public function getEventData1()
    {
        // Get calendar entries
        $calendarEntries = Calender2::all();
        $events = [];

        // Get current date and time
        $currentDateTime = date('Y-m-d H:i');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');

        // Loop through each calendar entry
        foreach ($calendarEntries as $calendarEntry) {
            $satker = Satker::find($calendarEntry->id_satker);
            $khusus = Khusus::find($calendarEntry->id_khusus);

            // Determine event title
            $eventTitle = $khusus ? $khusus->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '') : '';

            // Determine event color based on time
            $eventColor = $calendarEntry->color;
            $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
            $startTime = $khusus ? date('H:i', strtotime($khusus->jam_pengajuan)) : '';
            $endTime = $khusus ? date('H:i', strtotime($khusus->jam_selesai)) : '';

            if ($currentDate == $eventDate) {
                if ($currentTime >= $startTime && $currentTime <= $endTime) {
                    $eventColor = 'yellow';
                } elseif ($currentTime > $endTime) {
                    $eventColor = 'green';
                } else {
                    $eventColor = 'red';
                }
            } elseif ($currentDate < $eventDate) {
                $eventColor = 'red';
            } elseif ($currentDate > $eventDate) {
                $eventColor = 'green';
            }

            // Update color in database
            $calendarEntry->color = $eventColor;
            $calendarEntry->save();

            // Format date for calendar plugin
            $eventStartDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));

            // Add event data to events array
            $events[] = [
                'title' => $eventTitle,
                'start' => $eventStartDate,
                'color' => $eventColor,
            ];
        }

        // Return events data in JSON format
        return response()->json($events);
    }
}
