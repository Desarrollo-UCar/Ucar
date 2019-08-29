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
          <h4>Reservación cancelada!</h4>
        </div>
        @endif
        
    <div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">{{'Detalle Reservacion'}} <b>{{$reservacion->id}}</b></h3>
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
                    INE
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
                          <h4 ><br>Datos de la reservacion</h4>
                  <div class="col-md-6">
                      <label>Fecha Reservacion</label>
                      <input type="text" name="fecha Reservacion" id="" class="form-control" disabled value="{{$reservacion->fecha_reservacion}}">
                  </div>
                    
                  <div class="col-md-6  form-group">
                      <label>Precio Total</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->total}}">
                  </div>


                @if($reservacion->saldo==0)
                  <h3>Se pago el total de la reservacion en linea</h3>
                 @else
                <div class="col-md-6 form-group">
                    <label>Saldo</label>
                    <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->saldo}}">
                  </div>
                  <div class="row">
                    <div class="col-md-8">
   
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning2">
                          <b>Cobrar Saldo pendiente </b>
                        </button>

                        @endif
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning2">
                            <b>Cobrar garantia </b>
                          </button>

            </div>
          </div>
          
        </div>
      </div>

              <div class="row">
                <div class="col-md-8">
                    <h4 ><br>Datos del <a href="">vehiculo </a></h4> 


                  <div class="col-md-6 form-group">
                    <label>Vin</label>
                    <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->vin}}">
                  </div>

                   <div class="col-md-6 form-group">
                     <label>Tipo</label>
                     <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->tipo}}">
                   </div>

                   <div class="col-md-6 form-group">
                      <label>Vehiculo</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->marca}} {{$vehiculo->modelo}}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Transmision</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->transmicion}}">
                      </div>

                    <div class="col-md-4 form-group">
                      <label>Fecha Entrega</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->fecha_recogida}}">
                    </div>
                    
                    <div class="col-md-2 form-group">
                        <label>Hora</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->hora_recogida}}">
                      </div>
  
                     <div class="col-md-4 form-group">
                       <label>Fecha Devolucion</label>
                       <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->fecha_devolucion}}">
                    </div>

                    <div class="col-md-2 form-group">
                        <label>Hora</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->hora_recogida}}">
                      </div>
                      <div class="col-md-2 form-group">
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">
                              <b>Cambiar VEHICULO</b>
                            </button>
                            </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-md-8">
                        <h4 ><br>Datos del conductor</h4>

                        
                  <div class="col-md-6 form-group">
                      <label>Numero Licencia</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->num_licencia}}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Nombre conductor</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->nombreConductor}}">
                      </div>

                      
                    <div class="col-md-6 form-group">
                        <label>Fecha expedicion</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->expedicion_licencia}}">
                      </div>

                      
                    <div class="col-md-6 form-group">
                        <label>Fecha expiracion</label>
                        <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->expiracion_licencia}}">
                      </div>

                    </div>

                  </div>

                  <div class="row">
                    <div clas="col-md-8">
                        <h4 ><br>Servicios Extras </h4>.

                        <div class="col-md-6 form-group">
                            <table border="1">
                                     <body>
                                      <th>Identificacion</th>
                                       <th>Nombre</th>
                                        <tr>
                                          <td>1</td>
                                          <td>Silla bebe</td>
                                        </tr>
                                     </body>

                                      </table>
                        </div>
                    </div>

                  </div>

               
                <div class="row">
                  <div class="col-md-12">
                      <div class="box-footer" style="float: right">
                            @if($alquiler->estatus=='cancelado'||$reservacion->estatus=='rentado')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#" disabled>
                                <b>Cancelada</b>
                              </button>
                              <a  disabled class="btn btn-success" disabled><b>Contrato</b></a>
                              </div>
                              @else

                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">
                                  <b>Cancelar</b>
                                </button>
                                <a href="{{route('contrato', $reservacion)}}" class="btn btn-success"><b>Contrato</b></a>
                                @endif
                        </div>                       
                    </div>                    
                </div>

                </div>
            </div>
          </div>
        </div>
        </section>

        <div class="modal modal-danger fade" id="modal-warning">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"> <span class="glyphicon glyphicon-alert"></span> <b> {{' Esta seguro de cancelar la reservacion'}}  {{$reservacion->id}}</b> </h4>
                </div>
                <div class="modal-body">
                  <p><b>{{'La reservacion del servicio de alquiler y sus servicios extra seran cancelados'}} </b>&hellip;</p>
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
                    <h4 class="modal-title"> <span class="glyphicon glyphicon-usd"></span> <b> {{'Cobro de saldo pendiente por reservacion'}}  {{$reservacion->id}}</b> </h4>
                  </div>
                  <div class="modal-body">
                    <p><b>{{'Se registrara un pago por '}} {{$reservacion->saldo}} {{' de saldo pendeiente, de la reservacion'}} {{      $reservacion->id}} </b>&hellip;</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span><b>{{'  Cerrar'}}</b></button>
                    <a href="{{route('direccion')}}"class="btn btn-success"><b>Cobrar</b></a>
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
                      <h4 class="modal-title"> <span class="glyphicon glyphicon-usd"></span> <b> {{'Cobro de saldo pendiente por reservacion'}}  {{$reservacion->id}}</b> </h4>
                    </div>
                    <div class="modal-body">
                      <p><b>{{'Se registrara un pago por '}} {{$reservacion->saldo}} {{' de saldo pendeiente, de la reservacion'}} {{      $reservacion->id}} </b>&hellip;</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span><b>{{'  Cerrar'}}</b></button>
                      <a href="{{route('pagoReservacion', $reservacion)}}"class="btn btn-success"><b>Cobrar</b></a>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

    @endsection

  @section('scripts')

@endsection