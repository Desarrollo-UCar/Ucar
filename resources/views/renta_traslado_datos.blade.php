@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
            <h2 class="animated fadeInDown "><strong><span class="colored">SOLICITUD DE COTIZACIÓN DE TRASLADO!!!</span></strong></h2>
            <h6></h6>
            <h6>Hola <strong>{{$datos_reserva_traslado->nombres}} {{$datos_reserva_traslado->primer_apellido}} {{$datos_reserva_traslado->segundo_apellido}}</strong> Gracias por tu solicitud de cotizacion de traslado.</h6>
            <h6>La información sobre su cotización se enviará a esta dirección de correo electrónico: <strong> {{$datos_reserva_traslado->email}}</strong></h6>
            <h6>Uno de nuestros administradores se pondrá en contacto con usted al numero <strong> {{$datos_reserva_traslado->telefono}}</strong> para tratar asuntos relacionados con su solicitud de traslado</h6>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">                
                        <img src="img/viaje_en_carro.jpg" class="rounded mx-auto d-block" alt="" style="width:100%"/> 
        </div>
    </div>
    </div>
</section>
    <div class="container">
        <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <h6><strong>Datos Generales:</strong></h6>    
                            <dl>
                            <dt>Origen</dt>
                            <dd>{{$datos_reserva_traslado->lugar_salida}}</dd>
                            <dt>Destino</dt>
                            <dd>{{$datos_reserva_traslado->lugar_llegada}}</dd>
                            <dt>Fecha / Hora de llegada solicitada:</dt>
                            <dd>{{$datos_reserva_traslado->fecha_llegada_solicitada}} a las {{$datos_reserva_traslado->hora_llegada}} hrs</dd>
                            <dt>Número de pasajeros:</dt>
                            <dd>{{$datos_reserva_traslado->n_pasajeros}} Pasajeros</dd>
                            </dl> 
                </div>
                <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
                            <h6><strong><span class="colored">*Detalles a considerar:</span></strong></h6>    
                            <dl>
                            <dt>- Datos que contendrá el correo electronico enviado a su cuenta</dt>
                            <dt>- Flota de vehiculos disponibles</dt>
                            <dd>Los vehículos que se le proporcionarán dependen de la disponibilidad, segun la fecha y hora de salida que proporcionó y la fecha de llegada al destino calculada por el administrador.</dd>
                            <dt>- El costo del traslado:</dt>
                            <dd>Se calcula en base al vehículo que usted seleccione y le indique al administrador cuando este le llame multiplicado por los dias del traslado .</dd>
                            <dt>- Tarjeta de crédito</dt>
                            <dt>- Pago de garantia</dt>
                            <dd>De la tarjeta de crédito se retendrán 20,000.00MX como garantia en caso de cualquier siniestro o percanse.</dd>  
                            <dt>- Pago total de la renta</dt>
                            <dd>El pago total de la renta se liquida en el momento de la entrega el vehiculo.</dd>
                            <dt>- En caso de dudas</dt>
                            <dd>Consultar los términos y condiciones del servicio.</dd>
                            </dl> 
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <dt class = "text-danger"><strong>¡¡¡IMPORTANTE!!!</strong></dt>
                                <dd>De no cumplir con los documentos aqui mostrados, no se le podrá hacer entrega del vehículo, ni de su pago de reserva.</dd>
                                </dl> 
                    </div>
            <!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->

</div>
</div>
@endsection

