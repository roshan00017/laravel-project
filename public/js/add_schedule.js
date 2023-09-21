$(document).ready(function () {
  let i = 0;
  // Add new row
  $(document).on("click", ".addRow", function () {
    ++i;
    let html =
      "<tr>" +
      '<td width="30%">' +
      '<input type="text" name="dailySchedule[' +
      i +
      '][title]" class="form-control" autocomplete="off" />' +
      "</td>" +
      '<td width="10%">' +
      '<input type="time" name="dailySchedule[' +
      i +
      '][start_time]" class="form-control" autocomplete="off" />' +
      "</td>" +
      '<td width="10%">' +
      '<input type="time" name="dailySchedule[' +
      i +
      '][end_time]" class="form-control" autocomplete="off" />' +
      "</td>" +
      '<td width="20%">' +
      '<input type="text" name="dailySchedule[' +
      i +
      '][location]" class="form-control" autocomplete="off" />' +
      "</td>";
    i +
      '][schedule_end_date_en]" class="form-control" autocomplete="off" />' +
      "</td>";

    if ($(".dynamicAddRemove tr").length === 1) {
      html +=
        "<td wu>" +
        '<button type="button" class="btn btn-sm btn-success rounded-pill addRow f-kalimati">' +
        addText +
        "</button>" +
        "</td>";
    } else {
      html +=
        "<td>" +
        '<button type="button" class="btn btn-sm btn-success rounded-pill addRow f-kalimati">' +
        addText +
        "</button>" +
        '<span style="display: inline-block; width: 10px;"></span>' +
        '<button type="button" class="btn btn-sm btn-danger rounded-pill removeRow f-kalimati">' +
        removeText +
        "</button>" +
        "</td>";
    }

    html += "</tr>";

    $(".dynamicAddRemove").append(html);
  });

  // Remove row
  $(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
  });
});
