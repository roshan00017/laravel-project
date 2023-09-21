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

$('document').ready(function() {
  $('input[name="rep"]').change(function() {
    var val = $('input[name="rep"]:checked').val();
    $('.triggerDiv').hide();
    $('.triggerDiv.type_' + val).show();
  });

  // Show the initial selected form
  var val_ref = $('input[name="rep"]:checked').val();
  $('.triggerDiv.type_' + val_ref).show();
});



$('document').ready(function() {
  $('input[name="is_person"]').change(function() {
    $('.personForm').show();
    var val = $('input[name="is_person"]:checked').val();
    if (val == 1) {
      $('.personForm').show();
      $('.departmentForm').hide();
    } else if (val == 0) {
      $('.personForm').hide();
      $('.departmentForm').show();
    }
  });
});


$('document').ready(function() {
  $('input[name="is_foreign"]').change(function() {

    var val = $('input[name="is_foreign"]:checked').val();
    if (val == 1) {
      $('.CountryForm').show();

    } else if (val == 0) {
      $('.CountryForm').hide();

    }
  });
});



$('document').ready(function() {
  $('input[name="fee_applicable"]').change(function() {

    var val = $('input[name="fee_applicable"]:checked').val();
    if (val == 1) {
      $('.RateForm').show();

    } else if (val == 0) {
      $('.RateForm').hide();

    }
  });
});
  