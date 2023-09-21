$("document").ready(function () {
    $("#from_date_en").datepicker({
        dateFormat: 'yy-mm-dd',
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        maxDate:0
    });

    $("#to_date_en").datepicker({
        dateFormat: 'yy-mm-dd',
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        maxDate:0
    });

});

$('.englishDatePicker').inputmask('yyyy-mm-dd', { 'placeholder': 'YYYY-MM-DD' })
$('.nepaliDatePicker').inputmask('9999-99-99', { 'placeholder': 'YYYY-MM-DD' })
var form_date_np = document.getElementById("from_date_np");
form_date_np.nepaliDatePicker({
    dateFormat: "YYYY-MM-DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 100,
    disableDaysAfter: 0,
});
var to_date_np = document.getElementById("to_date_np");
to_date_np.nepaliDatePicker({
    dateFormat: "YYYY-MM-DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 100,
    disableDaysAfter: 0,
});



$('#from_date').on('change', function () {
    var date = $(this).val();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    if(date > today){
        $('#error').html('Date must be less than today\'s date');
        $('#check_data_modal').modal('show');
        $('#from_date').val('');
        $('#btn-search').prop('disabled',true);
        setTimeout(function() {
            $('#check_data_modal').modal('hide');
        }, 5000);
    }else{
        $('#btn-search').prop('disabled',false);
    }
})
$('#to_date').on('change', function () {
    var date = $(this).val();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    if(date > today){
        $('#error').html('Date must be less than today\'s date');
        $('#check_data_modal').modal('show');
        $('#to_date').val('');
        $('#btn-search').prop('disabled',true);
        setTimeout(function() {
            $('#check_data_modal').modal('hide');
        }, 5000);
    }else{
        $('#btn-search').prop('disabled',false);
    }
})


$(function () {
    $('.select2').select2()
});
$('.select2-single').select2({
    // placeholder: placeholder,
    width: '100%',
    containerCssClass: ':all:'
});