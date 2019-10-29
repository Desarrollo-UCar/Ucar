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
    <tr><td></td> <td><h2 style="color:dodgerblue"> Ü-Car </h2></td>      <td></td>                                           <td></td></tr>
    <tr><td></td>                                                 <td>---FINALIZACIÓN DE RESERVA---</td>             <td>Fecha: {{$fecha}} </td><td>Hora: {{$hora}} </td></tr>
    <tr><td></td>                                                 <td>{{$sucursal->nombre}}</td>                                    <td>Telefono:{{$sucursal->telefono}}</td></tr>
    <tr><td></td>                                                 <td><p>{{$sucursal->calle}},{{$sucursal->numero}}<br>    
                                                                         {{$sucursal->colonia}},<br>
                                                                         {{$sucursal->municipio}}, {{$sucursal->estado}}</p></td>   <td></td></tr>
</tbody>
</table>
<tr><td></td>  <td><p>Gracias por confiar en nosotros, esperamos la experiencia haya sido de lo mejor.<br> Te esperamos con los brazos abiertos en tu siguiente viaje </p></td>   <td></td></tr>

<table class="table">
<tbody>    
    @foreach($reservacion as $reserva)
    <tr><td></td>  <td>Reservación:</td>             <td>{{$reserva->id}}</td>  </tr>
    <tr><td></td>  <td>Vehículo:</td>             <td>{{$reserva->marca}} {{$reserva->modelo}} {{$reserva->anio}}</td>  </tr>
    @endforeach
</tbody>
</table>
</div>
</section>
</body>
</html>