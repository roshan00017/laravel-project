var site_url = window.location.origin;

$("#fed_permanent_province_id").on("change", function () {
  var fed_permanent_province_id = $(this).val();
  var csrf_token = $('meta[name="csrf-token"]').attr("content");

  $.ajaxSetup({
    headers: {
      "X-CSRF-Token": csrf_token,
    },
  });
  $.post(
    site_url + "/get_fed_district",
    {
      province_id: fed_permanent_province_id,
    },
    function (status) {
      $("#fed_permanent_district_id").html(status);
    }
  );
});
$("#fed_permanent_district_id").on("change", function () {
  var fed_permanent_district_id = $(this).val();
  var csrf_token = $('meta[name="csrf-token"]').attr("content");
  $.ajaxSetup({
    headers: {
      "X-CSRF-Token": csrf_token,
    },
  });
  $.post(
    site_url + "/get_fed_vdc_mun",
    {
      district_id: fed_permanent_district_id,
    },
    function (status) {
      $("#fed_permanent_vdc_mun_id").html(status);
    }
  );
});
