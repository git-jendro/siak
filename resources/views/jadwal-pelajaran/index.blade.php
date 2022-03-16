@extends('layouts.dashboard')

@section('plugins')
    <!-- Select2 -->
    <link href="{{ asset('sb-admin/vendor/select2/css/select2.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Event Jadwal -->
    <script src="{{ asset('sb-admin/js/jadwal.js') }}"></script>
    <script src="{{ asset('sb-admin/js/filter.js') }}"></script>
@endsection

@section('header')
    <div class="div">
        <h1 class="h3 mb-lg-0 text-gray-800">Jadwal Pelajaran</h1>
        <button type="button" class="btn btn-sm btn-primary shadow-sm mt-3" data-toggle="modal" data-target="#create-modal">
            <i class="fas fa-calendar-plus fa-sm text-white-50"></i> Buat Jadwal Baru
        </button>
        @include('jadwal-pelajaran.create')
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Pelajaran</h6>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        @if ($data)
                            <a href="{{ route('jadwal-pelajaran.download', [$data->slug]) }}"
                                class="btn btn-sm btn-primary shadow-sm mx-2" target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-download"></i> Download PDF
                            </a>
                        @else
                            <a href="{{ route('jadwal-uts') }}" class="btn btn-sm btn-primary shadow-sm mx-2"
                                target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-download"></i> Download PDF
                        @endif
                    </div>
                </div>
            </div>
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
                <table class="table table-bordered" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th colspan="5">
                                <h5 class="font-weight-bold text-center my-auto">
                                    Jadwal Pelajaran
                                    <span id="header-jadwal">{{ $data->kelas->tingkat->nama ?? 'Kelas' }}
                                        {{ $data->kelas->jurusan->kode ?? '' }}
                                        {{ $data->kelas->sub->nama ?? '' }}</span> <br>
                                    {{ $data == null ? '' : 'Tahun Akademik ' }}{{ $data->tahun->nama ?? '' }}
                                </h5>
                            </th>
                        </tr>
                        <tr>
                            <th>Nama Pelajaran</th>
                            <th>Ruangan</th>
                            <th>Guru Pengajar</th>
                            <th>Hari</th>
                            <th class="text-center">Jam</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Pelajaran</th>
                            <th>Ruangan</th>
                            <th>Guru Pengajar</th>
                            <th>Hari</th>
                            <th class="text-center">Jam</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbody_jadwal">
                        <meta name="_token" content="{{ csrf_token() }}">
                        @if (!is_null($data))
                            @php
                                $start_time = $jam;
                                $end_time = $jam;
                                array_pop($start_time);
                                array_shift($end_time);
                            @endphp
                            @foreach ($data->detail as $item)
                                <tr>
                                    <td>
                                        {{ $item->pelajaran->nama }}
                                    </td>
                                    <td>
                                        <select class="form-control ruangan" id="ruangan-{{ $item->id }}">
                                            <option value="">Pilih Ruangan</option>
                                            @foreach ($ruangan as $rgn)
                                                <option value="{{ $rgn->id }}"
                                                    {{ $rgn->id == $item->ruangan_id ? 'selected' : '' }}>
                                                    {{ $rgn->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control guru" style="width:100%;"
                                            id="guru-{{ $item->id }}">
                                            <option value=""></option>
                                            @foreach ($guru as $gr)
                                                <option value="{{ $gr->id }}"
                                                    {{ $gr->id == $item->guru_id ? 'selected' : '' }}>
                                                    {{ $gr->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control hari" id="hari-{{ $item->id }}">
                                            <option value="">Pilih Hari</option>
                                            @foreach ($hari as $hr)
                                                <option value="{{ $hr['id'] }}"
                                                    {{ $hr['id'] == $item->hari ? 'selected' : '' }}>{{ $hr['hari'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-6">
                                                <select class="form-control start" id="start-{{ $item->id }}">
                                                    <option value="">Mulai</option>
                                                    @foreach ($start_time as $s)
                                                        <option value="{{ $s['id'] }}"
                                                            {{ $s['id'] == $item->mulai ? 'selected' : '' }}>
                                                            {{ $s['jam'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            -

                                            <div class="col-6">
                                                <select class="form-control end" id="end-{{ $item->id }}">
                                                    <option value="">Selesai</option>
                                                    @foreach ($end_time as $j)
                                                        <option value="{{ $j['id'] }}"
                                                            {{ $j['id'] == $item->selesai ? 'selected' : '' }}>
                                                            {{ $j['jam'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <script>
                                    $(document).ready(function() {
                                        $('#guru-<?php print $item->id; ?>').select2({
                                            placeholder: "Pilih Guru Pengajar",
                                        });
                                    });
                                </script>
                            @endforeach
                        @else
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
