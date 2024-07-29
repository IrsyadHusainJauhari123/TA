<x-app title="Pengajuan LPJ">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA PENGAJUAN JADWAL
            KONSULTASI LAPORAN PERTANGGUNG JAWABAN
            BARU
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('user/lpj/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>
            <br>
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
                        @foreach ($list_lpj->sortByDesc('created_at')->values() as $lpj)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="user/lpj" id="{{ $lpj->id }}" />
                                        <x-template.button.edit-button url="user/lpj" id="{{ $lpj->id }}" />
                                        <x-template.button.delete-button url="user/lpj" id="{{ $lpj->id }}" />
                                    </div>
                                </td>
                                <td>{{ $lpj->tanggal_pengajuan }}</td>
                                <td>{{ $lpj->jam_pengajuan }} WIB</td>
                                <td>{{ $lpj->jam_selesai }} WIB</td>
                                <td>{{ $lpj->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($lpj->status == 'DiProses...')
                                        <span class="btn btn-warning">{{ $lpj->status }}</span>
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
