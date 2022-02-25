<!-- Logout Modal-->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('kelas.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control"
                                value="{{ 'KLS' . sprintf('%03u', $data->count() + 1) }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('tingkat_kelas_id') is-invalid @enderror"
                                name="tingkat_kelas_id">
                                <option value="">Pilih Tingkat Kelas</option>
                                @foreach ($tingkat as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('tingkat_kelas_id')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <select class="form-control @error('jurusan_id') is-invalid @enderror"
                                name="jurusan_id">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control @error('sub_kelas_id') is-invalid @enderror"
                                name="sub_kelas_id">
                                <option value="">Pilih Sub Kelas</option>
                                @foreach ($sub as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('sub_kelas_id')
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
