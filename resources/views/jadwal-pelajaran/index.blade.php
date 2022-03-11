@extends('layouts.dashboard')

@section('plugins')
    <!-- Select2 -->
    <link href="{{ asset('sb-admin/vendor/select2/css/select2.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection

@section('header')
    <div class="div">
        <h1 class="h3 mb-lg-0 text-gray-800">Tahun Akademik</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Pelajaran</h6>
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
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                                $start = $jam;
                                unset($start[count($start) - 1]);
                                
                                array_shift($jam);
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
                                                    @foreach ($start as $s)
                                                        <option value="{{ $s['id'] }}"
                                                            {{ substr($s['id'], 0, -3) == substr($item->jam, 0, -8) ? 'selected' : '' }}>
                                                            {{ $s['jam'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            -

                                            <div class="col-6">
                                                <select class="form-control end" id="end-{{ $item->id }}">
                                                    <option value="">Selesai</option>
                                                    @foreach ($jam as $j)
                                                        <option value="{{ $j['id'] }}"
                                                            {{ substr($j['id'], 0, -3) == substr($item->jam, 8) ? 'selected' : '' }}>
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
        var _token = $('meta[name="_token"]').attr('content');
        $('#filter_tingkat').change(function(e) {
            var tingkat_id = $(this).val();
            var jurusan_id = $('#filter_jurusan').val();
            if (jurusan_id) {
                $.ajax({
                    type: "get",
                    url: "/api/dashboard/jadwal-pelajaran/kelas/" + tingkat_id + "/" + jurusan_id,
                    dataType: "json",
                    success: function(res) {
                        $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                        $.each(res, function(index, value) {
                            $('#filter_kelas').append('<option value="' + value.id + '">' +
                                value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                                .sub.nama + '</option>');
                        });
                    }
                });
            } else {
                $.ajax({
                    type: "get",
                    url: "/api/dashboard/jadwal-pelajaran/tingkat/" + tingkat_id,
                    dataType: "json",
                    success: function(res) {
                        $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                        $.each(res, function(index, value) {
                            $('#filter_kelas').append('<option value="' + value.id + '">' +
                                value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                                .sub.nama + '</option>');
                        });
                    }
                });
            }
        });
        $('#filter_jurusan').change(function(e) {
            var jurusan_id = $(this).val();
            var tingkat_id = $('#filter_tingkat').val();
            if (tingkat_id) {
                $.ajax({
                    type: "get",
                    url: "/api/dashboard/jadwal-pelajaran/kelas/" + tingkat_id + "/" + jurusan_id,
                    dataType: "json",
                    success: function(res) {
                        $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                        $.each(res, function(index, value) {
                            $('#filter_kelas').append('<option value="' + value.id + '">' +
                                value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                                .sub.nama + '</option>');
                        });
                    }
                });
            } else {
                $.ajax({
                    type: "get",
                    url: "/api/dashboard/jadwal-pelajaran/jurusan/" + jurusan_id,
                    dataType: "json",
                    success: function(res) {
                        $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                        $.each(res, function(index, value) {
                            $('#filter_kelas').append('<option value="' + value.id + '">' +
                                value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                                .sub.nama + '</option>');
                        });
                    }
                });
            }
        });

        $('#filter_kelas').change(function(e) {
            var kelas_id = $(this).val();
            $.ajax({
                type: "get",
                url: "/api/dashboard/jadwal-pelajaran/jadwal/" + kelas_id,
                dataType: "json",
                success: function(res) {
                    $('#tbody_jadwal').html('');
                    $.each(res.data, function(index, valueJadwal) {
                        $('#tbody_jadwal').append('<tr><td>' + valueJadwal.pelajaran.nama +
                            '</td><td><select class="form-control ruangan" id="ruangan-' +
                            valueJadwal.id +
                            '"><option value="">Pilih Ruangan</option></select></td><td><select class="form-control guru"name="guru_id-' +
                            valueJadwal.id + '" style="width:100%;"id="guru-' +
                            valueJadwal.id +
                            '"><option value="">Pilih Guru Pengeajar</option></select></td><td><select class="form-control hari" id="hari-' +
                            valueJadwal.id +
                            '"><option value="">Pilih Hari</option></select></td><td><div class="d-flex justify-content-between"><div class="col-6"><select class="form-control start" id="start-' +
                            valueJadwal.id +
                            '"><option value="">Mulai</option></select></div>-<div class="col-6"><select class="form-control end" id="end-' +
                            valueJadwal.id +
                            '"><option value="">Selesai</option></select></div></div></td></tr>'
                        );
                        $.each(res.ruangan, function(index, valueRuangan) {
                            $('#ruangan-' + valueJadwal.id).append('<option value="' +
                                valueRuangan.id + '">' + valueRuangan.nama +
                                '</option>');
                        });
                        $.each(res.guru, function(index, valueGuru) {
                            $('#guru-' + valueJadwal.id).append(
                                '<option value="' + valueGuru.id + '">' + valueGuru
                                .nama + '</option>');
                        });
                        $.each(res.hari, function(index, valueHari) {
                            $('#hari-' + valueJadwal.id).append(
                                '<option value="' + valueHari.id + '">' + valueHari
                                .hari + '</option>');
                        });
                        $(document).ready(function() {
                            $('#guru-' + valueJadwal.id).select2({
                                placeholder: "Pilih Guru Pengajar",
                            });
                        });
                        res.mulai.pop();
                        $.each(res.mulai, function(index, valueStart) {
                            $('#start-' + valueJadwal.id).append(
                                '<option value="' + valueStart.id + '">' +
                                valueStart
                                .jam + '</option>');
                        });
                        res.selesai.shift();
                        $.each(res.selesai, function(index, valueEnd) {
                            $('#end-' + valueJadwal.id).append(
                                '<option value="' + valueEnd.id + '">' + valueEnd
                                .jam + '</option>');
                        });
                    });
                }
            });
        });
        $('.start').change(function(e) {
            var id = $(this).attr('id').split("-").pop();
            var start = $('#start-' + id).val();
            var end = $('#end-' + id).val();
            var con = $("#end-" + id + " > option");
            if (end) {
                if (start >= end) {
                    alert('Atur waktu dengan benar !');
                    $('#end-' + id).val('').trigger('change');
                    return false;
                }
            }
        });
        $('.end').change(function(e) {
            var id = $(this).attr('id').split("-").pop();
            var start = $('#start-' + id).val();
            var end = $('#end-' + id).val();
            var guru = $('#guru-' + id).val();
            var hari = $('#hari-' + id).val();
            var ruangan = $('#ruangan-' + id).val();
            if (end) {
                if (start >= end) {
                    alert('Atur waktu dengan benar !');
                    $('#end-' + id).val('').trigger('change');
                    return false;
                    return false;
                }
                if (pelajaran && guru && ruangan && hari && start && end) {
                    $.ajax({
                        type: "post",
                        url: "/api/dashboard/jadwal-pelajaran/store",
                        data: {
                            _token: _token,
                            id: id,
                            guru: guru,
                            ruangan: ruangan,
                            hari: hari,
                            start: start,
                            end: end,
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res == 200) {
                                $.confirm({
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    title: 'Berhasil',
                                    content: 'Data jadwal berhasil disimpan !',
                                    type: 'green',
                                    typeAnimated: true,
                                    buttons: {
                                        tryAgain: {
                                            text: 'OK',
                                            btnClass: 'btn-green',
                                            action: function() {}
                                        },
                                    }
                                });
                            } else if (res == 'ruangan') {
                                console.log(res);
                                $.confirm({
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Ruangan telah terpakai di hari dan jam yang sama !',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        tryAgain: {
                                            text: 'OK',
                                            btnClass: 'btn-red',
                                            action: function() {}
                                        },
                                    }
                                });
                                $('#end-' + id).val('').trigger('change');
                                return false;
                            } else if (res == 'guru') {
                                console.log(res);
                                $.confirm({
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Guru telah menjadi pengajar di hari dan jam yang sama !',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        tryAgain: {
                                            text: 'OK',
                                            btnClass: 'btn-red',
                                            action: function() {}
                                        },
                                    }
                                });
                                $('#end-' + id).val('').trigger('change');
                                return false;
                            }
                        }
                    });
                } else {
                    $.confirm({
                        columnClass: 'col-md-6 col-md-offset-3',
                        title: 'Peringatan',
                        content: 'Isikan semua kolom agar data dapat tersimpan !',
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'OK',
                                btnClass: 'btn-red',
                                action: function() {}
                            },
                        }
                    });
                    $('#end-' + id).val('').trigger('change');
                    return false;
                }
            }
        });
    </script>
@endsection
