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
            Data Kelas
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
            <div class="row">
                <div class="col-lg-3">
                    <h6 class="font-weight-bold">Filter Kelas</h6>
                </div>
                <div class="col-lg-9">
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <select class="form-control" id="filter_tahun">
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach ($tahun as $th)
                                    <option value="{{ $th->id }}">{{ $th->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <select class="form-control" id="filter_tingkat">
                                <option value="">Pilih Tingkat Kelas</option>
                                @foreach ($tingkat as $tngk)
                                    <option value="{{ $tngk->id }}">{{ $tngk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-3 mb-sm-0">
                            <select class="form-control" id="filter_jurusan">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusan as $jrs)
                                    <option value="{{ $jrs->id }}">{{ $jrs->kode }} ({{ $jrs->nama }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
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
                            <th>Tahun Akademik</th>
                            <th>Kelas</th>
                            <th>Walikelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tahun Akademik</th>
                            <th>Kelas</th>
                            <th>Walikelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody id="tbody">
                        <meta name="_token" content="{{ csrf_token() }}">
                        @if (!is_null($data))
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        {{ $item->tahun->nama }}
                                    </td>
                                    <td>
                                        {{ $item->kelas->tingkat->nama }} {{ $item->kelas->jurusan->kode }}
                                        {{ $item->kelas->sub->nama }}
                                    </td>
                                    <td>
                                        {{ $item->guru != null ? $item->guru->nama : '' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('riwayat.show', [$item->slug]) }}" class="btn btn-link ">
                                            <i class="fas fa-eye"></i>
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
        $(document).ready(function() {
            $('#riwayat').addClass('active');
        });
        $('#filter_tahun').change(function (e) {
            var tahun = $(this).val();
            var kelas_id = $('#filter_kelas').val();
            $('.table-responsive').html('');
            $('.table-responsive').append(
                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Tahun Akademik</th><th>Kelas</th><th>Walikelas</th><th class="text-center">Aksi</th></tr></thead><tfoot><tr><th>Tahun Akademik</th><th>Kelas</th><th>Walikelas</th><th class="text-center">Aksi</th></tr></tfoot><tbody id="tbody"></tbody></table>'
                );
            if (tahun) {
                $.ajax({
                    type: "post",
                    url: "/api/dashboard/riwayat/filter_tahun",
                    data: {
                        _token : _token,
                        tahun : tahun,
                        kelas_id : kelas_id
                    },
                    dataType: "json",
                    success: function (res) {
                        $.each(res, function(index, value) {
                            if (value) {
                                var url = "{{ route('nilai.show', ':id') }}";
                                url = url.replace(':id', value.slug);
                                var guru = '';
                                if (value.guru_id != null) {
                                    guru = value.guru
                                        .nama
                                }
                                $('#tbody').append('<tr><td>' + value.tahun.nama + '</td><td>' +
                                    value.kelas.tingkat.nama + ' ' + value.kelas.jurusan
                                    .kode +
                                    '' + value.kelas.sub.nama + '</td><td>' + guru +
                                    '</td><td class="text-center"><a href="' + url +
                                    '" class="btn btn-link "><i class="fas fa-eye"></i></a></td></tr>'
                                );
                            }
                        });
                        $(document).ready(function() {
                            $('#dataTable').DataTable({})
                        });
                    }
                });
            }
        });
        $('#filter_kelas').change(function(e) {
            var kelas_id = $(this).val();
            var tahun = $('#filter_tahun').val();
            $('.table-responsive').html('');
            $('.table-responsive').append(
                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Tahun Akademik</th><th>Kelas</th><th>Walikelas</th><th class="text-center">Aksi</th></tr></thead><tfoot><tr><th>Tahun Akademik</th><th>Kelas</th><th>Walikelas</th><th class="text-center">Aksi</th></tr></tfoot><tbody id="tbody"></tbody></table>'
                );
            if (kelas_id) {
                $.ajax({
                    type: "post",
                    url: "/api/dashboard/riwayat/filter_kelas",
                    data: {
                        _token: _token,
                        kelas_id: kelas_id,
                        tahun: tahun,
                    },
                    dataType: "json",
                    success: function(res) {
                        $.each(res, function(index, value) {
                            if (value) {
                                var url = "{{ route('nilai.show', ':id') }}";
                                url = url.replace(':id', value.slug);
                                var guru = '';
                                if (value.guru_id != null) {
                                    guru = value.guru
                                        .nama
                                }
                                $('#tbody').append('<tr><td>' + value.tahun.nama + '</td><td>' +
                                    value.kelas.tingkat.nama + ' ' + value.kelas.jurusan
                                    .kode +
                                    '' + value.kelas.sub.nama + '</td><td>' + guru +
                                    '</td><td class="text-center"><a href="' + url +
                                    '" class="btn btn-link "><i class="fas fa-eye"></i></a></td></tr>'
                                );
                            }
                        });
                        $(document).ready(function() {
                            $('#dataTable').DataTable({})
                        });
                    }
                });
            }
        });
    </script>
@endsection
