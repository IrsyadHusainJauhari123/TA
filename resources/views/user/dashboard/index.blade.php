<style>
    .card-primary {
        width: 1295px;
        height: 100vh;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .fc-header-toolbar.fc-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        max-width: calc(100% - 40px);
        overflow: hidden;
    }

    #calendar2,
    #calendar1 {
        width: 100%;
        height: 100%;
    }

    .navbar {
        width: 1295px;
        background-color: #007bff;
        color: white;
    }

    .navbar-brand {
        color: white;
    }

    .legend {
        display: flex;
        align-items: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 10px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }

    .legend-red {
        background-color: red;
    }

    .legend-yellow {
        background-color: yellow;
    }

    .legend-green {
        background-color: green;
    }

    @media screen and (max-width: 767px) {
        .card-primary {
            padding: 10px;
            margin: 10px auto;
        }

        .fc-header-toolbar.fc-toolbar {
            flex-wrap: wrap;
            justify-content: center;
        }

        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar-brand {
            margin-bottom: 10px;
        }

        .legend {
            flex-wrap: wrap;
            justify-content: flex-start;
        }
    }

    @media screen and (min-width: 768px) {
        .card-primary {
            max-width: 2000px;
        }
    }
</style>



<x-app>
    <div class="card-header">
        <h5 class="m-0 font-weight-bold text-dark" style="font-size: 30px">SELAMAT DATANG, {{ auth()->user()->nama }}</h5>
        <h6>Silahkan Tekan Tanggal Dikalender Untuk Melihat Jadwal Pertemuan Yang Telah Di Tentukan</h6>
    </div><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <a class="navbar-brand" href="#">Dashboard - Kalender Jadwal Konsultasi Satker Customer
                        Services</a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <div class="legend">
                                    <div class="legend-item">
                                        <div class="legend-color legend-red"></div>
                                        <span>Belum Dimulai</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color legend-yellow"></div>
                                        <span>Sedang Dimulai</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color legend-green"></div>
                                        <span>Sudah Selesai</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="card-primary">
                    <div id="calendar2"></div>
                </div>
                <div class="modal fade" id="eventModal2" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Pertemuan Jadwal KPPN Ketapang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>
                <div id="eventTitle2"></div>
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <a class="navbar-brand" href="#">Dashboard - Kalender Jadwal Konsultasi Khusus</a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <div class="legend">
                                    <div class="legend-item">
                                        <div class="legend-color legend-red"></div>
                                        <span>Belum Dimulai</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color legend-yellow"></div>
                                        <span>Sedang Dimulai</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color legend-green"></div>
                                        <span>Sudah Selesai</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="card-primary">
                    <div id="calendar1"></div>
                </div>
                <div class="modal fade" id="eventModal1" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Detail Pertemuan Jadwal KPPN Ketapang
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>
                <div id="eventTitle1"></div>
            </div>
        </div>
    </div>
