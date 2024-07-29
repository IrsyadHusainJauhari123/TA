<x-app title="Admin | Pengajuan Baru LPJ">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DAFTAR PENGAJUAN JADWAL
            KONSULTASI SATKER
            KHUSUS

        </h5>
    </div>
    <div class="card mt-4">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-datatable table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th width ="60px" class="text-center" style="color: white">NO</th>
                        <th width ="145px" class="text-center" style="color: white">AKSI</th>
                        <th class="text-center" style="color: white;">NAMA SATKER</th>
                        <th class="text-center" style="color: white;">KODE SATKER</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM PENGAJUAN DIAJUAKAN</th>
                        <th class="text-center" style="color: white;">JAM SELESAI DIAJUKAN</th>
                        {{-- <th class="text-center" style="color: white;">>JENIS PENGAJUAN</th> --}}
                        <th width ="10%" class="text-center" style="color: white">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_khususbaru as $khususbaru)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="btn-group">
                                    <!-- Ganti dengan tombol HTML biasa jika tidak menggunakan komponen kustom -->
                                    <a href="{{ url('admin/pengajuankhusus/khususbaru/info') }}/{{ $khususbaru->id }}"
                                        class="btn btn-info">
                                        <i class="fas fa-eye"></i> | Lihat Pengajuan
                                    </a>


                                </div>
                            </td>
                            <td>{{ $khususbaru->satker->nama_satker }}</td>
                            <td>{{ $khususbaru->satker->kode_satker }}</td>
                            <td>{{ $khususbaru->tanggal_pengajuan }}</td>
                            <td>{{ $khususbaru->jam_pengajuan }} WIB</td>
                            <td>{{ $khususbaru->jam_selesai }} WIB</td>
                            {{-- <td>{{ $khususbaru->jenis_pengajuan }}</td> --}}
                            <td>
                                @if ($khususbaru->status == 'DiProses...')
                                    <span class="btn btn-warning">{{ $khususbaru->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app>


<!-- Load jQuery -->
