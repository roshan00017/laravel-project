
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": true,

    })
    $('#example2').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": false,
        "searching": false,
        "info": false,
    });
    $('#example3').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "paging": false,
        "searching": false,
        "info": false,
    });
});

function resetForm(e, thisobj) {
    thisform = thisobj.closest('form');
    selectbox_in_form = thisform.find('select');

    // completely remove selected/input value  when it has been assigned.
    selectbox_in_form.find('option:selected').removeAttr('selected');
    thisform.find('input').removeAttr('value');


    selectbox_in_form.val('');
    selectbox_in_form.change();
    thisform.find('input').val('');
    thisform.find('input').change();



    // delete selectbox_in_form;
    delete thisform.find('input');
    delete thisform;
}
$('#addModal').on('hidden.bs.modal', function () {
    $('#addModal form')[0].reset();
    $(this).find('.select2 option').prop('selected', function(){ return this.defaultSelected; });
    $(".selected").val('').trigger('change')
    $('#btn-add').prop('disabled',false);
    var $remove = $('#addModal');
    $remove.validate().resetForm();
    $remove.find('.is-invalid').removeClass('is-invalid');
});
$('#searchModal').on('hidden.bs.modal', function(){
    $(this)
        .find("input:not([type=hidden]),textarea,select,selector")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    $(".selected").val('').trigger('change')
    $('#btn-search').prop('disabled',false);
});



$('#addForm').validate({
    rules: {
        name_np: {
            required: true,
        },
        name_en: {
            required: true
        },
    },
    messages: {
        name_en: {
            required: 'अंग्रेजी नाम  अनिवार्य छ ।',
        },
        name_np: {
            required: 'नेपाली नाम  अनिवार्य छ ।',
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass) {
        $(element).removeClass('is-invalid');
    }
});
// // BS-Stepper Init
// document.addEventListener('DOMContentLoaded', function () {
//     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
// })









