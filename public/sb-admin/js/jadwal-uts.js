var _token = $('meta[name="_token"]').attr('content');
$('#filter_kelas').change(function (e) {
    var kelas_id = $(this).val();
    $.ajax({
        type: "get",
        url: "/api/dashboard/jadwal-uts/jadwal/" + kelas_id,
        dataType: "json",
        success: function (res) {
            $('#tbody_jadwal').html('');
            res.mulai.pop();
            res.selesai.shift();
            $.each(res.data, function (index, valueJadwal) {
                $('#header-jadwal').html(res.kelas.tingkat.nama + ' ' + res.kelas.jurusan.kode + ' ' + res.kelas.sub.nama);
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
                $.each(res.ruangan, function (index, valueRuangan) {
                    $('#ruangan-' + valueJadwal.id).append('<option value="' +
                        valueRuangan.id + '">' + valueRuangan.nama +
                        '</option>');
                    if (valueRuangan.id == valueJadwal.ruangan_id) {
                        $('#ruangan-' + valueJadwal.id).val(valueRuangan.id);
                    }
                });
                $.each(res.guru, function (index, valueGuru) {
                    $('#guru-' + valueJadwal.id).append(
                        '<option value="' + valueGuru.id + '">' + valueGuru
                            .nama + '</option>');
                    if (valueGuru.id == valueJadwal.guru_id) {
                        $('#guru-' + valueJadwal.id).val(valueGuru.id);
                    }
                });
                $.each(res.hari, function (index, valueHari) {
                    $('#hari-' + valueJadwal.id).append(
                        '<option value="' + valueHari.id + '">' + valueHari
                            .hari + '</option>');
                    if (valueHari.id == valueJadwal.hari) {
                        $('#hari-' + valueJadwal.id).val(valueHari.id);
                    }
                });
                $(document).ready(function () {
                    $('#guru-' + valueJadwal.id).select2({
                        placeholder: "Pilih Guru Pengajar",
                    });
                });
                $.each(res.mulai, function (index, valueStart) {
                    $('#start-' + valueJadwal.id).append(
                        '<option value="' + valueStart.id + '">' +
                        valueStart
                            .jam + '</option>');
                    if (valueStart.id == valueJadwal.mulai) {
                        $('#start-' + valueJadwal.id).val(valueStart.id);
                    }
                });
                $.each(res.selesai, function (index, valueEnd) {
                    $('#end-' + valueJadwal.id).append(
                        '<option value="' + valueEnd.id + '">' + valueEnd
                            .jam + '</option>');
                    if (valueEnd.id == valueJadwal.selesai) {
                        $('#end-' + valueJadwal.id).val(valueEnd.id);
                    }
                });
            });
            $('.start').change(function (e) {
                var id = $(this).attr('id').split("-").pop();
                var start = $('#start-' + id).val();
                var end = $('#end-' + id).val();
                var hari = $('#hari-' + id).val();
                var guru = $('#guru-' + id).val();
                var ruangan = $('#ruangan-' + id).val();
                var url_ruangan = '/api/dashboard/jadwal-uts/check_ruangan/'+ ruangan +'/'+hari+'/'+start;
                var url_guru = '/api/dashboard/jadwal-uts/check_guru/'+ guru +'/'+hari+'/'+start;
                var url_both = '/api/dashboard/jadwal-uts/check_both/'+ ruangan +'/'+ guru +'/'+hari+'/'+start;
                if (ruangan && guru && hari) {
                    $.ajax({
                        type: "get",
                        url: url_both,
                        dataType: "json",
                        success: function (res) {
                            if (res == false) {
                                $.confirm({
                                    title: 'Error',
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Guru pengajar dan ruangan bentrok !',
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
                                $('#start-' + id).val('').trigger('change');
                            }  
                            if (res == 'ruangan') {
                                $.confirm({
                                    title: 'Error',
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Ruangan bentrok !',
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
                                $('#start-' + id).val('').trigger('change');
                            }  
                            if (res == 'guru') {
                                $.confirm({
                                    title: 'Error',
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Guru pengajar bentrok !',
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
                                $('#start-' + id).val('').trigger('change');
                            }  
                            if (res == 'hari') {
                                $.confirm({
                                    title: 'Error',
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Hari dan jam bentrok !',
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
                                $('#start-' + id).val('').trigger('change');
                            }  
                            return false;
                        }
                    });
                } else if (ruangan && hari) {
                    $.ajax({
                        type: "get",
                        url: url_ruangan,
                        dataType: "json",
                        success: function (res) {
                            if (res == false) {
                                $.confirm({
                                    title: 'Error',
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Ruangan bentrok !',
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
                                $('#start-' + id).val('').trigger('change');
                            }  
                            return false;  
                        }
                    });
                } else if(guru && hari) {
                    $.ajax({
                        type: "get",
                        url: url_guru,
                        dataType: "json",
                        success: function (res) {
                            if (res == false) {
                                $.confirm({
                                    title: 'Error',
                                    columnClass: 'col-md-6 col-md-offset-3',
                                    content: 'Guru pengajar bentrok !',
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
                                $('#start-' + id).val('').trigger('change');
                            }   
                            return false; 
                        }
                    });
                }
                if (end) {
                    if (start >= end) {
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            content: 'Atur waktu dengan benar !',
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
                        $('#end-' + id).val('').trigger('change');
                        return false;
                    }
                }
            });
            $('.end').change(function (e) {
                var id = $(this).attr('id').split("-").pop();
                var start = $('#start-' + id).val();
                var end = $('#end-' + id).val();
                var guru = $('#guru-' + id).val();
                var hari = $('#hari-' + id).val();
                var ruangan = $('#ruangan-' + id).val();
                if (end) {
                    if (start >= end) {
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            content: 'Atur waktu dengan benar !',
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
                        $('#end-' + id).val('').trigger('change');
                        return false;
                    }
                    if (pelajaran && guru && ruangan && hari && start && end) {
                        $.ajax({
                            type: "post",
                            url: "/api/dashboard/jadwal-uts/store",
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
                            success: function (res) {
                                if (res == 200) {
                                    $.confirm({
                                        columnClass: 'col-md-6 col-md-offset-3',
                                        title: 'Success',
                                        content: 'Data jadwal berhasil disimpan !',
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
                                } else if (res == 'ruangan') {
                                    console.log(res);
                                    $.confirm({
                                        title: 'Error',
                                        columnClass: 'col-md-6 col-md-offset-3',
                                        content: 'Ruangan telah terpakai di hari dan jam yang sama !',
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
                                    $('#end-' + id).val('').trigger('change');
                                    return false;
                                } else if (res == 'guru') {
                                    console.log(res);
                                    $.confirm({
                                        title: 'Error',
                                        columnClass: 'col-md-6 col-md-offset-3',
                                        content: 'Guru telah menjadi pengajar di hari dan jam yang sama !',
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
                                    $('#end-' + id).val('').trigger('change');
                                    return false;
                                } else if (res == 'hari') {
                                    console.log(res);
                                    $.confirm({
                                        title: 'Error',
                                        columnClass: 'col-md-6 col-md-offset-3',
                                        content: 'Hari dan jam bentrok !',
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
                                    $('#end-' + id).val('').trigger('change');
                                    return false;
                                }
                            }
                        });
                    } else {
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            title: 'Peringatan',
                            content: 'Isikan semua kolom agar data dapat tersimpan !',
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
                        $('#end-' + id).val('').trigger('change');
                        return false;
                    }
                }
            });
        }
    });
});
$('.start').change(function (e) {
    var id = $(this).attr('id').split("-").pop();
    var start = $('#start-' + id).val();
    var end = $('#end-' + id).val();
    var hari = $('#hari-' + id).val();
    var guru = $('#guru-' + id).val();
    var ruangan = $('#ruangan-' + id).val();
    var url_ruangan = '/api/dashboard/jadwal-uts/check_ruangan/'+ ruangan +'/'+hari+'/'+start;
    var url_guru = '/api/dashboard/jadwal-uts/check_guru/'+ guru +'/'+hari+'/'+start;
    var url_both = '/api/dashboard/jadwal-uts/check_both/'+ ruangan +'/'+ guru +'/'+hari+'/'+start;
    if (ruangan && guru && hari) {
        $.ajax({
            type: "get",
            url: url_both,
            dataType: "json",
            success: function (res) {
                if (res == false) {
                    $.confirm({
                        title: 'Error',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: 'Guru pengajar dan ruangan bentrok !',
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
                    $('#start-' + id).val('').trigger('change');
                }  
                if (res == 'ruangan') {
                    $.confirm({
                        title: 'Error',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: 'Ruangan bentrok !',
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
                    $('#start-' + id).val('').trigger('change');
                }  
                if (res == 'guru') {
                    $.confirm({
                        title: 'Error',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: 'Guru pengajar bentrok !',
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
                    $('#start-' + id).val('').trigger('change');
                }  
                if (res == 'hari') {
                    $.confirm({
                        title: 'Error',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: 'Hari dan jam bentrok !',
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
                    $('#start-' + id).val('').trigger('change');
                }  
                return false;
            }
        });
    } else if (ruangan && hari) {
        $.ajax({
            type: "get",
            url: url_ruangan,
            dataType: "json",
            success: function (res) {
                if (res == false) {
                    $.confirm({
                        title: 'Error',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: 'Ruangan bentrok !',
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
                    $('#start-' + id).val('').trigger('change');
                }  
                return false;  
            }
        });
    } else if(guru && hari) {
        $.ajax({
            type: "get",
            url: url_guru,
            dataType: "json",
            success: function (res) {
                if (res == false) {
                    $.confirm({
                        title: 'Error',
                        columnClass: 'col-md-6 col-md-offset-3',
                        content: 'Guru pengajar bentrok !',
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
                    $('#start-' + id).val('').trigger('change');
                }   
                return false; 
            }
        });
    }
    if (end) {
        if (start >= end) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Atur waktu dengan benar !',
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
            $('#end-' + id).val('').trigger('change');
            return false;
        }
    }
});
$('.end').change(function (e) {
    var id = $(this).attr('id').split("-").pop();
    var start = $('#start-' + id).val();
    var end = $('#end-' + id).val();
    var guru = $('#guru-' + id).val();
    var hari = $('#hari-' + id).val();
    var ruangan = $('#ruangan-' + id).val();
    if (end) {
        if (start >= end) {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                content: 'Atur waktu dengan benar !',
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
            $('#end-' + id).val('').trigger('change');
            return false;
        }
        if (pelajaran && guru && ruangan && hari && start && end) {
            $.ajax({
                type: "post",
                url: "/api/dashboard/jadwal-uts/store",
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
                success: function (res) {
                    if (res == 200) {
                        $.confirm({
                            columnClass: 'col-md-6 col-md-offset-3',
                            title: 'Success',
                            content: 'Data jadwal berhasil disimpan !',
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
                    } else if (res == 'ruangan') {
                        console.log(res);
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            content: 'Ruangan telah terpakai di hari dan jam yang sama !',
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
                        $('#end-' + id).val('').trigger('change');
                        return false;
                    } else if (res == 'guru') {
                        console.log(res);
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            content: 'Guru telah menjadi pengajar di hari dan jam yang sama !',
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
                        $('#end-' + id).val('').trigger('change');
                        return false;
                    } else if (res == 'hari') {
                        console.log(res);
                        $.confirm({
                            title: 'Error',
                            columnClass: 'col-md-6 col-md-offset-3',
                            content: 'Hari dan jam bentrok !',
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
                        $('#end-' + id).val('').trigger('change');
                        return false;
                    }
                }
            });
        } else {
            $.confirm({
                title: 'Error',
                columnClass: 'col-md-6 col-md-offset-3',
                title: 'Peringatan',
                content: 'Isikan semua kolom agar data dapat tersimpan !',
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
            $('#end-' + id).val('').trigger('change');
            return false;
        }
    }
});