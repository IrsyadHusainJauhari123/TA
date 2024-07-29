<x-app title="Pengajuan Khusus">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA PENGAJUAN JADWAL
            KONSULTASI
            KHUSUS BARU
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('user/khusus/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div><br>
            <div class="table-responsive">


                <table id="data-table1" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="10px" class="text-center" style="color: white;">NO</th>
                        <th width="90px" class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM PENGAJUAN</th>
                        <th class="text-center" style="color: white;">JAM SELESAI PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA PEGAWAI KPPN DIPILIH</th>
                        <th class="text-center" style="color: white;">STATUS</th>
                    </thead>
                    <tbody>
                        @foreach ($list_khusus->sortByDesc('created_at')->values() as $khusus)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="user/khusus" id="{{ $khusus->id }}" />
                                        <x-template.button.edit-button url="user/khusus" id="{{ $khusus->id }}" />
                                        <x-template.button.delete-button url="user/khusus" id="{{ $khusus->id }}" />
                                    </div>
                                </td>
                                <td>{{ $khusus->tanggal_pengajuan }}</td>
                                <td>{{ $khusus->jam_pengajuan }} WIB</td>
                                <td>{{ $khusus->jam_selesai }} WIB</td>
                                <td>{{ $khusus->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($khusus->status == 'DiProses...')
                                        <span class="btn btn-warning">{{ $khusus->status }}</span>
                                    @else
                                        {{-- Tidak melakukan apa-apa untuk data yang bukan 'DiProses' --}}
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
