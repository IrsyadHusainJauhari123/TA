<x-app title="Admin | Edit Data Absensi Agenda">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">
            EDIT ARSIP KEHADIRAN AGENDA SATKER
        </h5>
    </div>
    <x-template.button.back-button url="{{ url('admin/arsip') }}" />
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form id="arsipForm" action="{{ url('admin/arsip/' . $arsip->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul_pesan" class="form-label">Judul Pesan</label>
                    <select class="form-select form-control" id="judul_pesan" name="judul_pesan" required>
                        <option disabled selected>Pilih Judul Pesan</option>
                        @foreach ($blastwaData as $blastwa)
                            <option value="{{ $blastwa->id }}"
                                {{ $arsip->id_blastwa == $blastwa->id ? 'selected' : '' }}>
                                {{ $blastwa->judul_pesan }}
                            </option>
                        @endforeach
                        @foreach ($broadcastData as $broadcast)
                            <option value="{{ $broadcast->id }}"
                                {{ $arsip->id_blastwa == $broadcast->id ? 'selected' : '' }}>
                                {{ $broadcast->judul_pesan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nama_satker" class="form-label">Nama Satker</label>
                        <select class="form-select form-control" id="nama_satker" name="nama_satker">
                            <option selected>Pilih Nama Satker</option>
                            @foreach ($satkerData as $satker)
                                @if (!$currentSatkers->contains('id', $satker->id))
                                    <option value="{{ $satker->id }}" data-kode="{{ $satker->kode_satker }}">
                                        {{ $satker->nama_satker }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="kode_satker" class="form-label">Kode Satker</label>
                        <input type="text" class="form-control" id="kode_satker" name="kode_satker" readonly>
                    </div>
                </div><br>
                <button type="button" class="btn btn-primary" id="addSatker">Tambah</button>
                <br>
                <table id="satkerTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Satker</th>
                            <th>Kode Satker</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($currentSatkers as $satker)
                            <tr>
                                <td>{{ $satker->nama_satker }}</td>
                                <td>{{ $satker->kode_satker }}</td>
                                <td><button type="button" class="btn btn-danger btn-sm removeSatker">Remove</button>
                                </td>
                                <input type="hidden" name="satker_ids[]" value="{{ $satker->id }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <input type="hidden" id="selectedBlastwaId" name="judul_pesan_id" value="{{ $arsip->id_blastwa }}">
                <button type="submit" class="btn btn-primary float-right" id="submitForm"><i class="far fa-save"></i>
                    | Simpan</button>
            </form>
        </div>
    </div>
</x-app>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaSatkerSelect = document.getElementById('nama_satker');
        const kodeSatkerInput = document.getElementById('kode_satker');
        const addSatkerButton = document.getElementById('addSatker');
        const satkerTable = document.getElementById('satkerTable').getElementsByTagName('tbody')[0];
        const arsipForm = document.getElementById('arsipForm');
        const selectedBlastwaId = document.getElementById('selectedBlastwaId');

        // Event listener untuk memilih Nama Satker
        namaSatkerSelect.addEventListener('change', function() {
            const selectedOption = namaSatkerSelect.options[namaSatkerSelect.selectedIndex];
            const kodeSatker = selectedOption.getAttribute('data-kode');
            kodeSatkerInput.value = kodeSatker;
        });

        // Event listener untuk tombol Tambah
        addSatkerButton.addEventListener('click', function() {
            const selectedOption = namaSatkerSelect.options[namaSatkerSelect.selectedIndex];
            const namaSatker = selectedOption.text;
            const kodeSatker = kodeSatkerInput.value;

            if (selectedOption.value === 'Pilih Nama Satker') {
                alert('Please select a valid Nama Satker');
                return;
            }

            // Add the row to the table
            const newRow = satkerTable.insertRow();
            newRow.innerHTML = `
                <td>${namaSatker}</td>
                <td>${kodeSatker}</td>
                <td><button type="button" class="btn btn-danger btn-sm removeSatker">Remove</button></td>
                <input type="hidden" name="satker_ids[]" value="${selectedOption.value}">
            `;

            // Remove the selected option from the select dropdown
            selectedOption.remove();

            // Clear the kode_satker input
            kodeSatkerInput.value = '';

            // Attach event listener to the remove button
            newRow.querySelector('.removeSatker').addEventListener('click', function() {
                // Add the removed option back to the select dropdown only if it doesn't already exist
                if (!Array.from(namaSatkerSelect.options).some(option => option.value ===
                        selectedOption.value)) {
                    const option = document.createElement('option');
                    option.value = selectedOption.value;
                    option.text = namaSatker;
                    option.setAttribute('data-kode', kodeSatker);
                    namaSatkerSelect.add(option);
                }

                // Hapus baris dari tabel
                newRow.remove();
            });
        });

        // Event listener untuk submit form
        arsipForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Menghentikan perilaku default pengiriman form

            const selectedJudulPesan = document.getElementById('judul_pesan').value;
            selectedBlastwaId.value = selectedJudulPesan;

            // Lanjutkan dengan mengirimkan form secara manual
            arsipForm.submit();
        });

        // Event listener untuk tombol Remove di setiap baris
        satkerTable.addEventListener('click', function(event) {
            if (event.target.classList.contains('removeSatker')) {
                const row = event.target.closest('tr');
                const satkerId = row.querySelector('input[name="satker_ids[]"]').value;
                const satkerName = row.querySelector('td:first-child').innerText;
                const kodeSatker = row.querySelector('td:nth-child(2)').innerText;

                // Buat option baru untuk select dropdown hanya jika belum ada
                if (!Array.from(namaSatkerSelect.options).some(option => option.value === satkerId)) {
                    const option = document.createElement('option');
                    option.value = satkerId;
                    option.text = satkerName;
                    option.setAttribute('data-kode', kodeSatker);
                    namaSatkerSelect.add(option);
                }

                // Hapus baris dari tabel
                row.remove();
            }
        });

        // Inisialisasi event listener untuk setiap tombol Remove yang sudah ada
        const removeButtons = document.querySelectorAll('.removeSatker');
        removeButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                const row = event.target.closest('tr');
                const satkerId = row.querySelector('input[name="satker_ids[]"]').value;
                const satkerName = row.querySelector('td:first-child').innerText;
                const kodeSatker = row.querySelector('td:nth-child(2)').innerText;

                // Buat option baru untuk select dropdown hanya jika belum ada
                if (!Array.from(namaSatkerSelect.options).some(option => option.value ===
                        satkerId)) {
                    const option = document.createElement('option');
                    option.value = satkerId;
                    option.text = satkerName;
                    option.setAttribute('data-kode', kodeSatker);
                    namaSatkerSelect.add(option);
                }

                // Hapus baris dari tabel
                row.remove();
            });
        });
    });
</script>
