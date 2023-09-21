
$('#meeting_id').on("change", function () {
    const meeting_id = $(this).val();
    if (meeting_id != "") {
        $.post(
            site_url + "/getMeetingDetails",
            {
                meeting_id: meeting_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
                if (status.message.meeting_category_id == 2) {
                    $("#memberAddBlock").hide();
                    $("#memberMessageBlock").show();
                } else {
                    $("#memberAddBlock").show();
                }
            }, 'json'
        );
    }
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




