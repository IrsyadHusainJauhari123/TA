<x-app title="Detail Riwayat Jadwal Konsul Addendum Kontrak">
    <x-template.button.back-button url="admin/pengajuanselesai/riwayataddk" />
    <div class="card">
        <div class="card-header"><br>
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Addedum Kontrak</h5>
        </div><br>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Satker</th>
                    <td>{{ $addk->satker->nama_satker }}</td>
                </tr>
                <tr>
                    <th>Kode Satker</th>
                    <td>{{ $addk->satker->kode_satker }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $addk->tanggal_pengajuan }}</td>
                </tr>
                <tr>
                    <th>Jam Pengajuan</th>
                    <td>{{ $addk->jam_pengajuan }} WIB</td>
                </tr>
                <tr>
                    <th>Jam Selesai Pengajuan</th>
                    <td>{{ $addk->jam_selesai }} WIB</td>
                </tr>
                <tr>
                    <th>Nama Pegawai KPPN</th>
                    <td>{{ $addk->pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                    <th>Jabatan Pegawai KPPN</th>
                    <td>{{ $addk->pegawai->jabatan }}</td>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <td>
                        @if ($addk->status == 'Di Terima')
                            <span class="btn btn-success">{{ $addk->status }}</span>
                        @else
                            <span class="btn btn-danger">{{ $addk->status }}</span>
                        @endif
                    </td>
                </tr>
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            </table>
        </div>
    </div>
</x-app>
