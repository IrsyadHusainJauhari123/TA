<x-app title="Admin | Tambah Data Absensi Agenda">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">
            ARSIP KEHADIRAN AGENDA SATKER
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
            {{-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}
            <form id="arsipForm" action="{{ url('admin/arsip') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul_pesan" class="form-label">Judul Pesan</label>
                    <select class="form-select form-control" id="judul_pesan" name="judul_pesan" required>
                        <option disabled selected>Pilih Judul Pesan</option>
                        @foreach ($blastwaData as $blastwa)
                            <option value="{{ $blastwa->id }}">{{ $blastwa->judul_pesan }}</option>
                        @endforeach
                        @foreach ($broadcastData as $broadcast)
                            <option value="{{ $broadcast->id }}">{{ $broadcast->judul_pesan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="nama_satker" class="form-label">Nama Satker</label>
                        <select class="form-select form-control" id="nama_satker" name="nama_satker" required>
                            <option selected>Pilih Nama Satker</option>
                            @foreach ($satkerData as $satker)
                                <option value="{{ $satker->id }}" data-kode="{{ $satker->kode_satker }}">
                                    {{ $satker->nama_satker }}
                                </option>
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
                    </tbody>
                </table>
                <br>
                <input type="hidden" id="selectedBlastwaId" name="judul_pesan_id">
                <button type="submit" class="btn btn-primary float-right" id="submitForm"><i class="far fa-save"></i> |
                    Simpan</button>

            </form>
        </div>
    </div>
</x-app>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaSatkerSelect = document.getElementById('nama_satker');
        const kodeSatkerInput = document.getElementById('kode_satker');
        const addSatkerButton = document.getElementById('addSatker');
        const satkerTable = document.getElementById('satkerTable').getElementsByTagName('tbody')[0];
        const arsipForm = document.getElementById('arsipForm');
        const selectedBlastwaId = document.getElementById('selectedBlastwaId');

        namaSatkerSelect.addEventListener('change', function() {
            const selectedOption = namaSatkerSelect.options[namaSatkerSelect.selectedIndex];
            const kodeSatker = selectedOption.getAttribute('data-kode');
            kodeSatkerInput.value = kodeSatker;
        });

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
                // Add the removed option back to the select dropdown
                const option = document.createElement('option');
                option.value = selectedOption.value;
                option.text = namaSatker;
                option.setAttribute('data-kode', kodeSatker);
                namaSatkerSelect.add(option);

                // Remove the row from the table
                newRow.remove();
            });
        });

        // Submit the form with selected judul_pesan ID
        // Submit the form with selected judul_pesan ID
        arsipForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Menghentikan perilaku default pengiriman form

            const selectedJudulPesan = document.getElementById('judul_pesan').value;
            selectedBlastwaId.value = selectedJudulPesan;

            // Lanjutkan dengan mengirimkan form secara manual
            arsipForm.submit();
        });

    });
</script>
