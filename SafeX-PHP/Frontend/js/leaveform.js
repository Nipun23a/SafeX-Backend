$(document).ready(function () {
    // Initialize date picker for 'From' input
    $('#fromDatePicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true
    });

    // Initialize date picker for 'To' input
    $('#toDatePicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true
    });
});