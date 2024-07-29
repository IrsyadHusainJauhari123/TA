<x-app title="Setting">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> EDIT PROFILE
        </h5>
    </div>
    <br>
    <div class="card-body">
        <div class="card">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('profile/' . $user->id . '/edit') }}"
                            class="btn btn-warning btn-tone btn-sm float-right mt-3 mb-3">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dt class="font-weight-bold">NAMA LENGKAP</dt>
                                <dd>{{ $user->nama }}</dd>
                            </div>
                            <div class="col-md-6">
                                <dt class="font-weight-bold">USERNAME</dt>
                                <dd>{{ $user->username }}</dd>
                            </div>
                            <div class="col-md-6">
                                <dt class="font-weight-bold">EMAIL</dt>
                                <dd>{{ $user->email }}</dd>
                            </div>
                            <div class="col-md-6">
                                <dt class="font-weight-bold">JABATAN</dt>
                                <dd>{{ $user->jabatan }}</dd>
                            </div>
                            @if ($user->level === 'satker')
                                <div class="col-md-6">
                                    <dt class="font-weight-bold">KODE SATKER</dt>
                                    <dd>{{ $user->satker->kode_satker }}</dd>
                                </div>
                                <div class="col-md-6">
                                    <dt class="font-weight-bold">NAMA SATKER</dt>
                                    <dd>{{ $user->satker->nama_satker }}</dd>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
