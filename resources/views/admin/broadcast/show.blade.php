<x-app title="Admin | Detail Kirim Pesan Agenda Semua Satker">
    <x-template.button.back-button url="admin/broadcast" />
    <div class="card">
        <div class="card-header py-2">
            <h5 class="m-0 font-weight-bold text-dark">Detail Pengajuan Jadwal Konsultasi Khusus</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Tanggal Pengirim Pesan Agenda Ke Satker </th>
                    <td>{{ $broadcast->tanggal }}</td>
                </tr>
                <tr>
                    <th>Judul Pesan Agenda</th>
                    <td>{{ $broadcast->judul_pesan }}</td>
                </tr>
                <tr>
                    <th>Isi Pesan Agenda</th>
                    <td>{{ $broadcast->pesan }}</td>
                </tr>
                <tr>
                    <th>Satker Penerima Pesan Agenda</th>
                    <td>
                        @php
                            $idSatkers = explode(',', $broadcast->ids);
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
                        $idSatkers = explode(',', $broadcast->ids);
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
