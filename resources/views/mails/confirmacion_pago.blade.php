<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Ü-car Renta de vehículos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style type="text/css">
        .grid {
            display: grid;
            grid-template-areas: "head head"
                                "menu main"
                                "foot foot";
            }

            .a { grid-area: head; background: blue }
            .b { grid-area: menu; background: red }
            .c { grid-area: main; background: green }
            .d { grid-area: foot; background: orange }
      </style>
</head>
<body>
<section id="content">
<div >
<table class="table">
<tbody>
    <tr><td><h2 style="color:dodgerblue"> Ü-Car </h2></td>      <td>RECIBO DE PAGO</td>                                           <td></td></tr>
    <tr><td></td>                                                 <td>{{$sucursal->nombre}}</td>                                    <td>Telefono:{{$sucursal->telefono}}</td></tr>
    <tr><td></td>                                                 <td><p>{{$sucursal->calle}},{{$sucursal->numero}}<br>    
                                                                         {{$sucursal->colonia}},<br>
                                                                         {{$sucursal->municipio}}, {{$sucursal->estado}}</p></td>   <td></td></tr>
</tbody>
</table>
<table class="table">
<tbody>    
    <tr><td>................</td> <td><strong>Número de pago:</strong></td>           <td>{{$pago_reserva->id}}</td>            <td>Fecha:{{$pago_reserva->fecha}}</td></tr>
    <tr><td></td>                 <td><strong>Importe:</strong></td>                  <td>$ {{$pago_reserva->total}}</td>       <td></td></tr>
    <tr><td></td>                 <td><strong>Concepto:</strong></td>                 <td>{{$pago_reserva->motivo}}</td>        <td></td></tr>
    <tr><td></td>                 <td><strong>Cadena de confirmación:</strong></td>   <td>{{$pago_reserva->paypal_Datos}}</td>  <td></td></tr>
</tbody>
</table>
<br>
<table class="table">
<tbody>    
    @foreach($reservacion as $reserva)
    <tr><td>................</td>  <td>Datos sobre su reserva contratada en Ü-CAR</td>                                                                                                     </tr> 
    <tr><td>                </td>  <td>Vehículo:</td>             <td>{{$reserva->marca}} {{$reserva->modelo}}</td>                                                                        </tr>
    <tr><td>                </td>  <td>Fecha de Recogida:</td>    <td>{{$reserva->fecha_recogida}}</td>              <td>Hora de Recolección:</td> <td> {{$reserva->hora_recogida}} hrs</td></tr>
    <tr><td>                </td>  <td>Fecha de Devolucion:</td>  <td>{{$reserva->fecha_devolucion}}</td>            <td>Hora de Devolución:</td>  <td> {{$reserva->hora_devolucion}} hrs</td></tr>

    @endforeach
</tbody>
</table>
</div>
</section>
</body>
</html>