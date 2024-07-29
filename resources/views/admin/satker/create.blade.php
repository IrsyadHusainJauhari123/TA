<x-app title="Admin | Satker Create">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark text-center" style="font-size: 25px">TAMBAH DAFTAR SATKER</h5>
    </div>
    <x-template.button.back-button url="admin/satker" />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/satker') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_satker" class="control-label">NAMA SATKER</label>
                            @if ($errors->has('nama_satker'))
                                <label for="nama_satker"
                                    class="label text-danger">{{ $errors->first('nama_satker') }}</label>
                            @endif
                            <input type="text" name="nama_satker" id="nama_satker" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_satker" class="control-label">KODE SATKER</label>
                            @if ($errors->has('kode_satker'))
                                <label for="kode_satker"
                                    class="label text-danger">{{ $errors->first('kode_satker') }}</label>
                            @endif
                            <input type="text" name="kode_satker" id="kode_satker" class="form-control">
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
