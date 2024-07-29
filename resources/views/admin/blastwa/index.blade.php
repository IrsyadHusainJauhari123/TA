<x-app title="Admin | blastwa WhatsApp">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> KIRIM PESAN AGENDA
            WHATSAPP KE PER - SATUAN KERJA
        </h5>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <a href="{{ url('admin/blastwa/create') }}" class="float-right btn btn-dark"><i class="fas fa-plus"></i>
                    Tambah Data</a>
            </div>
            <br>
            {{-- <form action="{{ url('admin/blastwa/filter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="judul_pesan" class="form-control" placeholder="Judul Agenda    "
                            value="{{ request('judul_pesan') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="tanggal" class="form-control" placeholder="Tanggal Pengajuan"
                            value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Filter</button>
                    </div>
                </div>

            </form> --}}


            {{-- Filter section --}}

            <div class="table-responsive mt-3">
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="10px" class="text-center" style="color: white;">NO</th>
                        <th width="10px" class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">JUDUL AGENDA PESAN</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGIRIMAN</th>
                        <th class="text-center" style="color: white;">NAMA SATKER</th>
                        <th class="text-center" style="color: white;">KODE SATKER</th>
                        {{-- <th class="text-center" style="color: white;">NAMA TUJUAN</th> --}}
                        <th class="text-center" style="color: white;">ISI PESAN</th>

                    </thead>
                    <tbody>
                        @foreach ($list_blastwa as $blastwa)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/blastwa" id="{{ $blastwa->id }}" />
                                        <x-template.button.delete-button url="admin/blastwa" id="{{ $blastwa->id }}" />
                                    </div>
                                </td>
                                <td>{{ $blastwa->judul_pesan }}</td>
                                <td>{{ $blastwa->tanggal }}</td>
                                <td>
                                    @php
                                        $idSatkers = explode(',', $blastwa->ids);
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
                                <td>
                                    @php
                                        $idSatkers = explode(',', $blastwa->ids);
                                        $namaSatkers = [];
                                        foreach ($idSatkers as $idSatker) {
                                            $satker = \App\Models\Satker::find($idSatker);
                                            if ($satker) {
                                                $namaSatkers[] = $satker->kode_satker;
                                            }
                                        }
                                        echo implode(', ', $namaSatkers);
                                    @endphp
                                </td>
                                {{-- <td>
                                    @php
                                        $idUsers = explode(',', $blastwa->idu);
                                        $namaUsers = [];
                                        foreach ($idUsers as $idUser) {
                                            $user = \App\Models\User::find($idUser);
                                            if ($user) {
                                                $namaUsers[] = $user->nama; // Asumsi nama kolom nama user adalah 'name'
                                            }
                                        }
                                        echo implode(', ', $namaUsers);
                                    @endphp
                                </td> --}}
                                <td>{{ $blastwa->pesan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</x-app>
