<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calender2;
use App\Models\User\khusus;
use Carbon\Carbon;
use App\Models\Satker;
use Illuminate\Http\Request;

class CalenderKhususController extends Controller
{
    public function index()
    {
        $list_khusus = Khusus::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $calendarData = Calender2::orderByRaw('CASE WHEN tanggal_pengajuan = ? THEN 0 ELSE 1 END', [Carbon::today()->toDateString()])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();


        return view('admin.calenderkhusus.index', compact('list_khusus', 'calendarData'));
    }

    public function store(Request $request)
    {
        // Ambil nilai dari input select
        $selectedOption = $request->input('nama_jadwal');

        // Ambil data Khusus yang diperbarui hari ini dengan status_ad 'Di Terima'
        $list_khusus = Khusus::whereDate('updated_at', Carbon::today())
            ->where('status_ad', 'Di Terima')
            ->get();

        foreach ($list_khusus as $khusus) {
            // Periksa apakah entri sudah ada dalam Calender1
            $existing_entry = Calender2::where('id_khusus', $khusus->id)
                ->exists();

            // Jika entri belum ada, simpan data ke dalam tabel Calender2
            if (!$existing_entry) {
                // Tentukan warna berdasarkan waktu dan tanggal pengajuan
                $currentDate = date('Y-m-d');
                $submissionDate = date('Y-m-d', strtotime($khusus->tanggal_pengajuan));

                if ($currentDate == $submissionDate) {
                    // Jika tanggal pengajuan sama dengan tanggal saat ini
                    $currentTime = date('H:i');
                    $startTime = date('H:i', strtotime($khusus->jam_pengajuan));
                    $endTime = date('H:i', strtotime($khusus->jam_selesai));

                    if ($currentTime >= $startTime && $currentTime <= $endTime) {
                        $color = 'yellow'; // Warna kuning jika dalam rentang waktu pengajuan
                    } elseif ($currentTime > $endTime) {
                        $color = 'green'; // Warna hijau jika sudah melewati jam selesai
                    } else {
                        $color = 'red'; // Warna merah jika sebelum jam pengajuan atau saat ini belum mencapai waktu pengajuan
                    }
                } else {
                    // Jika tanggal pengajuan tidak sama dengan tanggal saat ini
                    $color = 'red'; // Warna merah jika belum pada tanggal pengajuan
                }

                // Buat entri baru dalam tabel Calender2
                $calender_entry = new Calender2();
                $calender_entry->nama_jadwal = "Nama Jadwal Default";
                $calender_entry->id_satker = $khusus->id_satker;
                $calender_entry->tanggal_pengajuan = $khusus->tanggal_pengajuan;
                $calender_entry->color = $color; // Warna yang sudah ditentukan secara otomatis
                $calender_entry->id_user = $khusus->id_user;
                $calender_entry->id_pegawai = $khusus->id_pegawai;
                $calender_entry->id_khusus = $khusus->id;
                // Tambahkan atribut lain sesuai kebutuhan

                $calender_entry->save();
            }
        }

        // Redirect dengan pesan sukses
        return redirect('admin/calenderkhusus')->with('success', 'Data Berhasil DiTambah');
    }

    public function getSatkerByDate1(Request $request, $tanggal_pengajuan)
    {
        // Ubah format tanggal sesuai kebutuhan basis data Anda
        $tanggal_pengajuan = date('d F Y', strtotime($tanggal_pengajuan));

        // Cari entri kalender berdasarkan tanggal_pengajuan
        $calendarEntries = Calender2::where('tanggal_pengajuan', $tanggal_pengajuan)->get();

        // Inisialisasi array untuk menyimpan data
        $data = [];

        // Loop melalui setiap entri kalender
        foreach ($calendarEntries as $calendarEntry) {
            // Ambil data Khusus terkait beserta pegawai dan satker
            $khusus = Khusus::with(['pegawai', 'satker'])->find($calendarEntry->id_khusus);

            if ($khusus) {
                // Tambahkan data ke dalam array $data
                $data['khusus'][] = $khusus;
            }
        }

        // Return data dalam format JSON
        return response()->json($data);
    }


    public function getEventData1()
    {
        // Ambil data dari model atau sumber data lainnya
        $calendarEntries = Calender2::all();

        // Inisialisasi array untuk menyimpan data acara
        $events = [];

        // Ambil waktu dan tanggal saat ini
        $currentDateTime = date('Y-m-d H:i');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');

        // Loop melalui setiap entri kalender
        foreach ($calendarEntries as $calendarEntry) {
            // Ambil data satker terkait
            $satker = Satker::find($calendarEntry->id_satker);
            $khusus = Khusus::find($calendarEntry->id_khusus);

            // Tentukan judul acara
            if ($khusus) {
                $eventTitle = $khusus->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '');
            } else {
                $eventTitle = ''; // Judul acara kosong jika data tidak lengkap
            }

            // Tentukan warna acara berdasarkan waktu
            $eventColor = $calendarEntry->color; // Default color
            if ($khusus) {
                $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
                $startTime = date('H:i', strtotime($khusus->jam_pengajuan));
                $endTime = date('H:i', strtotime($khusus->jam_selesai));
            }

            if (isset($eventDate) && isset($startTime) && isset($endTime)) {
                if ($currentDate == $eventDate) {
                    if ($currentTime >= $startTime && $currentTime <= $endTime) {
                        $eventColor = 'yellow'; // Warna kuning jika dalam rentang waktu pengajuan pada hari ini
                    } elseif ($currentTime > $endTime) {
                        $eventColor = 'green'; // Warna hijau jika sudah melewati jam selesai pada hari ini
                    } else {
                        $eventColor = 'red'; // Warna merah jika sebelum jam pengajuan pada hari ini
                    }
                } elseif ($currentDate < $eventDate) {
                    $eventColor = 'red'; // Warna merah jika tanggal pengajuan di masa depan
                } elseif ($currentDate > $eventDate) {
                    $eventColor = 'green'; // Warna hijau jika tanggal pengajuan sudah lewat
                }
            }

            // Update warna di database
            $calendarEntry->color = $eventColor;
            $calendarEntry->save();

            // Format tanggal ke format yang diharapkan oleh plugin kalender (misalnya 'Y-m-d')
            $eventStartDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));

            // Tambahkan data acara ke dalam array events
            $events[] = [
                'title' => $eventTitle,
                'start' => $eventStartDate,
                'color' => $eventColor,
                // Anda juga bisa menambahkan properti lain ke dalam event jika dibutuhkan
            ];
        }

        // Return data acara dalam format JSON
        return response()->json($events);
    }

    public function destroy($id)
    {
        $calendarData = Calender2::find($id);



        $calendarData->delete();

        return redirect('admin/calenderkhusus')->with('danger', 'Data Berhasil DiHapus.');
    }
}
