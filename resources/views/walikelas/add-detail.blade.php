<div class="modal fade" id="add-detail-modal-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Walikelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onclick="cancel('{{ $item->id }}')">×</span>
                </button>
            </div>
            <div class="modal-body">
                Jadikan <b id="nama-guru-{{ $item->id }}"></b> sebagai walikelas <b>{{ $item->kelas->tingkat->nama }} {{ $item->kelas->jurusan->kode }} {{ $item->kelas->sub->nama }}</b> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel('{{ $item->id }}')">
                    Tidak
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add('{{ $item->id }}')">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>
