<x-app title="Detail Satker">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DATA SATKER
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/satker" />
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <dl class="row">
                        <dt class="col-sm-12">Nama Satker</dt>
                        <dd class="col-sm-12">{{ $satker->nama_satker }}</dd>
                    </dl>
                </div>
                <div class="col-sm-6">
                    <dl class="row">
                        <dt class="col-sm-12">Kode Satker</dt>
                        <dd class="col-sm-12">{{ $satker->kode_satker }}</dd>
                    </dl>
                </div>
            </div>
        </div>

    </div>
</x-app>
