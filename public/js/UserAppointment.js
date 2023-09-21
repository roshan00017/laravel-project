$(".department").on("change", function () {
    const department = $(this).val();
    if (department !== "") {
      if (department == "om") {
        $(".postBlock_elected").hide();
        $(".postBlock_office").show();
        $(".employeeBlock").show();
        $(".electedPersonBlock").hide();
      } else if (department == "km") {
        $(".postBlock_elected").show();
        $(".postBlock_office").hide();
        $(".employeeBlock").hide();
        $(".electedPersonBlock").show();
      }
    }
  });


 
  $(".employee_designation").on("change", function () {
    const employee_designation = $(this).val();
    if (employee_designation !== "") {
      $(".electedPersonBlock").hide();
      $(".employeeBlock").show();
  
    }
  });
  
  $(".elected_designation").on("change", function () {
    const elected_designation = $(this).val();
    if (elected_designation !== "") {
      $(".electedPersonBlock").show();
      $(".employeeBlock").hide();
    }
  });
  
  $(".employee_designation").on("change", function () {
    const emp_designation = $(this).val();
    if (emp_designation != "") {
      $.post(
        site_url + "/getEmpName",
        {
          emp_designation: emp_designation,
          _token: $('meta[name="csrf-token"]').attr("content"),
        },
        function (status) {
          $(".employee_id").html(status);
          $(".employee_id").prop("disabled", false);
        }
      );
    }
  });
  
  $(".elected_designation").on("change", function () {
    const elected_designation = $(this).val();
    if (elected_designation != "") {
      $.post(
          site_url + "/getElectedPerson",
          {
            elected_designation: elected_designation,
            _token: $('meta[name="csrf-token"]').attr("content"),
          },
          function (status) {
            $(".elected_person_id").html(status);
            $(".elected_person_id").prop("disabled", false);
          }
      );
    }
  });

  
  
  
