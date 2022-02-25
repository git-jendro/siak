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
    <h1 class="h3 mb-lg-0 text-gray-800">Tahun Akademik</h1>
    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#create-modal">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah Data
    </button>
    @include('tahun-akademik.create')
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
            <h6 class="m-0 font-weight-bold text-primary">Data Tahun Akademik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Tahun Akademik</th>
                            <th>Semester</th>
                            <th class="text-center" colspan="2">Aksi</th>
                            <th style="display:none;">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama Tahun Akademik</th>
                            <th>Semester</th>
                            <th class="text-center" colspan="2">Aksi</th>
                            <th style="display:none;">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    {{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('tahun-akademik.active', $item->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <button class="btn btn-warning" type="submit" {{ $item->status == 1 ? 'disabled' : '' }}>
                                            {{ $item->status == 0 ? 'Aktifkan' : 'Aktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-link " data-toggle="modal"
                                        data-target="#edit-modal-{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                @include('tahun-akademik.edit')
                                <td style="display:none;"></td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#data-master').addClass('active');
            $('#tahun-akademik').addClass('active');
            if (window.screen.availWidth > 700) {
                $("#master-dropdown").click();
            }
        });
    </script>
@endsection
