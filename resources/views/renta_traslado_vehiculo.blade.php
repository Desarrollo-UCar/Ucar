@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="inner-heading">
            <h2>Selecciona tu Vehículo</h2>
        </div>
        </div>
    </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <aside class="left-sidebar">
              <div class="widget">
                    <div id="lista_itinerario">
                        <h6><strong>Datos Generales:</strong></h6>    
                        <dl>
                            <dt>Lugar de salida</dt>
                            <dd>{{$datos_reserva_traslado->lugar_salida}}</dd>
                            <dt>Fecha / Hora de salida:</dt>
                            <dd>{{$datos_reserva_traslado->fecha_salida}} a las {{$datos_reserva_traslado->hora_salida}} hrs</dd>
                            <dt>Lugar de llegada</dt>
                            <dd>{{$datos_reserva_traslado->lugar_llegada}}</dd>
                            <dt>Fecha / Hora de llegada estimada:</dt>
                            <dd>{{$datos_reserva_traslado->fecha_llegada_estimada}} a las {{$datos_reserva_traslado->hora_llegada_estimada}} hrs</dd>
                            <dt>Kilometros a recorrer:</dt>
                            <dd>{{$datos_reserva_traslado->km_recorridos}}</dd>
                            <dt>Tiempo estimado de viaje:</dt>
                            <dd>{{$datos_reserva_traslado->tiempo_estimado}}</dd>
                            <dt>Sucursal encargada</dt>
                            
                        </dl> 
                    </div>
                    <a a href="{{ route('renta_traslado') }}" class="btn btn-warning btn-sm">Modificar</a>    
              </div>
            </aside>
          </div>
          <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
@foreach($vehiculos_disponibles as $vehiculo)
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h5><strong><span class="colored"> {{$vehiculo->marca}}  {{$vehiculo->modelo}}</span></strong></h5>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="post-slider">
                    <div class="flexslider">
                            <img src="{{$vehiculo->foto}}" />
                    </div>
                    <!-- end flexslider -->
                </div>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <ul>
                    <li>{{$vehiculo->tipo}}</li>
                    <li><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</li>
                    <li><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</li>
                    <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</li>
                    <li><i class="fa fa-exchange"   aria-hidden="true"></i>Transmisión:  {{$vehiculo->transmicion}} </li>
                    <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</li>
                    <li><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</li>
                    <li><i class="fa fa-pencil-square"aria-hidden="true"></i>Color: {{$vehiculo->color}}</li>
                    <li></i>{{$vehiculo->descripcion}}</li>
                    </ul>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <dl>
                    <dd>Total a pagar:</dd>
                    <dd><h4><strong><span class="colored"> $ {{$vehiculo->precio}} MXN</span></strong></h4></dd>
                    <dd>Kilometraje ilimitado</dd>
                    <dd>incluye cuotas e IVA</dd>
                </dl> 
                <a a href="{{ route('renta_traslado_datos',[
                'id_reserva_traslado'=>$datos_reserva_traslado->id,
                'id_vehiculo'=>$vehiculo->idvehiculo
                ]) }}" class="btn btn-warning btn-sm">reservar Ahora</a> 
            </div>
        </div>
@endforeach
            </div>
        </div>
    </div>
</section>
@endsection
