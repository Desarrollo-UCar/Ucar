@extends("theme.$theme.layout")

<head>
  <title>Reservaciones</title>
</head>

<body>
  
@section('contenido')
  <section class="content-header">
    <h1>
      Panel de administración | <small>Reservaciones</small>

    </h1>
  </section>

  <section class="content">
    @if($alquiler->estatus=='cancelado')
      <div class="alert alert-warning alert-dismissible">
          <h4>¡Reservación cancelada!</h4>
        </div>
        @endif

        @if($alquiler->estatus=='terminado')
        <div class="alert alert-warning alert-dismissible">
            <h4>¡Alquiler terminado!</h4>
          </div>
          @endif
        
    <div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">{{'Detalle Reservación'}} <b>{{$reservacion->id}}</b></h3>
                  </div>
                <div class="box-body">

        <div class="row">

            <div class="col-md-8">

            <h4 >Datos del <a href="">cliente </a></h4>
                   <!-- {{$alquiler->id  }} -->
                   
                   <div class="col-md-6">
                    <label>
                      @if($cliente->credencial==null)
                     Pasaporte
                     @else
                    Identificación
                     @endif cliente</label>
                      <input type="text" name="cliente" id="" class="form-control" disabled value="@if($cliente->credencial==null)
                      {{$cliente->pasaporte}}
                      @else
                      {{$cliente->credencial}}
                      @endif">
                      </div>
                      <div class="col-md-6 form-group">
                      <label>Nombre cliente <!--{{$cliente->idCliente}}--></label>
                      <input type="text" name="cliente" id="" class="form-control" disabled value="{{$cliente->nombre}} {{$cliente->primer_apellido}} {{$cliente->segundo_apellido}}">  
                  </div>

                  <div class="col-md-4 form-group">
                      <label>Nacionalidad</label>
                      <input type="text" name="cliente" id="" class="form-control" disabled value="{{$cliente->pais}}">  
                  </div>

                  <div class="col-md-2 form-group">
                      <label>Edad</label>
                      <input type="text" name="cliente" id="" class="form-control" disabled value="{{$edad}}">  
                  </div>

                  <div class="col-md-6 form-group">
                      <label>Correo</label>
                      <input type="text" name="cliente" id="" class="form-control" disabled value="{{$cliente->correo}}">  
                  </div>
                </div>
                </div>

  
 
         
                  <div class="row">
                      <div class="col-md-8">
                          <h4 ><br>Datos de la reservación</h4>
                  <div class="col-md-6">
                      <label>Fecha Reservación</label>
                      <input type="text" name="fecha Reservacion" id="" class="form-control" disabled value="{{$reservacion->fecha_reservacion}}">
                  </div>
                    
                  <div class="col-md-6  form-group">
                      <label>Precio Total</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->total}}">
                  </div>


                @if($reservacion->saldo==0)
                  <h3>Se pagó el total de la reservación</h3>
                  @endif 
                <div class="col-md-6 form-group">
                    <label>Saldo</label>
                    <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->saldo}}">
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      @if($alquiler->estatus!='cancelado'&&$alquiler->estatus!='terminado')
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning2">
                          <b>Registrar cobro </b>
                        </button>
                        @endif
                      </div>
                    </div>
                      
                        {{-- @if($alquiler->estatus!='terminado')
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning3">
                            <b>Cobrar garantia </b>
                          </button>
                          
                          @endif --}}
                          <button type="button" class="btn btn-sucess" data-toggle="modal" data-target="#pagos">
                              <b>Ver cobros </b>
                            </button>


          
                      </div>
                    </div>

              <div class="row">
                <div class="col-md-8">
                    <h4 ><br>Datos del <a href="">vehículo </a></h4> 


                   <div class="col-md-6 form-group">
                     <label>Tipo</label>
                     <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->tipo}}">
                   </div>

                   <div class="col-md-6 form-group">
                      <label>Modelo</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->marca}} {{$vehiculo->modelo}}">
                    </div>

                    <div class="col-md-6 form-group">
                      <label>Vin</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->vin}}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Placas</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->matricula}}">
                      </div>

                    <div class="col-md-6 form-group">
                      <label>Fecha Entrega</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->fecha_recogida}}">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>Hora</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->hora_recogida}}">
                      </div>
  
                     <div class="col-md-6 form-group">
                       <label>Fecha Devolución</label>
                       <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->fecha_devolucion}}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Hora</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->hora_recogida}}">
                      </div>
                      <div class="col-md-2 form-group">
                          @if($alquiler->estatus!='terminado'&&$alquiler->estatus!='cancelado')
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning4">
                              <b>Cambiar VEHÍCULO</b>
                            </button>
                            @else
                            <button type="button" class="btn btn-danger" data-toggle="modal"  disabled data-target="">
                                <b>Cambiar VEHÍCULO</b>
                                @endif
                            </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-md-8">
                        <h4 ><br>Datos del conductor</h4>

                        <form method="GET" action="{{ route('conductor') }}"  role="form">
                            {{ csrf_field() }}
                            <input name="reservacion" type="hidden" value= "{{$reservacion->id}}">
                            <input name="alquiler" type="hidden" value= "{{$alquiler->id}}">

                        
                  <div class="col-md-6 form-group">
                      <label>Número Licencia</label>
                      @if($alquiler->num_licencia!=null)
                  <input type="text" name="numero" id="" class="form-control" value="{{$alquiler->num_licencia}}"  title="Escriba numero de licencia">
                  @else
                  <input type="text" name="numero" id="" class="form-control" value="{{$alquiler->num_licencia}}"  title="Escriba numero de licencia">
                  @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Nombre conductor</label>
                        @if($alquiler->nombreConductor!=null)
                        <input type="text" name="nombre" id="" class="form-control"  value="{{$alquiler->nombreConductor}} " required>
                        @else
                        <input type="text" name="nombre" id="" class="form-control"  value="" required>
                        @endif
                      </div>

                      
                    <div class="col-md-6 form-group">
                        <label>Fecha expedición</label>
                        @if($alquiler->expedicion_licecncia!=null)
                        <input type="date" name="fecha_e" id="" class="form-control"  value="">
                        @else
                        <input type="date" name="fecha_e" id="" class="form-control"  value="{{date($alquiler->expedicion_licencia)}}">
                        @endif
                      </div>

                      
                    <div class="col-md-6 form-group">
                        <label>Fecha expiración</label>
                        @if($alquiler->expedicion_licecncia1!=null)
                        <input type="date" name="fecha_c" id="" class="form-control"  value="">
                        @else
                        <input type="date" name="fecha_c" id="" class="form-control"  value="{{date($alquiler->expiracion_licencia)}}">
                        @endif
                 </div>
                 @if($alquiler->estatus!='terminado'&&$alquiler->estatus!='cancelado')
                 <button type="submit" class="btn btn-sucess"><span class="glyphicon glyphicon-info-sign"></span>{{'Registrar'}}</button>
                @endif
                  </form>
                  </div>
                </div>


                  <div class="row">
                    <div clas="col-md-8">
                        <h4 ><br>Servicios Extras Reservados </h4>.

                        <div class="col-md-6 form-group">
                            <table border="1">
                                     <body>

                                      <th>Nombre</th>
                                       <th>Descripción</th>
                                       
                                            @if($servicios->count())  
                                            @foreach($servicios as $servicio) 
                                            <tr>
                                        <td>{{$servicio->nombre}}</td>
                                        <td>{{$servicio->descripcion}}</td>
                                        </tr>
                                      @endforeach
                                      @else
                                      <tr>
                                      <td>No hay extras reservados!</td>
                                      </tr>
                                      @endif
                                     </body>

                                      </table>
                        </div>
                    </div>

                  </div>

               
                <div class="row">
                  <div class="col-md-12">
                      <div class="box-footer" style="float: right">

                      @if($alquiler->estatus=="pendiente_recogida")
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">
                        <b>Cancelar</b>
                      </button>
                      @if($alquiler->nombreConductor!="por rellenar"&&$alquiler->expedicion_licencia!="por rellenar"&&$alquiler->num_licencia!="por rellenar"&&$alquiler->expiracion_licencia!="por rellenar"&&$alquiler->estatus!='en curso'&&date("Y-m-d")>=$alquiler->fecha_recogida)
                      <a href="{{route('contrato', $reservacion)}}" class="btn btn-success"><b>Entregar</b></a>
                      @endif
                      @elseif($alquiler->estatus=="en curso")
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#recibir">
                        <b>Recibir</b>
                      </button>
                      @endif
                        </div>                       
                    </div>  
                  </div>  

             
   


        <div class="modal modal-danger fade" id="modal-warning">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title"> <span class="glyphicon glyphicon-alert"></span> <b> {{' Esta seguro de cancelar la reservacion'}}  {{$reservacion->id}}</b> </h4>
                    </div>
                <div class="modal-body">
                  <p><b>{{'La reservación del servicio de alquiler y sus servicios extra serán cancelados'}} </b>&hellip;</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span><b>{{'  Cerrar'}}</b></button>
                  <form method="GET" action="{{ route('cancelaReservacion',$reservacion->id) }}"  role="form">
                      {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-info-sign"></span>{{'  Cancelar'}}</button>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

          <div class="modal modal-warning fade" id="modal-warning2">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> <span class="glyphicon glyphicon-usd"></span> <b> {{'Registrar cobro '}}</b> </h4>
                  </div>
                  <div class="modal-body">

                    
                      <form method="POST" action="{{ route('pagoReservacion') }}"  role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="reservacion" type="hidden" value= "{{$reservacion->id}}">
                    <p><b>{{'Se registrará un nuevo cobro'}} </b>&hellip;</p>

                    <div class="row">
                        <div class="col-md-3">
                      <label>Motivo</label>
                             <select name= "motivo" id="motivo" class="form-control select2" style="width: 100%;">
                        <option value="otro">Otro</option>
                        @if($reservacion->saldo!=0)
                        <option value="saldo">Saldo</option>
                         @endif
                    </select>
 
                  </div>

                  <div class="col-md-3">
                    <label>Datos</label>
                    <input type="text" name="datos" id="" class="form-control"  value="">
                  </div>

                    <div class="col-md-3">
                    <label>Monto</label>
                    @if($reservacion->saldo!=0)
                    <input type="number" name="monto" id="" class="form-control"  value={{$reservacion->saldo}}>
                     @else
                    <input type="number" name="monto" id="" class="form-control"  value="">
                    @endif
                    </div>

                  <div class="col-md-9">
                      <label>Comentario</label>
                      <input type="text" name="comentario" id="" class="form-control"  value="">
                    </div>
  

                  </div>
                  </div>
                  <div class="modal-footer">
                     
                      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{' Registrar cobro'}}</button>
              </form>
    
                  </div>
                </div>
                
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <div class="modal modal-warning fade" id="modal-warning3">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"> <span class="glyphicon glyphicon-usd"></span> <b> {{'Cobro de saldo pendiente por reservación'}}  {{$reservacion->id}}</b> </h4>
                    </div>
                    <div class="modal-body">
                      <p><b>{{'Se registrará un pago por '}} {{$reservacion->saldo}} {{' de saldo pendiente, de la reservación'}} {{      $reservacion->id}} </b>&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <form method="GET" action="{{route('garantia',$reservacion)}}"  role="form">
                            {{ csrf_field() }}
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{' Registrar cobro'}}</button>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

            <div class="modal modal-warning fade" id="modal-warning4">

                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Cambio de vehículo para la reservación '}}  {{$reservacion->id}}</b> </h4>
                    </div>
                    <div class="modal-body">

                        <div class="box-body">
                            <div class="row">
                              <div class="col-md-12 ">
                                <div class="form-group">
                                  <label> Atención un vehículo no debe de cambiarse de una reservación a menos que sea por motivo de siniestro o fallo para llevar a mantenimiento<br> <br><br>A continuación se enlistan los vehículos disponibles en la sucursal para el periodo de renta </label>
                                <form action="{{route('cambia_Vehiculo')}}" method="" enctype="multipart/form-data">
                                    <input name="reservacion" type="hidden" value= "{{$reservacion->id}}">
                                  <select name= "vehiculo" id="vehiculo" class="form-control select2" style="width: 100%;">
                                    @if(count($disponibles)>0)
                                        @for($i = 0;$i<count($disponibles); $i++)

                                        <option value = {{$disponibles[$i]->idvehiculo}}>{{$disponibles[$i]->marca}} {{$disponibles[$i]->modelo}} Placas: {{$disponibles[$i]->matricula}}</option>
                                        @endfor
                                      @else
                                      <option value=""> No hay vehículos disponibles</option>

                                       @endif
                                  </select>
                            
                                
                                </div>
                              </div>
                            </div>
                          </div>
                            
                      <p><b>{{'Se cambiará el vehículo de la reservación '}} {{$reservacion->id}} {{' '}} </b>&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        @if(count($disponibles)>0)
                        <button class="btn btn-primary" type="submit">Cambiar vehículo</button>
                        @else
                        <button class="btn btn-primary" type="" disabled>Cambiar vehículo</button>
                        @endif
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

              <div class="modal fade in" id="pagos">

                  <div class="modal-dialog">
                    <div class="modal-content">
  
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Cobros por la reservación'}}  {{$reservacion->id}}</b> </h4>
                      </div>
                      <div class="modal-body">
  
                          <div class="box-body">
                              <div class="row">
                                <div class="col-md-12 ">
                                  <div class="form-group">

                              
                                    <table border="1">
                                      <th>Número</th>
                                      <th>Datos del pago</th>
                                      <th>Motivo</th>
                                      <th>Fecha</th>
                                      <th>Monto</th>
                                      <th>Comentario</th>
                                      @if($pagos->count())  
                                      {{$total = 0.0}}
                                      @foreach($pagos as $pago)
                                      {{$total+=$pago->total}}  
                                      <tr>
                                      <td>{{$pago->id}}</td>
                                  
                                        <td> {{$pago->paypal_Datos}}
           
                                        {{$pago->mostrador_Datos}} 
                                                                  </td>
                                          <td>{{$pago->motivo}}</td>

                                         <td>{{$pago->fecha}}</td>

                                        <td>{{$pago->total}}</td>
                                        <td>{{$pago->comentario}}</td>
                                        </tr>
                                      @endforeach
                                      @endif

                                    </table>
                                  <h3>Total cobrado = {{$total}}</h3>
                                  </div>
                                </div>
                              </div>
                            </div>
                              
                      </div>
                      <div class="modal-footer">


                      </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>


                <div class="modal fade in" id="recibir">

                    <div class="modal-dialog">
                      <div class="modal-content">
    
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Terminar renta de vehículo de reservación'}}  {{$reservacion->id}}</b> </h4>
                        </div>
                        <div class="modal-body">
    
                            <div class="box-body">
                                <div class="row">
                                  <div class="col-md-12 ">
                                    <div class="form-group">
                                        <form method="GET" action="{{ route('recibir') }}"  role="form">
                                            {{ csrf_field() }}
                                            <input name="reservacion" type="hidden" value= "{{$alquiler->id_reservacion}}">
                                            <input name="alquiler" type="hidden" value= "{{$alquiler->id}}">
                                        <div class="col-md-6 form-group">
                                            <label>Kilometraje del vehiculo</label>
                                        <input type="number" name="km" id="" class="form-control"  value="{{$vehiculo->kilometraje}}" min="{{$vehiculo->kilometraje}}">
                                          </div>

                                          <div class="col-md-6 form-group">
                                              <label>Comentario</label>
                                              <input type="text" name="comentario" id="" class="form-control"  value="">
                                            </div>
                                    
                                    </div>
                                  </div>
                                </div>
                              </div>
                                
                          <p><b>{{'Se recibirá el vehículo rentado de la reservación  '}} {{$reservacion->id}} {{' '}} </b>&hellip;</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{'Terminar'}}</button>
                        </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
    @endsection

  @section('scripts')

  <!-- bootstrap datepicker -->
<script src="{{asset("assets/$theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
  <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
    
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
          },
          function (start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )
    
        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        })
    
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
    
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
    
        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
      })
    </script>
@endsection