

// $('#addUerForm').validate({
//     rules: {
//         name_np: {
//             required: true,
//         },
//         name_en: {
//             required: true
//         },
//         province_code: {
//             required: true
//         },
//         district_code: {
//             required: true
//         },
//         local_body_code: {
//             required: true
//         },
//         ward_no: {
//             required: true
//         },
//         teacher_level_id: {
//             required: true
//         },
//
//     },
//     messages: {
//         name_en: {
//             required: 'अंग्रेजी नाम  अनिवार्य छ ।',
//         },
//         name_np: {
//             required: 'नेपाली नाम  अनिवार्य छ ।',
//         },
//         province_code: {
//             required: 'प्रदेश  अनिवार्य छ ।',
//         },
//         district_code: {
//             required: 'जिल्ला  अनिवार्य छ ।',
//         },
//         local_body_code: {
//             required: 'स्थानिय तह  अनिवार्य छ ।',
//         },
//         ward_no: {
//             required: 'वडा नं. अनिवार्य छ ।',
//         },
//
//     },
//     errorElement: 'span',
//     errorPlacement: function (error, element) {
//         error.addClass('invalid-feedback');
//         element.closest('.form-group').append(error);
//     },
//     highlight: function (element, errorClass, validClass) {
//         $(element).addClass('is-invalid');
//     },
//     unhighlight: function (element, errorClass, validClass) {
//         $(element).removeClass('is-invalid');
//     }
// });

$(document).ready(function($) {

    $('#addUerForm').on('submit', function(e){
        $("#addModal").modal('hide');
        $(".passwordUpdate").modal('hide');
        $("#dataSubmitModal").modal('show');
        e.preventDefault();
        // document.getElementById("addMore").value = 1
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
                    window.location.href = '';
                }
            },
            error: function(response) {
                window.location.href = '';
            }
        });
    });


})
$('#mobile').inputmask('9999999999', { 'placeholder': '98xxxxxxxx' })
$('#mobile').on('change', function () {
    var mobile = $(this).val();
    var login_user_type = 'user';
    if (mobile !== '') {
        $.post(site_url + '/check_mobile', {
            mobile: mobile, login_user_type: login_user_type, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            if (status.status == true) {
                $('#error').html(status.message);
                $('#check_data_modal').modal('show');
                $('#mobile').val('');
                $('#btn-add').prop('disabled', true);
                setTimeout(function () {
                    $('#check_data_modal').modal('hide');
                }, 5000);
            } else {
                $('#btn-add').prop('disabled', false);
            }
        });
    }

})

$('#credentialForm').validate({
    messages: {
        login_user_name: {
            required: 'प्रयोगकर्ता नाम  अनिवार्य छ ।',
        },
        mobile_no: {
            required: 'मोबाइल न.  अनिवार्य छ ।',
        },
        email: {
            required: 'इमेल ठेगाना  अनिवार्य छ ।',
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