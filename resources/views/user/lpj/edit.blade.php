<x-app title="LPJ | Edit">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> EDIT DAFTAR JADWAL
            KONSULTASI LAPORAN
            PERTANGGUNGJAWABAN
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="user/lpj" />
    <div id="alertContainer" style="display: none;" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Peringatan!</strong> Pilih jam antara 08:00 - 17:00 Jam Kerja.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="alertContainer1" class="alert alert-warning alert-dismissible fade show" style="display: none;"
        role="alert">
        <strong>Peringatan:</strong> Pegawai sedang Sakit . Data tidak tersimpan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="alertContainer2" class="alert alert-danger alert-dismissible fade show" style="display: none;"
        role="alert">
        <strong>Peringatan:</strong> Pegawai sedang Cuti . Data tidak tersimpan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('user/lpj/' . $lpj->id) }}" method="post">
                @csrf
                @method('PUT') <!-- Menyatakan bahwa ini adalah metode PUT untuk mengirimkan form -->

                <h5>Data Pengajuan</h5><br>
                <!-- Bagian input untuk jam pengajuan, jam selesai, dan tanggal pengajuan -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jam_pengajuan">JAM MULAI PENGAJUAN:</label>
                            @if ($errors->has('jam_pengajuan'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('jam_pengajuan')[0] }}</label>
                            @endif
                            <input type="time" id="jam_pengajuan" name="jam_pengajuan" class="form-control"
                                value="{{ $lpj->jam_pengajuan }}" list="jamList">
                            <datalist id="jamList">
                                @for ($i = 7; $i <= 17; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00"></option>
                                @endfor
                            </datalist>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jam_selesai">JAM SELESAI PENGAJUAN:</label>
                            @if ($errors->has('jam_selesai'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('jam_selesai')[0] }}</label>
                            @endif
                            <input type="time" id="jam_selesai" name="jam_selesai" class="form-control"
                                value="{{ $lpj->jam_selesai }}" list="jamList">
                            <datalist id="jamList">
                                @for ($i = 7; $i <= 17; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00"></option>
                                @endfor
                            </datalist>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tanggal_pengajuan" class="control-label">TANGGAL PENGAJUAN JADWAL</label>
                            @if ($errors->has('tanggal_pengajuan'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('tanggal_pengajuan')[0] }}</label>
                            @endif
                            <input type="text" name="tanggal_pengajuan" class="form-control" id="tanggal_pengajuan"
                                value="{{ old('tanggal_pengajuan', $lpj->tanggal_pengajuan) }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jenis_pengajuan" class="control-label">Konsultasi LPJ</label>
                            <p class="form-control">{{ $lpj->jenis_pengajuan }}</p>
                            <input type="hidden" name="jenis_pengajuan" value="{{ $lpj->jenis_pengajuan }}">
                        </div>
                    </div>

                </div>

                <!-- Bagian dropdown untuk memilih pegawai -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_pegawai">PILIH PEGAWAI</label>
                            @if ($errors->has('id_pegawai'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('id_pegawai')[0] }}</label>
                            @endif
                            <select id="id_pegawai" name="id_pegawai" class="form-control">
                                <option value="">Pilih Pegawai</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ $lpj->id_pegawai == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama_pegawai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Menampilkan status, jabatan, dan nomor handphone pegawai setelah memilih pegawai -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status_pegawai">STATUS PEGAWAI SAAT INI</label>
                            <input type="text" id="status_pegawai" name="status_pegawai" class="form-control"
                                value="{{ $lpj->pegawai ? $lpj->pegawai->status : '' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jabatan">JABATAN PEGAWAI</label>
                            <input type="text" id="jabatan" name="jabatan" class="form-control"
                                value="{{ $lpj->pegawai ? $lpj->pegawai->jabatan : '' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nomor_hp">NO HANDPHONE PEGAWAI</label>
                            <input type="text" id="nomor_hp" name="nomor_hp" class="form-control"
                                value="{{ $lpj->pegawai ? $lpj->pegawai->nomor_hp : '' }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Bagian data satker dan pengaju -->
                <hr>
                <h5>Data Satker</h5><br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama_satker">NAMA SATKER</label>
                            <input type="text" id="nama_satker" name="nama_satker" class="form-control"
                                value="{{ Auth::user()->satker->nama_satker }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kode_satker">KODE SATKER</label>
                            <input type="text" id="kode_satker" name="kode_satker" class="form-control"
                                value="{{ Auth::user()->satker->kode_satker }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama">NAMA PENGAJU</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                value="{{ Auth::user()->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jabatan">JABATAN PENGAJU</label>
                            <input type="text" id="jabatan" name="jabatan" class="form-control"
                                value="{{ Auth::user()->jabatan }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jenis_kelamin">JENIS KELAMIN</label>
                            <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control"
                                value="{{ Auth::user()->jenis_kelamin }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="alamat_satker">ALAMAT SATKER</label>
                            <input type="text" id="alamat_satker" name="alamat_satker" class="form-control"
                                value="{{ Auth::user()->alamat_satker }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="agama">AGAMA</label>
                            <input type="text" id="agama" name="agama" class="form-control"
                                value="{{ Auth::user()->agama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nomor_hp">NO HANDPHONE</label>
                            <input type="text" id="nomor_hp" name="nomor_hp" class="form-control"
                                value="{{ Auth::user()->nomor_hp }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Tombol untuk menyimpan perubahan -->
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-tone float-right">
                            <i class="far fa-save"></i> | Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app>
<script>
    // Mendapatkan elemen dropdown
    window.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event listener untuk mendeteksi perubahan pada dropdown pegawai
        var dropdown = document.getElementById('id_pegawai');
        dropdown.addEventListener('change', function() {
            // Mendapatkan id pegawai yang dipilih
            var selectedPegawaiId = this.value;
            // Mendapatkan data pegawai berdasarkan id yang dipilih
            var selectedPegawai = {!! $pegawais->toJson() !!}.find(pegawai => pegawai.id ==
                selectedPegawaiId);

            // Memasukkan nilai status pegawai ke dalam input teks
            document.getElementById('status_pegawai').value = selectedPegawai ? selectedPegawai.status :
                '';

            // Memasukkan nilai jabatan pegawai ke dalam input teks
            document.getElementById('jabatan').value = selectedPegawai ? selectedPegawai.jabatan : '';

            // Memasukkan nilai nomor handphone pegawai ke dalam input teks
            document.getElementById('nomor_hp').value = selectedPegawai ? selectedPegawai.nomor_hp : '';

            // Mendapatkan elemen notifikasi
            var notificationElement = document.getElementById('notification');

            // Memeriksa apakah status pegawai yang dipilih adalah "sakit"
            if (selectedPegawai && selectedPegawai.status.toLowerCase() === 'Sakit') {
                // Menampilkan notifikasi bahwa pegawai tersebut sedang sakit
                notificationElement.innerHTML =
                    '<div class="alert alert-danger" role="alert">Pegawai ini sedang sakit. Pilih pegawai lain.</div>';
            } else {
                // Mengosongkan notifikasi jika pegawai tidak sedang sakit
                notificationElement.innerHTML = '';
            }
        });
    });
