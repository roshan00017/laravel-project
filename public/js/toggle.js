$(document).ready(function () {
  $("#status-thik").change(function () {
    if ($(this).is(":checked")) {
      $("#country-id-wrapper").show();
    } else {
      $("#country-id-wrapper").hide();
    }
  });

  $("#status-xaina").change(function () {
    if ($(this).is(":checked")) {
      $("#country-id-wrapper").hide();
    }
  });
});
