<x-app title="Detail Riwayat Jadwal Konsultasi Surat Perintah Membayar">
    <x-template.button.back-button url="admin/pengajuanselesai/riwayatspm" />
    <div class="card">
        <div class="card-header py-2">
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Spm</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama Satker</th>
                    <td>{{ $spm->satker->nama_satker }}</td>
                </tr>
                <tr>
                    <th>Kode Satker</th>
                    <td>{{ $spm->satker->kode_satker }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $spm->tanggal_pengajuan }}</td>
                </tr>
                <tr>
                    <th>Jam Pengajuan</th>
                    <td>{{ $spm->jam_pengajuan }} WIB</td>
                </tr>
                <tr>
                    <th>Jam Selesai Pengajuan</th>
                    <td>{{ $spm->jam_selesai }} WIB</td>
                </tr>
                <tr>
                    <th>Nama Pegawai KPPN</th>
                    <td>{{ $spm->pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                    <th>Jabatan Pegawai KPPN</th>
                    <td>{{ $spm->pegawai->jabatan }}</td>
                </tr>
                <tr>
                    <th>Status Verifikasi</th>
                    <td>
                        @if ($spm->status == 'Di Terima')
                            <span class="btn btn-success">{{ $spm->status }}</span>
                        @else
                            <span class="btn btn-danger">{{ $spm->status }}</span>
                        @endif
                    </td>
                </tr>
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            </table>
        </div>
    </div>
</x-app>
