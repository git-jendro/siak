<!-- Logout Modal-->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Tahun Akademik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('tahun-akademik.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                value="{{ 'TAK' . sprintf('%02u', $data->count() + 1) }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama') }}" placeholder="Nama Tahun Akademik">
                        @error('nama')
                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                            <option value="">Pilih Semester</option>
                            @foreach ($semester as $sem)
                                <option value="{{ $sem['id'] }}">{{ $sem['nama'] }}</option>
                            @endforeach
                        </select>
                        @error('semester')
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
