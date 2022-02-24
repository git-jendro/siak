<!-- Logout Modal-->
<div class="modal fade" id="remove-detail-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Hapus Pelajaran Kurikulum</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onclick="cancel_remove('{{ $item->id }}')">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" name="kurikulum_id" value="{{ $data->id }}">
                    <input type="hidden" name="pelajaran_id" value="{{ $item->id }}">
                    Hapus pelajaran {{ $item->nama }} dari {{ $data->nama }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel_remove('{{ $item->id }}')">
                    Tidak
                </button>
                <button type="button" class="btn btn-primary" id="remove-{{ $item->id }}">
                    Ya
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
