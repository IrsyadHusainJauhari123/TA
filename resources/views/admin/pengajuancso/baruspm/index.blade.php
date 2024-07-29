<x-app title="Admin | Pengajuan Baru spm">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">DAFTAR PENGAJUAN JADWAL
            KONSULTASI SATKER
            SURAT PERINTAH MEMBAYAR SATKER</h5>
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
                        @foreach ($list_spmbaru as $spmbaru)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/pengajuancso/baruspm/info', $spmbaru->id) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-eye"></i> | Lihat Pengajuan
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $spmbaru->satker->nama_satker }}</td>
                                <td>{{ $spmbaru->satker->kode_satker }}</td>
                                <td>{{ $spmbaru->tanggal_pengajuan }}</td>
                                <td>{{ $spmbaru->jam_pengajuan }} WIB</td>
                                <td>{{ $spmbaru->jam_selesai }} WIB</td>
                                <td>
                                    @if ($spmbaru->status == 'DiProses...')
                                        <span class="btn btn-warning">{{ $spmbaru->status }}</span>
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
