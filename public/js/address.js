$('#per_province_code').on('change', function () {
    const province_code = $(this).val();
    if (province_code !== '') {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.post(site_url + '/app/get_district', {
            province_code: province_code, _token: token
        }, function (status) {
            $('#per_district_code').html(status);
            $('#per_district_code').prop('disabled', false);
            //for data reset
            const local_body_code = $('#per_local_body_code').val();
            if (local_body_code !== '') {
                $("#per_local_body_code").empty().trigger('change')
            }
            const ward_no = $('#per_ward_no').val();
            if (ward_no !== '') {
                $("#per_ward_no").empty().trigger('change')
            }
        });
    }

})

$('#per_district_code').on('change', function () {
    const district_code = $(this).val();
    if (district_code !== '') {
        $.post(site_url + '/app/get_local_body', {
            district_code: district_code, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            $('#per_local_body_code').html(status);
            $('#per_local_body_code').prop('disabled', false);
        });
        const ward_no = $('#per_ward_no').val();
        if (ward_no !== '') {
            $("#per_ward_no").empty().trigger('change')
        }
    }

})

$('#per_local_body_code').on('change', function () {
    const local_body_code = $(this).val();
    if (local_body_code !== '') {
        $.post(site_url + '/app/get_ward', {
            local_body_code: local_body_code, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            $('#per_ward_no').html(status);
            $('#per_ward_no').prop('disabled', false);
        });
    }

})

$('#temp_province_code').on('change', function () {
    const province_code = $(this).val();
    if (province_code !== '') {
        const token = $('meta[name="csrf-token"]').attr('content');
        $.post(site_url + '/app/get_district', {
            province_code: province_code, _token: token
        }, function (status) {
            $('#temp_district_code').html(status);
            $('#temp_district_code').prop('disabled', false);
            //for data reset
            const local_body_code = $('#temp_local_body_code').val();
            if (local_body_code !== '') {
                $("#temp_local_body_code").empty().trigger('change')
            }
            const ward_no = $('#temp_ward_no').val();
            if (ward_no !== '') {
                $("#temp_ward_no").empty().trigger('change')
            }
        });
    }

})

$('#temp_district_code').on('change', function () {
    const district_code = $(this).val();
    if (district_code !== '') {
        $.post(site_url + '/app/get_local_body', {
            district_code: district_code, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            $('#temp_local_body_code').html(status);
            $('#temp_local_body_code').prop('disabled', false);
        });
        const ward_no = $('#temp_ward_no').val();
        if (ward_no !== '') {
            $("#temp_ward_no").empty().trigger('change')
        }
    }

})

$('#temp_local_body_code').on('change', function () {
    const local_body_code = $(this).val();
    if (local_body_code !== '') {
        $.post(site_url + '/app/get_ward', {
            local_body_code: local_body_code, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            $('#temp_ward_no').html(status);
            $('#temp_ward_no').prop('disabled', false);
        });
    }

})

$('#isSameAddress').on('change',function(){
    const chk =   $(this).is(':checked');
    if(chk === true){
        const province_code = $('#temp_province_code').val();
        if (province_code !== '') {
            $('#temp_province_code').val(null).trigger('change');
        }
        const district_code = $('#temp_district_code').val();
        if (district_code !== '') {
            $('#temp_district_code').val(null).trigger('change');
            $('#temp_district_code').prop('disabled',true);
        }
        const local_body_code = $('#temp_local_body_code').val();
        if (local_body_code !== '') {
            $('#temp_local_body_code').val(null).trigger('change');
            $('#temp_local_body_code').prop('disabled',true);
        }
        const ward_no = $('#temp_ward_no').val();
        if (ward_no !== '') {
            $('#temp_ward_no').val(null).trigger('change');
            $('#temp_ward_no').prop('disabled',true);
        }


        $('#temp_province_code').prop('required',false);
        $('#temp_district_code').prop('required',false);
        $('#temp_local_body_code').prop('required',false);
        $('#temp_ward_no').prop('required',false);
        $('#temp_street_name').prop('required',false);

        $('#temp_province_code_block').hide();
        $('#is_copy_temp_province_block').show();
        $('#temp_district_code_block').hide();
        $('#is_copy_temp_district_block').show();
        $('#temp_local_body_code_block').hide();
        $('#is_copy_temp_local_body_block').show();
        $('#temp_ward_no_block').hide();
        $('#is_copy_temp_ward_no_block').show();


        const per_province_code = $('#per_province_code').val();
        const per_district_code = $('#per_district_code').val();
        const per_local_body_code = $('#per_local_body_code').val();
        const per_ward_no = $('#per_ward_no').val();
        const per_street_name = $('#per_street_name').val();
        if(per_province_code !==''){
            const type = 'province'
            $.post(site_url + '/app/get_is_copy_location_info', {
                code: per_province_code, type : type , _token: $('meta[name="csrf-token"]').attr('content')
            }, function (status) {
                $('#is_copy_province_code').val(status.code);
                $('#is_copy_province_name').val(status.name);
            });
        }
        if(per_district_code !==''){
            const type = 'district'
            $.post(site_url + '/app/get_is_copy_location_info', {
                code: per_district_code, type : type , _token: $('meta[name="csrf-token"]').attr('content')
            }, function (status) {
                $('#is_copy_district_code').val(status.code);
                $('#is_copy_district_name').val(status.name);
            });
        }
        if(per_local_body_code !==''){
            const type = 'local_body'
            $.post(site_url + '/app/get_is_copy_location_info', {
                code: per_local_body_code, type : type, _token: $('meta[name="csrf-token"]').attr('content')
            }, function (status) {
                $('#is_copy_local_body_code').val(status.code);
                $('#is_copy_local_body_name').val(status.name);
            });
        }

        if(per_ward_no !==''){
            const arr = per_ward_no.split('-');
            console.log(arr);

            $('#is_copy_temp_ward_no').val(arr[0]);
        }
        if(per_street_name !==''){
            $('#temp_street_name').val(per_street_name);
        }
        $('#is_copy_temp_ward_no').prop('readonly',true);
        $('#temp_street_name').prop('readonly',true);
    } else {
        $('#temp_province_code_block').show();
        $('#is_copy_temp_province_block').hide();
        $('#temp_district_code_block').show();
        $('#is_copy_temp_district_block').hide();
        $('#temp_local_body_code_block').show();
        $('#is_copy_temp_local_body_block').hide();
        $('#is_copy_province_code').val('');
        $('#is_copy_district_code').val('');
        $('#is_copy_local_body_code').val('');
        $('#is_copy_temp_ward_no').val('');
        $('#temp_ward_no_block').show();
        $('#is_copy_temp_ward_no_block').hide();
        $('#temp_street_name').val('');
        $('#temp_street_name').prop('readonly',false);

    }

})





