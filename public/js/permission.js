$(document).ready(function () {
    $('.read').on('change', function () {
        read = $(this).val();

        $.ajax({
            url: "permissions/1/" + read,
            type: "GET"
        });

        window.setTimeout( function() {
            window.location.reload();
        }, 5000);
    });

    $('.write').on('change', function () {
        write = $(this).val();
        $.ajax({
            url: "permissions/2/" + write,
            type: "GET"
        });

        window.setTimeout( function() {
            window.location.reload();
        }, 5000);
    });

    $('.edit').on('change', function () {
        edit = $(this).val();
        $.ajax({
            url: "permissions/3/" + edit,
            type: "GET"
        });

        window.setTimeout( function() {
            window.location.reload();
        }, 5000);
    });

    $('.delete').on('change', function () {
        del = $(this).val();
        $.ajax({
            url: "permissions/4/" + del,
            type: "GET"
        });

        window.setTimeout( function() {
            window.location.reload();
        }, 5000);
    });

    $('.show').on('change', function () {
        sh = $(this).val();
        $.ajax({
            url: "permissions/5/" + sh,
            type: "GET"
        });

        window.setTimeout( function() {
            window.location.reload();
        }, 5000);
    });
    $('.all').on('change', function () {
        all = $(this).val();

        $.ajax({
            url: "permissions/6/" + all,
            type: "GET"
        });

        window.setTimeout( function() {
            window.location.reload();
        }, 5000);
    });
});

$('#perForm').validate({
    rules: {
        role_id: {
            required: true,
        }
    },
    messages: {
        role_id: {
            required: 'प्रयोगकर्ता प्रकार   अनिवार्य छ ।',
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});