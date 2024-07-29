<x-app title="Info sp2d">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DAFTAR PENGAJUAN
            KONSULTASI SURAT PERINTAH PERCAIRAN DANA
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="user/sp2d" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>Info Data Pengajuan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>TANGGAL PENGAJUAN :</dt>
                            <dd>{{ $sp2d->tanggal_pengajuan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dt>JAM PENGAJUAN :</dt>
                            <dd>{{ $sp2d->jam_pengajuan }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JAM SELESAI :</dt>
                            <dd>{{ $sp2d->jam_selesai }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JENIS PENGAJUAN :</dt>
                            <dd>{{ $sp2d->jenis_pengajuan }} </dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Data Pegawai KPPN Yang Dipilih Bertemu</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NAMA PEGAWAI KPPN YANG DIPILIH :</dt>
                            <dd>{{ $sp2d->pegawai->nama_pegawai }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JABATAN PEGAWAI :</dt>
                            <dd>{{ $sp2d->pegawai->jabatan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>STATUS PEGAWAI :</dt>
                            <dd>
                                @if ($sp2d->pegawai->status == 'Aktif')
                                    <span class="btn btn-success">{{ $sp2d->pegawai->status }}</span>
                                @elseif ($sp2d->pegawai->status == 'Tidak Aktif')
                                    <span class="btn btn-danger">{{ $sp2d->pegawai->status }}</span>
                                @elseif ($sp2d->pegawai->status == 'Cuti')
                                    <span class="btn btn-warning">{{ $sp2d->pegawai->status }}</span>
                                @else
                                    {{ $sp2d->pegawai->status }}
                                @endif
                            </dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NOMOR HANDPHONE PEGAWAI:</dt>
                            <dd>{{ $sp2d->pegawai->nomor_hp }}</dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Status Verifikasi Dari Admin KPPN Ketapang</h5>
                    <hr>
                    <div class="col-md-12">
                        <dt>STATUS :</dt>
                        <dd>
                            @if ($sp2d->status == 'Di Terima')
                                <span class="btn btn-success">{{ $sp2d->status }}</span>
                            @elseif ($sp2d->status == 'Di Tolak')
                                <span class="btn btn-danger">{{ $sp2d->status }}</span>
                            @elseif ($sp2d->status == 'DiProses...')
                                <span class="btn btn-warning">{{ $sp2d->status }}</span>
                            @else
                                {{ $sp2d->status }}
                            @endif
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
