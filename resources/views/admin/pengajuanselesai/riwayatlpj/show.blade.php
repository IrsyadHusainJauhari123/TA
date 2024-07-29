<x-app title="Detail Riwayat Pengajuan Jadwal Konsultasi LPJ">
    <x-template.button.back-button url="admin/pengajuanselesai/riwayatlpj" />
    <div class="card">
        <div class="card-header py-2">
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Lpj</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Satker</th>
                    <td>{{ $lpj->satker->nama_satker }}</td>
                </tr>
                <tr>
                    <th>Kode Satker</th>
                    <td>{{ $lpj->satker->kode_satker }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $lpj->tanggal_pengajuan }}</td>
                </tr>
                <tr>
                    <th>Jam Pengajuan</th>
                    <td>{{ $lpj->jam_pengajuan }} WIB</td>
                </tr>
                <tr>
                    <th>Jam Selesai Pengajuan</th>
                    <td>{{ $lpj->jam_selesai }} WIB</td>
                </tr>
                <tr>
                    <th>Nama Pegawai KPPN</th>
                    <td>{{ $lpj->pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                    <th>Jabatan Pegawai KPPN</th>
                    <td>{{ $lpj->pegawai->jabatan }}</td>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <td>
                        @if ($lpj->status == 'Di Terima')
                            <span class="btn btn-success">{{ $lpj->status }}</span>
                        @else
                            <span class="btn btn-danger">{{ $lpj->status }}</span>
                        @endif
                    </td>
                </tr>
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            </table>
        </div>
    </div>
</x-app>
