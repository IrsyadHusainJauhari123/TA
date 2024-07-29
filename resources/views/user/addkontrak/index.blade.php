<x-app title="Pengajuan addk">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA PENGAJUAN JADWAL
            KONSULTASI
            ADDEDUM KONTRAK
            BARU
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('user/addk/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
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
                        @foreach ($list_addkontrak->sortByDesc('created_at')->values() as $addk)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="user/addk" id="{{ $addk->id }}" />
                                        <x-template.button.edit-button url="user/addk" id="{{ $addk->id }}" />
                                        <x-template.button.delete-button url="user/addk" id="{{ $addk->id }}" />
                                    </div>
                                </td>
                                <td>{{ $addk->tanggal_pengajuan }}</td>
                                <td>{{ $addk->jam_pengajuan }} WIB</td>
                                <td>{{ $addk->jam_selesai }} WIB</td>
                                <td>{{ $addk->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($addk->status == 'DiProses...')
                                        <span class="btn btn-warning">{{ $addk->status }}</span>
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
