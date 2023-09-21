$(document).ready(function () {
  // Mobile number placeholder
  $("#contact_no").on("mouseenter", function () {
    $(this).attr("placeholder", "98xxxxxxxx");
  });

  $("#contact_no").on("mouseleave", function () {
    if (!$(this).is(":focus")) {
      $(this).attr("placeholder", "");
    }
  });

  $("#contact_no").on("input", function () {
    var inputValue = $(this).val();
    if (inputValue.length > 0 && !inputValue.match(/^(98|9)/)) {
      $(this).val("");
    }
  });
});
