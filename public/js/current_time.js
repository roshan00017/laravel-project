$(document).ready(function () {
  // Get the current time
  var currentTime = new Date().toLocaleTimeString("np", { hour12: false });

  // Set the current time as the default value
  $('input[type="time"]').attr("value", currentTime);
});
