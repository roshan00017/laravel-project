$('.mobileNo').inputmask('9999999999', {placeholder: ''});
$('.sendMedium').on('change', function () {
    var medium = $(this).val();
    if (medium !== '') {
        if (medium == 1) {
            $('.individualNumberBlock').show();
            $('.bulkNumberBlock').hide();
            $('.individualMobile').prop('required', true);
            $('.bulkMobile').prop('required', false);
        } else if (medium == 2) {
            $('.individualNumberBlock').hide();
            $('.bulkNumberBlock').show();
            $('.individualMobile').prop('required', false);
            $('.bulkMobile').prop('required', true);
        }
    }

})

$('.submitData').on('submit', function (e) {
    e.preventDefault();
    $("#addModal").modal('hide');
    $("#addMobile").modal('hide');
    $(".updateModal").modal('hide');
    $("#dataSubmitModal").modal('show');
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        url: $(this).attr('action'),
        success: (response) => {
            if (response) {
                if (response.url) {
                    window.location.href = response.url;
                } else {
                    window.location.href = '/phoneSmsManagement';
                }
            }
        },
        error: function (response) {
            window.location.href = '/phoneSmsManagement';
        }
    });
});

$('.phoneSmsService').on('change', function () {

    const val = $('input[name=create_campaign]:checked').val();
    if (val == 1) {
        $('.serviceList').show();
        $('.service').prop('required', true);
    } else {
        $('.serviceList').hide();
        $('.service').prop('required', false);
    }
});


/* add update new campaign api call */
setInterval(add_update_campaign, 10000);

function add_update_campaign(){
    $.post(
        site_url + "/addUpdateCampaign",
        {
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        function (status) {
        }
    );
}

setInterval(add_update_campaign_number, 10000);

function add_update_campaign_number() {
    const campaign_id = $('#campaign_id').val();
    if (campaign_id != '') {

        $.post(
            site_url + "/addUpdateCampaignNumber",
            {
                campaign_id: campaign_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
            }
        );
    }
}

setInterval(delete_campaign, 10000);

function delete_campaign() {

        $.post(
            site_url + "/deleteCampaign",
            {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
            }
        );
}

setInterval(delete_campaign_number, 10000);

function delete_campaign_number() {

    $.post(
        site_url + "/deleteCampaignNumber",
        {
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        function (status) {
        }
    );
}

window.setTimeout(function () {
    window.location.reload();
}, 100000);