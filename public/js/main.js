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
                    window.location.href = '/';
                }
            },
            error: function(response) {
                window.location.href = '/';
            }
        });
    });


})