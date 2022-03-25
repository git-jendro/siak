@extends('layouts.dashboard')

@section('plugins')
    <!-- Custom styles for this page -->
    <link href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>

    <!-- Select2 -->
    <link href="{{ asset('sb-admin/vendor/select2/css/select2.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection

@section('header')
    <h1 class="h3 mb-lg-0 text-gray-800 d-inline">
        Kelola Walikelas
    </h1>
@endsection

@section('contain')
    @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('update'))
        <div class="alert alert-primary" role="alert">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelajaran</th>
                            <th>Tahun Akademik</th>
                            <th class="text-center">Walikelas</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelajaran</th>
                            <th>Tahun Akademik</th>
                            <th class="text-center">Walikelas</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <meta name="_token" content="{{ csrf_token() }}">
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->kelas_id }}
                                </td>
                                <td>
                                    {{ $item->kelas->tingkat->nama }} {{ $item->kelas->jurusan->kode }} {{ $item->kelas->sub->nama }}
                                </td>
                                <td>
                                    {{ $tahun->nama }}
                                </td>
                                <td class="text-center">
                                    <select class="form-control @error('guru_id-' . $item->id) is-invalid @enderror"
                                        name="guru_id-{{ $item->id }}" style="width:100%;"
                                        id="create-guru-{{ $item->id }}" onchange="kelas('{{ $item->id }}')">
                                        <option value=""></option>
                                        @foreach ($guru as $gr)
                                            <option value="{{ $gr->id }}" {{ $gr->id == $item->guru_id ? 'selected' : '' }}>
                                                {{ $gr->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <script>
                                        $(document).ready(function() {
                                            $('#create-guru-<?php print $item->id; ?>').select2({
                                                placeholder: "Pilih Walikelas",
                                            });
                                        });
                                    </script>
                                </td>
                                @include('walikelas.add-detail')
                                {{-- @include('walikelas.remove-detail') --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function kelas(id) {
            var guru_id = $('select[name=guru_id-' + id + ']').val();
            $.ajax({
                type: "get",
                url: "/api/dashboard/walikelas/" + guru_id,
                dataType: "json",
                success: function(res) {
                    $('#nama-guru-' + id).html(res.nama);
                    $('#add-detail-modal-' + id).modal('show');
                    return false;
                }
            });
        }

        function add(id) {
            var _token = $('meta[name="_token"]').attr('content');
            var guru_id = $('select[name=guru_id-' + id + ']').val();
            $.ajax({
                type: "post",
                url: "/api/dashboard/walikelas/store",
                data: {
                    _token: _token,
                    id: id,
                    guru_id: guru_id,
                },
                dataType: "json",
                success: function(res) {
                    if (res == 200) {
                        $.confirm({
                            columnClass: 'col-md-6 col-md-offset-3',
                            title: 'Success',
                            content: 'Data jadwal berhasil disimpan !',
                            type: 'green',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'OK',
                                    btnClass: 'btn-green',
                                    action: function () { }
                                },
                            }
                        });
                    } else {
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            title: 'Error',
                            content: 'Guru sudah menjadi walikelas lain !',
                            type: 'red',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'OK',
                                    btnClass: 'btn-red',
                                    action: function () { }
                                },
                            }
                        });
                        $("#create-guru-" + id).val('').trigger('change');
                    }
                    return false;
                }
            });
        }

        function cancel(kelas_id) {
            $("#create-guru-" + kelas_id).val('').trigger('change');
            return false;
        }
    </script>
@endsection
