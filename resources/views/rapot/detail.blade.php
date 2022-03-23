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
            <div class="d-flex justify-content-between">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <a href="{{ $data != null ? route('rapot.download', [$data->slug]) : route('rapot') }}"
                            class="btn btn-sm btn-primary shadow-sm mx-2" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" style="font-size:14px">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pelajaran</th>
                            <th>KKM</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Pelajaran</th>
                            <th>KKM</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        <meta name="_token" content="{{ csrf_token() }}">
                        @if (!is_null($data))
                            @foreach ($category as $cat)
                            <tr>
                                <td colspan="6">
                                    <b style="color:#5b5b5b; font-size:16px">{{ $cat->nama }}</b>
                                </td>

                            </tr>
                                @foreach ($data->nilai as $item)
                                    @if ($item->pelajaran->kategori->id == $cat->id)
                                    <tr>
                                        <td>
                                            {{ $i++ }}
                                        </td>
                                        <td>
                                            {{ $item->pelajaran->nama }}
                                        </td>
                                        <td>
                                            {{ $item->pelajaran->kkm }}
                                        </td>
                                        <td>
                                            <span id="total-{{ $item->id }}">{{ $item->nilai }}</span>
                                        </td>
                                        <td>
                                            <span id="grade-{{ $item->id }}">{{ $item->grade }}</span>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#rapot').addClass('active');
        });
    </script>
@endsection
