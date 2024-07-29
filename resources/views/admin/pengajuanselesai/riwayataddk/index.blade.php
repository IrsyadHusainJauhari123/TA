<x-app title="Riwayat Jadwal Konsultasi Addendum Kontrak">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> RIWAYAT PENGAJUAN
            JADWAL KONSULTASI SATKER
            ADDEDUM KONTRAK
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
                <table id="data-table" class="table table-datatable table-bordered">
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
                        @foreach ($addkDiterima as $addk)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/pengajuanselesai/riwayataddk"
                                            id="{{ $addk->id }}" />
                                        <x-template.button.delete-button url="admin/pengajuanselesai/riwayataddk"
                                            id="{{ $addk->id }}" />
                                    </div>
                                </td>
                                <td>{{ $addk->tanggal_pengajuan }}</td>
                                <td>{{ $addk->jam_pengajuan }} WIB</td>
                                <td>{{ $addk->jam_selesai }} WIB</td>
                                <td>{{ $addk->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($addk->status == 'Di Terima')
                                        <span class="btn btn-success">{{ $addk->status }}</span>
                                    @else
                                        {{ $addk->status }}
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
                        @foreach ($addkDitolak as $addk)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/pengajuanselesai/riwayataddk"
                                            id="{{ $addk->id }}" />
                                        <x-template.button.delete-button url="admin/pengajuanselesai/riwayataddk"
                                            id="{{ $addk->id }}" />
                                    </div>
                                </td>
                                <td>{{ $addk->tanggal_pengajuan }}</td>
                                <td>{{ $addk->jam_pengajuan }} WIB</td>
                                <td>{{ $addk->jam_selesai }} WIB</td>
                                <td>{{ $addk->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($addk->status == 'Di Tolak')
                                        <span class="btn btn-danger">{{ $addk->status }}</span>
                                    @else
                                        {{ $addk->status }}
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
