<x-app title=" Admin | Pegawai">
    <x-template.button.back-button url="admin/pegawai" />
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Edit Data Pegawai
            </div>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/pegawai', $pegawai->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pegawai" class="control-label">NAMA PEGAWAI</label>
                            @error('nama_pegawai')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="text" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jabatan" class="control-label">JABATAN</label>
                            @error('jabatan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <select name="jabatan" class="form-control">
                                <option selected>{{ $pegawai->jabatan }}</option>
                                <option value="Cso">CUSTOMER SERVICER OFFICER</option>
                                <option value="Csk">CUSTOMER SERVICER KHUSUS</option>
                                <option value="Kasubag">KASI BAGIAN UMUM</option>
                                <option value="Bank">KASI BAGIAN BANK</option>
                                <option value="Pdms">KASI BAGIAN PDMS</option>
                                <option value="Bendahara">BENDAHARA</option>
                                <option value="Pelaksana">PELAKSANA</option>
                            </select>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="control-label">STATUS</label>
                            @error('status')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <select name="status" class="form-control">
                                <option selected>{{ $pegawai->status }}</option>
                                <option value="Aktif">AKTIF</option>
                                <option value="Sakit">SAKIT</option>
                                <option value="Cuti">CUTI</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_hp" class="control-label">NO HANDPHONE</label>
                            @error('nomor_hp')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            <input type="text" name="nomor_hp" value="{{ $pegawai->nomor_hp }}" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-right"><i class="far fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</x-app>
