$("#identity").on("change", function () {
  const identity = $(this).val();
  const role = $("#role").val();
  if (identity !== "" && role !== "") {
    $.post(
      site_url + "check_identity",
      {
        identity: identity,
        role: role,
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        if (status.success === false) {
          $("#identity").val("");
          $("#bnt-submit").prop("disabled", true);
          $("#error").html(status.message);
          $("#check_data_modal").modal("show");
          setTimeout(function () {
            $("#check_data_modal").modal("hide");
          }, 5000);
        } else {
          $("#bnt-submit").prop("disabled", false);
        }
      }
    );
  } else {
    $("#bnt-submit").prop("disabled", true);
  }
});

$("#login_user_name").on("change", function () {
  var login_user_name = $(this).val();
  var login_user_type = "user";
  if (login_user_name !== "") {
    $.post(
      site_url + "/check_login_user_name",
      {
        login_user_name: login_user_name,
        login_user_type: login_user_type,
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        if (status.status == true) {
          $("#error").html(status.message);
          $("#check_data_modal").modal("show");
          $("#login_user_name").val("");
          $("#btn-add").prop("disabled", true);
          setTimeout(function () {
            $("#check_data_modal").modal("hide");
          }, 5000);
        } else {
          $("#btn-add").prop("disabled", false);
        }
      }
    );
  }
});
$("#email").on("change", function () {
  const email = $(this).val();
  const login_user_type = "user";
  if (email != "") {
    $.post(
      site_url + "/check_email",
      {
        email: email,
        login_user_type: login_user_type,
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        if (status.status == true) {
          $("#error").html(status.message);
          $("#check_data_modal").modal("show");
          $("#email").val("");
          $("#btn-add").prop("disabled", true);
          setTimeout(function () {
            $("#check_data_modal").modal("hide");
          }, 5000);
        } else {
          $("#btn-add").prop("disabled", false);
        }
      }
    );
  }
});

$("#app_name").on("change", function () {
  const app_name = $(this).val();

  if (app_name !== "") {
    $.post(
      site_url + "/check_api_app_name",
      {
        app_name: app_name,
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        if (status.status === true) {
          $("#error").html(status.message);
          $("#check_data_modal").modal("show");
          $("#app_name").val("");
          $("#btn-add").prop("disabled", true);
          setTimeout(function () {
            $("#check_data_modal").modal("hide");
          }, 5000);
        } else {
          $("#btn-add").prop("disabled", false);
        }
      }
    );
  }
});

$("#edit_app_name").on("change", function () {
  const app_name = $(this).val();

  if (app_name !== "") {
    $.post(
      site_url + "/check_api_app_name",
      {
        app_name: app_name,
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        if (status.status === true) {
          $("#error").html(status.message);
          $("#check_data_modal").modal("show");
          $("#app_name").val("");
          $("#btn-update").prop("disabled", true);
          setTimeout(function () {
            $("#check_data_modal").modal("hide");
          }, 5000);
        } else {
          $("#btn-update").prop("disabled", false);
        }
      }
    );
  }
});
$("#mobile").on("change", function () {
  const mobile = $(this).val();
  if (mobile !== "") {
    $.post(
      site_url + "/check_mobile",
      {
        mobile: mobile,
        _token: $('meta[name="csrf-token"]').attr("content"),
      },
      function (status) {
        if (status.status === true) {
          $("#error").html(status.message);
          $("#check_data_modal").modal("show");
          $("#mobile").val("");
          $("#btn-add").prop("disabled", true);
          setTimeout(function () {
            $("#check_data_modal").modal("hide");
          }, 5000);
        } else {
          $("#btn-add").prop("disabled", false);
        }
      }
    );
  }
});
