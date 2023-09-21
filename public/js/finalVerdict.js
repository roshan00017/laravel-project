$(document).ready(function () {
    $("#meeting_code").on("change", function () {
        const meeting_id = $(this).val();
        if (meeting_id != '') {
            $.post(site_url + '/agendaListByMeeting', {
                meeting_id: meeting_id, _token: $('meta[name="csrf-token"]').attr('content')
            }, function (status) {
                $('#agenda_title').html(status.result);
                $('#agenda_title').prop('disabled', false);
                $('#meeting_member').html(status.result1);
                $('#agenda_title').prop('disabled', false);
            });
        }
    });
});

$(document).ready(function () {
    $("#agenda_title").on("change", function () {
        const meeting_id = $(this).val();
        if (meeting_id != '') {

            $('#meeting_member').prop('disabled', false);
        }
    });
});


$(document).ready(function () {
    $("#meetingCode").on("change", function () {
        const meeting_id = $(this).val();
        // alert(meeting_id);
        if (meeting_id != '') {
            $.post(site_url + '/meetingAgenda', {
                meeting_id: meeting_id, _token: $('meta[name="csrf-token"]').attr('content')
            }, function (status) {
                $('#ajendList').html(status.result);
               
            });
        }
    });
});

$(document).on("click",'.addMore', function () {
    var ajendaId = $(this).attr('data-id');
    var cloneHtml = $('#cloneFeedback_'+ajendaId).html();
    // alert(cloneHtml);
    $('#ajendaFeedback_'+ajendaId).append('<tr>'+cloneHtml+'</tr>');
});
$(document).on("click",'.removefed', function () {   
    $(this).parent().parent().remove();
});