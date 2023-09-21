$('#role_level').on('change', function () {
    var role_level = $(this).val();
    if(role_level != ''){
        if(role_level == 1){
            $('#province_block').show();
            $('#district_block').hide();
            $('#local_body_block').hide();
            $('#ward_block').hide();
            $('#school_block').hide();
            $('#province_code').prop('required',true);
            $("#district_code").empty().trigger('change')
            $("#local_body_code").empty().trigger('change')
            $("#ward_no").empty().trigger('change')
            $("#school_id").empty().trigger('change')
            $("#role_id").empty().trigger('change')
        }else if(role_level == 2){
            $('#province_block').show();
            $('#district_block').show();
            $('#local_body_block').hide();
            $('#ward_block').hide();
            $('#school_block').hide();
            $('#province_code').prop('required',true);
            $('#district_code').prop('required',true);
            $("#local_body_code").empty().trigger('change')
            $("#ward_no").empty().trigger('change')
            $("#school_id").empty().trigger('change')
            $("#role_id").empty().trigger('change')
        }else if(role_level == 3){
            $('#province_block').show();
            $('#district_block').show();
            $('#local_body_block').show();
            $('#ward_block').hide();
            $('#school_block').hide();
            $('#province_code').prop('required',true);
            $('#district_code').prop('required',true);
            $('#local_body_block_code').prop('required',true);
            $("#ward_no").empty().trigger('change')
            $("#school_id").empty().trigger('change')
            $("#role_id").empty().trigger('change')
        }else if(role_level == 4){
            $('#province_block').show();
            $('#district_block').show();
            $('#local_body_block').show();
            $('#ward_block').show();
            $('#school_block').hide();
            $('#province_code').prop('required',true);
            $('#district_code').prop('required',true);
            $('#local_body_block_code').prop('required',true);
            $("#school_id").empty().trigger('change')
            $("#role_id").empty().trigger('change')
        }else if(role_level == 5){
            $('#province_block').show();
            $('#district_block').show();
            $('#local_body_block').show();
            $('#ward_block').show();
            $('#school_block').show();
            $('#province_code').prop('required',true);
            $('#district_code').prop('required',true);
            $('#local_body_block_code').prop('required',true);
            $('#ward_no').prop('required',true);
            $('#school_id').prop('required',true);
            $("#district_code").empty().trigger('change')
            $("#local_body_code").empty().trigger('change')
            $("#school_id").empty().trigger('change')
            $("#role_id").empty().trigger('change')
        }
    }

})

$('.roleLevelList').on('change', function () {
    var role_level = $(this).val();
    if(role_level !== ''){
        if(role_level == 1){
            $('.edit_province_block').show();
            $('.edit_district_block').hide();
            $('.edit_local_body_block').hide();
            $('.edit_ward_block').hide();
            $('.edit_school_block').hide();
            $('.provinceList').prop('required',true);
            //for data reset
            $(".localBodyList").empty().trigger('change')
            $(".wardList").empty().trigger('change')
            $(".schoolList").empty().trigger('change')
            $(".roleList").empty().trigger('change')
        }else if(role_level == 2){
            $('.edit_province_block').show();
            $('.edit_district_block').show();
            $('.edit_local_body_block').hide();
            $('.edit_ward_block').hide();
            $('.edit_school_block').hide();
            $('.provinceList').prop('required',true);
            $('.districtList').prop('required',true);
            $(".localBodyList").empty().trigger('change')
            $(".wardList").empty().trigger('change')
            $(".schoolList").empty().trigger('change')
            $(".roleList").empty().trigger('change')
        }else if(role_level == 3){
            $('.edit_province_block').show();
            $('.edit_district_block').show();
            $('.edit_local_body_block').show();
            $('.edit_ward_block').hide();
            $('.edit_school_block').hide();
            $('.provinceList').prop('required',true);
            $('.districtList').prop('required',true);
            $('.localBodyList').prop('required',true);
            $(".schoolList").empty().trigger('change')
            $(".roleList").empty().trigger('change')
        }else if(role_level == 4){
            $('.edit_province_block').show();
            $('.edit_district_block').show();
            $('.edit_local_body_block').show();
            $('.edit_ward_block').show();
            $('.edit_school_block').hide();
            $('.provinceList').prop('required',true);
            $('.districtList').prop('required',true);
            $('.localBodyList').prop('required',true);
            $('.wardList').prop('required',true);
            $(".localBodyList").empty().trigger('change')
            $(".wardList").empty().trigger('change')
            $(".schoolList").empty().trigger('change')
            $(".roleList").empty().trigger('change')
        }else if(role_level == 5){
            $('.edit_province_block').show();
            $('.edit_district_block').show();
            $('.local_body_block').show();
            $('.edit_ward_block').show();
            $('.edit_school_block').show();
            $('.provinceList').prop('required',true);
            $('.districtList').prop('required',true);
            $('.localBodyList').prop('required',true);
            $('.wardList').prop('required',true);
            $('.schoolList').prop('required',true);
            $(".localBodyList").empty().trigger('change')
            $(".wardList").empty().trigger('change')
            $(".schoolList").empty().trigger('change')
            $(".roleList").empty().trigger('change')
        }else if(role_level == 6){
            $('.edit_province_block').hide();
            $('.edit_district_block').hide();
            $('.local_body_block').hide();
            $('.edit_ward_block').hide();
            $('.edit_school_block').hide();
            $(".provinceList").empty().trigger('change')
            $(".districtList").empty().trigger('change')
            $(".localBodyList").empty().trigger('change')
            $(".wardList").empty().trigger('change')
            $(".schoolList").empty().trigger('change')
            var clientCode = 2;
            var roleLevel = document.getElementById("edit_role_level").value;
            if(clientCode !== '' && roleLevel == 6) {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.post(site_url + '/app/get_role_list', {
                    clientCode: clientCode, roleLevel: roleLevel, _token: token
                }, function (status) {
                    $('.roleList').html(status);
                    $('.roleList').prop('disabled', false);
                });
            }
        }
    }

})
