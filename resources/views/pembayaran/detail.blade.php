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
    <div class="col-12">
        <a href="{{ url()->previous() }}" class="btn btn-link"
            style="text-decoration: none; padding-left:0; padding-top:0;">
            <i class="fas fa-fw fa-arrow-alt-circle-left fa-2x"></i>
        </a>
        <h1 class="h3 mb-lg-0 text-gray-800 d-inline">
            Kelas {{ $data->kelas->tingkat->nama }} {{ $data->kelas->jurusan->kode }} {{ $data->kelas->sub->nama }}
            Tahun Akademik {{ $data->tahun->nama }}
        </h1>
    </div>
@endsection

@section('contain')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" style="font-size:14px">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @if (!is_null($data))
                            @foreach ($data->siswa as $item)
                                @php
                                    $item = $item->siswa;
                                @endphp
                                <tr>
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <td>
                                        <img class="rounded-circle img-fluid" src="{{ asset('storage/' . $item->foto) }}"
                                            alt="{{ $item->nama }}" style="width: 30px">
                                    </td>
                                    <td>
                                        {{ $item->nisn }}
                                    </td>
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-link " data-toggle="modal"
                                            data-target="#show-modal-{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    @include('siswa.show')
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#riwayat').addClass('active');
        });
    </script>
@endsection
