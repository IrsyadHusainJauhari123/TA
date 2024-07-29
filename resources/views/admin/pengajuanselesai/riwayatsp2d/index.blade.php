<x-app title="Riwayat Jadwal Konsultasi Surat Perintah Percairan Dana">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> RIWAYAT PENGAJUAN
            JADWAL KONSULTASI SATKER
            SURAT PERINTAH PERCAIRAN DANA
        </h5>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h5>Data Jadwal Yang Diterima</h5>
            <hr>
            {{-- <form action="{{ url('admin/pengajuanselesai/riwayatsp2d/filter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="nama_satker" class="form-control" placeholder="Nama Satker"
                            value="{{ request('nama_satker') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="tanggal_pengajuan" class="form-control"
                            placeholder="Tanggal Pengajuan" value="{{ request('tanggal_pengajuan') }}">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Filter</button>
                    </div>
                </div>

            </form> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="5px" class="text-center" style="color: white;">NO</th>
                        <th style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA SATKER</th>
                        <th class="text-center" style="color: white;">JAM PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA PEGAWAI KPPN DIPILIH</th>
                        <th class="text-center" style="color: white;">STATUS</th>
                    </thead>
                    <tbody>
                        @foreach ($sp2dDiterima as $sp2d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/pengajuanselesai/riwayatsp2d"
                                            id="{{ $sp2d->id }}" />
                                        <x-template.button.delete-button url="admin/pengajuanselesai/riwayatsp2d"
                                            id="{{ $sp2d->id }}" />
                                    </div>
                                </td>
                                <td>{{ $sp2d->tanggal_pengajuan }}</td>
                                <td>{{ $sp2d->satker->nama_satker }}</td>
                                <td>{{ $sp2d->jam_pengajuan }} WIB</td>
                                <td>{{ $sp2d->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($sp2d->status == 'Di Terima')
                                        <span class="btn btn-success">{{ $sp2d->status }}</span>
                                    @else
                                        {{ $sp2d->status }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-header py-2">
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h5>Data Jadwal Yang Di Tolak</h5>
            <hr>
            {{-- <form action="{{ url('admin/pengajuanselesai/riwayatsp2d/filter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="nama_satker" class="form-control" placeholder="Nama Satker"
                            value="{{ request('nama_satker') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="tanggal_pengajuan" class="form-control"
                            placeholder="Tanggal Pengajuan" value="{{ request('tanggal_pengajuan') }}">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Filter</button>
                    </div>
                </div>

            </form> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table1" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="5px" class="text-center" style="color: white;">NO</th>
                        <th class="text-center" style="color: white;">AKSI</th>
                        <th class="text-center" style="color: white;">TANGGAL PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA SATKER</th>
                        <th class="text-center" style="color: white;">JAM PENGAJUAN</th>
                        <th class="text-center" style="color: white;">NAMA PEGAWAI KPPN DIPILIH</th>
                        <th class="text-center" style="color: white;">STATUS</th>
                    </thead>
                    <tbody>
                        @foreach ($sp2dDitolak as $sp2d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="btn-group">
                                        <x-template.button.info-button url="admin/pengajuanselesai/riwayatsp2d"
                                            id="{{ $sp2d->id }}" />
                                        <x-template.button.delete-button url="admin/pengajuanselesai/riwayatsp2d"
                                            id="{{ $sp2d->id }}" />
                                    </div>
                                </td>
                                <td>{{ $sp2d->tanggal_pengajuan }}</td>
                                <td>{{ $sp2d->satker->nama_satker }}</td>
                                <td>{{ $sp2d->jam_pengajuan }} WIB</td>
                                <td>{{ $sp2d->pegawai->nama_pegawai }}</td>
                                <td>
                                    @if ($sp2d->status == 'Di Tolak')
                                        <span class="btn btn-danger">{{ $sp2d->status }}</span>
                                    @else
                                        {{ $sp2d->status }}
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
