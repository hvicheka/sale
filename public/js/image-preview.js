$(document).ready(function () {

    $('#image').change(function (e) {
        $('#preview-image').attr('src', URL.createObjectURL(e.target.files[0]))
    })

    $('.images').change(function (e) {
        const target = $(this).data('preview')
        $(target).attr('src', URL.createObjectURL(e.target.files[0]))
    })
})
