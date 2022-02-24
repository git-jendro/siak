<div class="modal fade" id="add-detail-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Pelajaran Kurikulum</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onclick="cancel_add('{{ $item->id }}')">×</span>
                </button>
            </div>
            <div class="modal-body">
                Tambahkan pelajaran <b>{{ $item->nama }}</b> ke dalam <b>{{ $data->nama }}</b> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel_add('{{ $item->id }}')">
                    Tidak
                </button>
                <button type="button" class="btn btn-primary" id="add-{{ $item->id }}">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>
