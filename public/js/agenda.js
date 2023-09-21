let i = 0;
$(".dynamic-ar").click(function () {
  ++i;
  $(".dynamicAddRemove").append(
    "<tr><td>" +
      '<input type="text" name="addMeetingAgendas[' +
      i +
      '][agenda_title]" class="form-control" /></td>' +
      '<td><textarea name="addMeetingAgendas[' +
      i +
      '][description]" class="form-control" /></td>' +
      '<td><button type="button" class="btn btn-danger remove-input-field rounded-pill">मेटाउने ?</button></td>' +
      "</tr>"
  );
});
$(document).on("click", ".remove-input-field", function () {
  $(this).parents("tr").remove();
});