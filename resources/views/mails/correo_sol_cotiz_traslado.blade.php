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
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <b style="color: dodgerblue">Ü-Car</b> <h1 class = "text-primary">Solicitud de traslado. El folio de tu solicitud de traslado es: <strong>{{$datos_reserva_traslado->id}}</strong></h1></div>
                    <div style="float:left;">
                        <div id="lista_itinerario">
                            <h2><strong>-------Datos de Contacto: -------</strong></h2>       
                            <ul>
                            <li>nombre</dt>
                            <dd>{{$datos_reserva_traslado->nombres}} {{$datos_reserva_traslado->primer_apellido}} {{$datos_reserva_traslado->segundo_apellido}}
                            <li>Teléfono:</dt>
                            <dd>{{$datos_reserva_traslado->telefono}} a las ?? hrs</dd>
                            <li>Email:</dt>
                            <dd>{{$datos_reserva_traslado->email}} Pasajeros</dd>
                            </ul> 
                        </div>
                    </div>
                    <div style="float:left;">
                        <div id="lista_itinerario">
                            <h2><strong>------- Datos Generales: -------</strong></h2>       
                            <ul>
                            <li>Origen</dt>
                            <dd>{{$datos_reserva_traslado->lugar_salida}}</dd>
                            <li>Fecha / Hora de recolección:</dt>
                            <dd>{{$datos_reserva_traslado->fecha_salida}} a las {{$datos_reserva_traslado->hora_salida}} hrs</dd>
                            <li>Destino</dt>
                            <dd>{{$datos_reserva_traslado->lugar_llegada}}</dd>
                            <li>Fecha / Hora de recolección:</dt>
                            <dd>{{$datos_reserva_traslado->fecha_llegada_solicitada}} a las ?? hrs</dd>
                            <li>Número de pasajeros:</dt>
                            <dd>{{$datos_reserva_traslado->n_pasajeros}} Pasajeros</dd>
                            </ul> 
                        </div>
                    </div>

                </div>
    @endforeach
    </div>
    </section>
</body>
</html>