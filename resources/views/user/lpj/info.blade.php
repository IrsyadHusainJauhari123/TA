<x-app title="Info lpj">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DETAIL DAFTAR PENGAJUAN
            JADWAL
            KONSULTASI
            JADWAL LAPORAN PERTANGGUNGJAWABAN
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="user/lpj" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>Info Data Pengajuan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>TANGGAL PENGAJUAN :</dt>
                            <dd>{{ $lpj->tanggal_pengajuan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dt>JAM PENGAJUAN :</dt>
                            <dd>{{ $lpj->jam_pengajuan }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JAM SELESAI :</dt>
                            <dd>{{ $lpj->jam_selesai }} WIB</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JENIS PENGAJUAN :</dt>
                            <dd>{{ $lpj->jenis_pengajuan }} </dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Data Pegawai KPPN Yang Dipilih Bertemu</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NAMA PEGAWAI KPPN YANG DIPILIH :</dt>
                            <dd>{{ $lpj->pegawai->nama_pegawai }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>JABATAN PEGAWAI :</dt>
                            <dd>{{ $lpj->pegawai->jabatan }}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>STATUS PEGAWAI :</dt>
                            <dd>
                                @if ($lpj->pegawai->status == 'Aktif')
                                    <span class="btn btn-success">{{ $lpj->pegawai->status }}</span>
                                @elseif ($lpj->pegawai->status == 'Tidak Aktif')
                                    <span class="btn btn-danger">{{ $lpj->pegawai->status }}</span>
                                @elseif ($lpj->pegawai->status == 'Cuti')
                                    <span class="btn btn-warning">{{ $lpj->pegawai->status }}</span>
                                @else
                                    {{ $lpj->pegawai->status }}
                                @endif
                            </dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <dt>NOMOR HANDPHONE PEGAWAI:</dt>
                            <dd>{{ $lpj->pegawai->nomor_hp }}</dd>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Status Verifikasi Dari Admin KPPN Ketapang</h5>
                    <hr>
                    <div class="col-md-12">
                        <dt>STATUS :</dt>
                        <dd>
                            @if ($lpj->status == 'Di Terima')
                                <span class="btn btn-success">{{ $lpj->status }}</span>
                            @elseif ($lpj->status == 'Di Tolak')
                                <span class="btn btn-danger">{{ $lpj->status }}</span>
                            @elseif ($lpj->status == 'DiProses...')
                                <span class="btn btn-warning">{{ $lpj->status }}</span>
                            @else
                                {{ $lpj->status }}
                            @endif
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
