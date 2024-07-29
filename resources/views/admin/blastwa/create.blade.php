<head>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<x-app title="Admin Broadcast WhatsApp | Create">
    <style>
        .satker-group {
            margin-bottom: 20px;
        }

        .remove-button {
            margin-top: 10px;
        }
    </style>
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> BUAT PESAN JADWAL DAN
            AGENDA BROADCAST WHATSAPP KE SATKER
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/blastwa" />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/blastwa') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="satker-container">
                    <div class="form-row satker-group">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="judul_pesan" class="control-label">JUDUL PESAN AGENDA</label>
                                @if ($errors->has('judul_pesan'))
                                    <label for="judul_pesan"
                                        class="label text-danger">{{ $errors->first('judul_pesan') }}</label>
                                @endif
                                <input type="text" name="judul_pesan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="tanggal" class="control-label">PILIH TANGGAL KIRIM PESAN AGENDA</label>
                                @if ($errors->has('tanggal'))
                                    <label for="tanggal"
                                        class="label text-danger">{{ $errors->first('tanggal') }}</label>
                                @endif
                                <input type="date" name="tanggal" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-row satker-group">
                        <div class="form-group col-md-6">
                            <label for="user_select_1">Pilih Satuan Kerja:</label>
                            <select class="form-control user_select" id="user_select_1" name="user_select[]" required>
                                <option value="" selected disabled>Pilih opsi</option>
                                @foreach ($list_satker as $satker)
                                    <option value="{{ $satker['kode_satker'] }}">{{ $satker['nama_satker'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="kode_satker_group_1">
                            <label for="kode_satker_1">Kode Satuan Kerja:</label>
                            <input type="text" class="form-control kode_satker" id="kode_satker_1"
                                name="kode_satker[]" readonly>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-button">Tambah Data</button>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="message">Pesan:</label>
                        @if ($errors->has('message'))
                            <label for="message" class="label text-danger">{{ $errors->first('message') }}</label>
                        @endif
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="file" class="control-label">FILE</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-primary float-right"><i class="fas fa-paper-plane"></i>
                            |
                            Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var satkerContainer = document.getElementById('satker-container');
            var addButton = document.getElementById('add-button');
            var satkerCount = 1;

            // Function to update kode_satker based on selected nama_satker
            function updateKodeSatker(select) {
                var selectedOption = select.options[select.selectedIndex];
                var kodeSatkerInput = select.closest('.satker-group').querySelector('.kode_satker');
                kodeSatkerInput.value = selectedOption.value;
            }

            // Event listener for dynamically created selects
            document.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('user_select')) {
                    updateKodeSatker(e.target);
                }
            });

            // Add new satker fields
            addButton.addEventListener('click', function() {
                satkerCount++;
                var newSatkerGroup = document.createElement('div');
                newSatkerGroup.classList.add('form-row', 'satker-group');
                newSatkerGroup.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="user_select_${satkerCount}">Pilih Satuan Kerja:</label>
                        <select class="form-control user_select" id="user_select_${satkerCount}" name="user_select[]" required>
                            <option value="" selected disabled>Pilih opsi</option>
                            @foreach ($list_satker as $satker)
                                <option value="{{ $satker['kode_satker'] }}">{{ $satker['nama_satker'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="kode_satker_group_${satkerCount}">
                        <label for="kode_satker_${satkerCount}">Kode Satuan Kerja:</label>
                        <input type="text" class="form-control kode_satker" id="kode_satker_${satkerCount}" name="kode_satker[]" readonly>
                    </div>
                    <button type="button" class="btn btn-danger remove-button">Hapus</button>
                `;
                satkerContainer.appendChild(newSatkerGroup);
            });

            // Remove satker fields
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-button')) {
                    e.target.closest('.satker-group').remove();
                }
            });
        });
    </script>




</x-app>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#message').summernote({
            placeholder: 'Tulis alasan pengajuan disini...',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Handle form submission
        $('form').on('submit', function(e) {
            // Dapatkan isi Summernote
            var content = $('#message').summernote('code');

            // Hapus tag HTML dan konversi ke teks murni
            var strippedContent = content.replace(/<[^>]*>/g, "");

            // Ganti simbol * sebelum dan sesudah teks yang ingin bold
            strippedContent = strippedContent.replace(/\*([^*]+)\*/g, '<strong>$1</strong>');

            // Set nilai input message dengan teks yang sudah diformat
            $('#message').val(strippedContent);
        });
    });
</script>
