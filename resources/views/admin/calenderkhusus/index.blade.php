<style>
    .card-primary {
        width: 100%;
        height: 100%;


        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .fc-header-toolbar.fc-toolbar {
        /* Tambahkan gaya CSS sesuai kebutuhan untuk membuatnya terlihat rapi */
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        /* Tambahkan gaya CSS untuk membatasi lebar headerToolbar */
        max-width: calc(100% - 40px);
        /* Sesuaikan dengan padding dan margin kartu */
        overflow: hidden;
        /* Untuk mengatasi teks yang melebihi lebar headerToolbar */
    }

    @media screen and (max-width: 767px) {
        .card-primary {
            padding: 10px;
            /* Kurangi padding pada layar kecil */
            margin: 10px auto;
            /* Atur margin agar tetap rapi */
        }

        .fc-header-toolbar.fc-toolbar {
            flex-wrap: wrap;
            /* Agar item-item pada toolbar bisa memenuhi ruang */
            justify-content: center;
            /* Agar item-item pada toolbar berada di tengah */
        }
    }

    @media screen and (min-width: 768px) {
        .card-primary {
            max-width: 800px;
        }
    }
</style>


<x-app>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pemberituan Jadwal</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/calenderkhusus') }}" method="post"
                                enctype="multipart/form-datas">
                                @csrf
                                @php
                                    $data_found = false;
                                @endphp

                                @foreach ($list_khusus as $khusus)
                                    @php
                                        $existing_calendar = App\Models\Calender2::where(
                                            'id_khusus',
                                            $khusus->id,
                                        )->exists();
                                    @endphp

                                    @if (!$existing_calendar)
                                        @php
                                            $data_found = true;
                                        @endphp

                                        <!-- Jika id_khusus tidak ada dalam Calender2, tampilkan elemen form -->

                                        <div class="form-group">
                                            <label for="kode_satker" class="form-label">Kode Satker</label>
                                            <select class="form-control" id="kode_satker" name="kode_satker">
                                                <option value="{{ optional($khusus->satker)->kode_satker }}">
                                                    {{ optional($khusus->satker)->kode_satker }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_satker" class="form-label">Nama Satker</label>
                                            <select class="form-control" id="nama_satker" name="nama_satker">
                                                <option value="{{ optional($khusus->satker)->nama_satker }}">
                                                    {{ optional($khusus->satker)->nama_satker }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                            <input type="text" class="form-control" id="nama_pegawai"
                                                value="{{ optional($khusus->pegawai)->nama_pegawai }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="jam_pengajuan" class="form-label">Jam Pengajuan</label>
                                            <input type="text" class="form-control" id="jam_pengajuan"
                                                value="{{ $khusus->jam_pengajuan }} WIB" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                            <input type="text" class="form-control" id="jam_selesai"
                                                value="{{ $khusus->jam_selesai }} WIB" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                JADWAL</label>
                                            <input type="text" name="tanggal_pengajuan"
                                                value="{{ $khusus->tanggal_pengajuan }}" class="form-control datepicker"
                                                id="tanggal_pengajuan" readonly>
                                        </div>
                                    @endif
                                @endforeach

                                <!-- Jika ada data, tampilkan tombol Simpan -->
                                @if ($data_found)
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">KETERANGAN EVENT TITLE KALENDER </h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <p><i class="fas fa-square text-danger"></i> Merah : Jadwal belum dimulai</p>
                                <p><i class="fas fa-square text-warning"></i> Kuning : Jadwal sedang berlangsung</p>
                                <p><i class="fas fa-square text-success"></i> Hijau : Jadwal telah selesai</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-primary float-right" style="margin-left: 5%">
                <div id="calendar"></div>
            </div> <!-- Menutup div yang mengandung kalender -->


            <div style="margin-left: 30%;  margin-top: 70px;" class="card-header py-2">
                <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">
                    DATA JADWAL KALENDER KHUSUS
                </h5>
            </div>
            <div style="margin-left: 5%" class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-datatable table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th width="10px" class="text-center" style="color: white;">NO</th>
                                    <th class="text-center" style="color: white;">AKSI</th>
                                    <th class="text-center" style="color: white;">NAMA SATKER</th>
                                    <th class="text-center" style="color: white;">KODE SATKER</th>
                                    <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                                    <th class="text-center" style="color: white;">NAMA KUNJUNGAN</th>
                                    <th class="text-center" style="color: white;">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calendarData as $index => $data)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="btn-group">
                                                {{-- <x-template.button.info-button url="admin/calenderkhusus"
                                                    id="{{ $data->id }}" />
                                                <x-template.button.edit-button url="admin/calenderkhusus"
                                                    id="{{ $data->id }}" /> --}}
                                                <x-template.button.delete-button url="admin/calenderkhusus"
                                                    id="{{ $data->id }}" />
                                            </div>
                                        </td>

                                        <td class="text-center">{{ $data->satker->nama_satker }}</td>
                                        <td class="text-center">{{ $data->satker->kode_satker }}</td>
                                        <td class="text-center">{{ $data->user->nama }}</td>
                                        <td class="text-center">{{ $data->tanggal_pengajuan }}</td>
                                        <td class="text-center"
                                            style="background-color: {{ $data->color }}; color: white; border: none; padding: 5px 10px;">
                                            @if ($data->color == 'red')
                                                Belum dimulai
                                            @elseif ($data->color == 'yellow')
                                                Sedang berlangsung
                                            @elseif ($data->color == 'green')
                                                Sudah selesai
                                            @else
                                                Status tidak dikenal
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Modal -->
            <div class="modal fade" id="eventModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pertemuan Jadwal KPPN Ketapang
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>

                    </div>
                </div>
            </div>
            <div id="eventTitle"></div>





        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>





    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "dd MM yy" // Format tanggal menjadi "dd MM yy"
            });
        });
    </script>

    <!-- Pastikan jQuery telah dimuat sebelum menggunakan script ini -->


    <!-- script nampilkan modal -->





    <!--End Script-->


</x-app>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prev,next today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            dateClick: function(info) {
                $('#eventModal').modal('show');
                var modalBody = $('#modalBody');
                modalBody.html('<p>Tanggal yang dipilih: ' + info.dateStr + '</p>');
            }
        });

        calendar.render();
    });
</script> --}}


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

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
                var url = 'http://localhost:8000/admin/calenderkhusus/get-events';
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
                $('#eventModal').modal('show');

                // Kirim permintaan AJAX untuk mendapatkan informasi LPJ, SPD, SP2D, dan ADDK berdasarkan tanggal_pengajuan
                $.ajax({
                    url: 'http://localhost:8000/admin/calenderkhusus/get-satker-by-date/' +
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
                $('#eventModal').modal('show');
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
