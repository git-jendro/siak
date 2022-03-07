<div class="modal fade" id="edit-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Peserta Didik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('siswa.update', [$item->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control @error('nama-' . $item->id) is-invalid @enderror" name="nama-{{ $item->id }}"
                            value="{{ $item->nama }}" placeholder="Nama">
                        @error('nama-' . $item->id)
                            <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control @error('nisn-' . $item->id) is-invalid @enderror" name="nisn-{{ $item->id }}"
                                value="{{ $item->nisn }}" placeholder="NISN">
                            @error('nisn-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('status-' . $item->id) is-invalid @enderror" name="status-{{ $item->id }}">
                                <option value="">Pilih Status Bersekolah</option>
                                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Lulus</option>
                                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Keluar/Pindah</option>
                            </select>
                            @error('status-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select class="form-control @error('agama_id-' . $item->id) is-invalid @enderror" name="agama_id-{{ $item->id }}">
                                <option value="">Pilih Agama</option>
                                @foreach ($agama as $agm)
                                    <option value="{{ $agm->id }}"
                                        {{ $item->agama_id == $agm->id ? 'selected' : '' }}>{{ $agm->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agama_id-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('jenis_kelamin-' . $item->id) is-invalid @enderror"
                                name="jenis_kelamin-{{ $item->id }}">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ $item->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - laki
                                </option>
                                <option value="P" {{ $item->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('kelas_id-' . $item->id) is-invalid @enderror"
                                name="kelas_id-{{ $item->id }}" style="width:100%;" id="create-kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}"{{ $item->kelas_id == $kls->id ? 'selected' : '' }}>{{ $kls->tingkat->nama }}&nbsp;{{ $kls->jurusan->kode }}&nbsp;{{ $kls->sub->nama }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control @error('tempat_lahir-' . $item->id) is-invalid @enderror"
                                name="tempat_lahir-{{ $item->id }}" value="{{ $item->tempat_lahir }}" placeholder="Tempat Lahir">
                            @error('tempat_lahir-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group" id="date">
                                <input type="text" class="form-control @error('tanggal_lahir-' . $item->id) is-invalid @enderror"
                                    data-toggle="datepicker" name="tanggal_lahir-{{ $item->id }}" value="{{ $item->tanggal_lahir }}"
                                    placeholder="Tanggal Lahir">
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>
                            @error('tanggal_lahir-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                </div>
                                <input type="text" class="form-control @error('no_telp-' . $item->id) is-invalid @enderror"
                                    name="no_telp-{{ $item->id }}" value="{{ $item->no_telp }}" placeholder="Nomor Telepon">
                            </div>
                        </div>
                        @error('no_telp-' . $item->id)
                            <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control @error('alamat-' . $item->id) is-invalid @enderror" name="alamat-{{ $item->id }}" rows="5"
                            placeholder="Alamat">{{ $item->alamat }}</textarea>
                        @error('alamat-' . $item->id)
                            <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control @error('username-' . $item->id) is-invalid @enderror"
                                name="username-{{ $item->id }}" value="{{ $item->username }}" placeholder="Username">
                                <sub>*Masukan username jika anda ingin merubah username</sub>
                            @error('username-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('password-' . $item->id) is-invalid @enderror"
                                name="password-{{ $item->id }}" value="{{ $item->password }}" placeholder="Password">
                                <sub>*Masukan password jika anda ingin merubah password</sub>
                            @error('password-' . $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 px-0 prev-edit-{{ $item->id }} mb-2">
                            <img class="img-fluid" src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->name }}">
                        </div>
                        <input type="file" class="form-control-file @error('foto-' . $item->id) is-invalid @enderror"
                        id="edit-image-{{ $item->id }}" name="foto-{{ $item->id }}">
                        @error('foto-' . $item->id)
                            <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    $('.prev-edit-<?php print $item->id; ?>').html('');
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr({
                            src: event.target.result,
                            class: "mr-1 img-fluid",
                        }).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#edit-image-<?php print $item->id; ?>').on('change', function() {
            imagesPreview(this, 'div.prev-edit-<?php print $item->id; ?>');
        });
    });
    $(document).ready(function() {
        if ($('#edit-error-<?php print $item->id; ?>').length) {
            $('#edit-modal-<?php print $item->id; ?>').modal('show');
        }
        return false;
    });
</script>
