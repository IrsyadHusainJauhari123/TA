<?php

//Ngehook Controller Admin

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\BlastWaController;
use App\Http\Controllers\Admin\BroadcastController;
use App\Http\Controllers\Admin\CalenderKhususController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SatkerController;
use App\Http\Controllers\Admin\PengajuanBaruLpj as AdminPengajuanBaruLpj;
use App\Http\Controllers\Admin\RiwayatAgendaController;
use App\Http\Controllers\PengajuanCso\AddkBaruController;
use App\Http\Controllers\CalenderController;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Calender1Controller;
use App\Http\Controllers\PengajuanCso\Sp2dBaruController;
use App\Http\Controllers\PengajuanCso\SpdBaruController;
use App\Http\Controllers\PengajuanCso\SpmBaruController;
use App\Http\Controllers\PengajuanKhusus\AdminKhususController;
//Ngehook Controlller Usser
use App\Http\Controllers\User\LpjController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\AddKontrakController;
use App\Http\Controllers\User\LpjSelesaiController;
use App\Http\Controllers\User\Sp2dController;
use App\Http\Controllers\User\SpdController;
use App\Http\Controllers\User\SpmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profil\ProfileController;
use App\Http\Controllers\Riwayat\RiwayatAddkController;
use App\Http\Controllers\Riwayat\RiwayatKhususController;
use App\Http\Controllers\Riwayat\RiwayatLpjController;
use App\Http\Controllers\Riwayat\RiwayatSp2dController;
use App\Http\Controllers\Riwayat\RiwayatSpdController;
use App\Http\Controllers\Riwayat\RiwayatSpmController;
use App\Http\Controllers\User\KhususController;
use App\Http\Controllers\User\PengajuanSelesai\AddkSelesaiController;
use App\Http\Controllers\User\PengajuanSelesai\KhususSelesaiController;
use App\Http\Controllers\User\PengajuanSelesai\Sp2dSelesaiController;
use App\Http\Controllers\User\PengajuanSelesai\SpdSelesaiController;
use App\Http\Controllers\User\PengajuanSelesai\SpmSelesaiController;

use App\Models\Calender1;
use App\Models\User\Sp2d;
// use Illuminate\Broadcasting\BroadcastController;
use Illuminate\Support\Facades\Broadcast;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});



// Route Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//End Login




