$(document).ready(function() {
    if ($('#create-error').length) {
        $('#create-modal').modal('show');
    }
    return false;
});
$('input[name=kkm]').keyup(function() {
    $(this).val($(this).val().replace(/[^\d]/g, ''));
    if ($(this).val().length > 2) {
        $(this).val($(this).val().slice(0, -1));
    }
});