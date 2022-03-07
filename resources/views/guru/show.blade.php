<div class="modal fade" id="show-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Detail Staff</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-4 px-0 mb-5">
                        <img class="img-fluid" src="{{ asset('storage/' . $item->foto) }}"
                            alt="{{ $item->name }}">
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        NUPTK
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->nuptk }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Nama
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->nama }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Status Mengajar
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Agama
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->agama->nama }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Jenis Kelamin
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->jenis_kelamin }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Tempat
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->tempat_lahir }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Tanggal Lahir
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->tanggal_lahir }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Nomor Telepon
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->no_telp }}</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Pendidikan Terakhir
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->pendidikan }} ({{ $item->jurusan }})</b>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Alamat
                    </div>
                    <div class="col-lg-6">
                        : <p class="d-inline">
                            <b>{{ $item->alamat }}</b>
                        </p>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <div class="col-5 mb-1 pl-5 mb-sm-0">
                        Username
                    </div>
                    <div class="col-lg-6">
                        : <b>{{ $item->user->username }}</b>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('#show-error-<?php print $item->id; ?>').length) {
            $('#show-modal-<?php print $item->id; ?>').modal('show');
        }
        return false;
    });
</script>
