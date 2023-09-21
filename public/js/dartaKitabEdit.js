

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
    