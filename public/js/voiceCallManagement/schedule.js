$('.schedule').on('change', function () {
    const val = $('input[name=is_schedule]:checked').val();
    if(val ==1)
    {
        $(".dateBlock").show();
        $(".timeBlock").show();
        $('.schedule_time').prop('required',true);
    }else{

        $(".dateBlock").hide();
        $(".timeBlock").hide();
        $('.schedule_time').prop('required',false);
    }
});

$("document").ready(function () {
    $("#date_ad").datepicker({
        dateFormat: "yy-mm-dd",
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        minDate: 0,
    });
});
const date_bs = document.getElementById("date_bs");
date_bs.nepaliDatePicker({
    dateFormat: "YYYY-MM-DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 100,
    disableDaysBefore: 0,
});