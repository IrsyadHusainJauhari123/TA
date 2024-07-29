<x-app title="Detail Riwayat Pengajuan Jadwal Konsultasi Khusus">
    <x-template.button.back-button url="admin/pengajuankhusus/khususselesai" />
    <div class="card">
        <div class="card-header py-2">
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Khusus</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Satker</th>
                    <td>{{ $khusus->satker->nama_satker }}</td>
                </tr>
                <tr>
                    <th>Kode Satker</th>
                    <td>{{ $khusus->satker->kode_satker }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $khusus->tanggal_pengajuan }}</td>
                </tr>
                <tr>
                    <th>Jam Pengajuan</th>
                    <td>{{ $khusus->jam_pengajuan }} WIB</td>
                </tr>
                <tr>
                    <th>Jam Selesai Pengajuan</th>
                    <td>{{ $khusus->jam_selesai }} WIB</td>
                </tr>
                <tr>
                    <th>Nama Pegawai KPPN</th>
                    <td>{{ $khusus->pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                    <th>Jabatan Pegawai KPPN</th>
                    <td>{{ $khusus->pegawai->jabatan }}</td>
                </tr>
                <tr>
                    <th>Keterangan Alasan Pengajuan</th>
                    <td>{{ $khusus->alasan_pengajuan }}</td>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <td>
                        @if ($khusus->status == 'Di Terima')
                            <span class="btn btn-success">{{ $khusus->status }}</span>
                        @else
                            <span class="btn btn-danger">{{ $khusus->status }}</span>
                        @endif
                    </td>
                </tr>
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            </table>
        </div>
    </div>
</x-app>
