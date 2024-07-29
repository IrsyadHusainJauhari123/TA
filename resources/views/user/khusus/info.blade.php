<x-app title="Info khusus">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DAFTAR PENGAJUAN
            JADWAL
            KONSULTASI KHUSUS
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="user/khusus" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>Info Data Pengajuan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>TANGGAL PENGAJUAN :</dt>
                            <dd>{{ $khusus->tanggal_pengajuan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dt>JAM PENGAJUAN :</dt>
                            <dd>{{ $khusus->jam_pengajuan }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JAM SELESAI :</dt>
                            <dd>{{ $khusus->jam_selesai }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JENIS PENGAJUAN :</dt>
                            <dd>{{ $khusus->jenis_pengajuan }} </dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Data Pegawai KPPN Yang Dipilih Bertemu</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NAMA PEGAWAI KPPN YANG DIPILIH :</dt>
                            <dd>{{ $khusus->pegawai->nama_pegawai }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JABATAN PEGAWAI :</dt>
                            <dd>{{ $khusus->pegawai->jabatan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>STATUS PEGAWAI :</dt>
                            <dd>
                                @if ($khusus->pegawai->status == 'Aktif')
                                    <span class="btn btn-success">{{ $khusus->pegawai->status }}</span>
                                @elseif ($khusus->pegawai->status == 'Tidak Aktif')
                                    <span class="btn btn-danger">{{ $khusus->pegawai->status }}</span>
                                @elseif ($khusus->pegawai->status == 'Cuti')
                                    <span class="btn btn-warning">{{ $khusus->pegawai->status }}</span>
                                @else
                                    {{ $khusus->pegawai->status }}
                                @endif
                            </dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NOMOR HANDPHONE PEGAWAI:</dt>
                            <dd>{{ $khusus->pegawai->nomor_hp }}</dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Status Verifikasi Dari Admin KPPN Ketapang</h5>
                    <hr>
                    <div class="col-md-12">
                        <dt>STATUS :</dt>
                        <dd>
                            @if ($khusus->status == 'Di Terima')
                                <span class="btn btn-success">{{ $khusus->status }}</span>
                            @elseif ($khusus->status == 'Di Tolak')
                                <span class="btn btn-danger">{{ $khusus->status }}</span>
                            @elseif ($khusus->status == 'DiProses...')
                                <span class="btn btn-warning">{{ $khusus->status }}</span>
                            @else
                                {{ $khusus->status }}
                            @endif
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
