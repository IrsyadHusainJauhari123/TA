<x-app title="Detail | Pegawai">

    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark text-center" style="font-size: 25px">DETAIL DATA PEGAWAI</h5>
    </div>
    <x-template.button.back-button url="admin/pegawai" />
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Nama Pegawai:</dt>
                        <dd class="col-sm-8">{{ $pegawai->nama_pegawai }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">Jabatan:</dt>
                        <dd class="col-sm-8">{{ $pegawai->jabatan }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Status Pegawai:</dt>
                        <dd class="col-sm-8">
                            @php
                                $statusClass = '';
                                switch ($pegawai->status) {
                                    case 'Aktif':
                                        $statusClass = 'btn-success';
                                        break;
                                    case 'Sakit':
                                        $statusClass = 'btn-danger';
                                        break;
                                    case 'Cuti':
                                        $statusClass = 'btn-warning';
                                        break;
                                    default:
                                        $statusClass = '';
                                        break;
                                }
                            @endphp
                            <span class="btn {{ $statusClass }}">{{ $pegawai->status }}</span>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-4">No Handphone:</dt>
                        <dd class="col-sm-8">{{ $pegawai->nomor_hp }}</dd>
                    </dl>
                </div>

            </div>
        </div>
    </div>
</x-app>
