<!-- Logout Modal-->
<div class="modal fade" id="create-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Peserta Didik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('siswa.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama') }}" placeholder="Nama">
                        @error('nama')
                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                                value="{{ old('nisn') }}" placeholder="NISN">
                            @error('nisn')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="">Pilih Status Bersekolah</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Lulus</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Keluar/Pindah</option>
                            </select>
                            @error('status')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select class="form-control @error('agama_id') is-invalid @enderror" name="agama_id">
                                <option value="">Pilih Agama</option>
                                @foreach ($agama as $agm)
                                    <option value="{{ $agm->id }}"
                                        {{ old('agama_id') == $agm->id ? 'selected' : '' }}>{{ $agm->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agama_id')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki - laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('kelas_id') is-invalid @enderror"
                                name="kelas_id" style="width:100%;" id="create-kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}"{{ old('kelas_id') == $kls->id ? 'selected' : '' }}>{{ $kls->tingkat->nama }}&nbsp;{{ $kls->jurusan->kode }}&nbsp;{{ $kls->sub->nama }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir">
                            @error('tempat_lahir')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group" id="date">
                                <input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    data-toggle="datepicker" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                    placeholder="Tanggal Lahir">
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>
                            @error('tanggal_lahir')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
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
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                    name="no_telp" value="{{ old('no_telp') }}" placeholder="Nomor Telepon">
                            </div>
                        </div>
                        @error('no_telp')
                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="5"
                            placeholder="Alamat">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" placeholder="Username">
                            @error('username')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" placeholder="Password">
                            @error('password')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 px-0 prev-create mb-2">
                            {{ old('foto') }}
                            <label for="create-image">Example file input</label>
                        </div>
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                            id="create-image" name="foto">
                        @error('foto')
                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
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
    function ignoreDotAndWhitespace(params, data) {
        params.term = params.term || '';

        term = params.term.toUpperCase().replace(/ /g, String.fromCharCode(160));
        text = data.text.toUpperCase();

        if (text.indexOf(term) > -1) {
            return data;
        }
        return false;
    }
    $(document).ready(function() {
        $('#create-kelas').select2({
            matcher: function(params, data) {
                return ignoreDotAndWhitespace(params, data);
            },
            dropdownParent: $("#create-modal"),
            placeholder: "Cari.."
        });
    });
</script>
