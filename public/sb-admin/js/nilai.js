var _token = $('meta[name="_token"]').attr('content');
var id = '';
var nilai = '';
var url = '';
$('.tugas1').keyup(function (e) {
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    id = $(this).attr('id');
    nilai = $(this).val();
    url = '/api/dashboard/store/tugas1';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('Tugas 1');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.tugas2').keyup(function (e) {
    id = $(this).attr('id');
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    nilai = $(this).val();
    url = '/api/dashboard/store/tugas2';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('Tugas 2');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.tugas3').keyup(function (e) {
    id = $(this).attr('id');
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    nilai = $(this).val();
    url = '/api/dashboard/store/tugas3';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('Tugas 3');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.tugas4').keyup(function (e) {
    id = $(this).attr('id');
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    nilai = $(this).val();
    url = '/api/dashboard/store/tugas4';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('Tugas 4');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.tugas5').keyup(function (e) {
    id = $(this).attr('id');
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    nilai = $(this).val();
    url = '/api/dashboard/store/tugas5';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('Tugas 5');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.uts').keyup(function (e) {
    id = $(this).attr('id');
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    nilai = $(this).val();
    url = '/api/dashboard/store/uts';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('UTS');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.uas').keyup(function (e) {
    id = $(this).attr('id');
    let check = $(this).val().charAt(0);
    if (check == 1) {
        $(this).attr('maxlength', '3');
    } else {
        $(this).attr('maxlength', '2');
    }
    nilai = $(this).val();
    url = '/api/dashboard/store/uas';
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    $('#nilai-' + id).html($(this).val());
    $('#nilai').html('UAS');
    if ($(this).val().length == 2) {
        if (check == 0) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Masukan nilai dengan benar !',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'OK',
                        btnClass: 'btn-red',
                        action: function () { }
                    },
                }
            });
            $(this).val('');
            return false;
        } else if (nilai) {
            $('#' + id).modal('show');
            return false;
        }
    } else if ($(this).val().length > 2) {
        $('#' + id).modal('show');
        return false;
    }
});
$('.submit').click(function (e) {
    e.preventDefault();
    $('.submit').addClass('d-none');
    $('.loading').toggleClass('d-none');
    $.ajax({
        type: "post",
        url: url,
        data: {
            _token: _token,
            id: id,
            nilai: nilai,
        },
        dataType: "json",
        success: function (res) {
            console.log(res.nilai, res.grade, res.status, id);
            $('#' + id).modal('hide');
            $('#total-'+id).html(res.nilai);
            $('#grade-'+id).html(res.grade);
            $('#status-'+id).html(res.status);
            if (res.grade > 80) {
                alert('A');
            } else if (res.grade <= 80 || res.grade >= 60) {
                alert('B');
            } else if (res.grade <= 60 || res.grade >= 40) {
                alert('C');
            } else if (res.grade <= 40 || res.grade >= 20) {
                alert('D');
            } else if (res.grade <= 20) {
                alert('E');
            }
            if (res.message) {
                $.confirm({
                    title: 'Success',
                    columnClass: 'col-md-6 col-md-offset-3',
                    content: 'Berhasil memasukan nilai !',
                    type: 'green',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'OK',
                            btnClass: 'btn-green',
                            action: function () { }
                        },
                    }
                });
            } else {
                $.confirm({
                    title: 'Error',
                    columnClass: 'col-md-6 col-md-offset-3',
                    content: 'Gagal menambahkan nilai !',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: 'OK',
                            btnClass: 'btn-red',
                            action: function () { }
                        },
                    }
                });
            }
            $('.submit').toggleClass('d-none');
            $('.loading').toggleClass('d-none');
        }
    });
});