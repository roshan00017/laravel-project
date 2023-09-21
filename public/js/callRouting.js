$(document).ready(function($) {

    $('.submitData').on('submit', function(e){
        $(".updateModal").modal('hide');
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
                    window.location.href = '/callRoutingNumberManagement';
                }
            },
            error: function(response) {
                window.location.href = '/callRoutingNumberManagement';
            }
        });
    });


})