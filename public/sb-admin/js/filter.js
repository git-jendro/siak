var _token = $('meta[name="_token"]').attr('content');
$('#filter_tingkat').change(function (e) {
    var tingkat_id = $(this).val();
    var jurusan_id = $('#filter_jurusan').val();
    if (jurusan_id) {
        $.ajax({
            type: "get",
            url: "/api/dashboard/filter/kelas/" + tingkat_id + "/" + jurusan_id,
            dataType: "json",
            success: function (res) {
                $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                $.each(res, function (index, value) {
                    $('#filter_kelas').append('<option value="' + value.id + '">' +
                        value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                            .sub.nama + '</option>');
                });
            }
        });
    } else {
        $.ajax({
            type: "get",
            url: "/api/dashboard/filter/tingkat/" + tingkat_id,
            dataType: "json",
            success: function (res) {
                $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                $.each(res, function (index, value) {
                    $('#filter_kelas').append('<option value="' + value.id + '">' +
                        value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                            .sub.nama + '</option>');
                });
            }
        });
    }
});
$('#filter_jurusan').change(function (e) {
    var jurusan_id = $(this).val();
    var tingkat_id = $('#filter_tingkat').val();
    if (tingkat_id) {
        $.ajax({
            type: "get",
            url: "/api/dashboard/filter/kelas/" + tingkat_id + "/" + jurusan_id,
            dataType: "json",
            success: function (res) {
                $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                $.each(res, function (index, value) {
                    $('#filter_kelas').append('<option value="' + value.id + '">' +
                        value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                            .sub.nama + '</option>');
                });
            }
        });
    } else {
        $.ajax({
            type: "get",
            url: "/api/dashboard/filter/jurusan/" + jurusan_id,
            dataType: "json",
            success: function (res) {
                $('#filter_kelas').html('<option value="">Pilih Kelas</option>');
                $.each(res, function (index, value) {
                    $('#filter_kelas').append('<option value="' + value.id + '">' +
                        value.tingkat.nama + ' ' + value.jurusan.kode + ' ' + value
                            .sub.nama + '</option>');
                });
            }
        });
    }
});