//ROUTE LEVEL Admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('admin/pegawai', PegawaiController::class);
    Route::resource('admin/user', UserController::class);
    Route::resource('admin/satker', SatkerController::class);
    Route::resource('admin/pengajuanbaru', SatkerController::class);

    //Route Calender
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
    // Route::post('/admin/dashboard', [DashboardController::class, 'store'])->name('admin.dashboard.store');
    Route::post('admin/dashboard', [AdminDashboardController::class, 'store'])->name('admin.dashboard.store');
    //End Calender

    //Route Calender Khusus
    Route::get('admin/calenderkhusus', [CalenderKhususController::class, 'index']);
    Route::post('admin/calenderkhusus', [CalenderKhususController::class, 'store'])->name('admin.khusus.store');
    Route::get('admin/calenderkhusus/get-satker-by-date/{tanggal_pengajuan}', [CalenderKhususController::class, 'getSatkerByDate1'])->name('admin.calenderkhusus.get_satker_by_date');
    Route::get('admin/calenderkhusus/get-events', [CalenderKhususController::class, 'getEventData1'])->name('admin.calenderkhusus.get_events');
    Route::delete('admin/calenderkhusus/{id}', [CalenderKhususController::class, 'destroy'])->name('admin.calenderkhusus.destroy');
    //End Route

    //Route SP2d
    Route::get('admin/pengajuancso/barusp2d', [Sp2dBaruController::class, 'index']);
    Route::post('admin/pengajuancso/barusp2d/{id}/accept', [Sp2dBaruController::class, 'accept'])->name('admin.sp2d.accept');
    Route::post('admin/pengajuancso/barusp2d/{id}/reject', [Sp2dBaruController::class, 'reject'])->name('admin.sp2d.reject');
    Route::post('admin/pengajuancso/barusp2d/{id}/process', [Sp2dBaruController::class, 'processInfo'])->name('admin.sp2d.processInfo');
    Route::get('admin/pengajuancso/barusp2d/info/{id}', [Sp2dBaruController::class, 'info'])->name('admin.sp2d.info');


    //Route SPD
    Route::get('admin/pengajuancso/baruspd', [SpdBaruController::class, 'index']);
    Route::post('admin/pengajuancso/baruspd/{id}/accept', [SpdBaruController::class, 'accept'])->name('admin.spd.accept');
    Route::post('admin/pengajuancso/baruspd/{id}/reject', [SpdBaruController::class, 'reject'])->name('admin.spd.reject');
    Route::post('admin/pengajuancso/baruspd/{id}/process', [SpdBaruController::class, 'processInfo'])->name('admin.spd.processInfo');
    Route::get('admin/pengajuancso/baruspd/info/{id}', [SpdBaruController::class, 'info'])->name('admin.spd.info');

    //Route SPM
    Route::get('admin/pengajuancso/baruspm', [SpmBaruController::class, 'index']);
    Route::post('admin/pengajuancso/baruspm/{id}/accept', [SpmBaruController::class, 'accept'])->name('admin.spm.accept');
    Route::post('admin/pengajuancso/baruspm/{id}/reject', [SpmBaruController::class, 'reject'])->name('admin.spm.reject');
    Route::post('admin/pengajuancso/baruspm/{id}/process', [SpmBaruController::class, 'processInfo'])->name('admin.spm.processInfo');
    Route::get('admin/pengajuancso/baruspm/info/{id}', [SpmBaruController::class, 'info'])->name('admin.spm.info');

    //Route Add Kontrak dan Validasinya
    Route::get('admin/pengajuancso/baruaddk', [AddkBaruController::class, 'index']);
    Route::post('admin/pengajuancso/baruaddk/{id}/accept', [AddkBaruController::class, 'accept'])->name('admin.addk.accept');
    Route::post('admin/pengajuancso/baruaddk/{id}/reject', [AddkBaruController::class, 'reject'])->name('admin.addk.reject');
    Route::post('admin/pengajuancso/baruaddk/{id}/process', [AddkBaruController::class, 'processInfo'])->name('admin.addk.processInfo');
    Route::get('admin/pengajuancso/baruaddk/info/{id}', [AddkBaruController::class, 'info'])->name('admin.addk.info');

    //ROOTE LPJ VALIDASI
    Route::get('admin/pengajuancso/barulpj', [AdminPengajuanBaruLpj::class, 'index']);
    Route::get('admin/pengajuancso/barulpj/info/{id}', [AdminPengajuanBaruLpj::class, 'info'])->name('admin.lpj.info');
    Route::post('admin/pengajuancso/barulpj/{id}/accept', [AdminPengajuanBaruLpj::class, 'accept'])->name('admin.lpj.accept');
    Route::post('admin/pengajuancso/barulpj/{id}/reject', [AdminPengajuanBaruLpj::class, 'reject'])->name('admin.lpj.reject');
    Route::post('admin/pengajuancso/barulpj/{id}/process', [AdminPengajuanBaruLpj::class, 'processInfo'])->name('admin.lpj.processInfo');
    //END ROUTE

    //ROUTE PENGAJUAN KHUSUS
    Route::get('admin/pengajuankhusus/khususbaru', [AdminKhususController::class, 'index']);
    Route::get('admin/pengajuankhusus/khususbaru/info/{id}', [AdminKhususController::class, 'info'])->name('admin.khusus.info');
    Route::post('admin/pengajuankhusus/khususbaru/{id}/accept', [AdminKhususController::class, 'accept'])->name('admin.khusus.accept');
    Route::post('admin/pengajuankhusus/khususbaru/{id}/reject', [AdminKhususController::class, 'reject'])->name('admin.khusus.reject');
    Route::get('admin/pengajuankhusus/khususbaru/total-proses', [AdminKhususController::class, 'getTotalKHUSUSProses'])->name('admin.pengajuankhusus.khususbaru.total_proses');
    //END ROUTE

    //Rute untuk Set Intervel Update data
    Route::get('admin/pengajuancso/barulpj/total-proses', [AdminPengajuanBaruLpj::class, 'getTotalLPJProses'])->name('admin.pengajuancso.barulpj.total_proses');
    Route::get('admin/pengajuancso/baruspd/total-proses', [SpdBaruController::class, 'getTotalSPDProses'])->name('admin.pengajuancso.baruspd.total_proses');
    Route::get('admin/pengajuancso/barusp2d/total-proses', [Sp2dBaruController::class, 'getTotalSP2DProses'])->name('admin.pengajuancso.barusp2d.total_proses');
    Route::get('admin/pengajuancso/baruspm/total-proses', [SpmBaruController::class, 'getTotalSPMProses'])->name('admin.pengajuancso.baruspm.total_proses');
    Route::get('admin/pengajuancso/baruaddk/total-proses', [AddkBaruController::class, 'getTotalADDKProses'])->name('admin.pengajuancso.baruaddk.total_proses');
    //End Route untuk Set Interval

    //Route Set Interval count Semua
    Route::get('admin/dashboard/total-proses', [AdminDashboardController::class, 'getTotalProses'])->name('admin.dashboard.total_proses');
    //End Route

    //Route untuk modal calender
    Route::get('admin/dashboard/get-satker-by-date/{tanggal_pengajuan}', [AdminDashboardController::class, 'getSatkerByDate2'])->name('admin.dashboard.get_satker_by_date');
    Route::get('admin/dashboard/get-events', [AdminDashboardController::class, 'getEventData2'])->name('admin.dashboard.get_events');
    Route::put('admin/dashboard/edit/{id}', [AdminDashboardController::class, 'edit'])->name('admin.dashboard.edit');
    Route::delete('admin/dashboard/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.dashboard.destroy');
    Route::resource('admin/dashboard', AdminDashboardController::class);

    //Hanlde Data Table di Calender1
    Route::get('admin/dashboard/fetch-data', [AdminDashboardController::class, 'fetchData'])->name('admin.dashboard.fetch.data');
    Route::post('admin/dashboard/{id}/update', [AdminDashboardController::class, 'update'])->name('admin.dashboard.update');
    //End Route

    //Handel Wa Pesan single
    Route::post('/send.whatsapp.message', 'Admin\PengajuanBaruLpj@sendWhatsAppMessage')->name('send.whatsapp.message');
    //end route

    //End Route

    //ROUTE Riwayat JAdwal Konsul  Selesai
    Route::resource('admin/pengajuanselesai/riwayatlpj', RiwayatLpjController::class);
    Route::resource('admin/pengajuanselesai/riwayatspd', RiwayatSpdController::class);
    Route::resource('admin/pengajuanselesai/riwayatsp2d', RiwayatSp2dController::class);
    Route::resource('admin/pengajuanselesai/riwayatspm', RiwayatSpmController::class);
    Route::resource('admin/pengajuanselesai/riwayataddk', RiwayatAddkController::class);
    //End Route

    //Route Riwayat Jadwal Pengajuan Khusus Selesai
    Route::resource('admin/pengajuankhusus/khususselesai', RiwayatKhususController::class);
    //End Route

    //Route Beranda
    Route::resource('admin/beranda', BerandaController::class);
    //ENd Route

    //Route Arsip Agenda
    Route::resource('admin/arsip', RiwayatAgendaController::class);
    // Route::get('admin/arsip', [RiwayatAgendaController::class, 'index'])->name('arsip.index');
    // Route::get('admin/arsip/create', [RiwayatAgendaController::class, 'create'])->name('arsip.create');
    // Route::post('admin/arsip', [RiwayatAgendaController::class, 'store'])->name('arsip.store');
    //End Route

    //Route FIlter Pengajuan Cso Selesai
    // Route::post('admin/pengajuanselesai/riwayatlpj/filter1', [RiwayatLpjController::class, 'filter1'])->name('admin.pengajuanselesai.riwayatlpj.diterima');
    // Route::post('admin/pengajuanselesai/riwayatlpj/filter2', [RiwayatLpjController::class, 'filter2'])->name('admin.pengajuanselesai.riwayatlpj.ditolak');
    // Route::post('admin/pengajuanselesai/riwayatsp2d/filter', [RiwayatSp2dController::class, 'filter'])->name('admin.pengajuanselesai.riwayatsp2d.filter');
    // Route::post('admin/blastwa/filter', [BlastWaController::class, 'filter'])->name('admin.blastwa.filter');
    // Route::post('admin/arsip/filter', [RiwayatAgendaController::class, 'filter'])->name('admin.arsip.filter');
    // Route::post('admin/broadcast/filter', [BroadcastController::class, 'filter'])->name('admin.broadcast.filter');
    //End Route

    //Handel Blast tunggal dan Blast Group WhatsApp Gateway
    Route::resource('admin/blastwa', BlastWaController::class);

    Route::resource('admin/broadcast', BroadcastController::class);

    //EndRoute
});



