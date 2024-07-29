<x-app title="Arsip | Agenda">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> ARSIP AGENDA
        </h5>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('admin/arsip/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>

            {{-- Filter section --}}
            {{-- <form action="{{ url('admin/arsip/filter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="judul_pesan" class="form-control" placeholder="Judul Agenda    "
                            value="{{ request('judul_pesan') }}">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Filter</button>
                    </div>
                </div>

            </form> --}}

            <div class="table-responsive mt-3">
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="10px" class="text-center" style="color: white;">NO</th>
                        <th width="10px" class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">JUDUL AGENDA PESAN</th>
                        <th class="text-center" style="color: white;">DAFTAR HADIR SATKER</th>
                    </thead>
                    <tbody>
                        @foreach ($list_arsip as $arsip)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.edit-button url="admin/arsip" id="{{ $arsip->id }}" />
                                        <x-template.button.delete-button url="admin/arsip" id="{{ $arsip->id }}" />

                                    </div>
                                </td>
                                <td>
                                    @php
                                        $judulAgenda = '';
                                        $blastwa = \App\Models\BlastWa::find($arsip->id_blastwa);
                                        $broadcast = \App\Models\Broadcast::find($arsip->id_blastwa);

                                        if ($blastwa) {
                                            $judulAgenda = $blastwa->judul_pesan;
                                        } elseif ($broadcast) {
                                            $judulAgenda = $broadcast->judul_pesan;
                                        }

                                        echo $judulAgenda;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $idSatkers = explode(',', $arsip->ids);
                                        $namaSatkers = [];
                                        foreach ($idSatkers as $idSatker) {
                                            $satker = \App\Models\Satker::find($idSatker);
                                            if ($satker) {
                                                $namaSatkers[] = $satker->nama_satker;
                                            }
                                        }
                                        echo implode(', ', $namaSatkers);
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app>
