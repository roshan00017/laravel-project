$(".fileSubmit").on("submit", function (e) {
  e.preventDefault();
  $("#addModal").modal("hide");
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
        window.location.href = "/finalVerdictFile";
        toastr.success(response.message);
      }
    },
    error: function (response) {
      window.location.href = '/finalVerdictFile';
      toastr.error(response.message);
    },
  });
});
