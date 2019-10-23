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
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <b style="color: dodgerblue">Ü-Car</b></div>
                    <div  style="float:left;">
                        <div id="lista_itinerario">
                            <h4><strong>{{$sucursal->nombre}}</strong></h4>
                            <p>
                            {{$sucursal->calle}}, NUMERO: {{$sucursal->numero}}<br><br>
                            {{$sucursal->colonia}},<br><br>
                            {{$sucursal->municipio}}, {{$sucursal->estado}},
                            {{$sucursal->telefono}}
                            </p>
                            <table class="table table-sm">
                            <tbody>
                                <tr><td>Pago:</td> <td>{{$pago_reserva->id}}</td> <td>{{$pago_reserva->fecha}}</td></tr>
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
                </div>
    @endforeach
    </div>
    </section>
</body>
</html>