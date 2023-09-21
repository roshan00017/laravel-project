$(".complaint_status").change(function () {
  if (this.value == "3") {
    $(".detailsBlock").show();
    $(".officeBlock").show();
     $('.details').prop('required',true);
     $('.office').prop('required',true);
  } else {
    $(".detailsBlock").hide();
    $(".officeBlock").hide();
    $('.details').prop('required',false);
    $('.office').prop('required',false);
  }
});

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
$("#mobile").inputmask("9999999999", { placeholder: "98xxxxxxxx" });

const date_bs = document.getElementById("date_bs");
date_bs.nepaliDatePicker({
  dateFormat: "YYYY-MM-DD",
  ndpYear: true,
  ndpMonth: true,
  ndpYearCount: 100,

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

$("#date_bs").change(function () {
  convertBsToAd($(this).val(), "#date_ad");
});

$("#date_ad").change(function () {
  convertAdToBs($(this).val(), "#date_bs");
});

$(function () {
  $('.select2').select2()
});
$('.select2-single').select2({
  // placeholder: placeholder,
  width: '100%',
  containerCssClass: ':all:'
});

var checkbox1 = document.getElementById("checkbox1");
var formContainer1 = document.querySelector(".autoUpdate");

checkbox1.addEventListener("change", function () {
  if (checkbox1.checked) {
    formContainer1.style.display = "none";
  } else {
    formContainer1.style.display = "flex";
  }
});

var checkbox2 = document.getElementById("checkbox2");
var formContainer2 = document.querySelector(".followUp");

checkbox2.addEventListener("change", function () {
  if (checkbox2.checked) {
    formContainer2.style.display = "inline-flex";
  } else {
    formContainer2.style.display = "none";
  }
});

$(function () {
  //country selector
  $(".countrySelector").on("change", function () {
    if (this.value == "1") {
      $("#provinceBlock").show();
      $("#districtBlock").show();
      $("#localBodyBlock").show();
      $("#wardBlock").show();
      $("#fed_permanent_province_id").prop("required", true);
      $("#fed_permanent_district_id").prop("required", true);
      $("#fed_permanent_vdc_mun_id").prop("required", true);
      $("#wardNo").prop("required", true);
    } else {
      $("#provinceBlock").hide();
      $("#districtBlock").hide();
      $("#localBodyBlock").hide();
      $("#wardBlock").hide();
      $("#fed_permanent_province_id").prop("required", false);
      $("#fed_permanent_district_id").prop("required", false);
      $("#fed_permanent_vdc_mun_id").prop("required", false);
      $("#wardNo").prop("required", false);
    }
  });

  if ($(".countrySelector").value == "1") {
    $(".showDetails").show();
  } else {
    $(".showDetails").hide();
  }
});

//office Unknown
if ($("#office_unknown").is(":checked")) {
  $(".officeInfo").hide();
} else {
  $(".officeInfo").show();
}

$("#office_unknown").change(function () {
  if (this.checked) {
    $(".officeInfo").hide();
  } else {
    $(".officeInfo").show();
  }
});
