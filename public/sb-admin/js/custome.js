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
$(function() {
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                $('.prev-create').html('');
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr({
                        src: event.target.result,
                        class: "mr-1 img-fluid",
                    }).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#create-image').on('change', function() {
        imagesPreview(this, 'div.prev-create');
    });
});