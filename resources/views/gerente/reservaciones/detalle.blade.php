@extends("theme.$theme.layout")

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reservaciones</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
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

          
        @if($vehiculo->estatus=='MANTENIMIENTO')
        <div class="alert alert-warning alert-dismissible">
            <h4>¡El vehículo se encuentra en mantenimiento!</h4>
          </div>
          @endif

          @if($vehiculo->estatus=='INACTIVO')
          <div class="alert alert-warning alert-dismissible">
              <h4>¡Vehiculo se encuentra inactivo!</h4>
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
                    {{-- <div class="col-md-4">
                      @if($alquiler->estatus!='cancelado'&&$alquiler->estatus!='terminado')
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning2">
                          <b>Registrar cobro </b>
                        </button>
                        @endif
                      </div>
                      <div class="col-md-4">
                        @if($alquiler->estatus!='cancelado'&&$alquiler->estatus!='terminado')
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#registrar_reintegro">
                            <b>Registrar reembolso </b>
                          </button>
                          @endif
                        </div> --}}
                      <div class="col-md-7">
                      <button type="button" class="btn btn-sucess" data-toggle="modal" data-target="#cobros">
                        <b>Ver cobros </b>
                      </button>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                        <button type="button" class="btn btn-sucess" data-toggle="modal" data-target="#reembolso">
                          <b>Ver reembolso </b>
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
                          @if($alquiler->estatus!='terminado'&&$alquiler->estatus!='cancelado'&&$alquiler->estatus!='en curso')
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

                        <form id="datos" >
                          @csrf
                            <input type="text" name="reservacion"  style="display: none" value= "{{$reservacion->id}}">
                            <input type="text" name="alquiler"  style="display: none" value= "{{$alquiler->id}}">
                        
                  <div class="col-md-6 form-group">
                      <label>Número Licencia</label>
                  <input type="text" name="numero" id="numero" class="form-control" value="{{$alquiler->num_licencia}}"  title="Escriba numero de licencia">

                  <span id="errornumero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                  <span id="validonumero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                 
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Nombre conductor</label>                       
                        <input type="text" name="nombre" id="nombre" class="form-control"  value="{{$alquiler->nombreConductor}} " required>                   

                        <span id="errornombre" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validonombre" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>

                      
                    <div class="col-md-6 form-group">
                        <label>Fecha expedición</label>                        
                        <input type="date" name="fecha_e" id="fecha_e" class="form-control"  value="{{date($alquiler->expedicion_licencia)}}">
                      
                        <span id="errorfecha_e" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validofecha_e" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>

                      
                    <div class="col-md-6 form-group">
                        <label>Fecha expiración</label>
                       
                        <input type="date" name="fecha_c" id="fecha_c" class="form-control"  value="{{date($alquiler->expiracion_licencia)}}">
                        <span id="errorfecha_c" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validofecha_c" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                 </div>
                 @if($alquiler->estatus!='terminado'&&$alquiler->estatus!='cancelado'&&$alquiler->estatus!='en curso')
                 <button type="submit" id="enviar" class="btn btn-primary pull-right">Agregar</button>
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
                      @if($vehiculo->estatus=='ACTIVO'&&$alquiler->nombreConductor!="por rellenar"&&$alquiler->expedicion_licencia!="por rellenar"&&$alquiler->num_licencia!="por rellenar"&&$alquiler->expiracion_licencia!="por rellenar"&&$alquiler->estatus!='en curso'&&date("Y-m-d")>=$alquiler->fecha_recogida)
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

          <div class="modal modal-warning fade" id="registrar_reintegro">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"> <span class="glyphicon glyphicon-usd"></span> <b> {{'Registrar reembolso'}}</b> </h4>
                </div>
                <div class="modal-body">

                  
                    <form method="POST" action="{{ route('reembolsoReservacion') }}"  role="form" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input name="reservacion" type="hidden" value= "{{$reservacion->id}}">
                  <p><b>{{'Se registrará un nuevo reembolso'}} </b>&hellip;</p>

                  <div class="row"> 
                      <div class="col-md-3">
                    <label>Motivo</label>
                           <select name= "motivo" id="motivo" class="form-control select2" style="width: 100%;">
                      <option value="otro">Otro</option>
                      <option value="cambio de vehiculo">Cambio de vehiculo</option>


                  </select>

                </div>

                <div class="col-md-3">
                  <label>Datos</label>
                  <input type="text" name="datos" id="" class="form-control"  value="">
                </div>

                  <div class="col-md-3">
                  <label>Monto</label>
                  <input type="number" name="monto" id="" class="form-control"  value="">
                  </div>

                <div class="col-md-9">
                    <label>Comentario</label>
                    <input type="text" name="comentario" id="" class="form-control"  value="">
                  </div>


                </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{' Registrar reembolso'}}</button>
            </form>
  
                </div>
              </div>
              
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


          <div class="modal modal-fade-in" id="cobros">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"> <b> {{'Gestión de cobros'}}</b> </h4>
                    </div>

                    <div class="modal-body">
                      <div class="col-md-12 col-md-offset-3">
                      <div clas="row"> 
                        <h4> <b> {{'Registrar nuevo cobro:'}}</b> </h4>
                      </div>
                      <form method="POST" action="{{ route('pagoReservacion') }}"  role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="reservacion" type="hidden" value= "{{$reservacion->id}}">
                      <div clas="row"> 
                          <div class="col-md-8">
                              <div class="col-md-3">
                              <label>Motivo</label>
                              </div>
                              <div class="col-md-5">
                                     <select name= "motivo" id="motivo" class="form-control select2" style="width: 100%;">
                                <option value="otro">Otro</option>
                                <option value="reparacion">Reparacion</option>
                                @if($reservacion->saldo!=0)
                                <option value="saldo">Saldo</option>
                                 @endif
                            </select>
                          </div>
                          </div>
                        </div>

                          <div clas="row">
                          <div class="col-md-8">
                              <div class="col-md-3">
                              <label>Metodo</label>
                              </div>
                              <div class="col-md-5">
                                <select name= "metodo" id="metodo" class="form-control select2" style="width: 100%;">
                                <option value="efectivo">Efectivo</option>
                                <option value="t. credito">Tarjeta/credito</option>
                                <option value="t. debito">Tarjeta/debito</option>
                            </select>
                          </div>
                          </div>
                        </div>

                          <div clas="row">
                              <div class="col-md-8">
                  <div class="col-md-3">
                      <label>Id/datos</label>
                      </div>

                      <div class="col-md-5">
                      <input type="text" name="datos" id="" class="form-control"  value="">
                    </div>
                  </div>
                    </div>
  
                    <div clas="row">
                        <div class="col-md-8">
                      <div class="col-md-3">
                      <label>Monto</label>
                      </div>
                      <div class="col-md-5">
                      {{-- @if($reservacion->saldo!=0)
                      <input type="number" name="monto" id="" class="form-control"  value={{$reservacion->saldo}}>
                       @else --}}
                      <input type="number" name="monto" id="" class="form-control"  value="" min="100" max="1000000">
                      {{-- @endif --}}
                    </div>
                      </div>
                    </div>
                 
                    <div clas="row">
                        <div class="col-md-8">
                            <div class="col-md-3">
                            <label>Comentario</label>
                            </div>
                    <div class="col-md-5">
                        <input type="text" name="comentario" id="" class="form-control"  value="">
                      </div>
                        </div>
                      </div>

                    </div>

                    <div clas="row">
                   
                    <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-info-sign"></span>{{'Registrar cobro'}}</button>
                  </form>
               
                </div>


                <div clas="row">
               
                </div>
                <div clas="row">
                    <div class="col-md-12 col-xs-offset-3">
                    <h4> <b> {{'Registro de cobros:'}}</b> </h4>
                    <br>
                  </div>
                    <div class="col-md-11" style="margin-left: 5%;">
                        <div class="form-group">

                    
                          <table border="1">
                            <th>Número</th>
                            <th>Datos del cobro</th>
                            <th>Motivo</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Comentario</th>
                            @if($pagos->count())  
                            <input id="dec" name="dec" type="hidden" value= {{$total = 0.0}}  >
                           
                            @foreach($pagos as $pago)
                            <input id="total" name="total" type="hidden" value={{$total+=$pago->total}}  >
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

                      <div class="modal-footer">
                      </div>
                  </div>
              </div>
          </div>

            <div class="modal modal-warning fade" id="modal-warning4"><!--MODAL CAMBIO DE VEHICULO -->

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

                                        <option value = {{$disponibles[$i]->idvehiculo}}>Tipo: {{$disponibles[$i]->tipo}}  {{$disponibles[$i]->marca}} {{$disponibles[$i]->modelo}} Placas: {{$disponibles[$i]->matricula}}</option>
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


