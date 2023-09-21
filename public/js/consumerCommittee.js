$("document").ready(function () {
  $(".englishDatePicker").datepicker({
    dateFormat: "yy-mm-dd",
    autoClose: true,
    changeMonth: true,
    changeYear: true,
  });
});


$(".englishDatePicker").inputmask("yyyy-mm-dd", { placeholder: "YYYY-MM-DD" });
$(".nepaliDatePicker").inputmask("9999-99-99", { placeholder: "YYYY-MM-DD" });

const date_from_bs = document.getElementById("date_from_bs");
date_from_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,

  onChange: function () {
    const date = date_from_bs.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#date_from_ad").val(bsToAd);
  },
});



const date_to_bs = document.getElementById("date_to_bs");
date_to_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,

  onChange: function () {
    const date = date_to_bs.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#date_to_ad").val(bsToAd);
  },
});



$("#date_from_bs").change(function () {
  convertBsToAd($(this).val(), "#date_from_ad");
});

$("#date_to_bs").change(function () {
  convertBsToAd($(this).val(), "#date_to_ad");
});


$("#date_from_ad").change(function () {
  convertAdToBs($(this).val(), "#date_from_bs");
});

$("#date_to_ad").change(function () {
  convertAdToBs($(this).val(), "#date_to_bs");
});