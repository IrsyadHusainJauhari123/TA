<x-app title="Admin | Pengajuan Baru Add Kontrak">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">
            DAFTAR PENGAJUAN JADWAL KONSULTASI SATKER ADDENDUM KONTRAK
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th width="60px" class="text-center" style="color: white">NO</th>
                            <th width="145px" class="text-center" style="color: white">AKSI</th>
                            <th class="text-center" style="color: white;">NAMA SATKER</th>
                            <th class="text-center" style="color: white;">KODE SATKER</th>
                            <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                            <th class="text-center" style="color: white;">JAM PENGAJUAN DIAJUAKAN</th>
                            <th class="text-center" style="color: white;">JAM SELESAI DIAJUKAN</th>
                            <th width="10%" class="text-center" style="color: white">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_addkbaru as $addkbaru)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/pengajuancso/baruaddk/info', $addkbaru->id) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-eye"></i> | Lihat Pengajuan
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $addkbaru->satker->nama_satker }}</td>
                                <td>{{ $addkbaru->satker->kode_satker }}</td>
                                <td>{{ $addkbaru->tanggal_pengajuan }}</td>
                                <td>{{ $addkbaru->jam_pengajuan }} WIB</td>
                                <td>{{ $addkbaru->jam_selesai }} WIB</td>
                                <td>
                                    @if ($addkbaru->status == 'DiProses...')
                                        <span class="btn btn-warning">{{ $addkbaru->status }}</span>
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
