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
    <tr><td></td>                                                 <td>---SALIDA DE VEHÍCULO---</td>                                           <td></td></tr>
    <tr><td></td>                                                 <td>{{$sucursal->nombre}}</td>                                    <td>Telefono:{{$sucursal->telefono}}</td></tr>
    <tr><td></td>                                                 <td><p>{{$sucursal->calle}},{{$sucursal->numero}}<br>    
                                                                         {{$sucursal->colonia}},<br>
                                                                         {{$sucursal->municipio}}, {{$sucursal->estado}}</p></td>   <td></td></tr>
</tbody>
</table>
<tr><td></td>    <td><p>Gracias por recoger su vehículo, para cualquier duda, favor de llamar al telefono {{$sucursal->telefono}},<br> </p></td>   <td></td></tr>
<tr><td></td>  <td> Se le recuerda que debe de entregar el vehiculo en la misma sucursal en la fecha siguiente:</td>                                                                                                     </tr> 

<table class="table">
<tbody>    
    @foreach($reservacion as $reserva)
    <tr><td></td>  <td>Vehículo:</td>             <td>{{$reserva->marca}} {{$reserva->modelo}} {{$reserva->anio}}</td>  </tr>
    <tr><td>                </td>  <td>kilometraje:</td>          <td>{{number_format($reserva->kilometraje)}} km</td>  </tr>
    <tr><td>                </td>  <td>Fecha de Devolucion:</td>  <td>{{$reserva->fecha_devolucion}}</td>            <td>Hora de Devolución:</td>  <td> {{$reserva->hora_devolucion}} hrs</td></tr>
    @endforeach
</tbody>
</table>
</div>
</section>
</body>
</html>