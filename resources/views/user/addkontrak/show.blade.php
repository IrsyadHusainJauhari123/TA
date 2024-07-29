<x-app title="Info addk">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DAFTAR PENGAJUAN
            JADWAL
            KONSULTASI ADDEDUM
            KONTRAK
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="user/addk" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>Info Data Pengajuan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>TANGGAL PENGAJUAN :</dt>
                            <dd>{{ $addk->tanggal_pengajuan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dt>JAM PENGAJUAN :</dt>
                            <dd>{{ $addk->jam_pengajuan }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JAM SELESAI :</dt>
                            <dd>{{ $addk->jam_selesai }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JENIS PENGAJUAN :</dt>
                            <dd>{{ $addk->jenis_pengajuan }} </dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Data Pegawai KPPN Yang Dipilih Bertemu</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NAMA PEGAWAI KPPN YANG DIPILIH :</dt>
                            <dd>{{ $addk->pegawai->nama_pegawai }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JABATAN PEGAWAI :</dt>
                            <dd>{{ $addk->pegawai->jabatan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>STATUS PEGAWAI :</dt>
                            <dd>
                                @if ($addk->pegawai->status == 'Aktif')
                                    <span class="btn btn-success">{{ $addk->pegawai->status }}</span>
                                @elseif ($addk->pegawai->status == 'Tidak Aktif')
                                    <span class="btn btn-danger">{{ $addk->pegawai->status }}</span>
                                @elseif ($addk->pegawai->status == 'Cuti')
                                    <span class="btn btn-warning">{{ $addk->pegawai->status }}</span>
                                @else
                                    {{ $addk->pegawai->status }}
                                @endif
                            </dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NOMOR HANDPHONE PEGAWAI:</dt>
                            <dd>{{ $addk->pegawai->nomor_hp }}</dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Status Verifikasi Dari Admin KPPN Ketapang</h5>
                    <hr>
                    <div class="col-md-12">
                        <dt>STATUS :</dt>
                        <dd>
                            @if ($addk->status == 'Di Terima')
                                <span class="btn btn-success">{{ $addk->status }}</span>
                            @elseif ($addk->status == 'Di Tolak')
                                <span class="btn btn-danger">{{ $addk->status }}</span>
                            @elseif ($addk->status == 'DiProses...')
                                <span class="btn btn-warning">{{ $addk->status }}</span>
                            @else
                                {{ $addk->status }}
                            @endif
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
