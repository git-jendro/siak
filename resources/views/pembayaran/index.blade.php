@extends('layouts.dashboard')

@section('header')
    <div class="div">
        <h1 class="h3 mb-lg-0 text-gray-800">
            Data Pembayaran
        </h1>
        <a href="{{ route('pembayaran.detail') }}" class="btn btn-sm btn-primary shadow-sm mt-3">
            <i class="fas fa-eye fa-sm text-white-50"></i> Lihat Detail Pembayaran
        </a>
        <button type="button" class="btn btn-sm btn-primary shadow-sm mt-3 d-inline" data-toggle="modal"
            data-target="#create-modal">
            <i class="fas fa-cash-register fa-sm text-white-50"></i> Generate Pembayaran
        </button>
        
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
                            @foreach ($data as $item)
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
            $('#pembayaran').addClass('active');
        });
    </script>
@endsection
