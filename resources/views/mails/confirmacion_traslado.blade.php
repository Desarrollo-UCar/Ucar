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

            <div class="row border border-primary">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <b style="color: dodgerblue">Ü-Car</b> <h1 class = "text-primary">Solicitud de traslado. El folio de tu solicitud de traslado es: <strong>{{$solicitud_traslado->id}}</strong></h1></div>
                    <div style="float:left;">
                        <div id="lista_itinerario">
                            <h2><strong>-------Datos de Contacto: -------</strong></h2>       
                            <ul>
                            <li>nombre</dt>
                            <dd>{{$solicitud_traslado->nombres}} {{$solicitud_traslado->primer_apellido}} {{$solicitud_traslado->segundo_apellido}}
                            <li>Teléfono:</dt>
                            <dd>{{$solicitud_traslado->telefono}}</dd>
                            <li>Email:</dt>
                            <dd>{{$solicitud_traslado->email}}</dd>
                            </ul> 
                        </div>
                    </div>
                    <div style="float:left;">
                        <div id="lista_itinerario">
                            <h2><strong>------- Datos Generales: -------</strong></h2>       
                            <ul>
                            <li><strong>**Viaje Redondo**</strong></dt>
                            <dd>{{$solicitud_traslado->dias_espera}} Dias de espera</dd>
                            <li>Origen</dt>
                            <dd>{{$solicitud_traslado->lugar_salida}}</dd>
                            <li>Fecha / Hora de recolección:</dt>
                            <dd>{{$solicitud_traslado->fecha_salida}} a las {{$solicitud_traslado->hora_salida}} hrs</dd>
                            <li>Destino</dt>
                            <dd>{{$solicitud_traslado->lugar_llegada}}</dd>
                            <li>Fecha / Hora de recolección:</dt>
                            <dd>{{$solicitud_traslado->fecha_llegada_solicitada}} a las {{$solicitud_traslado->hora_llegada}} hrs</dd>
                            <li>Número de pasajeros:</dt>
                            <dd>{{$solicitud_traslado->n_pasajeros}} Pasajeros</dd>
                            </ul> 
                        </div>
                    </div>
                    <div style="float:left;">
                            <div id="lista_itinerario">
                                <h2><strong>------- Cotización: -------</strong></h2>       
                                <ul>
                                <li><strong>**Estos son tus cobros**</strong></dt>
                                <li>Renta del automovil</dt>
                                <dd>{{$vehiculo->precio}}</dd>
                                <li>Servicio de chofer:</dt>
                                <dd>{{$solicitud_traslado->n_choferes}} ? Choferes por viaje por {{$dias}} dias</dd>
                                <li>Subtotal</dt>
                                <dd>{{$subtotal}}--MXN</dd>
                                <li>Descuento de:</dt>
                                <dd>{{$solicitud_traslado->descuento * $subtotal }}--MXN</dd>
                                <li>Total a pagar:</dt>
                                <dd>{{$total}}--MXN</dd>
                                </ul> 
                            </div>
                        </div>

                </div>
    </div>
    </section>
</body>
</html>