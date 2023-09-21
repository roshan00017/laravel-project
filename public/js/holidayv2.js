$(document).ready(function () {
  // Function to show or hide select fields based on the selected holiday type
  function showHideSelectFields(holidayType) {
    // Hide all select fields
    $('[id$="_only"]').hide();

    // Show the select field based on the selected holiday type
    $("#" + holidayType).show();

    // Trigger change event on the shown select field to refresh its value display
    $("#" + holidayType + " select")
      .select2("destroy")
      .select2();
  }

  // Event handler for holiday type field change
  $("#holidayTypeId").on("change", function () {
    var holidayType = $(this).val();
    showHideSelectFields(holidayType);
  });

  // Initially show or hide select fields based on the selected holiday type
  var initialHolidayType = $("#holidayTypeId").val();
  showHideSelectFields(initialHolidayType);
});
