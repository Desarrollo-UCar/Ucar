/**
 * funciones del calendrio y del relog
 */

$(function () {
    $('#datetimepicker_fechaRecogida').datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: false
    });
});

$(function () {
    $('#datetimepicker_fechaDevolucion').datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false
    });
});

$("#datetimepicker_fechaRecogida").on("dp.change", function (e) {
    $('#datetimepicker_fechaRecogida').data("DateTimePicker").minDate('now');
    $('#datetimepicker_fechaDevolucion').data("DateTimePicker").minDate(e.date);
});


$("#datetimepicker_fechaDevolucion").on("dp.change", function (e) {
    $('#datetimepicker_fechaDevolucion').data("DateTimePicker").minDate('now');
    $('#datetimepicker_fechaRecogida').data("DateTimePicker").maxDate(e.date);
});

    $(function () {
      $('#fecha_traslado_salida').datetimepicker({   
            format: 'DD-MM-YYYY',
            minDate: false
        });
    });
