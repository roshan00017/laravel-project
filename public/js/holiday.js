$(".nepaliDatePicker").inputmask("9999-99-99", { placeholder: "YYYY-MM-DD" });

$(".nepaliDatePicker").nepaliDatePicker({
    dateFormat: "YYYY-MM-DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 100,
    disableDaysAfter: 0,
});

$(".holiday").inputmask("9999-99-99", { placeholder: "YYYY-MM-DD" });

$(".holiday").nepaliDatePicker({
    dateFormat: "YYYY-MM-DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 100,
    disableDaysAfter: 0,
});
