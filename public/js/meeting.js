$(document).ready(function () {
  let i = 0;

  $(document).on("click", ".dynamic-ar", function () {
    ++i;
    let html = `<tr>
         <td width="40%">
           <input type="text" name="addMeetingAgendas[${i}][agenda_title]" class="form-control" autocomplete="off" />
         </td>
         <td width="40%">
           <textarea type="text" name="addMeetingAgendas[${i}][description]" class="form-control" autocomplete="off" rows="1"></textarea>
         </td>
         <td>`;

    if ($(".dynamicAddRemove tr").length === 1) {
      html += `<button type="button" class="btn btn-success btn-sm rounded-pill dynamic-ar">${addText}</button>`;
    } else {
      html += `<button type="button" class="btn btn-success btn-sm rounded-pill dynamic-ar">${addText}</button>
               <span style="display: inline-block; width: 10px;"></span>
               <button type="button" class="btn btn-sm btn-danger rounded-pill removeRow">${removeText}</button>`;
    }

    html += `</td>
            </tr>`;

    $(".dynamicAddRemove").append(html);
  });

  $(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
  });

  let j = 0;

  $(document).on("click", ".dynamic-arMembers", function () {
    ++j;
    let html = `<tr>
      <td><input type="text" name="addMeetingMembers[${j}][name_en]" class="form-control" /></td>
      <td><input type="text" name="addMeetingMembers[${j}][name_np]" class="form-control" /></td>
      <td><input type="text" name="addMeetingMembers[${j}][office]" class="form-control" /></td>
      <td><input type="text" name="addMeetingMembers[${j}][post]" class="form-control" /></td>
      <td><input type="text"  name="addMeetingMembers[${j}][contact_no]" class="form-control mobileNo" /></td>
      <td><input type="text" name="addMeetingMembers[${j}][email]" class="form-control" /></td>
      <td>
        <input class="radio-button f-kalimati" name="addMeetingMembers[${j}][is_invite]" type="radio" checked value="1" style="margin-top: 2px"> &nbsp;${yes}</br>
        <input class="radio-button f-kalimati" name="addMeetingMembers[${j}][is_invite]" type="radio" value="0" style="margin-top: 2px"> &nbsp;${no}
      </td>
      <td>`;

  if ($(".dynamicAddRemoveMembers tr").length === 1) {
    html += `<button type="button" class="btn btn-success btn-sm rounded-pill dynamic-arMembers">${addText}</button>`;
  } else {
    html += `<button type="button" class="btn btn-success  btn-sm rounded-pill dynamic-arMembers">${addText}</button>
             <span style="display: inline-block; width: 10px;"></span>
             <button type="button" class="btn btn-danger  btn-sm remove-input-field f-kalimati rounded-pill">${removeText}</button>`;
  }

    html += `</td>
           </tr>`;

    $(".dynamicAddRemoveMembers").append(html);
  });

  $(document).on("click", ".remove-input-field", function () {
    $(this).closest("tr").remove();
  });
});

function offline() {
  $(".meetingMode").hide();
  $(".gnBtn").hide();
  $(".isPassword").hide();
}

function online() {
  $(".meetingMode").show();
  $(".gnBtn").show();
  $(".isPassword").show();
}
function online() {
  $(".meetingMode").show();
  $(".gnBtn").show();
  $(".isPassword").show();
}

$('.isPassword').on('change', function () {
  const val = $('input[name=meeting_password_available]:checked').val();
  if(val ==1)
  {
    $(".passwordGen").show();
  }else{
    $(".passwordGen").hide();
  }
});

$('#meeting_category').on("change", function () {
  const meeting_category = $(this).val();
  if (meeting_category != "" && meeting_category ==2) {
    $("#memberAddBlock").hide();
  }else{
    $("#memberAddBlock").show();
  }
});


$("#proposed_date_bs").change(function () {
  convertBsToAd($(this).val(), "#date_from_ad");
});

$("#date_bs").change(function () {
  convertBsToAd($(this).val(), "#date_ad");
});

$("#bs_date").change(function () {
  convertBsToAd($(this).val(), "#ad_date");
});

$("#proposed_date_ad").change(function () {
  convertAdToBs($(this).val(), "#proposed_date_bs");
});

$("#date_ad").change(function () {
  convertAdToBs($(this).val(), "#date_bs");
});

$("#ad_date").change(function () {
  convertAdToBs($(this).val(), "#bs_date");
});

$(document).ready(function () {
  $("button").click(function () {
    $.post(
      site_url + "/generateMeetingLink",
      {
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        $("#meetingUrl").val(status.data);
      }
    );
  });
});

$(".mobileNo").inputmask("9999999999", { placeholder: "98xxxxxxxx" });

$("#agendaUpdate").on("submit", function (e) {
  e.preventDefault();
  $("#dataSubmitModal").modal("show");
  $.ajax({
    type: "POST",
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    data: new FormData(this),
    dataType: "JSON",
    contentType: false,
    cache: false,
    processData: false,
    url: $(this).attr("action"),
    success: (response) => {
      if (response) {
        window.location.href = "/meetings";
        toastr.success(response.message);
      }
    },
    error: function (response) {
      window.location.href = "/meetings";
      toastr.error(response.message);
    },
  });
});

$(document).on("click", ".remove-input-field", function () {
  $(this).parents("tr").remove();
});

$(document).on("click", ".remove-input-field", function () {
  $(this).parents("tr").remove();
});

$("document").ready(function () {
  $(".englishDatePicker").datepicker({
    dateFormat: "yy-mm-dd",
    autoClose: true,
    changeMonth: true,
    changeYear: true,
    minDate: 0,
  });
});
$(".englishDatePicker").inputmask("yyyy-mm-dd", { placeholder: "YYYY-MM-DD" });
$(".nepaliDatePicker").inputmask("9999-99-99", { placeholder: "YYYY-MM-DD" });

const proposed_date_bs = document.getElementById("proposed_date_bs");
proposed_date_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,
  disableDaysBefore: 0,

  onChange: function () {
    const date = proposed_date_bs.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#proposed_date_ad").val(bsToAd);
  },
});

const date_bs = document.getElementById("date_bs");
date_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,
  disableDaysBefore: 0,

  onChange: function () {
    const date = date_bs.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#date_ad").val(bsToAd);
  },
});
