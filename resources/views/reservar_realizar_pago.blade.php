@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="inner-heading">
            <h2>Revisa y Reserva (Paso 4 de 4)</h2>
        </div>
        </div>
    </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div id="lista_itinerario">
                        <h6><strong>Tu Cotización:</strong></h6>    
                        <table class="table table-sm">
                        <tbody>
                            <tr><td><small>Kilometraje incluido</small></td>                    <td><small>Ilimitado</small></td></tr>
                            <tr><td><small>1 Día de alquiler</small></td>                                   <td><small>${{number_format($vehiculo->precio,2)}}</small></td></tr>
                            <tr><td><small><strong>Subtotal MXN {{$dias}} Dia(s)</strong></small></td> <td><small><strong>${{number_format($alquiler,2)}}</strong></small></td></tr>
                            @foreach($servicios_extra as $servicio)
                            <tr><td><small>{{$servicio->nombre}}</small></td>                   <td><small>${{$servicio->precioRenta}}.00</small></td></tr>
                            @endforeach
                            <tr><td><small><strong>Total</strong></small></td>                  <td><small><strong>${{$total}}</strong></small></td></tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div id="lista_itinerario">
                        <h6><strong>Datos Generales:</strong></h6>    
                        <dl>
                        <dt>Lugar de Recogida y Devolución</dt>
                        <dd>{{$datos_reserva->lugar_recogida}}</dd>
                        <dt>Fecha / Hora de recolección:</dt>
                        <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_recogida))}} a las {{$datos_reserva->hora_recogida}} hrs</dd>
                        <dt>Fecha / Hora de devolución:</dt>
                        <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_devolucion))}} a las {{$datos_reserva->hora_devolucion}} hrs</dd>
                        <dt>Descuentos y Tarifas</dt>
                        <dd>{{$datos_reserva->codigo_descuento}}</dd>
                        </dl> 
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">    
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

                        <form action="{{ route('validar_logeo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_reserva" value="{{$datos_reserva->id}}">
                            <button class="btn btn-primary" type="submit">Continuar</button>
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <img src="{{$vehiculo->foto}}" />
                    </div>

                </div>
                </div>
            <!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->

</div>
</div>
</section>
@endsection

