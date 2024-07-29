<x-app title="Detail | Lpj">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DATA USER
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/user" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <dt>Nama:</dt>
                            <dd>{{ $user->nama }}</dd>
                        </div>

                        @if ($user->level === 'satker')
                            <div class="col-md-4">
                                <dt>Kode Satker:</dt>
                                <dd>{{ $user->satker->kode_satker }}</dd>
                            </div>
                            <div class="col-md-4">
                                <dt>Nama Satker:</dt>
                                <dd>{{ $user->satker->nama_satker }}</dd>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <dt>Jabatan:</dt>
                            <dd>{{ $user->jabatan }}</dd>
                        </div>
                        <div class="col-md-4">
                            <dt>Jenis Kelamin:</dt>
                            <dd>{{ $user->jenis_kelamin }}</dd>
                        </div>


                        <div class="col-md-4">
                            <dt>Agama:</dt>
                            <dd>{{ $user->agama }}</dd>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <dt>No Handphone:</dt>
                            <dd>{{ $user->no_hp }}</dd>
                        </div>
                        <div class="col-md-4">
                            <dt>Level:</dt>
                            <dd>{{ $user->level }}</dd>
                        </div>
                        <div class="col-md-4">
                            <dt>Username:</dt>
                            <dd>{{ $user->username }}</dd>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>


<div class="col-md-3">

</div>
<div class="col-md-4">

</div> --}}
