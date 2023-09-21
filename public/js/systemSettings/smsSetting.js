$('.clientInfo').on('change', function () {
    const client_id = $(this).val();
    if (client_id !== '') {
        $.post(site_url + '/check_client_sms_setting', {
            client_id: client_id, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            if (status.status == true) {
                $('#error').html(status.message);
                $('#check_data_modal').modal('show');
                $('.clientInfo').val('');
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