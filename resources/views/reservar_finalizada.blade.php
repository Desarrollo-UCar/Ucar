@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
            <h2 class="animated fadeInDown "><strong><span class="colored">CONFIRMACIÓN DE TU RESERVA!!!</span></strong></h2>
            <h6></h6>
            <h6> <strong>{{$cliente->nombre}} {{$cliente->apellidos}}</strong> Gracias por tu reservación.</h6>
            <h6>Acude a la Oficina U-car <strong>{{$alquiler->lugar_recogida}}</strong> que elegiste y presenta tu número de reserva:<strong>AF10{{$alquiler->id}}</strong> </h6>
            <h6>Si has incluido una dirección de correo electrónico en esta solicitud, la información sobre su reserva se enviará a esa dirección de correo electrónico: <strong> {{$cliente->correo}}</strong></h6>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">                
                        <img src="{{$vehiculo->foto}}" class="rounded mx-auto d-block" alt="" style="width:100%"/> 
        </div>
    </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div id="lista_itinerario">
                        <h6><strong>Tu Cotización:</strong></h6>    
                        <table class="table table-sm">
                        <tbody>
                            <tr><td><small>Kilometraje incluido</small></td>                    <td><small>Ilimitado</small></td></tr>
                            <tr><td><small>1 Día</small></td>                                   <td><small>${{number_format($vehiculo->precio,2)}}</small></td></tr>
                            <tr><td><small><strong>Subtotal MXN {{$dias}} Dia(s)</strong></small></td> <td><small><strong>${{number_format($total_vehiculo,2)}}</strong></small></td></tr>
                           
                            <tr><td><small>Servicios_extra</small></td>                   <td><small>{{$servicios_extra}}</small></td></tr>
                            
                            <tr><td><small><strong>Cargos Adicionales</strong></small></td>     <td><small></small></td></tr>
                            <tr><td><small>Cuota Aeropuerto</small></td>                        <td><small>$130.00</small></td></tr>
                            <tr><td><small>Cargo Por Servicio</small></td>                      <td><small>$10.00</small></td></tr>
                            <tr><td><small>IVA / TAX</small></td>                               <td><small>${{$iva}}</small></td></tr>
                            <tr><td><small><strong>Total</strong></small></td>                  <td><small><strong>${{$pago_reserva->total}}</strong></small></td></tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <div id="lista_itinerario">
                            <h6><strong>Datos Generales:</strong></h6>    
                            <dl>
                            <dt>Lugar de Recogida y Devolución</dt>
                            <dd>{{$alquiler->lugar_recogida}}</dd>
                            <dt>Fecha / Hora de recolección:</dt>
                            <dd>{{$alquiler->fecha_recogida}} a las {{$alquiler->hora_recogida}} hrs</dd>
                            <dt>Fecha / Hora de devolución:</dt>
                            <dd>{{$alquiler->fecha_devolucion}} a las {{$alquiler->hora_devolucion}} hrs</dd>

                            </dl> 
                        </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <div id="lista_itinerario">
                            <h6><strong>Tu vehículo:</strong></h6>  
                            <dl>
                            <dt>{{$vehiculo->marca}} {{$vehiculo->modelo}}</dt>
                            <dd><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</dd>
                            <dd><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</dd>
                            <dd><i class="fa fa-car"   aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</dd>
                            <dd><i class="fa fa-exchange"aria-hidden="true"></i>Transmisión {{$vehiculo->transmicion}}</dd>
                            <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</dd>
                            <dd><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</dd>
                            <dd><i class="fa fa-bolt"       aria-hidden="true"></i>Color: {{$vehiculo->color}}</dd>
                            </dl> 
                             
                        </div>
                </div>
            <!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->

</div>
</div>
</section>
@endsection

