$(document).ready(function () {
  $('input[name="status"]').on("change", function () {
    var isChecked = $(this).val() === "0";
    $("#dateFields").toggle(isChecked);

    if (isChecked) {
      $("#dateFields input").prop("required", true);
    } else {
      $("#dateFields input").prop("required", false);
    }
  });

  // Initially set the date fields as not required
  $("#dateFields input").prop("required", false);
});
