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
    <script src="{{ asset('sb-admin/js/filter.js') }}"></script>
@endsection

@section('header')
    <div>
        <h1 class="h3 mb-lg-0 text-gray-800">
            Data Siswa Kelas
            @if (!is_null($data))
                {{ $data->tingkat->nama }} {{ $data->jurusan->kode }} {{ $data->sub->nama }}
            @endif
        </h1>
        @if (Auth::user()->staff)
        <button type="button" class="btn btn-sm btn-primary shadow-sm mt-3" data-toggle="modal" data-target="#create-modal">
            <i class="fas fa-cogs fa-sm text-white-50"></i> Generate Nilai
        </button>
        @include('nilai.create')
        @endif
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <h6 class="font-weight-bold">Filter Kelas</h6>
                </div>
                <div class="col-lg-9">
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <select class="form-control" id="filter_tingkat">
                                <option value="">Pilih Tingkat Kelas</option>
                                @foreach ($tingkat as $tngk)
                                    <option value="{{ $tngk->id }}">{{ $tngk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <select class="form-control" id="filter_jurusan">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $jrs)
                                    <option value="{{ $jrs->id }}">{{ $jrs->kode }} ({{ $jrs->nama }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" id="filter_kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->tingkat->nama }}
                                        {{ $kls->jurusan->kode }} {{ $kls->sub->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th class="text-center">Tahun Akademik</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th class="text-center">Tahun Akademik</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <meta name="_token" content="{{ csrf_token() }}">
                        @if (!is_null($data))
                            @foreach ($data->siswa as $item)
                                <tr>
                                    <td>
                                        {{ $item->nisn }}
                                    </td>
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    <td class="text-center">
                                        {{ $tahun->nama }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('nilai.show', [$item->slug]) }}" class="btn btn-info">
                                            <i class="fas fa-file-signature"></i> Kelola Nilai
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    </script>
@endsection
