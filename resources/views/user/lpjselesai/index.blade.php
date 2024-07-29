<x-app title="Pengajuan LPJ">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA RIWAYAT PENGAJUAN
            JADWAL
            LAPORAN PERTANGGUNGJAWABN
            SELESAI
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h5>Data Jadwal Yang Diterima</h5>
            <hr>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table1" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="5px" class="text-center" style="color: white;">NO</th>
                        <th style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM SELESAI PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA PEGAWAI KPPN DIPILIH</th>
                        <th class="text-center" style="color: white;">STATUS</th>
                    </thead>
                    <tbody>
                        @foreach ($lpjDiterima as $lpj)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="user/lpj" :id="$lpj->id">
                                            <i class="fas fa-eye"></i> Lihat Pengajuan
                                        </x-template.button.info-button>
                                    </div>
                                </td>

                                <td>{{ $lpj->tanggal_pengajuan }}</td>
                                <td>{{ $lpj->jam_pengajuan }} WIB</td>
                                <td>{{ $lpj->jam_selesai }} WIB</td>
                                <td>{{ $lpj->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($lpj->status == 'Di Terima')
                                        <span class="btn btn-success">{{ $lpj->status }}</span>
                                    @else
                                        {{ $lpj->status }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-header py-2">
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h5>Data Jadwal Yang Di Tolak</h5>
            <hr>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table1" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="5px" class="text-center" style="color: white;">NO</th>
                        <th class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM SELESAI PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA PEGAWAI KPPN DIPILIH</th>
                        <th class="text-center" style="color: white;">STATUS</th>
                    </thead>
                    <tbody>
                        @foreach ($lpjDitolak as $lpj)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="user/lpj" :id="$lpj->id">
                                            <i class="fas fa-eye">| Lihat Pengajuan</i>
                                        </x-template.button.info-button>
                                    </div>
                                </td>
                                <td>{{ $lpj->tanggal_pengajuan }}</td>
                                <td>{{ $lpj->jam_pengajuan }} WIB</td>
                                <td>{{ $lpj->jam_selesai }} WIB</td>
                                <td>{{ $lpj->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($lpj->status == 'Di Tolak')
                                        <span class="btn btn-danger">{{ $lpj->status }}</span>
                                    @else
                                        {{ $lpj->status }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app>
