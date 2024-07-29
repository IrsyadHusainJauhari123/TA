<x-app title="Admin | Pegawai">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA PEGAWAI
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('admin/pegawai/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="10px" class="text-center" style="color: white;">NO</th>
                        <th width="90px" class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">NAMA</th>
                        <th class="text-center" style="color: white;">JABATAN</th>
                        <th class="text-center" style="color: white;">NOMOR HANDPHONE</th>
                        <th width="5%" class="text-center" style="color: white;">STATUS</th>
                    </thead>
                    <tbody>
                        @foreach ($list_pegawai->sortByDesc('created_at')->values() as $pegawai)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/pegawai" id="{{ $pegawai->id }}" />
                                        <x-template.button.edit-button url="admin/pegawai" id="{{ $pegawai->id }}" />
                                        <x-template.button.delete-button url="admin/pegawai" id="{{ $pegawai->id }}" />
                                    </div>
                                </td>
                                <td>{{ $pegawai->nama_pegawai }}</td>
                                <td>{{ $pegawai->jabatan }}</td>
                                <td>{{ $pegawai->nomor_hp }}</td>

                                <td>
                                    @if ($pegawai->status == 'Aktif')
                                        <span class="btn btn-success">{{ $pegawai->status }}</span>
                                    @elseif ($pegawai->status == 'Sakit')
                                        <span class="btn btn-danger">{{ $pegawai->status }}</span>
                                    @elseif ($pegawai->status == 'Cuti')
                                        <span class="btn btn-warning">{{ $pegawai->status }}</span>
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
