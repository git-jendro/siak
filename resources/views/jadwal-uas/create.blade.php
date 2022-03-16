<!-- Logout Modal-->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 14px">
                    *Jika membuat Jadwal baru, maka Jadwal yang lama akan terhapus !
                </p>
                    <p style="font-size: 1.3rem">
                        Yakin ingin membuat Jadwal UAS Baru ?
                    </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <form action="{{ route('jadwal-uas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
