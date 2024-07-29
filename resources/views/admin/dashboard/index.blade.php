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
                            <form action="{{ url('admin/dashboard') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_jadwal" class="form-label">Pilih Jadwal Pengajuan</label>
                                    <select class="form-control" id="nama_jadwal" name="nama_jadwal" required>
                                        <option disabled selected>Pilih Jadwal</option>
                                        <option value="1">LPJ</option>
                                        <option value="2">SPD</option>
                                        <option value="3">SPM</option>
                                        <option value="4">SP2D</option>
                                        <option value="5">Addedum Kontrak</option>

                                    </select>
                                </div>


                                <!-- Element LPJ -->
                                <div class="lpj-fields" id="lpj-fields" style="display: none;">

                                    @foreach ($list_lpj as $lpj)
                                        @php
                                            // Periksa apakah LPJ sudah ada dalam Calender1
                                            $existing_calendar = App\Models\Calender1::where(
                                                'id_lpj',
                                                $lpj->id,
                                            )->exists();
                                        @endphp

                                        @if (!$existing_calendar)
                                            <!-- Tambahkan elemen form jika id_lpj belum ada dalam database -->

                                            <div class="mb-3 lpj-fields">
                                                <!-- Isi elemen form sesuai dengan kebutuhan -->
                                                <label for="kode_satker" class="form-label">Kode Satker</label>
                                                <select class="form-control" id="kode_satker" name="kode_satker">
                                                    <option value="{{ optional($lpj->satker)->kode_satker }}">
                                                        {{ optional($lpj->satker)->kode_satker }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3 lpj-fields">
                                                <label for="nama_satker" class="form-label">Nama Satker</label>
                                                <select class="form-control" id="nama_satker" name="nama_satker">
                                                    <option value="{{ optional($lpj->satker)->nama_satker }}">
                                                        {{ optional($lpj->satker)->nama_satker }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 lpj-fields">
                                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    value="{{ optional($lpj->pegawai)->nama_pegawai }}" readonly>
                                            </div>
                                            <div class="mb-3 lpj-fields">
                                                <label for="jam_pengajuan" class="form-label">Jam Pengajuan</label>
                                                <input type="text" class="form-control" id="jam_pengajuan"
                                                    value="{{ $lpj->jam_pengajuan }} WIB" readonly>
                                            </div>
                                            <div class="mb-3 lpj-fields">
                                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control" id="jam_selesai"
                                                    value="{{ $lpj->jam_selesai }} WIB" readonly>
                                            </div>
                                            {{-- <div class="mb-3 lpj-fields">
                                                <label for="tanggal_pengajuan" class="form-label">Tanggal
                                                    Pengajuan</label>
                                                <input type="date" class="form-control" id="tanggal_pengajuan"
                                                    value="{{ $lpj->tanggal_pengajuan }}" readonly>
                                            </div> --}}
                                            <div class="mb-3 lpj-fields">
                                                <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                    JADWAL</label>
                                                <input type="text" name="tanggal_pengajuan"
                                                    value="{{ $lpj->tanggal_pengajuan }}"
                                                    class="form-control datepicker" id="tanggal_pengajuan" readonly>
                                            </div>

                                            {{-- <div class="mb-3 lpj-fields">
                                                <label for="color">Pilih warna:</label>
                                                <select id="color" name="color" class="form-control">
                                                    <option value="red">Belum dimulai (Merah)</option>
                                                    <option value="yellow">Sedang berlangsung (Kuning)</option>
                                                    <option value="green">Sudah selesai (Hijau)</option>
                                                </select>
                                            </div> --}}
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Element SPD -->
                                <div class="spd-fields" id="spd-fields" style="display: none;">
                                    @foreach ($list_spd as $spd)
                                        @php
                                            // Periksa apakah SPD sudah ada dalam Calender1
                                            $existing_calendar = App\Models\Calender1::where(
                                                'id_spd',
                                                $spd->id,
                                            )->exists();
                                        @endphp

                                        @if (!$existing_calendar)
                                            <div class="mb-3 spd-fields">
                                                <!-- Isi elemen form sesuai dengan kebutuhan -->
                                                <label for="kode_satker" class="form-label">Kode Satker</label>
                                                <select class="form-control" id="kode_satker" name="kode_satker">
                                                    <option value="{{ optional($spd->satker)->kode_satker }}">
                                                        {{ optional($spd->satker)->kode_satker }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3 spd-fields">
                                                <label for="nama_satker" class="form-label">Nama Satker</label>
                                                <select class="form-control" id="nama_satker" name="nama_satker">
                                                    <option value="{{ optional($spd->satker)->nama_satker }}">
                                                        {{ optional($spd->satker)->nama_satker }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 spd-fields">
                                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    value="{{ optional($spd->pegawai)->nama_pegawai }}" readonly>
                                            </div>
                                            <div class="mb-3 spd-fields">
                                                <label for="jam_pengajuan" class="form-label">Jam Pengajuan</label>
                                                <input type="text" class="form-control" id="jam_pengajuan"
                                                    value="{{ $spd->jam_pengajuan }} WIB" readonly>
                                            </div>
                                            <div class="mb-3 spd-fields">
                                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control" id="jam_selesai"
                                                    value="{{ $spd->jam_selesai }} WIB" readonly>
                                            </div>
                                            <div class="mb-3 spd-fields">
                                                <label for="tanggal_pengajuan" class="form-label">Tanggal
                                                    Pengajuan</label>
                                                <input type="date" class="form-control" id="tanggal_pengajuan"
                                                    value="{{ $spd->tanggal_pengajuan }}" readonly>
                                            </div>
                                            <div class="mb-3 spd-fields">
                                                <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                    JADWAL</label>
                                                <input type="text" name="tanggal_pengajuan"
                                                    value="{{ $spd->tanggal_pengajuan }}"
                                                    class="form-control datepicker" id="tanggal_pengajuan" readonly>
                                            </div>

                                            {{-- <div class="mb-3 spd-fields">
                                                <label for="color">Pilih warna:</label>
                                                <select id="color" name="color" class="form-control">
                                                    <option value="red">Belum dimulai (Merah)</option>
                                                    <option value="yellow">Sedang berlangsung (Kuning)</option>
                                                    <option value="green">Sudah selesai (Hijau)</option>
                                                </select>
                                            </div> --}}
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Element SPM -->
                                <div class="spm-fields" id="spm-fields" style="display: none;">
                                    @foreach ($list_spm as $spm)
                                        @php
                                            // Periksa apakah spm sudah ada dalam Calender1
                                            $existing_calendar = App\Models\Calender1::where(
                                                'id_spm',
                                                $spm->id,
                                            )->exists();
                                        @endphp

                                        @if (!$existing_calendar)
                                            <div class="mb-3 spm-fields">
                                                <!-- Isi elemen form sesuai dengan kebutuhan -->
                                                <label for="kode_satker" class="form-label">Kode Satker</label>
                                                <select class="form-control" id="kode_satker" name="kode_satker">
                                                    <option value="{{ optional($spm->satker)->kode_satker }}">
                                                        {{ optional($spm->satker)->kode_satker }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3 spm-fields">
                                                <label for="nama_satker" class="form-label">Nama Satker</label>
                                                <select class="form-control" id="nama_satker" name="nama_satker">
                                                    <option value="{{ optional($spm->satker)->nama_satker }}">
                                                        {{ optional($spm->satker)->nama_satker }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 spm-fields">
                                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    value="{{ optional($spm->pegawai)->nama_pegawai }}" readonly>
                                            </div>
                                            <div class="mb-3 spm-fields">
                                                <label for="jam_pengajuan" class="form-label">Jam Pengajuan</label>
                                                <input type="text" class="form-control" id="jam_pengajuan"
                                                    value="{{ $spm->jam_pengajuan }} WIB" readonly>
                                            </div>
                                            <div class="mb-3 spm-fields">
                                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control" id="jam_selesai"
                                                    value="{{ $spm->jam_selesai }} WIB" readonly>
                                            </div>
                                            {{-- <div class="mb-3 spm-fields">
                                                <label for="tanggal_pengajuan" class="form-label">Tanggal
                                                    Pengajuan</label>
                                                <input type="date" class="form-control" id="tanggal_pengajuan"
                                                    value="{{ $spm->tanggal_pengajuan }}" readonly>
                                            </div> --}}
                                            <div class="mb-3 spm-fields">
                                                <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                    JADWAL</label>
                                                <input type="text" name="tanggal_pengajuan"
                                                    value="{{ $spm->tanggal_pengajuan }}"
                                                    class="form-control datepicker" id="tanggal_pengajuan" readonly>
                                            </div>

                                            {{-- <div class="mb-3 spm-fields">
                                                <label for="color">Pilih warna:</label>
                                                <select id="color" name="color" class="form-control">
                                                    <option value="red">Belum dimulai (Merah)</option>
                                                    <option value="yellow">Sedang berlangsung (Kuning)</option>
                                                    <option value="green">Sudah selesai (Hijau)</option>
                                                </select>
                                            </div> --}}
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Element SP2D-->
                                <div class="sp2d-fields" id="sp2d-fields" style="display: none;">
                                    @foreach ($list_sp2d as $sp2d)
                                        @php
                                            // Periksa apakah sp2d sudah ada dalam Calender1
                                            $existing_calendar = App\Models\Calender1::where(
                                                'id_sp2d',
                                                $sp2d->id,
                                            )->exists();
                                        @endphp

                                        @if (!$existing_calendar)
                                            <div class="mb-3 sp2d-fields">
                                                <!-- Isi elemen form sesuai dengan kebutuhan -->
                                                <label for="kode_satker" class="form-label">Kode Satker</label>
                                                <select class="form-control" id="kode_satker" name="kode_satker">
                                                    <option value="{{ optional($sp2d->satker)->kode_satker }}">
                                                        {{ optional($sp2d->satker)->kode_satker }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3 sp2d-fields">
                                                <label for="nama_satker" class="form-label">Nama Satker</label>
                                                <select class="form-control" id="nama_satker" name="nama_satker">
                                                    <option value="{{ optional($sp2d->satker)->nama_satker }}">
                                                        {{ optional($sp2d->satker)->nama_satker }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 sp2d-fields">
                                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    value="{{ optional($sp2d->pegawai)->nama_pegawai }}" readonly>
                                            </div>
                                            <div class="mb-3 sp2d-fields">
                                                <label for="jam_pengajuan" class="form-label">Jam Pengajuan</label>
                                                <input type="text" class="form-control" id="jam_pengajuan"
                                                    value="{{ $sp2d->jam_pengajuan }} WIB" readonly>
                                            </div>
                                            <div class="mb-3 sp2d-fields">
                                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control" id="jam_selesai"
                                                    value="{{ $sp2d->jam_selesai }} WIB" readonly>
                                            </div>
                                            {{-- <div class="mb-3 sp2d-fields">
                                                <label for="tanggal_pengajuan" class="form-label">Tanggal
                                                    Pengajuan</label>
                                                <input type="date" class="form-control" id="tanggal_pengajuan"
                                                    value="{{ $sp2d->tanggal_pengajuan }}" readonly>
                                            </div> --}}
                                            <div class="mb-3 sp2d-fields">
                                                <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                    JADWAL</label>
                                                <input type="text" name="tanggal_pengajuan"
                                                    value="{{ $sp2d->tanggal_pengajuan }}"
                                                    class="form-control datepicker" id="tanggal_pengajuan" readonly>
                                            </div>

                                            {{-- <div class="mb-3 sp2d-fields">
                                                <label for="color">Pilih warna:</label>
                                                <select id="color" name="color" class="form-control">
                                                    <option value="red">Belum dimulai (Merah)</option>
                                                    <option value="yellow">Sedang berlangsung (Kuning)</option>
                                                    <option value="green">Sudah selesai (Hijau)</option>
                                                </select>
                                            </div> --}}
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Element Addedum Kontrak -->
                                <div class="addk-fields" id="addk-fields" style="display: none;">
                                    @foreach ($list_addk as $addk)
                                        @php
                                            // Periksa apakah addk sudah ada dalam Calender1
                                            $existing_calendar = App\Models\Calender1::where(
                                                'id_addk',
                                                $addk->id,
                                            )->exists();
                                        @endphp

                                        @if (!$existing_calendar)
                                            <div class="mb-3 addk-fields">
                                                <!-- Isi elemen form sesuai dengan kebutuhan -->
                                                <label for="kode_satker" class="form-label">Kode Satker</label>
                                                <select class="form-control" id="kode_satker" name="kode_satker">
                                                    <option value="{{ optional($addk->satker)->kode_satker }}">
                                                        {{ optional($addk->satker)->kode_satker }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3 addk-fields">
                                                <label for="nama_satker" class="form-label">Nama Satker</label>
                                                <select class="form-control" id="nama_satker" name="nama_satker">
                                                    <option value="{{ optional($addk->satker)->nama_satker }}">
                                                        {{ optional($addk->satker)->nama_satker }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 addk-fields">
                                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    value="{{ optional($addk->pegawai)->nama_pegawai }}" readonly>
                                            </div>
                                            <div class="mb-3 addk-fields">
                                                <label for="jam_pengajuan" class="form-label">Jam Pengajuan</label>
                                                <input type="text" class="form-control" id="jam_pengajuan"
                                                    value="{{ $addk->jam_pengajuan }} WIB" readonly>
                                            </div>
                                            <div class="mb-3 addk-fields">
                                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control" id="jam_selesai"
                                                    value="{{ $addk->jam_selesai }} WIB" readonly>
                                            </div>
                                            {{-- <div class="mb-3 addk-fields">
                                                <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                    JADWAL</label>
                                                <input type="text" name="tanggal_pengajuan"
                                                    value="{{ $addk->tanggal_pengajuan }}"
                                                    class="form-control datepicker" id="tanggal_pengajuan" readonly>
                                            </div> --}}
                                            <div class="mb-3 addk-fields">
                                                <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN
                                                    JADWAL</label>
                                                <input type="text" name="tanggal_pengajuan"
                                                    value="{{ $addk->tanggal_pengajuan }}"
                                                    class="form-control datepicker" id="tanggal_pengajuan" readonly>
                                            </div>

                                            {{-- <div class="mb-3 addk-fields">
                                                <label for="color">Pilih warna:</label>
                                                <select id="color" name="color" class="form-control">
                                                    <option value="red">Belum dimulai (Merah)</option>
                                                    <option value="yellow">Sedang berlangsung (Kuning)</option>
                                                    <option value="green">Sudah selesai (Hijau)</option>
                                                </select>
                                            </div> --}}
                                        @endif
                                    @endforeach
                                </div>


                                <button type="submit" class="btn btn-primary">Simpan</button>
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
            <br><br><br>

            <div style="margin-left: 12%" class="card-header py-2">
                <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">
                    DATA JADWAL KALENDER UMUM CUSTOMER SERVICER OFFICER
                </h5>
            </div>
            <div style="margin-left: 5%" class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="dataSelect">Select Data:</label>
                        <select id="dataSelect" class="form-control" style="width: 200px;">
                            <option value="id_lpj">LPJ</option>
                            <option value="id_spd">SPD</option>
                            <option value="id_spm">SPM</option>
                            <option value="id_sp2d">SP2D</option>
                            <option value="id_addk">Addedum Kontrak</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-datatable table-bordered">
                            <thead class="bg-dark">
                                <tr>
                                    <th width="10px" class="text-center" style="color: white;">NO</th>
                                    <th width="90px" class="text-center" style="color: white;">AKSI</th>
                                    <th class="text-center" style="color: white;">NAMA SATKER</th>
                                    <th class="text-center" style="color: white;">KODE SATKER</th>
                                    <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                                    <th class="text-center" style="color: white;">JAM PENGAJUAN</th>
                                    <th width="5%" class="text-center" style="color: white;">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Load jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarData = @json($calendarData);

            function toggleColumnsAndFillTable(selectedValue) {
                // Hide all rows initially
                $("#data-table tbody").empty();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (selectedValue === "id_lpj") {
                    // Filter calendarData for LPJ entries
                    var filteredData = calendarData.filter(function(data) {
                        return data.id_lpj !== null; // Change this according to your data structure
                    });

                    // Fill table with filtered LPJ data
                    filteredData.forEach(function(data, index) {
                        var row = "<tr>" +
                            "<td class='text-center'>" + (index + 1) + "</td>" +
                            "<td class='text-center'>" +
                            "<form action='/admin/dashboard/" + data.id +
                            "' method='POST' style='display:inline-block;'>" +
                            "<input type='hidden' name='_token' value='" + csrfToken + "'>" +
                            "<input type='hidden' name='_method' value='DELETE'>" +
                            "<button type='submit' class='btn btn-sm btn-danger'>Delete</button>" +
                            "</form>" +
                            "</td>" +
                            "<td class='text-center'>" + (data.lpj ? data.lpj.satker.nama_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + (data.lpj ? data.lpj.satker.kode_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + data.tanggal_pengajuan + "</td>" +
                            "<td class='text-center'>" + data.lpj.jam_pengajuan + " WIB</td>" +
                            "<td class='text-center'><button style='background-color: " + data.color +
                            "; color: white; border: none; padding: 5px 10px;'>" +
                            (data.color === 'yellow' ? 'Sedang Berlangsung' :
                                (data.color === 'red' ? 'Belum di Mulai' :
                                    (data.color === 'green' ? 'Sudah Selesai' : data.color))) +
                            "</button></td>"

                        "</tr>";
                        $("#data-table tbody").append(row);
                    });
                    $(document).on('submit', 'form[id^=form-delete-]', function(event) {
                        event.preventDefault();
                        var form = $(this);

                        // Lakukan AJAX request untuk menghapus data
                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Hapus baris dari tabel jika berhasil dihapus
                                form.closest('tr').remove();

                                // Tampilkan alert atau modal sukses
                                alert('Data Berhasil Dihapus');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Failed to delete data. Please try again.');
                            }
                        });
                    });
                } else if (selectedValue === "id_spd") {
                    // Filter calendarData for SPD entries
                    var filteredData = calendarData.filter(function(data) {
                        return data.id_spd !== null; // Change this according to your data structure
                    });

                    // Fill table with filtered SPD data
                    filteredData.forEach(function(data, index) {
                        var row = "<tr>" +
                            "<td class='text-center'>" + (index + 1) + "</td>" +
                            "<td class='text-center'>" +
                            // "<a href='/admin/dashboard/" + data.id +
                            // "/edit' class='btn btn-sm btn-warning'>Edit</a> " +
                            "<form action='/admin/dashboard/" + data.id +
                            "' method='POST' style='display:inline-block;'>" +
                            "<input type='hidden' name='_token' value='" + csrfToken + "'>" +
                            "<input type='hidden' name='_method' value='DELETE'>" +
                            "<button type='submit' class='btn btn-sm btn-danger'>Delete</button>" +
                            "</form>" +
                            "</td>" +
                            "<td class='text-center'>" + (data.spd ? data.spd.satker.nama_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + (data.spd ? data.spd.satker.kode_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + data.tanggal_pengajuan + "</td>" +
                            "<td class='text-center'>" + data.spd.jam_pengajuan + "</td>" +
                            "<td class='text-center'><button style='background-color: " + data.color +
                            "; color: white; border: none; padding: 5px 10px;'>" +
                            (data.color === 'yellow' ? 'Sedang Berlangsung' :
                                (data.color === 'red' ? 'Belum di Mulai' :
                                    (data.color === 'green' ? 'Sudah Selesai' : data.color))) +
                            "</button></td>"

                        "</tr>";
                        $("#data-table tbody").append(row);
                    });
                    $(document).on('submit', 'form[id^=form-delete-]', function(event) {
                        event.preventDefault();
                        var form = $(this);

                        // Lakukan AJAX request untuk menghapus data
                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Hapus baris dari tabel jika berhasil dihapus
                                form.closest('tr').remove();

                                // Tampilkan alert atau modal sukses
                                alert('Data Berhasil Dihapus');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Failed to delete data. Please try again.');
                            }
                        });
                    });
                } else if (selectedValue === "id_spm") {
                    // Filter calendarData for SPD entries
                    var filteredData = calendarData.filter(function(data) {
                        return data.id_spm !== null; // Change this according to your data structure
                    });

                    // Fill table with filtered SPD data
                    filteredData.forEach(function(data, index) {
                        var row = "<tr>" +
                            "<td class='text-center'>" + (index + 1) + "</td>" +
                            "<td class='text-center'>" +
                            // "<a href='/admin/dashboard/" + data.id +
                            // "/edit' class='btn btn-sm btn-warning'>Edit</a> " +
                            "<form action='/admin/dashboard/" + data.id +
                            "' method='POST' style='display:inline-block;'>" +
                            "<input type='hidden' name='_token' value='" + csrfToken + "'>" +
                            "<input type='hidden' name='_method' value='DELETE'>" +
                            "<button type='submit' class='btn btn-sm btn-danger'>Delete</button>" +
                            "</form>" +
                            "</td>" +
                            "<td class='text-center'>" + (data.spm ? data.spm.satker.nama_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + (data.spm ? data.spm.satker.kode_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + data.tanggal_pengajuan + "</td>" +
                            "<td class='text-center'>" + data.spm.jam_pengajuan + "</td>" +
                            "<td class='text-center'><button style='background-color: " + data.color +
                            "; color: white; border: none; padding: 5px 10px;'>" +
                            (data.color === 'yellow' ? 'Sedang Berlangsung' :
                                (data.color === 'red' ? 'Belum di Mulai' :
                                    (data.color === 'green' ? 'Sudah Selesai' : data.color))) +
                            "</button></td>"

                        "</tr>";
                        $("#data-table tbody").append(row);
                    });
                    $(document).on('submit', 'form[id^=form-delete-]', function(event) {
                        event.preventDefault();
                        var form = $(this);

                        // Lakukan AJAX request untuk menghapus data
                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Hapus baris dari tabel jika berhasil dihapus
                                form.closest('tr').remove();

                                // Tampilkan alert atau modal sukses
                                alert('Data Berhasil Dihapus');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Failed to delete data. Please try again.');
                            }
                        });
                    });
                } else if (selectedValue === "id_sp2d") {
                    // Filter calendarData for SPD entries
                    var filteredData = calendarData.filter(function(data) {
                        return data.id_sp2d !== null; // Change this according to your data structure
                    });

                    // Fill table with filtered SPD data
                    filteredData.forEach(function(data, index) {
                        var row = "<tr>" +
                            "<td class='text-center'>" + (index + 1) + "</td>" +
                            "<td class='text-center'>" +
                            "<form action='/admin/dashboard/" + data.id +
                            "' method='POST' style='display:inline-block;'>" +
                            "<input type='hidden' name='_token' value='" + csrfToken + "'>" +
                            "<input type='hidden' name='_method' value='DELETE'>" +
                            "<button type='submit' class='btn btn-sm btn-danger'>Delete</button>" +
                            "</form>" +
                            "</td>" +
                            "<td class='text-center'>" + (data.sp2d ? data.sp2d.satker.nama_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + (data.sp2d ? data.sp2d.satker.kode_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + data.tanggal_pengajuan + "</td>" +
                            "<td class='text-center'>" + data.sp2d.jam_pengajuan + "</td>" +
                            "<td class='text-center'><button style='background-color: " + data.color +
                            "; color: white; border: none; padding: 5px 10px;'>" +
                            (data.color === 'yellow' ? 'Sedang Berlangsung' :
                                (data.color === 'red' ? 'Belum di Mulai' :
                                    (data.color === 'green' ? 'Sudah Selesai' : data.color))) +
                            "</button></td>"

                        "</tr>";
                        $("#data-table tbody").append(row);
                    });
                    $(document).on('submit', 'form[id^=form-delete-]', function(event) {
                        event.preventDefault();
                        var form = $(this);

                        // Lakukan AJAX request untuk menghapus data
                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Hapus baris dari tabel jika berhasil dihapus
                                form.closest('tr').remove();

                                // Tampilkan alert atau modal sukses
                                alert('Data Berhasil Dihapus');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Failed to delete data. Please try again.');
                            }
                        });
                    });
                } else if (selectedValue === "id_addk") {
                    // Filter calendarData for SPD entries
                    var filteredData = calendarData.filter(function(data) {
                        return data.id_addk !== null; // Change this according to your data structure
                    });

                    // Fill table with filtered SPD data
                    filteredData.forEach(function(data, index) {
                        var row = "<tr>" +
                            "<td class='text-center'>" + (index + 1) + "</td>" +
                            "<td class='text-center'>" +
                            // "<a href='/admin/dashboard/" + data.id +
                            // "/edit' class='btn btn-sm btn-warning'>Edit</a> " +
                            "<form action='/admin/dashboard/" + data.id +
                            "' method='POST' style='display:inline-block;'>" +
                            "<input type='hidden' name='_token' value='" + csrfToken + "'>" +
                            "<input type='hidden' name='_method' value='DELETE'>" +
                            "<button type='submit' class='btn btn-sm btn-danger'>Delete</button>" +
                            "</form>" +
                            "</td>" +
                            "<td class='text-center'>" + (data.addk ? data.addk.satker.nama_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + (data.addk ? data.addk.satker.kode_satker : '') +
                            "</td>" +
                            "<td class='text-center'>" + data.tanggal_pengajuan + "</td>" +
                            "<td class='text-center'>" + data.addk.jam_pengajuan + "</td>" +
                            "<td class='text-center'><button style='background-color: " + data.color +
                            "; color: white; border: none; padding: 5px 10px;'>" +
                            (data.color === 'yellow' ? 'Sedang Berlangsung' :
                                (data.color === 'red' ? 'Belum di Mulai' :
                                    (data.color === 'green' ? 'Sudah Selesai' : data.color))) +
                            "</button></td>"

                        "</tr>";
                        $("#data-table tbody").append(row);
                    });
                    $(document).on('submit', 'form[id^=form-delete-]', function(event) {
                        event.preventDefault();
                        var form = $(this);

                        // Lakukan AJAX request untuk menghapus data
                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                // Hapus baris dari tabel jika berhasil dihapus
                                form.closest('tr').remove();

                                // Tampilkan alert atau modal sukses
                                alert('Data Berhasil Dihapus');
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Failed to delete data. Please try again.');
                            }
                        });
                    });
                }
            }

            // Trigger function on select change
            $("#dataSelect").change(function() {
                var selectedValue = $(this).val();
                toggleColumnsAndFillTable(selectedValue);
            });

            // Initialize table with default option
            toggleColumnsAndFillTable($("#dataSelect").val());
        });
    </script>


    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "dd MM yy" // Format tanggal menjadi "dd MM yy"
            });
        });
    </script>

    <!-- Pastikan jQuery telah dimuat sebelum menggunakan script ini -->


    <!-- script nampilkan modal -->
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
                    var url = 'http://localhost:8000/admin/dashboard/get-events';
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
                    $('#eventModal').modal('show');

                    // Kirim permintaan AJAX untuk mendapatkan informasi LPJ, SPD, SP2D, dan ADDK berdasarkan tanggal_pengajuan
                    $.ajax({
                        url: 'http://localhost:8000/admin/dashboard/get-satker-by-date/' +
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





    <!--End Script-->

    <script>
        $(document).ready(function() {
            // Ketika opsi pada select berubah
            $('#nama_jadwal').on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption === '1') {
                    // Jika LPJ dipilih, tampilkan elemen LPJ dan sembunyikan elemen-elemen lainnya
                    $('#lpj-fields').show();
                    $('#spd-fields, #spm-fields, #sp2d-fields, #addk-fields').hide();
                    // Isi data dari $list_lpj ke dalam elemen-elemen form LPJ
                    // Anda dapat menambahkan logika di sini untuk mengisi nilai-nilai form sesuai dengan data dari $list_lpj
                } else if (selectedOption === '2') {
                    // Jika SPD dipilih, tampilkan elemen SPD dan sembunyikan elemen-elemen lainnya
                    $('#spd-fields').show();
                    $('#lpj-fields, #spm-fields, #sp2d-fields, #addk-fields').hide();
                    // Isi data dari $list_spd ke dalam elemen-elemen form SPD
                    // Anda dapat menambahkan logika di sini untuk mengisi nilai-nilai form sesuai dengan data dari $list_spd
                } else if (selectedOption === '3') {
                    // Jika SPM dipilih, tampilkan elemen SPM dan sembunyikan elemen-elemen lainnya
                    $('#spm-fields').show();
                    $('#lpj-fields, #spd-fields, #sp2d-fields, #addk-fields').hide();
                    // Isi data dari $list_spm ke dalam elemen-elemen form SPM
                    // Anda dapat menambahkan logika di sini untuk mengisi nilai-nilai form sesuai dengan data dari $list_spm
                } else if (selectedOption === '4') {
                    // Jika SP2D dipilih, tampilkan elemen SP2D dan sembunyikan elemen-elemen lainnya
                    $('#sp2d-fields').show();
                    $('#lpj-fields, #spd-fields, #spm-fields, #addk-fields').hide();
                    // Isi data dari $list_sp2d ke dalam elemen-elemen form SP2D
                    // Anda dapat menambahkan logika di sini untuk mengisi nilai-nilai form sesuai dengan data dari $list_sp2d
                } else if (selectedOption === '5') {
                    // Jika Addedum Kontrak dipilih, tampilkan elemen Addedum Kontrak dan sembunyikan elemen-elemen lainnya
                    $('#addk-fields').show();
                    $('#lpj-fields, #spd-fields, #spm-fields, #sp2d-fields').hide();
                    // Isi data dari $list_addk ke dalam elemen-elemen form Addedum Kontrak
                    // Anda dapat menambahkan logika di sini untuk mengisi nilai-nilai form sesuai dengan data dari $list_addk
                } else {
                    // Jika opsi lain dipilih, sembunyikan semua elemen
                    $('#lpj-fields, #spd-fields, #spm-fields, #sp2d-fields, #addk-fields').hide();
                }
            });
        });
    </script>
</x-app>
