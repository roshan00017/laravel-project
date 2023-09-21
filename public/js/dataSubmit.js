$(document).ready(function($) {
    $('.checkData').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const id = $(this).data('id');
        const baseUrl = $(this).data('widget');
        $.ajax({
            type: "POST",
            url:  baseUrl + '/checkData',
            data: { id: id },
            dataType: 'JSON',
            success: function(response) {

            }
        });
    });

    $('.deleteFile').on('click', function () {
        $(".update").modal("hide");
        $(".show").modal("hide");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const id = $(this).data('id');
        const baseUrl = $(this).data('widget');
        $.ajax({
            type: "POST",
            url:  '/' + baseUrl + '/checkData',
            data: { id: id },
            dataType: 'JSON',
            success: function(response) {
                 console.log(response.data.id)
                $('#deleteFileModal').modal('show');
                $('.setId').val(`${response.data.id}`);
            }
        });

    });

    $('#passwordResetForm').on('submit', function(e){
        $("#passwordResetModal").modal('hide');
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
                    window.location.href = '';
                }
            },
            error: function(response) {
                window.location.href = '';
            }
        });
    });


    $('.passwordReset').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const id = $(this).data('id');
        const baseUrl = $(this).data('widget');
        $.ajax({
            type: "POST",
            url:  '/' + baseUrl + '/checkData',
            data: { id: id },
            dataType: 'JSON',
            success: function(response) {
                $('#passwordResetModal').modal('show');
                $('#dataId').val(response.data.id);
            }
        });
    });
})


