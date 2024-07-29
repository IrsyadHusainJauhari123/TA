<x-app title="Edit | User">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> EDIT DAFTAR USER
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/user" />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/user', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="control-label">NAMA</label>
                            <input type="text" name="nama" class="form-control" value="{{ $user->nama }}">
                            @error('nama')
                                <label for="nama" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="control-label">USERNAME</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                            @error('username')
                                <label for="username" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jabatan" class="control-label">JABATAN</label>
                            <input type="text" name="jabatan" class="form-control" value="{{ $user->jabatan }}">
                            @error('jabatan')
                                <label for="jabatan" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin" class="control-label">JENIS KELAMIN</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option disabled selected>Pilih opsi</option>
                                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <label for="jenis_kelamin" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_satker" class="control-label">ALAMAT SATKER</label>
                            <input type="text" name="alamat_satker" class="form-control"
                                value="{{ $user->alamat_satker }}">
                            @error('alamat_satker')
                                <label for="alamat_satker" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="level" class="control-label">LEVEL</label>
                            <input type="text" name="level" class="form-control" value="{{ $user->level }}"
                                readonly>
                            <!-- Untuk menampilkan pesan kesalahan jika ada -->
                            {{-- @error('level')
                                <label for="level" class="label text-danger">{{ $message }}</label>
                            @enderror --}}
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama" class="control-label">AGAMA</label>
                            @error('agama')
                                <label for="agama" class="label text-danger">{{ $message }}</label>
                            @enderror
                            <select name="agama" class="form-control">
                                <option selected>{{ $user->agama }}</option>
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
                            <label for="password" class="control-label">PASSWORD BARU</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye-slash" id="togglePassword"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <label for="password" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="control-label">EMAIL</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            @error('email')
                                <label for="email" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label">KONFIRMASI PASSWORD
                                BARU(*Masukan sesuai Password baru)</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye-slash" id="toggleConfirmPassword"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <label for="password_confirmation" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="no_hp" class="control-label">NO HANDPHONE</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}">
                            @error('no_hp')
                                <label for="no_hp" class="label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-tone float-right"><i
                                class="far fa-save"></i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
        this.classList.toggle('fa-eye');
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
        this.classList.toggle('fa-eye');
    });
</script>
