$(document).ready(function () {
  // Mobile number placeholder
  $("#mobile").on("mouseenter", function () {
    $(this).attr("placeholder", "98xxxxxxxx");
  });

  $("#mobile").on("mouseleave", function () {
    if (!$(this).is(":focus")) {
      $(this).attr("placeholder", "");
    }
  });

  $("#mobile").on("input", function () {
    var inputValue = $(this).val();
    if (inputValue.length > 0 && !inputValue.match(/^(98|9)/)) {
      $(this).val("");
    }
  });
});
