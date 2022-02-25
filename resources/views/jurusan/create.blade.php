<!-- Logout Modal-->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Jurusan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('jurusan.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control"
                            value="{{ 'JRS'.sprintf('%02u', $data->count()+1) }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <input type="text"
                                class="form-control @error('kode') is-invalid @enderror" name="kode"
                                placeholder="Kode Jurusan"  value="{{ old('kode') }}">
                            @error('kode')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Nama Jurusan"  value="{{ old('nama') }}">
                            @error('nama')
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
