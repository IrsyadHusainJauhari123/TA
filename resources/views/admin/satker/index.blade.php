<x-app title="Admin | Satker">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA SATKER
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('admin/satker/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>
            <br>
            <div class="table-responsive">

                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="10px" class="text-center" style="color: white;">NO</th>
                        <th width="90px" class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">NAMA SATKER</th>
                        <th class="text-center" style="color: white;">KODE SATKER</th>

                    </thead>
                    <tbody>
                        @foreach ($list_satker->sortByDesc('created_at')->values() as $satker)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- <x-template.button.info-button url="admin/satker" id="{{ $satker->id }}" /> --}}
                                        <x-template.button.edit-button url="admin/satker" id="{{ $satker->id }}" />
                                        <x-template.button.delete-button url="admin/satker" id="{{ $satker->id }}" />
                                    </div>
                                </td>
                                <td>{{ $satker->nama_satker }}</td>
                                <td>{{ $satker->kode_satker }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app>