</script>

<script>
    $(function() {
        $.datepicker.setDefaults($.datepicker.regional['id']);
        $('#tanggal_pengajuan').datepicker({
            dateFormat: 'dd MM yy'
        });
    });

    // Load Indonesian localization for jQuery UI Datepicker
    (function($) {
        $.datepicker.regional['id'] = {
            closeText: 'Tutup',
            prevText: '‹',
            nextText: '›',
            currentText: 'Hari ini',
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            dayNamesMin: ['Mi', 'Sn', 'Sl', 'Ra', 'Ka', 'Ju', 'Sa'],
            weekHeader: 'Mg',
            dateFormat: 'dd MM yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['id']);
    })(jQuery);
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Handle Alert Status-->
<script>
    // Mendapatkan elemen dropdown
    var dropdown = document.getElementById('id_pegawai');

    // Menambahkan event listener untuk mendeteksi perubahan pada dropdown
    dropdown.addEventListener('change', function() {
        // Mendapatkan id pegawai yang dipilih
        var selectedPegawaiId = this.value;
        // Mendapatkan data pegawai berdasarkan id yang dipilih
        var selectedPegawai = {!! $pegawais->toJson() !!}.find(pegawai => pegawai.id == selectedPegawaiId);

        // Memeriksa status pegawai
        if (selectedPegawai) {
            // Jika pegawai sakit, tampilkan alert sakit dan sembunyikan alert cuti
            if (selectedPegawai.status === 'Sakit') {
                var alertContainer1 = document.getElementById('alertContainer1');
                alertContainer1.innerHTML =
                    '<strong>Peringatan:</strong> Pegawai sedang sakit. Data tidak tersimpan. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                alertContainer1.style.display = 'block';
                var alertContainer2 = document.getElementById('alertContainer2');
                alertContainer2.style.display = 'none';
                this.value = ''; // Reset dropdown ke opsi default
            }
            // Jika pegawai cuti, tampilkan alert cuti dan sembunyikan alert sakit
            else if (selectedPegawai.status === 'Cuti') {
                var alertContainer1 = document.getElementById('alertContainer1');
                alertContainer1.style.display = 'none';
                var alertContainer2 = document.getElementById('alertContainer2');
                alertContainer2.innerHTML =
                    '<strong>Peringatan:</strong> Pegawai sedang cuti. Data tidak tersimpan. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                alertContainer2.style.display = 'block';
                this.value = ''; // Reset dropdown ke opsi default
            }
            // Jika pegawai tidak sakit atau cuti, sembunyikan kedua alert
            else {
                var alertContainer1 = document.getElementById('alertContainer1');
                alertContainer1.style.display = 'none';
                var alertContainer2 = document.getElementById('alertContainer2');
                alertContainer2.style.display = 'none';
            }
        }
    });

    // Menangani event form submission
    document.querySelector('form').addEventListener('submit', function(event) {
        // Mendapatkan status pegawai yang dipilih
        var selectedPegawaiId = dropdown.value;
        var selectedPegawai = {!! $pegawais->toJson() !!}.find(pegawai => pegawai.id == selectedPegawaiId);

        // Memeriksa kembali status pegawai
        if (selectedPegawai) {
            // Mencegah formulir dari disimpan jika pegawai sedang sakit atau cuti
            if (selectedPegawai.status === 'Sakit') {
                event.preventDefault();
                var alertContainer1 = document.getElementById('alertContainer1');
                alertContainer1.innerHTML =
                    '<strong>Peringatan:</strong> Pegawai sedang sakit. Data tidak tersimpan. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                alertContainer1.style.display = 'block';
            } else if (selectedPegawai.status === 'Cuti') {
                event.preventDefault();
                var alertContainer2 = document.getElementById('alertContainer2');
                alertContainer2.innerHTML =
                    '<strong>Peringatan:</strong> Pegawai sedang cuti. Data tidak tersimpan. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                alertContainer2.style.display = 'block';
            }
        }
    });
</script>


<script>
    window.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memfilter jam yang akan ditampilkan
        function filterJam() {
            var jamDropdowns = document.querySelectorAll('input[type="time"]');
            var minTime = '08:00'; // Jam mulai yang diizinkan
            var maxTime = '17:00'; // Jam selesai yang diizinkan
            var alertContainer = document.getElementById('alertContainer');

            jamDropdowns.forEach(function(jamDropdown) {
                jamDropdown.addEventListener('change', function() {
                    var selectedTime = this.value;
                    // Memeriksa apakah jam yang dipilih berada di dalam rentang yang diinginkan
                    if (selectedTime < minTime || selectedTime > maxTime) {
                        alertContainer.style.display = 'block'; // Menampilkan pesan alert
                        this.value = ''; // Mengosongkan nilai input
                    } else {
                        alertContainer.style.display =
                            'none'; // Menyembunyikan pesan alert jika jam yang dipilih valid
                    }
                });
            });
        }

        // Panggil fungsi untuk memfilter jam saat halaman dimuat
        filterJam();
    });
</script>
