<x-app title="Admin | Detail Pengajuan Baru Sp2d">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> INFO DAFTAR JADWAL SURAT
            PERINTAH PENCAIRAN DANA
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/pengajuancso/barusp2d" />
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <label for="nama_satker">NAMA SATKER :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="nama_satker"
                        style="text-align: center" value="{{ $sp2d->satker->nama_satker }}">
                </div>

                <div class="col-md-4">
                    <label for="kode_satker">KODE SATKER :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="kode_satker"
                        style="text-align: center" value="{{ $sp2d->satker->kode_satker }} ">
                </div>

                <div class="col-md-4">
                    <label for="tanggal_pengajuan">TANGGAL PENGAJUAN :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="tanggal_pengajuan"
                        style="text-align: center" value="{{ $sp2d->tanggal_pengajuan }}"><br><br>
                </div>
                <div class="col-md-4">
                    <label for="jam_pengajuan">JAM PENGAJUAN DI AJUKAN :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="jam_pengajuan"
                        style="text-align: center" value="{{ $sp2d->jam_pengajuan }} WIB">
                </div>
                <div class="col-md-4">
                    <label for="jam_selesai">JAM SELESAI DIAJUKAN :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="jam_selesai"
                        style="text-align: center" value="{{ $sp2d->jam_selesai }} WIB">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="status">STATUS PENGAJUAN AWAL :</label>
                    <input type="text" readonly class="btn btn-warning form-control-plaintext" id="status"
                        value="{{ $sp2d->status }}">
                </div>
            </div>
            <br><br>
            <div class="col-md-12">
                <div class="form-group d-flex justify-content-end">
                    @if ($sp2d->status == 'DiProses...')
                        <form id="acceptForm" action="{{ url('admin/pengajuancso/barusp2d', $sp2d->id) }}/accept"
                            method="post">
                            @csrf
                            <button type="button" class="btn btn-success mr-2" name="action" value="accept"
                                onclick="showModal('accept')">Di Terima</button>
                        </form>

                        <form id="rejectForm" action="{{ url('admin/pengajuancso/barusp2d', $sp2d->id) }}/reject"
                            method="post">
                            @csrf
                            <button type="button" class="btn btn-danger" name="action" value="reject"
                                onclick="showModal('reject')">Di Tolak</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app>

<div class="modal fade" id="balasanModal" tabindex="-1" role="dialog" aria-labelledby="balasanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balasanModalLabel">Balasan WA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="balasanForm" action="" method="post" style="display: none;">
                    @csrf
                    <div class="form-group">
                        <label for="balasan_wa">Balasan WA:</label>
                        <textarea class="form-control" id="balasan_wa" name="balasan_wa" rows="5">*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *{{ $sp2d->satker->nama_satker }}* dengan Kode Satker *{{ $sp2d->satker->kode_satker }}* untuk pertemuan jadwal konsultasi sp2d dengan pegawai KPPN Ketapang bagian *{{ $sp2d->pegawai->jabatan }}* pada tanggal *{{ $sp2d->tanggal_pengajuan }}* pada pukul *{{ $sp2d->jam_pengajuan }} WIB* hingga pukul *{{ $sp2d->jam_selesai }} WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *{{ $sp2d->pegawai->nama_pegawai }}* *10 Menit* sebelum Jam *{{ $sp2d->jam_pengajuan }} WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-primary float-right"><i class="fas fa-paper-plane"></i>
                                |
                                Simpan</button>
                        </div>
                    </div>
                </form>


                <form id="rejectFormModal" action="" method="post" style="display: none;">
                    @csrf
                    <div class="form-group">
                        <label for="balasan_wa">Balasan WA:</label>
                        <textarea class="form-control" id="balasan_wa" name="balasan_wa" rows="5">
                            *Hallo*, Perkenalkan saya *Agung*, bagian Admin KPPN Ketapang. Mohon Maaf Atas Pengajuan Jadwal Konsultasi sp2d dari Satker {{ $sp2d->satker->nama_satker }} dengan Kode Satker {{ $sp2d->satker->kode_satker }} dengan pegawai kami *{{ $sp2d->pegawai->nama_pegawai }}* dengan jabatan *{{ $sp2d->pegawai->jabatan }}*. Yang ingin bertemu pada tanggal *{{ $sp2d->tanggal_pengajuan }}* pada pukul *{{ $sp2d->jam_pengajuan }} WIB*, hingga *{{ $sp2d->jam_selesai }} WIB* *DI Tolak*. Di karena pegawai tersebut sudah ada jadwal pertemuan konsultasi dengan Satker lain. Silahkan untuk pengajuan Jadwal ulang kembali. Dengan melihat di Kelander bagian Dashboard dengan Mengklick tanggal dikalender untuk melihat jadwal CSO dan CSK KPPN Ketapang. Sekian Kami Ucapkan Terima Kasih
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-primary float-right"><i class="fas fa-paper-plane"></i>
                                |
                                Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function showModal(action) {
        var modal = $('#balasanModal');
        var acceptForm = $('#balasanForm');
        var rejectForm = $('#rejectFormModal'); // Ganti ID agar tidak terjadi duplikasi

        // Menetapkan tindakan form berdasarkan aksi
        var acceptAction = '{{ url('admin/pengajuancso/barusp2d', $sp2d->id) }}/accept';
        var rejectAction = '{{ url('admin/pengajuancso/barusp2d', $sp2d->id) }}/reject';

        if (action === 'accept') {
            acceptForm.attr('action', acceptAction);
            acceptForm.show();
            rejectForm.hide();
        } else if (action === 'reject') {
            rejectForm.attr('action', rejectAction);
            rejectForm.show();
            acceptForm.hide();
        }

        // Menampilkan modal
        modal.modal('show');
    }

    function sendWhatsApp() {
        var modal = $('#balasanModal');
        var phoneNumber = modal.data('phone-number');
        var message = $('#balasan_wa').val();

        $.ajax({
            url: currentUrl.replace('/info', '/send.whatsapp.message'),
            type: 'POST',
            data: {
                phone_number: phoneNumber,
                message: message,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
