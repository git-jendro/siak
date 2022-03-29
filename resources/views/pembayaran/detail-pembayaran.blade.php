@extends('layouts.dashboard')

@section('header')
    <div class="">
        <a href="{{ url()->previous() }}" class="btn btn-link"
            style="text-decoration: none; padding-left:0; padding-top:0;">
            <i class="fas fa-fw fa-arrow-alt-circle-left fa-2x"></i>
        </a>
        <h1 class="h3 mb-lg-0 text-gray-800 d-inline">
            Detail Pembayaran
        </h1>
        <button type="button" class="btn btn-sm btn-primary shadow-sm mt-3 d-block" data-toggle="modal" data-target="#create-modal">
            <i class="fas fa-money-check-alt fa-sm text-white-50"></i> Buat Detail
        </button>
        @include('pembayaran.create')
    </div>
@endsection

@section('contain')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" style="font-size:14px">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @if (!is_null($data))
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    <td>
                                        {{ $item->kode }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-sm btn-link " data-toggle="modal"
                                                data-target="#show-modal-{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-link " data-toggle="modal"
                                                data-target="#edit-modal-{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
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
        $(document).ready(function() {
            $('#pembayaran').addClass('active');
        });
    </script>
@endsection
