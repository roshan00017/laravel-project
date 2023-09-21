$("#department").on("change", function () {
    const department = $(this).val();
    if (department !== "") {
        if (department == "om") {
            $("#postBlock_elected").hide();
            $("#postBlock_office").show();
            $("#employeeBlock").show();
            $("#electedPersonBlock").hide();
        } else if (department == "km") {
            $("#postBlock_elected").show();
            $("#postBlock_office").hide();
            $("#employeeBlock").hide();
            $("#electedPersonBlock").show();
        }
    }
});

$("#employee_designation").on("change", function () {
    const employee_designation = $(this).val();
    if (employee_designation !== "") {
        $("#electedPersonBlock").hide();
        $("#employeeBlock").show();

    }
});

$("#elected_designation").on("change", function () {
    const elected_designation = $(this).val();
    if (elected_designation !== "") {
        $("#electedPersonBlock").show();
        $("#employeeBlock").hide();

    }
});
$("#employee_designation").on("change", function () {
    const emp_designation = $(this).val();
    if (emp_designation != "") {
        $.post(
            site_url + "/getEmpName",
            {
                emp_designation: emp_designation,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
                $("#employee_id").html(status);
                $("#employee_id").prop("disabled", false);
            }
        );
    }
});

$("#elected_designation").on("change", function () {
    const elected_designation = $(this).val();
    if (elected_designation != "") {
        $.post(
            site_url + "/getElectedPerson",
            {
                elected_designation: elected_designation,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
                console.log(status)
                $("#elected_person_id").html(status);
                $("#elected_person_id").prop("disabled", false);
            }
        );
    }
});

$('#mobile_no').on("change", function () {
    const mobile = $(this).val();
    if (mobile != "") {
        $.post(
            site_url + "/checkAppointmentByMobile",
            {
                mobile: mobile,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
               if(status.status ==true){
                   $("#name").val(status.message.name);
                   if(status.message.name !=null)
                   {
                       $("#name").prop("readonly", true);
                   }
                   $("#address").val(status.message.address);
                   if(status.message.address !=null)
                   {
                       $("#address").prop("readonly", true);
                   }
                   $("#email").val(status.message.email);
                   if(status.message.email !=null)
                   {
                       $("#email").prop("readonly", true);
                   }
                   $("#mobile").val(status.message.mobile);
                   if(status.message.mobile !=null)
                   {
                       $("#mobile").prop("readonly", true);
                   }
               }else{
                   $("#error").html(status.message);
                   $("#check_data_modal").modal("show");
                   $("#mobile").val("");
                   $("#name").val("");
                   $("#email").val("");
                   $("#address").val("");

                   $("#name").prop("readonly", false);
                   $("#email").prop("readonly", false);
                   $("#address").prop("readonly", false);
                   $("#mobile").prop("readonly", false);
                   setTimeout(function () {
                       $("#check_data_modal").modal("hide");
                   }, 5000);
               }
            }
        );
    }
});


$('.email').on("change", function () {
    const email = $(this).val();
    if (email != "") {
        $.post(
            site_url + "/checkAppointmentByEmail",
            {
                email: email,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            function (status) {
               if(status.status ==true){
                   $("#name").val(status.message.name);
                   if(status.message.name !=null)
                   {
                       $("#name").prop("readonly", true);
                   }
                   $("#address").val(status.message.address);
                   if(status.message.address !=null)
                   {
                       $("#address").prop("readonly", true);
                   }
                   $("#email").val(status.message.email);
                   if(status.message.email !=null)
                   {
                       $("#email").prop("readonly", true);
                   }
                   $("#mobile").val(status.message.mobile);
                   if(status.message.mobile !=null)
                   {
                       $("#mobile").prop("readonly", true);
                   }
               }else{
                   $("#error").html(status.message);
                   $("#check_data_modal").modal("show");
                   $("#mobile").val("");
                   $("#name").val("");
                   $("#email").val("");
                   $("#address").val("");
                   
                   $("#name").prop("readonly", false);
                   $("#email").prop("readonly", false);
                   $("#address").prop("readonly", false);
                   $("#mobile").prop("readonly", false);
                   setTimeout(function () {
                       $("#check_data_modal").modal("hide");
                   }, 5000);
               }
            }
        );
    }
});


$(function () {
    $('.select2').select2()
});