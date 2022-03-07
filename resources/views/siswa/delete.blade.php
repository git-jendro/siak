<div class="modal fade" id="delete-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Hapus Staff</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingi mengahapus data {{ $item->nama }} ?
            </div>
            <div class="modal-footer">
                <form class="user" action="{{ route('staff.destroy', [$item->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-secondary" type="button" data-dismiss="modal">
                        Tidak
                    </button>
                    <button type="submit" class="btn btn-danger" style="width: 66px">
                        Ya
                    </button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('#delete-error-<?php print $item->id; ?>').length) {
            $('#delete-modal-<?php print $item->id; ?>').modal('show');
        }
        return false;
    });
</script>
