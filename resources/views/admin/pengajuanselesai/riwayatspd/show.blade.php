<x-app title="Detail Riwayat Jadwal Konsultasi Surat Perjalanan Dinas">
    <x-template.button.back-button url="admin/pengajuanselesai/riwayatspd" />
    <div class="card">
        <div class="card-header py-2">
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Spd</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Satker</th>
                    <td>{{ $spd->satker->nama_satker }}</td>
                </tr>
                <tr>
                    <th>Kode Satker</th>
                    <td>{{ $spd->satker->kode_satker }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $spd->tanggal_pengajuan }}</td>
                </tr>
                <tr>
                    <th>Jam Pengajuan</th>
                    <td>{{ $spd->jam_pengajuan }} WIB</td>
                </tr>
                <tr>
                    <th>Jam Selesai Pengajuan</th>
                    <td>{{ $spd->jam_selesai }} WIB</td>
                </tr>
                <tr>
                    <th>Nama Pegawai KPPN</th>
                    <td>{{ $spd->pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                    <th>Jabatan Pegawai KPPN</th>
                    <td>{{ $spd->pegawai->jabatan }}</td>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <td>
                        @if ($spd->status == 'Di Terima')
                            <span class="btn btn-success">{{ $spd->status }}</span>
                        @else
                            <span class="btn btn-danger">{{ $spd->status }}</span>
                        @endif
                    </td>
                </tr>
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            </table>
        </div>
    </div>
</x-app>
