$(document).ready(function () {
  $('input[name="dailySchedule[0][is_completed_sameday]"]').change(function () {
    if ($(this).val() === "0") {
      $("#schedule_end_date_fields").show();
      $("#end_time_field").show();
    } else {
      $("#schedule_end_date_fields").hide();
      $("#end_time_field").show();
    }
  });

  // Show the corresponding fields based on the initial value
  if (
    $('input[name="dailySchedule[0][is_completed_sameday]"]:checked').val() ===
    "0"
  ) {
    $("#schedule_end_date_fields").show();
    $("#end_time_field").hide();
  } else {
    $("#schedule_end_date_fields").hide();
    $("#end_time_field").show();
  }
});
