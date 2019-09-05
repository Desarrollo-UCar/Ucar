<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Información sobre tu reserva en Ü-CAR</title>
</head>
<body>
<section id="content">
<div class="container">
    <div class="row border border-primary">
@foreach($reservacion as $reserva)
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <h1 class = "text-primary">Folio: <strong>{{$reserva->id}}</strong></h1></div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <div id="lista_itinerario">
                <h6><strong>Tu Cotización:</strong></h6>    
                <table class="table table-sm">
                <tbody>
                    <tr><td><small>Kilometraje incluido</small></td>                    <td><small>Ilimitado</small></td></tr>
                    <tr><td><small>Alquiler del automovil por 1 dia</small></td>                                   <td><small>${{number_format($reserva->precio,2)}}</small></td></tr>
                    <tr><td><small><strong>Subtotal MXN {{$reserva->dias}} Dia(s)</strong></small></td> <td><small><strong>${{number_format($reserva->precio*$reserva->dias,2)}}</strong></small></td></tr>
                    @foreach($serv_extra as $servicio)
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
                        <img src="{{$reserva->foto}}" />
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
</body>
</html>