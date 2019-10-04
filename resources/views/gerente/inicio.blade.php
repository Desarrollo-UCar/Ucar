@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/fullcalendar/dist/fullcalendar.min.css")}}">
    {{-- <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/dist/fullcalendar.min.css")}}"> --}}
    <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/fullcalendar/dist/fullcalendar.print.min.css")}}" media="print">
@endsection

@section('contenido')
<section class="content-header">
    <h1>
      Panel de administracion
      <small>Gerente</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3> <br> </h3>

              <b>Reservaciones</b></p>
            </div>
            <div class="icon">
              <i class="	fa fa-clipboard"></i>
            </div>
            <a href="{{ route('reservacion.index')}}" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
              <h3><br></h3>
              <p><b>Vehiculos</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-car"></i>
            </div>
            <a href="{{ route('vehiculo.index') }}" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">

                <?php $content = DB::table('clientes')->get(); ?>

            <h3>{{count($content)}}</h3>

              <p>Clientes Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('cliente.index')}}" class="small-box-footer">Ver mas<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>0</h3>

              <p>Visitas a la página</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-body ">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        
      </div>


    </section>
@endsection

@section('scripts')

<!-- fullCalendar -->
<script src="{{asset("assets/$theme/bower_components/moment/moment.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/fullcalendar/dist/fullcalendar.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("assets/$theme/bower_components/jquery-ui/jquery-ui.min.js")}}"></script>


<script>
  $(function () {
    @json($reservaciones);
    var arr = [];
arr[0] = "Oranges";
console.log(arr); 

var obj; 
obj ={hola:1};
console.log(obj); 
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week : 'Semana',
        day  : 'Dia'
      },
      
      //Random default events
      events    : [
        @foreach($reservaciones as $reservacion)
        
                {
                 @if($reservacion->estatus_alquiler =='espera')
                    title : 'Reservacion {{$reservacion->id}}',
                    start : '{{$reservacion->fecha_recogida}}T{{$reservacion->hora_recogida}}',
                    backgroundColor:  '#0073b7', //blue
                    borderColor    :  '#0073b7' //bluesw
                @endif

                @if($reservacion->estatus_alquiler =='terminado')
                    title : 'Reservacion {{$reservacion->id}}',
                    start : '{{$reservacion->fecha_recogida}}T{{$reservacion->hora_recogida}}',
                    backgroundColor:  '#00a65a', //green
                    borderColor    :  '#00a65a' //red
                @endif

                @if($reservacion->estatus_alquiler =='cancelado')
                    title : 'Reservacion {{$reservacion->id}}',
                    start : '{{$reservacion->fecha_recogida}}T{{$reservacion->hora_recogida}}',
                    backgroundColor:  '#f56954', //green
                    borderColor    :  '#f39c12' //red
                @endif

                @if($reservacion->estatus_alquiler =='en curso')
                    title : 'Reservacion {{$reservacion->id}}',
                    start : '{{$reservacion->fecha_devolucion}}T{{$reservacion->hora_devolucion}}',
                    backgroundColor:  '#FFC100', //green
                    borderColor    :  '#f39c12' //red
                @endif
                },
        
                @endforeach

      ],
      // editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

@endsection