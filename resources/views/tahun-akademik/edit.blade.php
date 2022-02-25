<div class="modal fade" id="edit-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Tahun Akademik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('tahun-akademik.update', [$item->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                value="{{ $item->id }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('status-'. $item->id) is-invalid @enderror" name="status-{{ $item->id }}">
                                <option value="">Pilih Status</option>
                                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Aktif</option>
                            </select>
                            @error('status-'. $item->id)
                                <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('nama-'. $item->id) is-invalid @enderror" name="nama-{{ $item->id }}"
                            value="{{ $item->nama }}" placeholder="Nama Tahun Akademik">
                        @error('nama-'. $item->id)
                            <div id="edit-error-{{ $item->id }}" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('semester-'. $item->id) is-invalid @enderror" name="semester-{{ $item->id }}">
                            <option value="">Pilih Semester</option>
                            @foreach ($semester as $sem)
                                <option value="{{ $sem['id'] }}" {{ $item->semester == $sem['id'] ? 'selected' : '' }}>{{ $sem['nama'] }}</option>
                            @endforeach
                        </select>
                        @error('semester-'. $item->id)
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
    $(document).ready(function() {
        if ($('#edit-error-<?php print $item->id; ?>').length) {
            $('#edit-modal-<?php print $item->id; ?>').modal('show');
        }
        return false;
    });
</script>
