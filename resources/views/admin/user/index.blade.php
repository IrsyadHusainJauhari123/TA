<x-app title=" Admin User">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DATA USER
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('admin/user/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th style="color: white;" width="10px" class="text-center">NO</th>
                        <th style="color: white;" width="90px" class="text-center">AKSI</th>
                        <th style="color: white;">NAMA USER</th>
                        <th style="color: white;">EMAIL</th>
                        <th style="color: white;">LEVEL</th>
                        <th style="color: white;">NO HANDPHONE</th>
                        <th style="color: white;">JABATAN</th>
                    </thead>
                    <tbody>
                        @foreach ($list_user->sortByDesc('created_at')->values() as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/user" id="{{ $user->id }}" />
                                        <x-template.button.edit-button url="admin/user" id="{{ $user->id }}" />
                                        <x-template.button.delete-button url="admin/user" id="{{ $user->id }}" />
                                    </div>
                                </td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td>{{ $user->jabatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app>
