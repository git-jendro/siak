<!-- Logout Modal-->
<div class="modal fade" id="edit-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Tingkat Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('tingkat-kelas.update', [$item->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="{{ $item->id }}"
                                readonly>
                        </div>
                        <div class="col-sm-6">
                            <input type="text"
                            class="form-control @error('nama-' . $item->id) is-invalid @enderror"
                            name="nama-{{ $item->id }}" placeholder="Nama Tingkatan" value="{{ $item->nama }}">
                        @error('nama-' . $item->id)
                            <div id="edit-error-{{ $item->id }}" class="pl-3 mt-2 error invalid-feedback d-block w-100 text-left">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('kurikulum_id-' . $item->id) is-invalid @enderror"
                                name="kurikulum_id-{{ $item->id }}">
                                <option value="">Pilih Kurikulum</option>
                                @foreach ($kurikulum as $kur)
                                    <option value="{{ $kur->id }}" {{ $item->kurikulum_id == $kur->id ? 'selected' : '' }}>{{ $kur->nama }}</option>
                                @endforeach
                            </select>
                            @error('kurikulum_id-' . $item->id)
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
