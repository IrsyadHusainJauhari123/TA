<head>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<x-app title="Admin | WhatsApp Message New">

    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">
            BUAT PESAN JADWAL DAN AGENDA BROADCAST WHATSAPP KE SEMUA SATKER
        </h5>
    </div>
    <x-template.button.back-button url="admin/broadcast" />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/broadcast') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                                <label for="tanggal" class="label text-danger">{{ $errors->first('tanggal') }}</label>
                            @endif
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                    </div>
                </div>
                <div id="satker-container" class="form-row">
                    @foreach ($list_satker as $satker)
                        <div class="form-group col-md-6">
                            <label for="nama_satker_{{ $satker->id }}">Nama Satker:</label>
                            <input type="text" class="form-control" id="nama_satker_{{ $satker->id }}"
                                value="{{ $satker->nama_satker }}" readonly>
                            <input type="hidden" name="kode_satker[]" value="{{ $satker->kode_satker }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kode_satker_{{ $satker->id }}">Kode Satker:</label>
                            <input type="text" class="form-control" id="kode_satker_{{ $satker->id }}"
                                value="{{ $satker->kode_satker }}" readonly>
                        </div>
                    @endforeach
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="message">Pesan:</label>
                        @if ($errors->has('message'))
                            <label for="message" class="label text-danger">{{ $errors->first('message') }}</label>
                        @endif
                        <textarea class="form-control" id="message" name="message" rows="4" ></textarea>
                    </div>
                </div>
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
