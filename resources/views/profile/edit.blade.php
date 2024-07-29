<x-app title="Edit Profile">
    <div class="card-header">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> EDIT PROFILE
        </h5>
    </div>
    <br>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <div class="card-body">
        <button onclick="goBack()" class="btn btn-sm btn-primary btn-tone"><i class="fas fa-arrow-left"></i>
            Kembali</button>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            EDIT DATA user
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('profile', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">NAMA LENGKAP</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $user->nama }}"></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">LEVEL</label>
                                        <p class="form-control">{{ $user->level }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">AGAMA</label>
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
                                        <label for="" class="control-label">JENIS KELAMIN</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option selected>{{ $user->jenis_kelamin }}</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">NO. TELP</label>
                                        <input type="number" name="no_hp" class="form-control"
                                            value="{{ $user->no_hp }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">ALAMAT</label>
                                        <p class="form-control">{{ $user->alamat_satker }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">EMAIL</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">PASSWORD</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="control-label">JABATAN</label>
                                        <p class="form-control">{{ $user->jabatan }}</p>
                                    </div>
                                </div>

                            </div>
                            @if ($user->level === 'satker')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">KODE SATKER</label>
                                            <p class="form-control">{{ $user->satker->kode_satker }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">NAMA SATKER</label>
                                            <p class="form-control">{{ $user->satker->nama_satker }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-tone float-right"><i class="far fa-save"></i>
                                        Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