<!--MODAL REEMBOLSOS-->
<div class="modal fade in" id="reembolso">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> <b> {{'Gestión de reembolsos'}}</b> </h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12 col-md-offset-3">
              <div clas="row"> 
                <h4> <b> {{'Registrar nuevo reembolso:'}}</b> </h4>
              </div>
              <form method="POST" action="{{ route('reembolsoReservacion') }}"  role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="reservacion" type="hidden" value= "{{$reservacion->id}}">
              <div clas="row"> 
                  <div class="col-md-8">
                      <div class="col-md-3">
                      <label>Motivo</label>
                      </div>
                      <div class="col-md-5">
                             <select name= "motivo" id="motivo" class="form-control select2" style="width: 100%;">
                        <option value="otro">Otro</option>
                        <option value="reparacion">Retraso</option>
                    </select>
                  </div>
                  </div>
                </div>



                  <div clas="row">
                      <div class="col-md-8">
          <div class="col-md-3">
              <label>Dato</label>
              </div>

              <div class="col-md-5">
              <input type="text" name="datos" id="" class="form-control"  value="">
            </div>
          </div>
            </div>

            <div clas="row">
                <div class="col-md-8">
              <div class="col-md-3">
              <label>Monto</label>
              </div>
              <div class="col-md-5">
              {{-- @if($reservacion->saldo!=0)
              <input type="number" name="monto" id="" class="form-control"  value={{$reservacion->saldo}}>
               @else --}}
              <input type="number" name="monto" id="" class="form-control"  value="" min="100" max="1000000">
              {{-- @endif --}}
            </div>
              </div>
            </div>
         
            <div clas="row">
                <div class="col-md-8">
                    <div class="col-md-3">
                    <label>Comentario</label>
                    </div>
            <div class="col-md-5">
                <input type="text" name="comentario" id="" class="form-control"  value="">
              </div>
                </div>
              </div>

            </div>

            <div clas="row">

            <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-info-sign"></span>{{'Registrar reembolso'}}</button>
          </form>
          
        </div>

        <div clas="row">
               
          </div>


        <div clas="row">
            <div class="col-md-12 col-xs-offset-3">
            <h4> <b> {{'Registro de reembolsos:'}}</b> </h4>
            <br>
          </div>
          <div class="col-md-11" style="margin-left: 5%;">
                <div class="form-group">
                    <input id="dec" name="dec" type="hidden" value={{$totalr = 0.0}} >
                    <table border="1">
                        <th>Número</th>
                        <th>Datos</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Comentario</th>
                        @if($reembolsos->count())  
                        @foreach($reembolsos as $reembolso)
                        <input id="total" name="total" type="hidden" value={{$totalr+=$reembolso->total}}>
                        <tr>
                        <td>{{$reembolso->id}}</td>
                    
                          <td> {{$reembolso->paypal_Datos}}
  
                          {{$reembolso->mostrador_Datos}} 
                                                    </td>
                            <td>{{$reembolso->motivo}}</td>
  
                           <td>{{$reembolso->fecha}}</td>
  
                          <td>{{$reembolso->total}}</td>
                          <td>{{$reembolso->comentario}}</td>
                          </tr>
                        @endforeach
                        @endif
  
                      </table>
                    <h3>Total pagado = {{$totalr}}</h3>
                </div>
              </div>

        </div>
      </div>



              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>

