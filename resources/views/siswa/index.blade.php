@extends('layouts.dashboard')

@section('plugins')
    <!-- Custom styles for this page -->
    <link href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('sb-admin/vendor/datepicker-in-bootstrap-modal/css/datepicker.css') }}">

    <!-- Datepicker JS-->
    <script src="{{ asset('sb-admin/vendor/datepicker-in-bootstrap-modal/js/datepicker.js') }}"></script>

    <!-- Select2 -->
    <link href="{{ asset('sb-admin/vendor/select2/css/select2.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection

@section('header')
    <h1 class="h3 mb-lg-0 text-gray-800">Peserta Didik</h1>
    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#create-modal">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah Data
    </button>
    @include('siswa.create')
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
            <h6 class="m-0 font-weight-bold text-primary">Data Peserta Didik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Foto</th>
                            <th>Nama Peserta Didik</th>
                            <th>Kelas</th>
                            <th>Status Bersekolah</th>
                            <th class="text-center" colspan="2">Aksi</th>
                            <th style="display:none;">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NISN</th>
                            <th>Foto</th>
                            <th>Nama Peserta Didik</th>
                            <th>Kelas</th>
                            <th>Status Bersekolah</th>
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
                                    {{ $item->nisn }}
                                </td>
                                <td class="text-center">
                                    <img class="rounded-circle img-fluid" src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->nama }}" style="width: 30px">
                                </td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    {{ $item->kelas->tingkat->nama }} {{ $item->kelas->jurusan->kode }}
                                    {{ $item->kelas->sub->nama }}
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        Aktif
                                    @elseif ($item->status == 2)
                                        Lulus
                                    @else
                                        Keluar/Pindah
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-link " data-toggle="modal"
                                        data-target="#show-modal-{{ $item->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                @include('siswa.show')
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-link " data-toggle="modal"
                                        data-target="#edit-modal-{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                @include('siswa.edit')
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
            $('#peserta-didik').addClass('active');
        });
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                zIndex: 2048,
            });
        });
    </script>
@endsection
