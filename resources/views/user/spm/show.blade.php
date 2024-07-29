<x-app title="Info spm">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DAFTAR PENGAJUAN
            JADWAL KONSULTASI SURAT PERINTAH MEMBAYAR
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="user/spm" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>Info Data Pengajuan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>TANGGAL PENGAJUAN :</dt>
                            <dd>{{ $spm->tanggal_pengajuan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dt>JAM PENGAJUAN :</dt>
                            <dd>{{ $spm->jam_pengajuan }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JAM SELESAI :</dt>
                            <dd>{{ $spm->jam_selesai }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JENIS PENGAJUAN :</dt>
                            <dd>{{ $spm->jenis_pengajuan }} </dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Data Pegawai KPPN Yang Dipilih Bertemu</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NAMA PEGAWAI KPPN YANG DIPILIH :</dt>
                            <dd>{{ $spm->pegawai->nama_pegawai }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JABATAN PEGAWAI :</dt>
                            <dd>{{ $spm->pegawai->jabatan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>STATUS PEGAWAI :</dt>
                            <dd>
                                @if ($spm->pegawai->status == 'Aktif')
                                    <span class="btn btn-success">{{ $spm->pegawai->status }}</span>
                                @elseif ($spm->pegawai->status == 'Tidak Aktif')
                                    <span class="btn btn-danger">{{ $spm->pegawai->status }}</span>
                                @elseif ($spm->pegawai->status == 'Cuti')
                                    <span class="btn btn-warning">{{ $spm->pegawai->status }}</span>
                                @else
                                    {{ $spm->pegawai->status }}
                                @endif
                            </dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NOMOR HANDPHONE PEGAWAI:</dt>
                            <dd>{{ $spm->pegawai->nomor_hp }}</dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Status Verifikasi Dari Admin KPPN Ketapang</h5>
                    <hr>
                    <div class="col-md-12">
                        <dt>STATUS :</dt>
                        <dd>
                            @if ($spm->status == 'Di Terima')
                                <span class="btn btn-success">{{ $spm->status }}</span>
                            @elseif ($spm->status == 'Di Tolak')
                                <span class="btn btn-danger">{{ $spm->status }}</span>
                            @elseif ($spm->status == 'DiProses...')
                                <span class="btn btn-warning">{{ $spm->status }}</span>
                            @else
                                {{ $spm->status }}
                            @endif
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
