<x-app title="Admin | Pegawai Create">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark text-center" style="font-size: 25px">TAMBAH DAFTAR PEGAWAI</h5>
    </div>
    <x-template.button.back-button url="admin/pegawai" />
    <div class="card">

        <div class="card-body">
            <form action="{{ url('admin/pegawai') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pegawai" class="control-label">NAMA PEGAWAI</label>
                            <input type="text" name="nama_pegawai" class="form-control">
                            @error('nama_pegawai')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jabatan" class="control-label">JABATAN</label>
                            <select name="jabatan" class="form-control">
                                <option disabled selected>Pilih opsi</option>
                                <option value="Customer Services">CUSTOMER SERVICE OFFICER</option>
                                <option value="Customer Services Khusus">CUSTOMER SERVICE KHUSUS</option>
                                <option value="Kasubag">KASI BAGIAN UMUM</option>
                                <option value="Bank">KASI BAGIAN BANK</option>
                                <option value="Pdms">KASI BAGIAN PDMS</option>
                                <option value="Bendahara">BENDAHARA</option>
                                <option value="Pelaksana">PELAKSANA</option>
                            </select>
                            @error('jabatan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="control-label">STATUS</label>
                            <select name="status" class="form-control">
                                <option disabled selected>Pilih opsi</option>
                                <option value="Aktif">AKTIF</option>
                                <option value="Sakit">SAKIT</option>
                                <option value="Cuti">CUTI</option>
                            </select>
                            @error('status')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_hp" class="control-label">NO HANDPHONE</label>
                            <input type="text" name="nomor_hp" class="form-control">
                            @error('nomor_hp')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-tone float-right"><i class="far fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>
