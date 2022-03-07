@extends('layouts.dashboard')

@section('plugins')
    <!-- Custom styles for this page -->
    <link href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>
@endsection

@section('header')
    <div class="col-12">
        <a href="{{ url()->previous() }}" class="btn btn-link"
            style="text-decoration: none; padding-left:0; padding-top:0;">
            <i class="fas fa-fw fa-arrow-alt-circle-left fa-2x"></i>
        </a>
        <h1 class="h3 mb-lg-0 text-gray-800 d-inline">
            Kelola Pelajaran Kurikulum
        </h1>
    </div>
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
    <div class="col-lg-4 my-md-2">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kurikulum</h6>
            </div>
            <div class="card-body">
                <h4 class="h4 mb-lg-0 text-gray-800">{{ $data->nama }}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-8 my-md-2">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kurikulum</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kurikulum</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kurikulum</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <meta name="_token" content="{{ csrf_token() }}">
                            @foreach ($pelajaran as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" onclick="pelajaran('{{ $item->id }}')"
                                                id="subject-{{ $item->id }}" type="checkbox"
                                                value="{{ $item->id }}"
                                                @foreach ($detail as $det) {{ $item->id == $det->pelajaran_id ? 'checked' : '' }} @endforeach>
                                        </div>
                                    </td>
                                    @include('kurikulum.add-detail')
                                    @include('kurikulum.remove-detail')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#data-master').addClass('active');
            $('#kurikulum').addClass('active');
            if (window.screen.availWidth > 700) {
                $("#master-dropdown").click();
            }
        });

        var _token = $('meta[name="_token"]').attr('content');

        function pelajaran(pelajaran_id) {
            if ($('#subject-' + pelajaran_id).is(':checked')) {
                $('#add-detail-modal-' + pelajaran_id).modal('show');

                $('#add-' + pelajaran_id).click(function(e) {
                    $.ajax({
                        type: "post",
                        url: "/api/dashboard/kurikulum/add_pelajaran",
                        data: {
                            _token: _token,
                            kurikulum_id: '<?php print $data->id; ?>',
                            pelajaran_id: pelajaran_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#add-detail-modal-' + pelajaran_id).modal('hide');
                            if (response == 'success') {
                                alert('Berhasil menambahkan pelajaran !');
                            }
                            if (response == 'fail') {
                                alert('Proses gagal !');
                                $('#subject-' + pelajaran_id).prop("checked", false);
                            }
                        }
                    });
                });
            } else if (!$('#subject-' + pelajaran_id).is(':checked')) {
                $('#remove-detail-modal-' + pelajaran_id).modal('show');
                $('#remove-' + pelajaran_id).click(function(e) {
                    $.ajax({
                        type: "post",
                        url: "/api/dashboard/kurikulum/remove_pelajaran",
                        data: {
                            _token: _token,
                            kurikulum_id: '<?php print $data->id; ?>',
                            pelajaran_id: pelajaran_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#remove-detail-modal-' + pelajaran_id).modal('hide');
                            if (response == 'success') {
                                alert('Berhasil menghapus pelajaran !');
                            }
                            if (response == 'fail') {
                                alert('Proses gagal !');
                                $('#subject-' + pelajaran_id).prop("checked", false);
                            }
                        }
                    });
                });
            }
        }

        function cancel_add(id) {
            $('#subject-' + id).prop("checked", false);
        }

        function cancel_remove(id) {
            $('#subject-' + id).prop("checked", true);
        }
    </script>
@endsection
