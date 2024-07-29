<x-app title="Admin | Detail Kirim Pesan Agenda Per Satker">
    <x-template.button.back-button url="admin/blastwa" />
    <div class="card">
        <div class="card-header py-2">
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Khusus</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Tanggal Pengirim Pesan Agenda Ke Satker </th>
                    <td>{{ $blastwa->tanggal }}</td>
                </tr>
                <tr>
                    <th>Judul Pesan Agenda</th>
                    <td>{{ $blastwa->judul_pesan }}</td>
                </tr>
                <tr>
                    <th>Isi Pesan Agenda</th>
                    <td>{{ $blastwa->pesan }}</td>
                </tr>
                <tr>
                    <th>Satker Penerima Pesan Agenda</th>
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
                </tr>
                <th>Kode Satker Penerima Pesan</th>
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
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            </table>
        </div>
    </div>
</x-app>
