$(".statusUpdate").on("change", function () {
  const status = $(this).val();
  if (status == 2 || status == 3 || status == 4) {
    $(".reasonBlock").show();
    $("#remark").prop("required", true);
    if (status == 3 || status == 4) {
      $(".nepaliDate").show();
      $("#bs_date").prop("required", true);
      $(".englishDate").show();
      $("#ad_date").prop("required", true);
    } else {
      $(".nepaliDate").hide();
      $("#bs_date").prop("required", false);
      $(".englishDate").hide();
      $("#ad_date").prop("required", false);
    }
  } else {
    $(".reasonBlock").hide();
    $("#remark").prop("required", false);
    $(".nepaliDate").hide();
    $("#bs_date").prop("required", false);
    $(".englishDate").hide();
    $("#ad_date").prop("required", false);
  }
});

$(".agendaUpdate").on("submit", function (e) {
  e.preventDefault();
  $(".statusUpdateModal").modal("hide");
  $("#dataSubmitModal").modal("show");
  $.ajax({
    type: "POST",
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    data: new FormData(this),
    dataType: "JSON",
    contentType: false,
    cache: false,
    processData: false,
    url: $(this).attr("action"),
    success: (response) => {
      if (response) {
        window.location.href = "/meetings";
        toastr.success(response.message);
      }
    },
    error: function (response) {
      // window.location.href = '/meetings';
      // toastr.error(response.message);
    },
  });
});

$("document").ready(function () {
  $(".englishDatePicker").datepicker({
    dateFormat: "yy-mm-dd",
    autoClose: true,
    changeMonth: true,
    changeYear: true,
    minDate: 0,
  });
});
$(".englishDatePicker").inputmask("yyyy-mm-dd", { placeholder: "YYYY-MM-DD" });
$(".nepaliDatePicker").inputmask("9999-99-99", { placeholder: "YYYY-MM-DD" });

$("#date_bs").change(function () {
  convertBsToAd($(this).val(), "#date_ad");
});

$("#date_ad").change(function () {
  convertAdToBs($(this).val(), "#date_bs");
});

const date_bs = document.getElementById("date_bs");
date_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,
  disableDaysBefore: 0,

  onChange: function () {
    const date = date_bs.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#date_ad").val(bsToAd);
  },
});
