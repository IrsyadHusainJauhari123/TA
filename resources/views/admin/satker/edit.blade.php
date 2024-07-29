<x-app title="Admin | Satker Edit">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> EDIT DAFTAR SATKER KPPN
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/satker" />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/satker', $satker->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_satker" class="control-label">NAMA SATKER</label>
                            @if ($errors->has('nama_satker'))
                                <label for="nama_satker"
                                    class="label text-danger">{{ $errors->get('nama_satker')[0] }}</label>
                            @endif
                            <input type="text" name="nama_satker" class="form-control"
                                value="{{ $satker->nama_satker }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_satker" class="control-label">KODE SATKER</label>
                            @if ($errors->has('kode_satker'))
                                <label for=""
                                    class="label text-danger">{{ $errors->get('kode_satker')[0] }}</label>
                            @endif
                            <input type="text" name="kode_satker" class="form-control"
                                value="{{ $satker->kode_satker }}">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-tone float-right"><i class="far fa-save"></i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>
