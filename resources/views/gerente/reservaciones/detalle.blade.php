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
      <div class="col-xs-12">
          <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title">{{'Detalle Reservacion'}} <b>{{$reservacion->id}}</b></h3>

              <div class="box-body">
                </div>
                <h4 >Datos del <a href="">cliente </a></h4>
                  <!-- {{$alquiler->id  }} -->
                  <div class="col-md-6 form-group">
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

                  <div class="row">
                      <div class="col-xs-12">
                          <h4 ><br>Datos de la reservación</h4>
                  <div class="col-md-6 form-group">
                      <label>Fecha Reservación</label>
                      <input type="text" name="fecha Reservacion" id="" class="form-control" disabled value="{{$reservacion->fecha_reservacion}}">
                  </div>
                    
                  <div class="col-md-6 form-group">
                      <label>Precio Total</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->total}}">
                  </div>

                <!--  <div class="col-md-6 form-group">
                      <label>Estatus</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->estatus}}">
                  </div>
                -->

                @if($reservacion->saldo==0)
                <h3>Se pagó el total de la reservación en línea</h3>
                @else
                <div class="col-md-6 form-group">
                    <label>Saldo</label>
                    <input type="text" name="nombre" id="" class="form-control" disabled value="{{$reservacion->saldo}}">
                  </div>
                  <div class="row">
                  
                  
                <div class="col-md-6 form-group">
                  <a href="" class="btn btn-success"><b>Cobrar</b></a>
                </div>
              </div>
              @endif
              <div class="row">
                <div class="col-xs-12">
                    <h4 ><br>Datos del <a href="">vehículo </a></h4>

                  <div class="col-md-6 form-group">
                    <label>Vin</label>
                    <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->vin}}">
                  </div>

                   <div class="col-md-6 form-group">
                     <label>Vehículo</label>
                     <input type="text" name="nombre" id="" class="form-control" disabled value="{{$vehiculo->marca}} {{$vehiculo->modelo}}">
                   </div>


                    <div class="col-md-6 form-group">
                      <label>Fecha Entrega</label>
                      <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->fecha_recogida}}">
                    </div>

                     <div class="col-md-6 form-group">
                       <label>Fecha Devolución</label>
                       <input type="text" name="nombre" id="" class="form-control" disabled value="{{$alquiler->fecha_devolucion}}">
                    </div>
                  </div>
                </div>
               
                <div class="row">
                  <div class="col-md-12">
                      <div class="box-footer" style="float: right">
                            @if($alquiler->estatus=='cancelado'||$reservacion->estatus=='rentado')
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#" disabled>
                                <b>Cancelada</b>
                              </button>
                              <a  disabled class="btn btn-success" disabled><b>Contrato</b></a>
                              </div>
                              @else

                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning">
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

        </section>

        <div class="modal modal-warning fade" id="modal-warning">
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

    @endsection

  @section('scripts')

@endsection