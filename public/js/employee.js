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

const dob_bs = document.getElementById("dob_bs");
dob_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,

  onChange: function () {
    const date = dob_bs.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#dob_ad").val(bsToAd);
  },
});

$("#dob_bs").change(function () {
  convertBsToAd($(this).val(), "#dob_ad");
});

$("#dob_ad").change(function () {
  convertAdToBs($(this).val(), "#dob_bs");
});

//edit---------------------------------------

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

const dob_bs_e = document.getElementById("dob_bs_e");
dob_bs_e.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,

  onChange: function () {
    const date = dob_bs_e.value;
    const arr = date.split("-");
    const bsToAd = NepaliFunctions.ConvertDateFormat(
      NepaliFunctions.BS2AD({
        year: arr[0],
        month: arr[1],
        day: arr[2],
      })
    );
    $("#dob_ad").val(bsToAd);
  },
});

$("#dob_bs_e").change(function () {
  convertBsToAd($(this).val(), "#dob_ad_e");
});

$("#dob_ad_e").change(function () {
  convertAdToBs($(this).val(), "#dob_bs_e");
});
