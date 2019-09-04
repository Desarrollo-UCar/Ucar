
@extends('plantilla')
@section('seccion')
<section id="content">
    <div class="container">
                    <form action="{{ route('validar_logeo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row"> 
                            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                                <h2>Hola <strong>{{$cliente->nombre}} {{$cliente->primer_apellido}}</strong> Consulta tu Historial de Reservas</h2>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <button class="btn btn-primary" style="float: right;" type="submit">Mi Perfil</button>          
                            </div>
                        </div>
                    </form>
@foreach($reservas_cliente as $reserva)
        <div class="row border border-primary">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <h1 class = "text-primary">Folio: <strong>{{$reserva->id}}</strong></h1></div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div id="lista_itinerario">
                        <h6><strong>Tu Cotización:</strong></h6>    
                        <table class="table table-sm">
                        <tbody>
                            <tr><td><small>Kilometraje incluido</small></td>                    <td><small>Ilimitado</small></td></tr>
                            <tr><td><small>Alquiler del automovil por 1 dia</small></td>                                   <td><small>${{number_format($reserva->precio,2)}}</small></td></tr>
                            <tr><td><small><strong>Subtotal MXN {{$reserva->dias}} Dia(s)</strong></small></td> <td><small><strong>${{number_format($reserva->precio*$reserva->dias,2)}}</strong></small></td></tr>
                            @foreach($cliente_serv_extra as $servicio)
                            @if($servicio->alquiler == $reserva->id_alquiler)
                            <tr><td><small>{{$servicio->nombre}}</small></td>                   <td><small>${{$servicio->precio*$reserva->dias}}.00</small></td></tr>
                            @endif
                            @endforeach
                            <tr><td><small><strong>Total</strong></small></td>                  <td><small><strong>${{$reserva->total}}</strong></small></td></tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div id="lista_itinerario">
                        <h6><strong>Datos Generales:</strong></h6>    
                        <dl>
                        <dt>Lugar de Recogida y Devolución</dt>
                        <dd>{{$reserva->nombre}}</dd>
                        <dt>Fecha / Hora de recolección:</dt>
                        <dd>{{date("d\-m\-Y", strtotime($reserva->fecha_recogida))}} a las {{$reserva->hora_recogida}} hrs</dd>
                        <dt>Fecha / Hora de devolución:</dt>
                        <dd>{{date("d\-m\-Y", strtotime($reserva->fecha_devolucion))}} a las {{$reserva->hora_devolucion}} hrs</dd>
                        </dl> 
                    </div>
                </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">    
                            <div id="lista_itinerario">
                                <h6><strong>Tu vehículo:</strong></h6>  
                                <dl>
                                <dt>{{$reserva->marca}} {{$reserva->modelo}}</dt>
                                <dd><i class="fa fa-male"       aria-hidden="true"></i> <small> {{$reserva->pasajeros}} Pasajeros </small></dd>
                                <dd><i class="fa fa-suitcase"   aria-hidden="true"></i><small> {{$reserva->maletero}}</small></dd>
                                <dd><i class="fa fa-car"   aria-hidden="true"></i> <small>{{$reserva->puertas}} Puertas</small></dd>
                                <dd><i class="fa fa-exchange"aria-hidden="true"></i> <small>Transmisión {{$reserva->transmicion}}</small></dd>
                                <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i> <small>{{$reserva->cilindros}} Cilindros</small></dd>
                                <dd><i class="fa fa-bolt"       aria-hidden="true"></i> <small>{{$reserva->rendimiento}} Kilómetros por litro</small></dd>
                                <dd><i class="fa fa-bolt"       aria-hidden="true"></i> <small>Color: {{$reserva->color}}</small></dd>
                                </dl>   
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="container">
                                <div class="row">
                                    <form action="{{ route('validar_logeo')}}" method="GET" enctype="multipart/form-data">
                                    @csrf    
                                    <input type="hidden" name="id_reserva" value="{{$reserva->id}}">
                                            <img src="{{$reserva->foto}}" />
                                        <div class="form-row">
                                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                                <button class="btn btn-primary" type="submit" style="margin-top: 15%;">Cancelar</button>
                                            </div>
                                        </div>          
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
@endforeach
</div>
</section>
@endsection

