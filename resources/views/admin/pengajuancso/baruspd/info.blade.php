<x-app title=" | Add Kontrak">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> INFO DAFTAR JADWAL SURAT
            PERJALANAN DINAS
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/pengajuancso/baruspd" />
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <label for="nama_satker">NAMA SATKER :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="nama_satker"
                        style="text-align: center" value="{{ $spd->satker->nama_satker }}">
                </div>

                <div class="col-md-4">
                    <label for="kode_satker">KODE SATKER :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="kode_satker"
                        style="text-align: center" value="{{ $spd->satker->kode_satker }} ">
                </div>

                <div class="col-md-4">
                    <label for="tanggal_pengajuan">TANGGAL PENGAJUAN :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="tanggal_pengajuan"
                        style="text-align: center" value="{{ $spd->tanggal_pengajuan }}"><br><br>
                </div>
                <div class="col-md-4">
                    <label for="jam_pengajuan">JAM PENGAJUAN DI AJUKAN :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="jam_pengajuan"
                        style="text-align: center" value="{{ $spd->jam_pengajuan }} WIB">
                </div>
                <div class="col-md-4">
                    <label for="jam_selesai">JAM SELESAI DIAJUKAN :</label>
                    <input type="text" readonly class="form-control form-control-plaintext" id="jam_selesai"
                        style="text-align: center" value="{{ $spd->jam_selesai }} WIB">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="status">STATUS PENGAJUAN AWAL :</label>
                    <input type="text" readonly class="btn btn-warning form-control-plaintext" id="status"
                        value="{{ $spd->status }}">
                </div>
            </div>
            <br><br>
            <div class="col-md-12">
                <div class="form-group d-flex justify-content-end">
                    @if ($spd->status == 'DiProses...')
                        <form id="acceptForm" action="{{ url('admin/pengajuancso/baruspd', $spd->id) }}/accept"
                            method="post">
                            @csrf
                            <button type="button" class="btn btn-success mr-2" name="action" value="accept"
                                onclick="showModal('accept')">Di Terima</button>
                        </form>

                        <form id="rejectForm" action="{{ url('admin/pengajuancso/baruspd', $spd->id) }}/reject"
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
                        <textarea class="form-control" id="balasan_wa" name="balasan_wa" rows="5">*Hallo*, Perkenalkan saya *Agung* Bagian Admin KPPN Ketapang. Yang terhormat Kepada *{{ $spd->satker->nama_satker }}* dengan Kode Satker *{{ $spd->satker->kode_satker }}* untuk pertemuan jadwal konsultasi spd dengan pegawai KPPN Ketapang bagian *{{ $spd->pegawai->jabatan }}* pada tanggal *{{ $spd->tanggal_pengajuan }}* pada pukul *{{ $spd->jam_pengajuan }} WIB* hingga pukul *{{ $spd->jam_selesai }} WIB*. Pengajuan Jadwal Pertemuan Konsultasi *Di Terima*. Silahkan datang ke KPPN Ketapang dan bertemu dengan *{{ $spd->pegawai->nama_pegawai }}* *10 Menit* sebelum Jam *{{ $spd->jam_pengajuan }} WIB* dimulai. Sekian atas perhatian kami, ucapkan Terima Kasih.</textarea>
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
                            *Hallo*, Perkenalkan saya *Agung*, bagian Admin KPPN Ketapang. Mohon Maaf Atas Pengajuan Jadwal Konsultasi spd dari Satker {{ $spd->satker->nama_satker }} dengan Kode Satker {{ $spd->satker->kode_satker }} dengan pegawai kami *{{ $spd->pegawai->nama_pegawai }}* dengan jabatan *{{ $spd->pegawai->jabatan }}*. Yang ingin bertemu pada tanggal *{{ $spd->tanggal_pengajuan }}* pada pukul *{{ $spd->jam_pengajuan }} WIB*, hingga *{{ $spd->jam_selesai }} WIB* *DI Tolak*. Di karena pegawai tersebut sudah ada jadwal pertemuan konsultasi dengan Satker lain. Silahkan untuk pengajuan Jadwal ulang kembali. Dengan melihat di Kelander bagian Dashboard dengan Mengklick tanggal dikalender untuk melihat jadwal CSO dan CSK KPPN Ketapang. Sekian Kami Ucapkan Terima Kasih
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
        var acceptAction = '{{ url('admin/pengajuancso/baruspd', $spd->id) }}/accept';
        var rejectAction = '{{ url('admin/pengajuancso/baruspd', $spd->id) }}/reject';

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