//ROUTE LEVEL SATKER
Route::middleware(['auth', 'satker'])->group(function () {

    Route::resource('user/lpj', LpjController::class);
    Route::resource('user/spm', SpmController::class);
    Route::resource('user/spd', SpdController::class);
    Route::resource('user/sp2d', Sp2dController::class);
    Route::resource('user/addk', AddKontrakController::class);
    Route::resource('user/khusus', KhususController::class);
    // Route Index Selesai Satker//

    //Route Pengajuan cso selesai
    Route::get('user/lpjselesai', [LpjSelesaiController::class, 'index']);
    Route::resource('user/spdselesai', SpdSelesaiController::class);
    Route::resource('user/khususselesai', KhususSelesaiController::class);
    //Route SetInterval
    Route::get('user/lpjselesai/totalProses', [LpjSelesaiController::class, 'getTotalProses'])->name('user.lpjselesai.totalProses');
    // Route::get('/user/lpjselesai/totalProses', [LpjController::class, 'getTotalProses']);
    //End Route
    Route::resource('user/sp2dselesai', Sp2dSelesaiController::class);
    Route::resource('user/spmselesai', SpmSelesaiController::class);
    Route::resource('user/addkselesai', AddkSelesaiController::class);

    //Route Handel Modal dan eventitle calender
    Route::get('user/dashboard/get-satker-by-date1/{tanggal_pengajuan}', [DashboardController::class, 'getSatkerByDate2'])->name('user.dashboard.get_satker_by_date1');
    Route::get('user/dashboard/get-events1', [DashboardController::class, 'getEventData2'])->name('user.dashboard.get_events1');
    //End Route
    Route::get('user/dashboard', [DashboardController::class, 'index']);
    Route::get('user/dashboard/get-satker-by-date/{tanggal_pengajuan}', [DashboardController::class, 'getSatkerByDate1'])->name('user.dashboard.get_satker_by_date');
    Route::get('user/dashboard/get-events', [DashboardController::class, 'getEventData1'])->name('user.dashboard.get_events');
    //Route Handel Model dan Event title calender Khusu
    //End ROute
});

//End Route


//ROUTE HANDLE SETTING PROFIL
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
