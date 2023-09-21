$("#mobile").on("change", function () {
    const mobile = $(this).val();
    if (mobile != "") {
        $.post(
            site_url + "/checkMobile",
            {
                mobile: mobile,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
                if (status.status == true) {
                    $("#error").html(status.message);
                    $("#check_data_modal").modal("show");
                    $("#mobile").val("");
                    setTimeout(function () {
                        $("#check_data_modal").modal("hide");
                    }, 5000);
                } else {
                    $("#btn-add").prop("disabled", false);
                }
            }
        );
    }
});

$("#email").on("change", function () {
    const email = $(this).val();
    if (email != "") {
        $.post(
            site_url + "/checkEmail",
            {
                email: email,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
                if (status.status == true) {
                    $("#error").html(status.message);
                    $("#check_data_modal").modal("show");
                    $("#email").val("");
                    setTimeout(function () {
                        $("#check_data_modal").modal("hide");
                    }, 5000);
                } else {
                    $("#btn-add").prop("disabled", false);
                }
            }
        );
    }
});

$(document).ready(function($) {
    $('.addFrom').on('submit', function(e){
        $("#dataSubmitModal").modal('show');
        e.preventDefault();
        $.ajax({
            type:'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            url: $(this).attr('action'),
            success: (response) => {
                if (response) {
                    window.location.href = '/otp-verify';
                }
            },
            error: function(response) {
                window.location.href = '/otp-verify';
            }
        });
    });


})