<!-- Logout Modal-->
<div class="modal fade" id="edit-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('kelas.update', [$item->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" value="{{ $item->id }}"
                                readonly>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('tingkat_kelas_id-'. $item->id) is-invalid @enderror"
                            name="tingkat_kelas_id-{{ $item->id }}">
                            <option value="">Pilih Tingkat Kelas</option>
                            @foreach ($tingkat as $ting)
                                <option value="{{ $ting->id }}" {{ $ting->id == $item->tingkat_kelas_id ? 'selected' : '' }}>{{ $ting->nama }}</option>
                            @endforeach
                        </select>
                        @error('tingkat_kelas_id-'. $item->id)
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select class="form-control @error('jurusan_id-'. $item->id) is-invalid @enderror"
                            name="jurusan_id-{{ $item->id }}">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusan as $jur)
                                <option value="{{ $jur->id }}" {{ $jur->id == $item->jurusan_id ? 'selected' : '' }}>{{ $jur->kode }} ({{ $jur->nama }})</option>
                            @endforeach
                        </select>
                        @error('jurusan_id-'. $item->id)
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('sub_kelas_id-'. $item->id) is-invalid @enderror"
                            name="sub_kelas_id-{{ $item->id }}">
                            <option value="">Pilih Sub Kelas</option>
                            @foreach ($sub as $subk)
                                <option value="{{ $subk->id }}" {{ $subk->id == $item->sub_kelas_id ? 'selected' : '' }}>{{ $subk->nama }}</option>
                            @endforeach
                        </select>
                        @error('sub_kelas_id-'. $item->id)
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
    $(document).ready(function() {
        if ($('#edit-error-<?php print $item->id; ?>').length) {
            $('#edit-modal-<?php print $item->id; ?>').modal('show');
        }
        return false;
    });
</script>
