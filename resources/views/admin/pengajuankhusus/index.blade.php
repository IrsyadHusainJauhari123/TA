<x-app title=" | Pengajuan Baru LPJ">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> DAFTAR PENGAJUAN LPJ SATKER
            BARU
        </h5>
    </div>
    <div class="card mt-4">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table id="example1" class="table table-datatable table-bordered">
                <thead class="bg-dark">
                    <th width="10px" class="text-center" style="color: white;">NO</th>
                    <th width="90px" class="text-center" style="color: white;">AKSI</th>
                    <th class="text-center" style="color: white;">NAMA SATKER</th>
                    <th class="text-center" style="color: white;">KODE SATKER</th>
                    <th class="text-center" style="color: white;">JENIS PENGAJUAN</th>
                    <th width="180px" class="text-center" style="color: white;">STATUS</th>
                </thead>
                <tbody>
                    @foreach ($list_lpjbaru as $lpjbaru)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="btn-group">
                                    <!-- Menggunakan URL yang sesuai -->
                                    <x-template.button.info-button url="admin/pengajuanbaru" id="{{ $lpjbaru->id }}" />
                                    <x-template.button.edit-button url="admin/pengajuanbaru" id="{{ $lpjbaru->id }}" />
                                    <x-template.button.delete-button url="admin/pengajuanbaru"
                                        id="{{ $lpjbaru->id }}" />

                                </div>
                            </td>
                            <td>{{ $lpjbaru->satker->nama_satker }}</td>
                            <td>{{ $lpjbaru->satker->kode_satker }}</td>
                            <td>{{ $lpjbaru->jenis_pengajuan }}</td>
                            <td>
                                @if ($lpjbaru->status == 'DiProses...')
                                    <span class="btn btn-warning">{{ $lpjbaru->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
