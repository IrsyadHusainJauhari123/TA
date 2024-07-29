<x-app>
    <!-- Struktur modal untuk menampilkan data Calender1 -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detail LPJ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                @foreach ($calenderData as $data)
                    <p>Nama Jadwal: {{ $data->nama_jadwal }}</p>
                    <p>Tanggal Pengajuan: {{ $data->tanggal_pengajuan }}</p>
                    <p>Nama Pegawai: {{ $data->lpj->pegawai->nama_pegawai }}</p>
                    <!-- Tambahan informasi lain yang ingin ditampilkan -->
                @endforeach

            </div>
        </div>
    </div>




</x-app>
