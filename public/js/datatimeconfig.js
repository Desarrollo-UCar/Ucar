/**
 * funciones del calendrio y del relog
 */
    $(function () {
        $('#datetimepicker_fechaRecogida').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: false
        });
    });

    $(function () {
        $('#datetimepicker_horaRecogida').datetimepicker({
            format: 'LT',
            stepping: 30
        });
    });

    $(function () {
        $('#datetimepicker_fechaDevolucion').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: false,
            useCurrent: false
        });
    });

    $(function () {
        $('#datetimepicker_horaDevolucion').datetimepicker({
            format: 'LT',
            stepping: 30
        });
    });

        $("#datetimepicker_fechaRecogida").on("dp.change", function (e) {
            $('#datetimepicker_fechaDevolucion').data("DateTimePicker").minDate(e.date);
        });
   

        $("#datetimepicker_fechaDevolucion").on("dp.change", function (e) {
            $('#datetimepicker_fechaRecogida').data("DateTimePicker").maxDate(e.date);
        });

        $(function () {
          $('#fecha_traslado_salida').datetimepicker({   
                format: 'YYYY-MM-DD',
                minDate: false
            });
        });
    