<!-- Logout Modal-->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pembayaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('pembayaran.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <select class="form-control @error('jurusan_id') is-invalid @enderror" name="jurusan_id">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>{{ $item->kode }}
                                    ({{ $item->nama }})
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group" id="detail">
                        <div class="row row-detail">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label for="">Keterangan</label>
                                        <textarea type="text" name="keterangan" placeholder="Keterangan"
                                            class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                                        @error('ketarangan')
                                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Jumlah Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="">Rp.</span>
                                            </div>
                                            <input type="text" name="nominal" placeholder="Nominal"
                                                class="form-control @error('nominal') is-invalid @enderror">
                                        </div>
                                        @error('nominal')
                                            <div id="create-error" class="mt-2 error invalid-feedback d-block w-100">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <i class="fas fa-lg fa-plus-circle" style="color: #2e59d9;" id="plus"></i>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary submit">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#plus').click(function(e) {
        var rowCount = $('#detail .row-detail').length;
        if (rowCount <= 5) {
            $('#detail').append('<div class="row  row-detail" id="' + rowCount +
                '"><div class="col-11"><div class="row"><div class="col-sm-6 mb-3"><label for="">Keterangan</label><textarea type="text" name="keterangan" placeholder="Keterangan" class="form-control "></textarea></div><div class="col-sm-6"><label for="">Jumlah Pembayaran</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"id="">Rp.</span></div><input type="text" name="nominal" placeholder="Nominal"class="form-control"></div></div></div></div><div class="col-1 pl-0"><i class="fas fa-lg fa-times-circle remove" style="color: red"></i></div></div>'
            );
        } else {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Tidak bisa menambahkan keterangan dan nominal lagi !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function() {}
                    },
                }
            });
        }
        $('.remove').click(function(e) {
            var id = $(this).parent().parent().attr('id');
            $('#' + id).remove();
        });
    });
</script>
