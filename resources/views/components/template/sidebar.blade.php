@php
    function checkRouteActive($route)
    {
        if (request()->is($route)) {
            return 'active';
        }
        return '';
    }
@endphp

<style>
    .nav-item.active {
        /* Tambahkan gaya CSS sesuai kebutuhan */
        background-color: rgba(63, 135, 245, 0.15);

        /* Contoh: Mengubah warna latar belakang menjadi merah */
    }

    .nav-item.active .title {
        color: #3f87f5;
        /* Mengatur warna teks menjadi biru */
    }
</style>
<style>
    .icon-holder {
        display: inline-block;
        margin-right: 8px;
    }

    .title {
        vertical-align: middle;
    }

    .nav-item {
        list-style: none;
    }

    .nav-item a {
        text-decoration: none;
        color: inherit;
    }

    .active {
        font-weight: bold;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    function updateTotalLPJProses() {
        $.ajax({
            url: "/admin/pengajuancso/barulpj/total-proses",
            type: "GET",
            success: function(response) {
                $('#totalLPJProses').text(response.total_lpj_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Panggil fungsi update saat halaman dimuat
    $(document).ready(function() {
        updateTotalLPJProses();
        setInterval(updateTotalLPJProses, 5000);
    });
</script> --}}

<!-- Handel total Dropdown -->
<script>
    // Fungsi untuk memperbarui total pengajuan yang sedang diproses
    function updateTotalProses() {
        // Variable untuk menyimpan total keseluruhan
        var totalProses = 0;

        // Ambil total LPJ
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/barulpj/total-proses",
            type: "GET",
            success: function(lpjResponse) {
                totalProses += lpjResponse.total_lpj_proses;
                updateBadge();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        // Ambil total SPD
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/baruspd/total-proses",
            type: "GET",
            success: function(spdResponse) {
                totalProses += spdResponse.total_spd_proses;
                updateBadge();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/barusp2d/total-proses",
            type: "GET",
            success: function(lpjResponse) {
                totalProses += lpjResponse.total_sp2d_proses;
                updateBadge();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/baruspm/total-proses",
            type: "GET",
            success: function(lpjResponse) {
                totalProses += lpjResponse.total_spm_proses;
                updateBadge();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/baruaddk/total-proses",
            type: "GET",
            success: function(lpjResponse) {
                totalProses += lpjResponse.total_addk_proses;
                updateBadge();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        // Ambil total SP2D
        // Lakukan hal yang sama untuk jenis pengajuan lainnya

        // Fungsi untuk memperbarui badge dengan jumlah total
        function updateBadge() {
            $('#totalProses').text(totalProses);
        }
    }

    // Panggil fungsi update saat halaman dimuat
    $(document).ready(function() {
        updateTotalProses();
        // Atur interval untuk refresh setiap 5 detik
        setInterval(updateTotalProses, 5000); // 5000 ms = 5 detik
    });
</script>
<!--End Script-->

<!-- Handle Satu-persatu Menu -->
<script>
    // Fungsi untuk memperbarui total LPJ yang sedang diproses
    function updateTotalLPJProses() {
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/barulpj/total-proses",
            type: "GET",
            success: function(response) {
                $('#totalLPJProses').text(response.total_lpj_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Fungsi untuk memperbarui total SPD yang sedang diproses
    function updateTotalSPDProses() {
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/baruspd/total-proses",
            type: "GET",
            success: function(response) {
                $('#totalSPDProses').text(response.total_spd_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function updateTotalSP2DProses() {
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/barusp2d/total-proses",
            type: "GET",
            success: function(response) {
                $('#totalSP2DProses').text(response.total_sp2d_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function updateTotalSPMProses() {
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/baruspm/total-proses",
            type: "GET",
            success: function(response) {
                $('#totalSPMProses').text(response.total_spm_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function updateTotalADDKProses() {
        $.ajax({
            url: "http://localhost:8000/admin/pengajuancso/baruaddk/total-proses",
            type: "GET",
            success: function(response) {
                $('#totalADDKProses').text(response.total_addk_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    // Panggil fungsi update saat halaman dimuat
    $(document).ready(function() {
        updateTotalLPJProses();
        updateTotalSPDProses();
        updateTotalSP2DProses();
        updateTotalSPMProses();
        updateTotalADDKProses();

        // Atur refresh otomatis setiap 5 detik
        setInterval(function() {
            updateTotalLPJProses();
            updateTotalSPDProses();
            updateTotalSP2DProses();
            updateTotalSPMProses();
            updateTotalADDKProses();
        }, 5000); // 5000 milidetik = 5 detik
    });
</script>
<!--End Script-->

<!--Handle pengajuan Khusus!-->
<script>
    function updateTotalKHUSUSProses() {
        $.ajax({
            url: "{{ url('admin/pengajuankhusus/khususbaru/total-proses') }}",
            type: "GET",
            success: function(response) {
                $('#totalKHUSUSProses').text(response.total_khusus_proses);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    $(document).ready(function() {
        updateTotalKHUSUSProses();

        // Atur refresh otomatis setiap 5 detik
        setInterval(function() {
            updateTotalKHUSUSProses();

        }, 5000); // 5000 milidetik = 5 detik
    });
</script>
<!--  !-->


<!-- Menangani Ajax bagian User-->
<script>
    $(document).ready(function() {
        // Variabel global untuk menyimpan jumlah LPJ yang diterima sebelum menu diklik
        var initialTotalProses;

        // Function to update total LPJ count badge
        function updateTotalProses() {
            $.ajax({
                url: "{{ url('user/lpjselesai/totalProses') }}",
                type: "GET",
                success: function(response) {
                    if (response.count > 0) {
                        $('#totalProsesBadge').text(response.count).show();
                    } else {
                        $('#totalProsesBadge').hide();
                    }

                    // Membandingkan jumlah LPJ yang baru dengan yang sebelumnya
                    if (initialTotalProses !== undefined && response.count === initialTotalProses) {
                        // Jika tidak ada perubahan, sembunyikan badge
                        $('#totalProsesBadge').hide();
                    } else {
                        // Jika ada perubahan, perbarui initialTotalProses
                        initialTotalProses = response.count;
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error); // Menampilkan pesan kesalahan
                }
            });
        }

        // Call the function initially
        updateTotalProses();

        // Sembunyikan badge saat menu diklik dan reset initialTotalProses ke 0
        $('a[href="{{ url('user/lpjselesai') }}"]').click(function() {
            $('#totalProsesBadge').hide();
            // Reset initialTotalProses to 0 when badge is clicked
            initialTotalProses = 0;
        });

        // Panggil fungsi setiap 5 detik
        setInterval(updateTotalProses, 5000); // Perbarui setiap 5 detik
    });
</script>





<!--End script Ajax-->

<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable ps-theme-dark">
            <br>
            @if (Auth::check() && Auth::user()->level === 'admin')
                <li class="font-weight-bold ml-3">Menu</li>
                <li class="nav-item {{ checkRouteActive('admin/beranda*') }}">
                    <a href="{{ url('admin/beranda') }}">
                        <span class="icon-holder">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                        </span>
                        <span class="title">DASHBOARD</span>
                    </a>
                </li>

                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="nav-icon fas fa-calendar"></i>
                        </span>
                        <span class="title">KALENDER JADWAL </span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }} ">
                            <a href="{{ url('admin/dashboard') }}"><i class="fa fa-calendar"></i> | KALENDER
                                CUSTOMER
                                SERVICER
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/calenderkhusus') ? 'active' : '' }} ">
                            <a href="{{ url('admin/calenderkhusus') }}"><i class="fa fa-calendar"></i> | KALENDER
                                KHUSUS
                            </a>

                    </ul>
                </li>



                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fa fa-share"></i>
                        </span>
                        <span class="title"> PENGAJUAN BARU CSO</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                        <span id="totalProses" class="badge badge-danger"></span>
                    </a>
                    {{-- @php
                        $count_status = DB::table('lpj')->where('status', 'DiProses...')->count();
                    @endphp --}}
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('admin/pengajuancso/barulpj') ? 'active' : '' }}">
                            <a href="{{ url('admin/pengajuancso/barulpj') }}">
                                <i class="far fa-file"></i> | Lpj Baru
                                <span id="totalLPJProses" class="badge badge-danger float-right"></span>
                            </a>
                        </li>




                        <li class="{{ request()->is('admin/pengajuancso/barusp2d') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuancso/barusp2d') }}"><i class="far fa-file"></i> | Spd2d
                                Baru <span id="totalSP2DProses" class="badge badge-danger float-right"></span></a>
                        </li>

                        <li class="{{ request()->is('admin/pengajuancso/baruspd') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuancso/baruspd') }}"><i class="far fa-file"></i> | Spd
                                Baru <span id="totalSPDProses" class="badge badge-danger float-right"></span>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/pengajuancso/baruspm') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuancso/baruspm') }}"><i class="far fa-file"></i> | Spm
                                Baru <span id="totalSPMProses" class="badge badge-danger float-right"></span></a>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/pengajuancso/baruaddk') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuancso/baruaddk') }}"><i class="far fa-file"></i> |
                                Addendum
                                Kontrak
                                <span id="totalADDKProses" class="badge badge-danger float-right"></span></a>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fa fa-reply"></i>
                        </span>
                        <span class="title"> PENGAJUAN SELESAI CSO</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('admin/pengajuanselesai/riwayatlpj') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuanselesai/riwayatlpj') }}"><i class="far fa-file"></i> | Lpj
                                Selesai</a>
                        </li>
                        <li class="{{ request()->is('admin/pengajuanselesai/riwayatsp2d') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuanselesai/riwayatsp2d') }}"><i class="far fa-file"></i> |
                                Spd2d
                                Selesai</a>
                        </li>
                        <li class="{{ request()->is('admin/pengajuanselesai/riwayatspd') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuanselesai/riwayatspd') }}"><i class="far fa-file"></i> | Spd
                                Selesai
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/pengajuanselesai/riwayatspm') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuanselesai/riwayatspm') }}"><i class="far fa-file"></i> | Spm
                                Selesai
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/pengajuanselesai/riwayataddk') ? 'active' : '' }} ">
                            <a href="{{ url('admin/pengajuanselesai/riwayataddk') }}"><i class="far fa-file"></i> |
                                Addendum
                                Kontrak
                                Selesai
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fa-solid fa-message"></i>
                        </span>
                        <span class="title">PENGAJUAN BARU KHUSUS</span>
                        <span id="totalKHUSUSProses" class="badge badge-danger"></span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('admin/pengajuankhusus/khususbaru') ? 'active' : '' }}">
                            <a href="{{ url('admin/pengajuankhusus/khususbaru') }}">
                                <i class="fa-solid fa-envelope"></i> | PENGAJUAN MASUK
                                <span id="totalKHUSUSProses" class="badge badge-danger float-right"></span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/pengajuankhusus/khususselesai') ? 'active' : '' }}">
                            <a href="{{ url('admin/pengajuankhusus/khususselesai') }}">
                                <i class="fa-solid fa-envelope"></i> | PENGAJUAN SELESAI
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fa fa-paper-plane"></i>
                        </span>
                        <span class="title">KIRIM PESAN WHATSAPP</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('admin/blastwa') ? 'active' : '' }}">
                            <a href="{{ url('admin/blastwa') }}">
                                <i class="fas fa-mouse-pointer"></i> | KIRIM PESAN PER - SATKER
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/broadcast') ? 'active' : '' }}">
                            <a href="{{ url('admin/broadcast') }}">
                                <i class="fas fa-mouse-pointer"></i> | KIRIM PESAN SEMUA SATKER
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ checkRouteActive('admin/arsip*') }}">
                    <a href="{{ url('admin/arsip') }} ">
                        <span class="icon-holder">
                            <i class="nav-icon fas fa-file"></i>
                        </span>
                        <span class="title">ARSIP AGENDA</span>
                    </a>
                </li>




                <li class="nav-item {{ checkRouteActive('admin/pegawai*') }}">
                    <a href="{{ url('admin/pegawai') }} ">
                        <span class="icon-holder">
                            <i class="nav-icon fas fa-user"></i>
                        </span>
                        <span class="title">PEGAWAI</span>
                    </a>
                </li>



                <li class="nav-item {{ checkRouteActive('admin/satker*') }}">
                    <a href=" {{ url('admin/satker') }}">
                        <span class="icon-holder">
                            <i class="nav-icon fas fa-plus"></i>
                        </span>
                        <span class="title">DATA SATKER</span>
                    </a>
                </li>

                <li class="nav-item {{ checkRouteActive('admin/user*') }}">
                    <a href="{{ url('admin/user') }}">
                        <span class="icon-holder">
                            <i class="nav-icon fa fa-users"></i>
                        </span>
                        <span class="title">USER</span>
                    </a>
                </li>
            @elseif (Auth::check() && Auth::user()->level === 'satker')
                <li class="font-weight-bold ml-3">Menu</li>
                <li class="nav-item {{ checkRouteActive('user/dashboard*') }}">
                    <a href="{{ url('user/dashboard') }}">
                        <span class="icon-holder">
                            <i class="fas fa-calendar"></i>
                        </span>
                        <span class="title">DASHBOARD</span>
                    </a>
                </li>
                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="title"> PENGAJUAN JADWAL LPJ </span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('user/lpj') ? 'active' : '' }} ">
                            <a href="{{ url('user/lpj') }}"><i class="fas fa-file-export"></i> | LPJ
                                BARU</a>
                        </li>
                        <li class="{{ request()->is('user/lpjselesai') ? 'active' : '' }} ">
                            <a href="{{ url('user/lpjselesai') }}"><i class="fas fa-file-lines"></i> | LPJ
                                SELESAI
                                <span id="totalProsesBadge" class="badge badge-danger "></span></a>

                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="title"> PENGAJUAN JADWAL SPD </span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('user/spd') ? 'active' : '' }} ">
                            <a href="{{ url('user/spd') }}"><i class="fas fa-file-export"></i> | SPD
                                BARU</a>
                        </li>
                        <li class="{{ request()->is('user/spdselesai') ? 'active' : '' }} ">
                            <a href="{{ url('user/spdselesai') }}"><i class="far fa-file-lines"></i> | SPD
                                SELESAI</a>

                    </ul>
                </li>
                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="title"> PENGAJUAN JADWAL SP2D </span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('user/sp2d') ? 'active' : '' }} ">
                            <a href="{{ url('user/sp2d') }}"><i class="fas fa-file-export"></i> | SP2D
                                BARU</a>
                        </li>
                        <li class="{{ request()->is('user/sp2dselesai') ? 'active' : '' }} ">
                            <a href="{{ url('user/sp2dselesai') }}"><i class="far fa-file-lines"></i> | SP2D
                                SELESAI</a>

                    </ul>
                </li>
                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="title"> PENGAJUAN JADWAL SPM </span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('user/spm') ? 'active' : '' }} ">
                            <a href="{{ url('user/spm') }}"><i class="fas fa-file-export"></i> | SPM
                                BARU</a>
                        </li>
                        <li class="{{ request()->is('user/spmselesai') ? 'active' : '' }} ">
                            <a href="{{ url('user/spmselesai') }}"><i class="far fa-file-lines"></i> | SPM
                                SELESAI</a>

                    </ul>
                </li>

                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="title">PENGAJUAN JADWAL ADDK</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('user/addk') ? 'active' : '' }} ">
                            <a href="{{ url('user/addk') }}"><i class="fas fa-file-export"></i> | ADD Kontrak
                                BARU</a>
                        </li>
                        <li class="{{ request()->is('user/addkselesai') ? 'active' : '' }} ">
                            <a href="{{ url('user/addkselesai') }}"><i class="far fa-file-lines"></i> | ADD
                                KONTRAK
                                SELESAI</a>

                    </ul>
                </li>
                <li class="nav-item dropdown closed">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="title">Pengajuan Jadwal Khusus</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('user/khusus') ? 'active' : '' }} ">
                            <a href="{{ url('user/khusus') }}"><i class="fas fa-file-export"></i> | KHUSUS
                                BARU</a>
                        </li>
                        <li class="{{ request()->is('user/khususselesai') ? 'active' : '' }} ">
                            <a href="{{ url('user/khususselesai') }}"><i class="far fa-file-lines"></i> | KHUSUS
                                SELESAI</a>

                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- Di dalam file blade menu sidebar Anda -->
{{-- @php
                    $count_spm = DB::table('spm')->where('status', 'DiProses...')->count();
                    $count_lpj = DB::table('lpj')->where('status', 'DiProses...')->count();
                    $count_sp2d = DB::table('sp2d')->where('status', 'DiProses...')->count();
                    $count_spd = DB::table('spd')->where('status', 'DiProses...')->count();
                    $count_addk = DB::table('addk')->where('status', 'DiProses...')->count();
                    $total_count = $count_lpj + $count_spm + $count_addk + $count_sp2d + $count_spd;
                @endphp --}}
