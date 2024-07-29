<x-app title="Beranda">
    <div class="card-header">
        <h5 class="m-0 font-weight-bold text-dark" style="font-size: 30px"> SELAMAT DATANG,
            {{ auth()->user()->nama }}
        </h5>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="mb-0">{{ $totalCount }}</h2>
                                <p class="mb-0 text-muted">Pengajuan Jadwal Di Terima Konsultasi Customer Servicer </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="mb-0">{{ $satker }}</h2>
                                <p class="mb-0 text-muted">Jumlah Satker KPPN Ketapang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="mb-0">{{ $pesanCount }}</h2>
                                <p class="mb-0 text-muted">Pesan Agenda Terkirim Ke Semua Satker</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="anticon anticon-profile"></i>
                            </div>
                            <div class="ml-3">
                                <h2 class="mb-0">{{ $khusus }}</h2>
                                <p class="mb-0 text-muted">Pengajuan Jadwal Konsultasi Khusus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Anda bisa menambahkan lebih banyak kartu di sini -->
        </div>
    </div>
</x-app>
