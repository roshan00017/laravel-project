$('#province_code').on('change', function () {
    const province_code = $(this).val();
    if (province_code != '') {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.post(site_url + '/app/get_district', {
            province_code: province_code, _token: token
        }, function (status) {
            $('#district_code').html(status);
            $('#district_code').prop('disabled', false);
            //for data reset
            const local_body_code = $('#local_body_code').val();
            if (local_body_code != '') {
                $("#local_body_code").empty().trigger('change')
            }
        });
    }

})

$('#district_code').on('change', function () {
    const district_code = $(this).val();
    if (district_code != '') {
        $.post(site_url + '/app/get_local_body', {
            district_code: district_code, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            $('#local_body_code').html(status);
            $('#local_body_code').prop('disabled', false);
        });
    }

})

$('#local_body_code').on('change', function () {
    console.log('permanent');
    const local_body_code = $(this).val();
    if (local_body_code != '') {
        $.post(site_url + '/app/get_ward', {
            local_body_code: local_body_code, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            $('#wardList').html(status);
            $('#wardList').prop('disabled', false);
        });
    }

})