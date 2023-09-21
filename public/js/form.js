$(document).ready(function () {
  // Uncheck both buttons initially
  $("#person-radio").prop("checked", true);
  $("#office-radio").prop("checked", false);

  // Show/hide fields based on radio button selection
  $("#person-radio").click(function () {
    $("#person-details").show();
    $("#office-details").hide();
    $("#office-select").hide();
  });

  $("#office-radio").click(function () {
    $("#person-details").hide();
    $("#office-details").show();
    $("#office-select").show();
  });

  // Initial setup
  $("#person-details").show();
  $("#office-details").hide();
  $("#office-select").hide();
});
