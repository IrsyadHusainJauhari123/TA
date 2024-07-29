<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\{Addk, Lpj, Spm, Sp2d, Spd};
use App\Models\Calender1;
use App\Models\Pegawai;
use App\Models\Satker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class AdminDashboardController extends Controller
{

    public function index()
    {

        // Ambil data LPJ dengan status_ad 'Diterima' yang diupdate pada hari ini
        $list_lpj = Lpj::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $list_spd = Spd::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $list_spm = Spm::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $list_addk = Addk::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        $list_sp2d = Sp2d::where('status_ad', 'Di Terima')
            ->whereDate('updated_at', Carbon::today())
            ->get();
        $calendarData = Calender1::with([
            'lpj.satker',
            'spd.satker',
            'spm.satker',
            'addk.satker',
            'sp2d.satker'
        ])
            ->orderByRaw('CASE WHEN tanggal_pengajuan = ? THEN 0 ELSE 1 END', [Carbon::today()->toDateString()])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();


        return view('admin.dashboard.index', compact('list_lpj', 'list_spd', 'list_spm', 'list_addk', 'list_sp2d', 'calendarData'));
    }

    public function edit($id)
    {
        $calendarData = Calender1::with(['lpj.satker', 'spd.satker', 'spm.satker', 'addk.satker', 'sp2d.satker'])->find($id);

        if (!$calendarData) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        return view('admin.dashboard.edit', compact('calendarData'));
    }





    // Fungsi untuk menyimpan perubahan
    public function update(Request $request, $id)
    {
        $calendarData = Calender1::find($id);

        if (!$calendarData) {
            return redirect('admin/dashboard')->with('error', 'Data not found.');
        }

        $request->validate([
            'color' => 'required|string|max:7', // Ubah validasi sesuai kebutuhan
        ]);

        $calendarData->update([
            'color' => $request->color, // Gunakan nama kolom yang tepat
        ]);

        return redirect('admin/dashboard')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $calendarData = Calender1::find($id);

        if (!$calendarData) {
            return Redirect::back()->with('error', 'Data not found.');
        }

        $calendarData->delete();

        return redirect('admin/dashboard')->with('danger', 'Data Berhasil DiHapus.');
    }





    public function store(Request $request)
    {
        // Ambil nilai dari input select
        $selectedOption = $request->input('nama_jadwal');

        // Jika opsi yang dipilih adalah LPJ
        if ($selectedOption == '1') {
            // Proses penyimpanan data LPJ
            // Ambil data LPJ yang diperbarui hari ini dengan status_ad yang diterima
            $list_lpj = LPJ::whereDate('updated_at', Carbon::today())
                ->where('status_ad', 'Di Terima')
                ->get();

            foreach ($list_lpj as $lpj) {
                // Periksa apakah ada entri dalam tabel Calender1 dengan kombinasi yang sama
                $existing_entry_lpj = Calender1::where('id_satker', $lpj->id_satker)
                    ->where('id_user', $lpj->id_user)
                    ->where('id_pegawai', $lpj->id_pegawai)
                    ->exists();

                // Jika tidak ada entri yang sama, atau jika ada entri yang sama tetapi dengan id_lpj yang berbeda, simpan data LPJ ke dalam tabel Calender1
                if (!$existing_entry_lpj || ($existing_entry_lpj && !Calender1::where('id_lpj', $lpj->id)->exists())) {
                    // Tentukan warna berdasarkan waktu
                    // Tentukan warna berdasarkan tanggal pengajuan
                    // Tentukan warna berdasarkan waktu dan tanggal pengajuan
                    $currentDate = date('Y-m-d');
                    $submissionDate = date('Y-m-d', strtotime($lpj->tanggal_pengajuan));

                    if ($currentDate == $submissionDate) {
                        // Jika tanggal pengajuan sama dengan tanggal saat ini
                        $currentTime = date('H:i');
                        $startTime = date('H:i', strtotime($lpj->jam_pengajuan));
                        $endTime = date('H:i', strtotime($lpj->jam_selesai));

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



                    // Buat entri baru dalam tabel Calender1
                    $calender_entry_lpj = new Calender1();
                    $calender_entry_lpj->nama_jadwal = "Konsultasi Laporan Pertanggungjawaban";
                    $calender_entry_lpj->id_satker = $lpj->id_satker;
                    $calender_entry_lpj->tanggal_pengajuan = $lpj->tanggal_pengajuan;
                    $calender_entry_lpj->color = $color; // Warna yang sudah ditentukan secara otomatis
                    $calender_entry_lpj->id_user = $lpj->id_user;
                    $calender_entry_lpj->id_pegawai = $lpj->id_pegawai;
                    $calender_entry_lpj->id_lpj = $lpj->id;
                    $calender_entry_lpj->id_spd = null;
                    $calender_entry_lpj->id_spm = null;
                    $calender_entry_lpj->id_sp2d = null;
                    $calender_entry_lpj->id_addk = null;
                    // Tambahkan atribut lain sesuai kebutuhan

                    $calender_entry_lpj->save();
                }
            }

            // Redirect dengan pesan sukses
            return redirect('admin/dashboard')->with('success', 'Data LPJ Berhasil DiTambah');
        } elseif ($selectedOption == '2') {
            // Proses penyimpanan data SPD

            $list_spd = Spd::whereDate('updated_at', Carbon::today())
                ->where('status_ad', 'Di Terima')
                ->get();

            foreach ($list_spd as $spd) {
                // Periksa apakah entri SPD sudah ada dalam Calender1
                // Jika tidak ada entri yang sama, simpan data SPD ke dalam tabel Calender1
                $existing_entry_spd = Calender1::where('id_satker', $spd->id_satker)
                    ->where('id_user', $spd->id_user)
                    ->where('id_pegawai', $spd->id_pegawai)
                    ->exists();
                $currentDate = date('Y-m-d');
                $submissionDate = date('Y-m-d', strtotime($spd->tanggal_pengajuan));

                if ($currentDate == $submissionDate) {
                    // Jika tanggal pengajuan sama dengan tanggal saat ini
                    $currentTime = date('H:i');
                    $startTime = date('H:i', strtotime($spd->jam_pengajuan));
                    $endTime = date('H:i', strtotime($spd->jam_selesai));

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

                // Jika tidak ada entri yang sama, atau jika ada entri yang sama tetapi dengan id_spd yang berbeda, simpan data spd ke dalam tabel Calender1
                if (!$existing_entry_spd || ($existing_entry_spd && !Calender1::where('id_spd', $spd->id)->exists())) {
                    $calender_entry_spd = new Calender1();
                    $calender_entry_spd->nama_jadwal = "Nama Jadwal Default spd";
                    $calender_entry_spd->id_satker = $spd->id_satker;
                    $calender_entry_spd->tanggal_pengajuan = $spd->tanggal_pengajuan;
                    $calender_entry_spd->color = $color;
                    $calender_entry_spd->id_user = $spd->id_user;
                    $calender_entry_spd->id_pegawai = $spd->id_pegawai;
                    $calender_entry_spd->id_spd = $spd->id;
                    $calender_entry_spd->id_lpj = null;
                    $calender_entry_spd->id_spm = null;
                    $calender_entry_spd->id_sp2d = null;
                    $calender_entry_spd->id_addk = null;


                    // Tambahkan atribut lain sesuai kebutuhan

                    $calender_entry_spd->save();
                }
            }

            // Redirect dengan pesan sukses
            return redirect('admin/dashboard')->with('success', 'Data SPD Berhasil DiTambah');
        } elseif ($selectedOption == '3') {
            $list_spm = Spm::whereDate('updated_at', Carbon::today())
                ->where('status_ad', 'Di Terima')
                ->get();

            foreach ($list_spm as $spm) {
                // Periksa apakah entri spm sudah ada dalam Calender1
                // Jika tidak ada entri yang sama, simpan data spm ke dalam tabel Calender1
                $existing_entry_spm = Calender1::where('id_satker', $spm->id_satker)
                    ->where('id_user', $spm->id_user)
                    ->where('id_pegawai', $spm->id_pegawai)
                    ->exists();
                $currentDate = date('Y-m-d');
                $submissionDate = date('Y-m-d', strtotime($spm->tanggal_pengajuan));

                if ($currentDate == $submissionDate) {
                    // Jika tanggal pengajuan sama dengan tanggal saat ini
                    $currentTime = date('H:i');
                    $startTime = date('H:i', strtotime($spm->jam_pengajuan));
                    $endTime = date('H:i', strtotime($spm->jam_selesai));

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

                // Jika tidak ada entri yang sama, atau jika ada entri yang sama tetapi dengan id_spm yang berbeda, simpan data spm ke dalam tabel Calender1
                if (!$existing_entry_spm || ($existing_entry_spm && !Calender1::where('id_spm', $spm->id)->exists())) {
                    $calender_entry_spm = new Calender1();
                    $calender_entry_spm->nama_jadwal = "Nama Jadwal Default spm";
                    $calender_entry_spm->id_satker = $spm->id_satker;
                    $calender_entry_spm->tanggal_pengajuan = $spm->tanggal_pengajuan;
                    $calender_entry_spm->color = $color;
                    $calender_entry_spm->id_user = $spm->id_user;
                    $calender_entry_spm->id_pegawai = $spm->id_pegawai;
                    $calender_entry_spm->id_spm = $spm->id;
                    $calender_entry_spm->id_lpj = null;
                    $calender_entry_spm->id_spd = null;
                    $calender_entry_spm->id_sp2d = null;
                    $calender_entry_spm->id_addk = null;


                    // Tambahkan atribut lain sesuai kebutuhan

                    $calender_entry_spm->save();
                }
            }

            // Redirect dengan pesan sukses
            return redirect('admin/dashboard')->with('success', 'Data SPM Berhasil DiTambah');
            // Proses untuk opsi lainnya
        } elseif ($selectedOption == '4') {
            $list_sp2d = Sp2d::whereDate('updated_at', Carbon::today())
                ->where('status_ad', 'Di Terima')
                ->get();

            foreach ($list_sp2d as $sp2d) {
                // Periksa apakah entri sp2d sudah ada dalam Calender1
                // Jika tidak ada entri yang sama, simpan data sp2d ke dalam tabel Calender1
                $existing_entry_sp2d = Calender1::where('id_satker', $sp2d->id_satker)
                    ->where('id_user', $sp2d->id_user)
                    ->where('id_pegawai', $sp2d->id_pegawai)
                    ->exists();
                $currentDate = date('Y-m-d');
                $submissionDate = date('Y-m-d', strtotime($sp2d->tanggal_pengajuan));

                if ($currentDate == $submissionDate) {
                    // Jika tanggal pengajuan sama dengan tanggal saat ini
                    $currentTime = date('H:i');
                    $startTime = date('H:i', strtotime($sp2d->jam_pengajuan));
                    $endTime = date('H:i', strtotime($sp2d->jam_selesai));

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

                // Jika tidak ada entri yang sama, atau jika ada entri yang sama tetapi dengan id_sp2d yang berbeda, simpan data sp2d ke dalam tabel Calender1
                if (!$existing_entry_sp2d || ($existing_entry_sp2d && !Calender1::where('id_sp2d', $sp2d->id)->exists())) {
                    $calender_entry_sp2d = new Calender1();
                    $calender_entry_sp2d->nama_jadwal = "Nama Jadwal Default sp2d";
                    $calender_entry_sp2d->id_satker = $sp2d->id_satker;
                    $calender_entry_sp2d->tanggal_pengajuan = $sp2d->tanggal_pengajuan;
                    $calender_entry_sp2d->color = $color;
                    $calender_entry_sp2d->id_user = $sp2d->id_user;
                    $calender_entry_sp2d->id_pegawai = $sp2d->id_pegawai;
                    $calender_entry_sp2d->id_sp2d = $sp2d->id;
                    $calender_entry_sp2d->id_lpj = null;
                    $calender_entry_sp2d->id_spd = null;
                    $calender_entry_sp2d->id_spm = null;
                    $calender_entry_sp2d->id_addk = null;


                    // Tambahkan atribut lain sesuai kebutuhan

                    $calender_entry_sp2d->save();
                }
            }

            // Redirect dengan pesan sukses
            return redirect('admin/dashboard')->with('success', 'Data SP2D Berhasil DiTamabah');
            // Proses untuk opsi lainnya
        } elseif ($selectedOption == '5') {
            $list_addk = Addk::whereDate('updated_at', Carbon::today())
                ->where('status_ad', 'Di Terima')
                ->get();

            foreach ($list_addk as $addk) {
                // Periksa apakah entri addk sudah ada dalam Calender1
                // Jika tidak ada entri yang sama, simpan data addk ke dalam tabel Calender1
                $existing_entry_addk = Calender1::where('id_satker', $addk->id_satker)
                    ->where('id_user', $addk->id_user)
                    ->where('id_pegawai', $addk->id_pegawai)
                    ->exists();
                $currentDate = date('Y-m-d');
                $submissionDate = date('Y-m-d', strtotime($addk->tanggal_pengajuan));

                if ($currentDate == $submissionDate) {
                    // Jika tanggal pengajuan sama dengan tanggal saat ini
                    $currentTime = date('H:i');
                    $startTime = date('H:i', strtotime($addk->jam_pengajuan));
                    $endTime = date('H:i', strtotime($addk->jam_selesai));

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

                // Jika tidak ada entri yang sama, atau jika ada entri yang sama tetapi dengan id_addk yang berbeda, simpan data addk ke dalam tabel Calender1
                if (!$existing_entry_addk || ($existing_entry_addk && !Calender1::where('id_addk', $addk->id)->exists())) {
                    $calender_entry_addk = new Calender1();
                    $calender_entry_addk->nama_jadwal = "Nama Jadwal Default addk";
                    $calender_entry_addk->id_satker = $addk->id_satker;
                    $calender_entry_addk->id_user = $addk->id_user;
                    $calender_entry_addk->tanggal_pengajuan = $addk->tanggal_pengajuan;
                    $calender_entry_addk->color = $color;
                    $calender_entry_addk->id_pegawai = $addk->id_pegawai;
                    $calender_entry_addk->id_addk = $addk->id;
                    $calender_entry_addk->id_lpj = null;
                    $calender_entry_addk->id_spd = null;
                    $calender_entry_addk->id_sp2d = null;
                    $calender_entry_addk->id_spm = null;


                    // Tambahkan atribut lain sesuai kebutuhan

                    $calender_entry_addk->save();
                }
            }

            // Redirect dengan pesan sukses
            return redirect('admin/dashboard')->with('success', 'Data Addedum Kontrak Berhasil DiTambah');
            // Proses untuk opsi lainnya
        }
    }


    public function getTotalProses()
    {
        // Hitung total LPJ yang sedang diproses
        $total_lpj_proses = Lpj::where('status', 'DiProses...')->count();

        // Hitung total SPD yang sedang diproses
        $total_spd_proses = Spd::where('status', 'DiProses...')->count();

        // Hitung total SP2D yang sedang diproses
        $total_sp2d_proses = Sp2d::where('status', 'DiProses...')->count();

        // Hitung total SPM yang sedang diproses
        $total_spm_proses = Spm::where('status', 'DiProses...')->count();

        // Hitung total ADDK yang sedang diproses
        $total_addk_proses = Addk::where('status', 'DiProses...')->count();

        // Mengembalikan response dalam bentuk JSON dengan total dari setiap jenis pengajuan
        return response()->json([
            'total_lpj_proses' => $total_lpj_proses,
            'total_spd_proses' => $total_spd_proses,
            'total_sp2d_proses' => $total_sp2d_proses,
            'total_spm_proses' => $total_spm_proses,
            'total_addk_proses' => $total_addk_proses,
        ]);
    }

    // Controller untuk menangani permintaan AJAX
    public function getSatkerByDate2(Request $request, $tanggal_pengajuan)
    {
        // Cari LPJ berdasarkan tanggal pengajuan dan status_ad "diterima"
        $tanggal_pengajuan = date('d F Y', strtotime($tanggal_pengajuan));
        $calendarEntries = Calender1::where('tanggal_pengajuan', $tanggal_pengajuan)->get();

        // Inisialisasi array untuk menyimpan data LPJ, SPD, Pegawai, dan Satker
        $data = [];

        // Loop melalui setiap entri kalender
        foreach ($calendarEntries as $calendarEntry) {
            // Ambil data LPJ terkait beserta pegawai dan satker
            $lpj = LPJ::with(['pegawai', 'satker'])->find($calendarEntry->id_lpj);
            if ($lpj) {
                $data['lpj'][] = $lpj;
            }

            // Ambil data SPD terkait
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



            // Ambil data pegawai terkait dari tabel pegawai

        }

        // Return data LPJ, SPD, Pegawai, dan Satker dalam format JSON
        return response()->json($data);
    }
    public function getEventData2()
    {
        // Ambil data dari model atau sumber data lainnya
        $calendarEntries = Calender1::all();

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
            $lpj = Lpj::find($calendarEntry->id_lpj);
            $addk = Addk::find($calendarEntry->id_addk);
            $spm = Spm::find($calendarEntry->id_spm);
            $spd = Spd::find($calendarEntry->id_spd);
            $sp2d = Sp2d::find($calendarEntry->id_sp2d);

            // Tentukan judul acara
            if ($lpj) {
                $eventTitle = $lpj->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '');
            } elseif ($addk) {
                $eventTitle = $addk->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '');
            } elseif ($spm) {
                $eventTitle = $spm->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '');
            } elseif ($spd) {
                $eventTitle = $spd->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '');
            } elseif ($sp2d) {
                $eventTitle = $sp2d->jam_pengajuan . ' - ' . ($satker ? $satker->nama_satker : '');
            } else {
                $eventTitle = ''; // Judul acara kosong jika data tidak lengkap
            }

            // Tentukan warna acara berdasarkan waktu
            $eventColor = $calendarEntry->color; // Default color
            if ($lpj) {
                $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
                $startTime = date('H:i', strtotime($lpj->jam_pengajuan));
                $endTime = date('H:i', strtotime($lpj->jam_selesai));
            } elseif ($addk) {
                $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
                $startTime = date('H:i', strtotime($addk->jam_pengajuan));
                $endTime = date('H:i', strtotime($addk->jam_selesai));
            } elseif ($spm) {
                $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
                $startTime = date('H:i', strtotime($spm->jam_pengajuan));
                $endTime = date('H:i', strtotime($spm->jam_selesai));
            } elseif ($spd) {
                $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
                $startTime = date('H:i', strtotime($spd->jam_pengajuan));
                $endTime = date('H:i', strtotime($spd->jam_selesai));
            } elseif ($sp2d) {
                $eventDate = date('Y-m-d', strtotime($calendarEntry->tanggal_pengajuan));
                $startTime = date('H:i', strtotime($sp2d->jam_pengajuan));
                $endTime = date('H:i', strtotime($sp2d->jam_selesai));
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

            // Perbarui warna di database
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
    // Handle data table calender1

}
