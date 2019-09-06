<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Ü-car Renta de vehículos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
    </style>
</head>
<body>
<section id="content">
<div class="container">
    @foreach($reservacion as $reserva)
            <div class="row border border-primary">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <b style="color: dodgerblue">Ü-Car</b> <h1 class = "text-primary">Folio: <strong>{{$reserva->id}}</strong></h1></div>
                    <div  style="float:left;">
                        <div id="lista_itinerario">
                            <h2><strong>------- Tu Cotización: -------</strong></h2>    
                            <table class="table table-sm">
                            <tbody>
                                <tr><td>Kilometraje incluido</td>                    <td>Ilimitado</td></tr>
                                <tr><td>Alquiler del automovil por 1 dia </td>                                   <td> ${{number_format($reserva->precio,2)}}</td></tr>
                                <tr><td><strong>Subtotal MXN {{$reserva->dias}} Dia(s)</strong></td> <td><strong>${{number_format($reserva->precio*$reserva->dias,2)}}</strong></td></tr>
                                @foreach($serv_extra as $servicio)
                                @if($servicio->alquiler == $reserva->id_alquiler)
                                <tr><td>{{$servicio->nombre}}</td>                   <td>${{$servicio->precio*$reserva->dias}}.00</td></tr>
                                @endif
                                @endforeach
                                <tr><td><strong>Total</strong></td>                  <td><strong>${{number_format($reserva->total,2)}}</strong></td></tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="float:left;">
                        <div id="lista_itinerario">
                            <h2><strong>------- Datos Generales: -------</strong></h2>    
                            <ul>
                            <li>Lugar de Recogida y Devolución</li>
                            <dd>{{$reserva->nombre}}</dd>
                            <li>Fecha / Hora de recolección:</li>
                            <dd>{{date("d\-m\-Y", strtotime($reserva->fecha_recogida))}} a las {{$reserva->hora_recogida}} hrs</dd>
                            <li>Fecha / Hora de devolución:</li>
                            <dd>{{date("d\-m\-Y", strtotime($reserva->fecha_devolucion))}} a las {{$reserva->hora_devolucion}} hrs</dd>
                            </ul> 
                        </div>
                    </div>
                            <div style="float:left;">    
                                <div id="lista_itinerario">
                                    <h2><strong>---- Tu vehículo: ----</strong></h2>  
                                    <ul>
                                    <li>{{$reserva->marca}} {{$reserva->modelo}}</li>
                                    <li>{{$reserva->pasajeros}} Pasajeros </dd>
                                    <li>{{$reserva->maletero}}</dd>
                                    <li>{{$reserva->puertas}} Puertas</dd>
                                    <li>Transmisión {{$reserva->transmicion}}</dd>
                                    <li>{{$reserva->cilindros}} Cilindros</dd>
                                    <li>{{$reserva->rendimiento}} Kilómetros por litro</dd>
                                    <li>Color: {{$reserva->color}}</dd>
                                    </ul>   
                                </div>
                            </div>
                            <div style="float:left;">
                                <div class="container">
                                    <div class="row">
                                            
                                    </div>
                                </div>
                            </div>
                </div>
    @endforeach
    </div>
    </section>
</body>
</html>