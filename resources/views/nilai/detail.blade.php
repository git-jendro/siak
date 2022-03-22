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
    <script src="{{ asset('sb-admin/js/nilai.js') }}"></script>
@endsection

@section('header')
    <div>
        <h1 class="h3 mb-lg-0 text-gray-800">
            Data Nilai {{ $data->nama }}
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:14px">
                    <thead>
                        <tr>
                            <th>Pelajaran</th>
                            <th>Nilai Tugas 1</th>
                            <th>Nilai Tugas 2</th>
                            <th>Nilai Tugas 3</th>
                            <th>Nilai Tugas 4</th>
                            <th>Nilai Tugas 5</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Total Nilai</th>
                            <th>Grade</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Pelajaran</th>
                            <th>Nilai Tugas 1</th>
                            <th>Nilai Tugas 2</th>
                            <th>Nilai Tugas 3</th>
                            <th>Nilai Tugas 4</th>
                            <th>Nilai Tugas 5</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Total Nilai</th>
                            <th>Grade</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <meta name="_token" content="{{ csrf_token() }}">
                        @if (!is_null($data))
                            @foreach ($data->nilai as $item)
                                <tr>
                                    <td>
                                        {{ $item->pelajaran->nama }}
                                    </td>
                                    <td>
                                        @include('nilai.store-nilai')
                                        <input type="text" class="form-control tugas1" id="{{ $item->id }}"
                                            value="{{ $item->tugas_1 }}" maxlength="2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tugas2" id="{{ $item->id }}"
                                            value="{{ $item->tugas_2 }}" maxlength="2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tugas3" id="{{ $item->id }}"
                                            value="{{ $item->tugas_3 }}" maxlength="2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tugas4" id="{{ $item->id }}"
                                            value="{{ $item->tugas_4 }}" maxlength="2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control tugas5" id="{{ $item->id }}"
                                            value="{{ $item->tugas_5 }}" maxlength="2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control uts" id="{{ $item->id }}"
                                            value="{{ $item->uts }}" maxlength="2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control uas" id="{{ $item->id }}"
                                            value="{{ $item->uas }}" maxlength="2">
                                    </td>
                                    <td>
                                        <span id="total-{{ $item->id }}">{{ $item->nilai }}</span>
                                    </td>
                                    <td>
                                        <span id="grade-{{ $item->id }}">{{ $item->grade }}</span>
                                    </td>
                                    <td>
                                        <span id="status-{{ $item->id }}">{{ $item->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
