<x-app title="Admin | Pengajuan Baru sp2d">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">DAFTAR PENGAJUAN JADWAL
            KONSULTASI SATKER
            SURAT PERINTAH PERCAIRAN DANA</h5>
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
                            <th class="text-center" style="color: white">NAMA SATKER</th>
                            <th class="text-center" style="color: white">KODE SATKER</th>
                            <th class="text-center" style="color: white">TANGGAL PENGAJUAN</th>
                            <th class="text-center" style="color: white">JAM PENGAJUAN DIAJUKAN</th>
                            <th class="text-center" style="color: white">JAM SELESAI DIAJUKAN</th>
                            <th width="10%" class="text-center" style="color: white">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_sp2dbaru as $sp2dbaru)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/pengajuancso/barusp2d/info', $sp2dbaru->id) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-eye"></i> | Lihat Pengajuan
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $sp2dbaru->satker->nama_satker }}</td>
                                <td>{{ $sp2dbaru->satker->kode_satker }}</td>
                                <td>{{ $sp2dbaru->tanggal_pengajuan }}</td>
                                <td>{{ $sp2dbaru->jam_pengajuan }} WIB</td>
                                <td>{{ $sp2dbaru->jam_selesai }} WIB</td>
                                <td>
                                    @if ($sp2dbaru->status == 'DiProses...')
                                        <span class="btn btn-warning">{{ $sp2dbaru->status }}</span>
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
