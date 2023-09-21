$('.profile-img').on('change', function () {
    let files;
    files = $(this).val();
    var size = parseFloat(this.files[0].size / (1024 * 1024)).toFixed(2);
    var ext = files.split('.').pop();
    if (ext == "png" || ext == "jpg" || ext == "jpeg" && size <= 1) {
        $('#profile-img-tag').css("display", "block");
    } else {
        $('#error').html('फाइलको  प्रकार jpeg, jpg, png मात्र हुनुपर्छ ।');
        $('#check_data_modal').modal('show');
        $('#profilePictureModal').modal('hide');
        $('.profile-img').val('');
        $('#profile-img-tag').css("display", "none");
        setTimeout(function () {
            $('#check_data_modal').modal('hide');
        }, 5000);
    }
    //for check size
    if ((ext == "png" || ext == "jpg") && size > 1) {
        $('#error').html('फाइलको साइज १ MB भन्दा कमको  हुनुपर्छ।');
        $('#check_data_modal').modal('show');
        $('#profilePictureModal').modal('hide');
        $('.profile-img').val('');
        $('#profile-img-tag').css("display", "none");
        setTimeout(function () {
            $('#check_data_modal').modal('hide');
        }, 5000);
        $('#btn-add').prop('disabled',true);
    }
});