<!--FIN MODAL REEMBOLSOS-->


<div class="modal fade in" id="reembolsos">

  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Remmbolsos por la reservación'}}  {{$reservacion->id}}</b> </h4>
      </div>
      <div class="modal-body">

          <div class="box-body">
              <div class="row">
                <div class="col-md-12 ">
                  <div class="form-group">

              

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

{{-- ---- --}}

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


  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#error" style="display: none" id="error1">Cancelar</button>
<div class="modal modal-danger fade" id="error">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Error al agregar datos del conductor</b> </h4>
        </div>
        <div class="modal-body">
          <p>Verifique los campos necesarios&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none" >

  </button>
  <div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">DATOS DE LICENCIA</h4>
        </div>
        <div class="modal-body">
          <p>LOS DATOS FUERON AGREGADOS CORRECTAMENTE&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" data-dismiss="modal">Continuar</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal ---->

    @endsection

  @section('scripts')


 
    <script>
      $(function () {
          
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        $(document).ready(function(){
        $('#enviar').click(function (e) {
       e.preventDefault();
        
            $.ajax({
              url: "{{ route('conductor')}}",
              data:$('#datos').serialize(),              
              type: "POST",
              dataType: 'json',
              success: function (data) {
               var mensaje=data.success;
                // console.log(data);
                if(mensaje=='FECHAS'){
                $('#error1').click();
                jQuery('#validofecha_e').hide(); 
                 jQuery('#errorfecha_e').show();          
                $( '#fecha_e' ).css('borderColor', 'red');
                jQuery('#validofecha_c').hide(); 
                 jQuery('#errorfecha_c').show();          
                $( '#fecha_c' ).css('borderColor', 'red');
                }
                if(mensaje=='EXITO'){
                  $('.btn-info').click();
                }
              },
              error: function (data) {
              var err = JSON.parse(data.responseText);
              var arreglo = err.errors;
              //  console.log(arreglo);
               var numero = arreglo.numero;
               var nombre = arreglo.nombre;
               var fecha_e = arreglo.fecha_e;
               var fecha_c = arreglo.fecha_c;
             
     
               
               if (numero == undefined){  
                 $( '#numero' ).css('borderColor', 'green');         
                 jQuery('#validonumero').show(); 
                 jQuery('#errornumero').hide(); 
                 }else{
                   jQuery('#validonumero').hide(); 
                 jQuery('#errornumero').show();          
                $( '#numero' ).css('borderColor', 'red');
                 
               }
     
           
               if (nombre == undefined){  
                 $( '#nombre' ).css('borderColor', 'green');         
                 jQuery('#validonombre').show(); 
                 jQuery('#errornombre').hide(); 
                 }else{
                   jQuery('#validonombre').hide(); 
                 jQuery('#errornombre').show();          
                $( '#nombre' ).css('borderColor', 'red');
                 
               }


               if (fecha_e == undefined){  
                 $( '#fecha_e' ).css('borderColor', 'green');         
                 jQuery('#validofecha_e').show(); 
                 jQuery('#errorfecha_e').hide(); 
                 }else{
                   jQuery('#validofecha_e').hide(); 
                 jQuery('#errorfecha_e').show();          
                $( '#fecha_e' ).css('borderColor', 'red');
                 
               }
     
               if (fecha_c == undefined){  
                 $( '#fecha_c' ).css('borderColor', 'green');         
                 jQuery('#validofecha_c').show(); 
                 jQuery('#errorfecha_c').hide(); 
                 }else{
                   jQuery('#validofecha_c').hide(); 
                 jQuery('#errorfecha_c').show();          
                $( '#fecha_c' ).css('borderColor', 'red');
                 
               }              
                $('#enviar').html('guardar cambios');
                   $('#error1').click();
              }
          });
        });
        
       
         
      });
           });
      </script>
<script>   
        function validar_fecha(){
          var expedicion = document.getElementById("fecha_e").value;
          var vencimiento = document.getElementById("fecha_c").value;
            var expedicion  = new Date(expedicion);
            var vencimiento = new Date(vencimiento);
            var hoy =  new Date();
            //--------------
            if(vencimiento < expedicion ){
                alert("Fecha invalida!! La fecha de vencimiento no puede ser menor a la de expedición");
                document.getElementById("fecha_e").value = null;
                document.getElementById("fecha_c").value = null;
            }
            if(expedicion > hoy){
                alert("Licencia de conducir no existente");
                document.getElementById("fecha_e").value = null;
                document.getElementById("fecha_c").value = null;
            }
            if(vencimiento < hoy){
                alert("La licencia ya vencio");
                document.getElementById("fecha_e").value = null;
                document.getElementById("fecha_c").value = null;
            }
                    
        };
</script>
@endsection