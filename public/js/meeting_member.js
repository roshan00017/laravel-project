$(document).ready(function(){
    $("input:checkbox").change(function() {
        const row_id = $(this).attr("data-id");
        $.ajax({
            type:'POST',
            url:'/updateMemberPresentStatus',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { "id" : row_id },
            success: (response) => {
                if (response) {
                    window.location.href = '/meetingMembers';
                }
            },
            error: function(response) {
                window.location.href = '/meetingMembers';
            }
        });


    });
});


$('document').ready(function() {
    $('input[name="is_karyapalika"]').change(function() {
      $('.hidden-form').show();
      var val = $('input[name="is_karyapalika"]:checked').val();
      if (val == 1) {
        $('.hidden-form').hide();
        $('.karyapalika').show();

        
      } else if (val == 0) {
        
        $('.hidden-form').show();
        $('.karyapalika').hide();
      }
    });
  });


  $(document).ready(function() {
    $('#meeting-select').change(function() {
        var selectedValue = $(this).val();
        var karyapalikaDiv = $('.karyapalika');

        if (selectedValue === '2') {
            karyapalikaDiv.show();
            $('.hidden-form').hide();
        } else {
            karyapalikaDiv.hide();
            $('.hidden-form').show();
        }
    });
});

$('#meeting_code').on('change', function () {
    const meeting_id = $(this).val();
    if (meeting_id !== '') {
        $.post(site_url + '/get_karyapalika_member_list', {
            meeting_id: meeting_id, _token: $('meta[name="csrf-token"]').attr('content')
        }, function (status) {
            if (status.status == true) {
                $('#error').html(status.message);
            } else {
                $('#btn-add').prop('disabled', false);
            }
        });
    }

})
