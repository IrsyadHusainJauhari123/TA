<x-app title="Admin | user Create">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> TAMBAH DAFTAR USER
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/user" />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/user') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">NAMA</label>
                            @if ($errors->has('nama'))
                                <label for="nama" class="label text-danger">{{ $errors->get('nama')[0] }}</label>
                            @endif
                            <input type="text" name="nama" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="control-label">USERNAME</label>
                            @if ($errors->has('username'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('username')[0] }}</label>
                            @endif
                            <input type="text" name="username" class="form-control">
                        </div>
                    </div>

                </div>

                <!-- Satker Form Group -->
                <div class="satker-form-group" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_sater" class="control-label">KODE SATKER</label>
                                <select class="form-control default-select" name="kode_satker">
                                    <option disabled selected value="-1">Pilih Kode Satker</option>
                                    <!-- Tambahkan value kosong -->
                                    @foreach ($list_satker as $satker)
                                        <option value="{{ $satker->id }}">{{ $satker->kode_satker }}</option>
                                    @endforeach
                                </select>
                                <!-- Label untuk menampilkan pesan kesalahan -->
                                @error('kode_satker')
                                    <label for="" class="label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_satker" class="control-label">NAMA SATKER</label>
                                <select class="form-control default-select" name="nama_satker">
                                    <option disabled selected value="-1">Pilih Nama Satker</option>
                                    @foreach ($list_satker as $satker)
                                        <option value="{{ $satker->id }}">{{ $satker->nama_satker }}</option>
                                    @endforeach
                                </select>
                                <!-- Label untuk menampilkan pesan kesalahan -->
                                @error('nama_satker')
                                    <label for="" class="label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <!-- End of Satker Form Group -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">JABATAN</label>
                            @if ($errors->has('jabatan'))
                                <label for="jabatan" class="label text-danger">{{ $errors->get('jabatan')[0] }}</label>
                            @endif
                            <input type="text" name="jabatan" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin" class="control-label">JENIS KELAMIN</label>
                            @if ($errors->has('jenis_kelamin'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('jenis_kelamin')[0] }}</label>
                            @endif
                            <select name="jenis_kelamin" class="form-control">
                                <option disabled selected>Pilih opsi</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_satker" class="control-label">ALAMAT</label>
                            @if ($errors->has('alamat_satker'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('alamat_satker')[0] }}</label>
                            @endif
                            <input type="text" name="alamat_satker" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="level" class="control-label">LEVEL</label>
                            @if ($errors->has('level'))
                                <label for="" class="label text-danger">{{ $errors->get('level')[0] }}</label>
                            @endif
                            <select name="level" class="form-control userLevel">
                                <option disabled selected>Pilih opsi</option>
                                <option value="admin">Admin</option>
                                <option value="satker">Satker</option>
                            </select>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama" class="control-label">AGAMA</label>
                            @if ($errors->has('agama'))
                                <label for="" class="label text-danger">{{ $errors->get('agama')[0] }}</label>
                            @endif
                            <select name="agama" id="agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            @if ($errors->has('password'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('password')[0] }}</label>
                            @endif
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="control-label">EMAIL</label>
                            @if ($errors->has('email'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('email')[0] }}</label>
                            @endif
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp" class="control-label">NO HANDPHONE</label>
                            @if ($errors->has('no_hp'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('no_hp')[0] }}</label>
                            @endif
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-tone float-right"><i class="far fa-save"></i>
                            | Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>



<!-- JavaScript untuk menampilkan form grup Satker saat Level dipilih sebagai Satker -->
<script>
    document.querySelector('.userLevel').addEventListener('change', function() {
        var selectedValue = this.value;
        if (selectedValue === 'satker') {
            document.querySelector('.satker-form-group').style.display = 'block';
        } else {
            document.querySelector('.satker-form-group').style.display = 'none';
        }
    });

    // Menangani perubahan pada dropdown kode satker
    document.querySelector('[name="kode_satker"]').addEventListener('change', function() {
        var selectedKodeSatker = this.value; // Mengambil nilai kode satker yang dipilih

        // Mendapatkan dropdown nama satker
        var dropdownNamaSatker = document.querySelector('[name="nama_satker"]');
        // Menghapus semua opsi sebelum menambahkan opsi baru
        dropdownNamaSatker.innerHTML = '';

        // Menambahkan opsi default
        var defaultOption = document.createElement('option');
        defaultOption.text = 'Pilih Nama Satker';
        defaultOption.value = '-1';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        dropdownNamaSatker.appendChild(defaultOption);

        // Memperbarui dropdown nama satker berdasarkan kode satker yang dipilih
        @foreach ($list_satker as $satker)
            // Jika kode satker yang dipilih cocok dengan kode satker pada loop saat ini
            if ('{{ $satker->id }}' === selectedKodeSatker) {
                // Membuat opsi baru untuk nama satker
                var option = document.createElement('option');
                option.text = '{{ $satker->nama_satker }}';
                option.value = '{{ $satker->id }}';
                dropdownNamaSatker.appendChild(option);
            }
        @endforeach
    });
</script>