</x-app>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar2');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            // Konfigurasi kalender
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prev,next today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: function(info, successCallback, failureCallback) {
                // Kirim permintaan HTTP untuk mengambil data dari endpoint
                var url = 'http://localhost:8000/user/dashboard/get-events1';
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        // Format data yang diterima untuk dimasukkan ke kalender
                        var events = [];
                        // Proses data dari server
                        data.forEach(function(entry) {
                            var eventTitle = entry.title;
                            var eventStart = entry.start;
                            var eventColor = entry.color;
                            events.push({
                                title: eventTitle,
                                start: eventStart,
                                color: eventColor
                            });
                        });
                        // Panggil successCallback untuk memasukkan data ke kalender
                        successCallback(events);
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan kesalahan jika terjadi masalah
                        console.error("Error fetching events:", status, error);
                        // Panggil failureCallback jika terjadi kesalahan
                        failureCallback();
                    }
                });
            },

            dateClick: function(info) {
                // Kosongkan konten modal sebelum menambahkan data LPJ yang baru
                clearModal();

                // Tampilkan modal
                $('#eventModal2').modal('show');

                // Kirim permintaan AJAX untuk mendapatkan informasi LPJ, SPD, SP2D, dan ADDK berdasarkan tanggal_pengajuan
                $.ajax({
                    url: 'http://localhost:8000/user/dashboard/get-satker-by-date1/' +
                        info.dateStr,
                    type: 'GET',
                    success: function(response) {
                        var lpj = response.lpj || [];
                        var spd = response.spd || [];
                        var sp2d = response.sp2d || [];
                        var spm = response.spm || [];
                        var addk = response.addk || [];


                        // Gabungkan semua data dari LPJ, SPD, SP2D, ADDK, dan SPM menjadi satu array
                        var allData = lpj.concat(spd, sp2d, spm, addk);

                        // Urutkan array berdasarkan kolom "jam_pengajuan"
                        allData.sort(function(a, b) {
                            // Ubah format jam_pengajuan menjadi format yang dapat dibandingkan
                            var timeA = new Date("1970/01/01 " + a
                                .jam_pengajuan).getTime();
                            var timeB = new Date("1970/01/01 " + b
                                .jam_pengajuan).getTime();
                            // Urutkan berdasarkan jam_pengajuan dari yang terkecil ke yang terbesar
                            return timeA - timeB;
                        });

                        // Variabel untuk menyimpan HTML konten modal
                        var modalContent = '';

                        // Loop melalui setiap entri data yang telah diurutkan
                        // Loop melalui setiap entri data yang telah diurutkan
                        // Loop melalui setiap entri data yang telah diurutkan
                        allData.forEach(function(item, index) {
                            // Tambahkan judul untuk jenis data saat ini
                            if (lpj && index < lpj.length) {
                                modalContent +=
                                    '<h6>DAFTAR JADWAL CSO LAPORAN PERTANGGUNGJAWABAN</h6>';
                            } else if (spd && index >= lpj.length && index < lpj
                                .length + spd.length) {
                                modalContent +=
                                    '<h6>DAFTAR JADWAL CSO SURAT PERJALANAN DINAS</h6>';
                            } else if (sp2d && index >= lpj.length + spd
                                .length && index < lpj.length + spd.length +
                                sp2d.length) {
                                modalContent +=
                                    '<h6>DAFTAR JADWAL CSO SURAT PERINTAH PERCAIRAN DANA</h6>';
                            } else if (spm && index >= lpj.length + spd.length +
                                sp2d.length && index < lpj.length + spd.length +
                                sp2d.length + spm.length) {
                                modalContent +=
                                    '<h6>DAFTAR JADWAL CSO SURAT PERINTAH MEMBAYAR</h6>';
                            } else if (addk && index >= lpj.length + spd
                                .length + sp2d.length + spm.length) {
                                modalContent +=
                                    '<h6>DAFTAR JADWAL CSO ADDENDUM KONTRAK</h6>';
                            }

                            // Tambahkan detail ke dalam konten modal
                            modalContent += '<div class="item">';
                            modalContent +=
                                '<p><strong>Nama Satker :</strong> ' +
                                (item
                                    .pegawai ? item.satker.nama_satker :
                                    'Satker tidak ditemukan') + '</p>';
                            modalContent +=
                                '<p><strong>Kode Satker :</strong> ' +
                                (item
                                    .pegawai ? item.satker.kode_satker :
                                    'Kode Satker tidak ditemukan') + '</p>';
                            modalContent +=
                                '<p><strong>Nama Pegawai KPPN Yang Di Pilih :</strong> ' +
                                (item
                                    .pegawai ? item.pegawai.nama_pegawai :
                                    'Pegawai tidak ditemukan') + '</p>';
                            modalContent +=
                                '<p><strong>Jam Mulai Pertemuan :</strong> ' +
                                item
                                .jam_pengajuan + ' WIB</p>';
                            modalContent +=
                                '<p><strong>Jam Selesai Pertemuan :</strong> ' +
                                item
                                .jam_selesai + ' WIB </p>';

                            // Tambahkan informasi tambahan sesuai kebutuhan
                            modalContent += '</div>';

                            // Tambahkan batas horizontal setelah setiap item, kecuali untuk item terakhir dalam loop
                            if (index < allData.length - 1) {
                                modalContent += '<hr>';
                            }
                        });


                        // Tampilkan konten ke dalam modal
                        $('.modal-body').html(modalContent);
                        // Tampilkan nama satker, jam pengajuan, dan warna di luar kalender sebagai title



                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Tampilkan pesan kesalahan jika terjadi kesalahan dalam permintaan AJAX
                        $('.modal-body').html(
                            '<p>Terjadi kesalahan saat memuat data.</p>');
                    }
                });
            },
            eventClick: function(info) {
                $('#eventModal1').modal('show');
                var eventStart = info.event.startStr;

                $.ajax({
                    url: 'http://localhost:8000/admin/calenderkhusus/get-satker-by-date/' +
                        eventStart,
                    type: 'GET',
                    success: function(response) {
                        var modalContent = '';

                        if (response.khusus && response.khusus.length > 0) {
                            modalContent += '<h6>DAFTAR JADWAL KONSULTASI KHUSUS</h6>';
                            response.khusus.forEach(function(item) {
                                modalContent += '<div class="item">';
                                modalContent +=
                                    '<p><strong>Nama Satker :</strong> ' + (item
                                        .satker ? item.satker.nama_satker :
                                        'Satker tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Kode Satker :</strong> ' + (item
                                        .satker ? item.satker.kode_satker :
                                        'Kode Satker tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Nama Pegawai KPPN Yang Di Pilih :</strong> ' +
                                    (item.pegawai ? item.pegawai.nama_pegawai :
                                        'Pegawai tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Jam Mulai Pertemuan :</strong> ' +
                                    item.jam_pengajuan + ' WIB</p>';
                                modalContent +=
                                    '<p><strong>Jam Selesai Pertemuan :</strong> ' +
                                    item.jam_selesai + ' WIB </p>';
                                modalContent += '</div>';
                                modalContent += '<hr>';
                            });
                        } else {
                            modalContent +=
                                '<p>Tidak ada data Jadwal Khusus untuk tanggal ini.</p>';
                        }

                        $('.modal-body').html(modalContent);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('.modal-body').html(
                            '<p>Terjadi kesalahan saat memuat data.</p>');
                    }
                });
            },


            select: function(info) {
                // Implementasi apa yang akan terjadi ketika rentang tanggal dipilih
                // Misalnya, Anda dapat menampilkan pesan atau menangani operasi lainnya
                console.log('Rentang tanggal dipilih:', info);
            }
        });

        calendar.render();

        function clearModal() {
            // Kosongkan konten modal
            $('.modal-body').empty();
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar1');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            // Konfigurasi kalender
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prev,next today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: function(info, successCallback, failureCallback) {
                // Kirim permintaan HTTP untuk mengambil data dari endpoint
                var url = 'http://localhost:8000/user/dashboard/get-events';
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        // Format data yang diterima untuk dimasukkan ke kalender
                        var events = [];
                        // Proses data dari server
                        data.forEach(function(entry) {
                            var eventTitle = entry.title;
                            var eventStart = entry.start;
                            var eventColor = entry.color;
                            events.push({
                                title: eventTitle,
                                start: eventStart,
                                color: eventColor
                            });
                        });
                        // Panggil successCallback untuk memasukkan data ke kalender
                        successCallback(events);
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan kesalahan jika terjadi masalah
                        console.error("Error fetching events:", status, error);
                        // Panggil failureCallback jika terjadi kesalahan
                        failureCallback();
                    }
                });
            },

            dateClick: function(info) {
                // Kosongkan konten modal sebelum menambahkan data
                clearModal();

                // Tampilkan modal
                $('#eventModal1').modal('show');

                // Kirim permintaan AJAX untuk mendapatkan informasi LPJ, SPD, SP2D, dan ADDK berdasarkan tanggal_pengajuan
                $.ajax({
                    url: 'http://localhost:8000/user/dashboard/get-satker-by-date/' +
                        info.dateStr,
                    type: 'GET',
                    success: function(response) {
                        // Variabel untuk menyimpan HTML konten modal
                        var modalContent = '';


                        // Tampilkan hanya jenis data LPJ yang ada
                        if (response.khusus && response.khusus.length > 0) {
                            modalContent +=
                                '<h6>DAFTAR JADWAL KONSULTASI KHUSUS</h6>';
                            response.khusus.forEach(function(item) {
                                modalContent += '<div class="item">';
                                modalContent +=
                                    '<p><strong>Nama Satker :</strong> ' +
                                    (item.satker ? item.satker.nama_satker :
                                        'Satker tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Kode Satker :</strong> ' +
                                    (item.satker ? item.satker.kode_satker :
                                        'Kode Satker tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Nama Pegawai KPPN Yang Di Pilih :</strong> ' +
                                    (item.pegawai ? item.pegawai.nama_pegawai :
                                        'Pegawai tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Jam Mulai Pertemuan :</strong> ' +
                                    item.jam_pengajuan + ' WIB</p>';
                                modalContent +=
                                    '<p><strong>Jam Selesai Pertemuan :</strong> ' +
                                    item.jam_selesai + ' WIB </p>';
                                modalContent += '</div>';
                                modalContent += '<hr>';
                            });
                        } else {
                            modalContent +=
                                '<p>Tidak ada data Jadwal Khusus untuk tanggal ini.</p>';
                        }

                        // Tampilkan konten ke dalam modal
                        $('.modal-body').html(modalContent);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Tampilkan pesan kesalahan jika terjadi kesalahan dalam permintaan AJAX
                        $('.modal-body').html(
                            '<p>Terjadi kesalahan saat memuat data.</p>');
                    }
                });
            },

            eventClick: function(info) {
                $('#eventModal1').modal('show');
                var eventStart = info.event.startStr;

                $.ajax({
                    url: 'http://localhost:8000/admin/calenderkhusus/get-satker-by-date/' +
                        eventStart,
                    type: 'GET',
                    success: function(response) {
                        var modalContent = '';

                        if (response.khusus && response.khusus.length > 0) {
                            modalContent += '<h6>DAFTAR JADWAL KONSULTASI KHUSUS</h6>';
                            response.khusus.forEach(function(item) {
                                modalContent += '<div class="item">';
                                modalContent +=
                                    '<p><strong>Nama Satker :</strong> ' + (item
                                        .satker ? item.satker.nama_satker :
                                        'Satker tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Kode Satker :</strong> ' + (item
                                        .satker ? item.satker.kode_satker :
                                        'Kode Satker tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Nama Pegawai KPPN Yang Di Pilih :</strong> ' +
                                    (item.pegawai ? item.pegawai.nama_pegawai :
                                        'Pegawai tidak ditemukan') + '</p>';
                                modalContent +=
                                    '<p><strong>Jam Mulai Pertemuan :</strong> ' +
                                    item.jam_pengajuan + ' WIB</p>';
                                modalContent +=
                                    '<p><strong>Jam Selesai Pertemuan :</strong> ' +
                                    item.jam_selesai + ' WIB </p>';
                                modalContent += '</div>';
                                modalContent += '<hr>';
                            });
                        } else {
                            modalContent +=
                                '<p>Tidak ada data Jadwal Khusus untuk tanggal ini.</p>';
                        }

                        $('.modal-body').html(modalContent);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('.modal-body').html(
                            '<p>Terjadi kesalahan saat memuat data.</p>');
                    }
                });
            },

            select: function(info) {
                // Implementasi apa yang akan terjadi ketika rentang tanggal dipilih
                // Misalnya, Anda dapat menampilkan pesan atau menangani operasi lainnya
                console.log('Rentang tanggal dipilih:', info);
            }
        });

        calendar.render();

        function clearModal() {
            // Kosongkan konten modal
            $('.modal-body').empty();
        }
    });
</script>
