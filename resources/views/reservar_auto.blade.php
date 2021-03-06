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
          <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <aside class="left-sidebar">
              <div class="widget">
                    <div id="lista_itinerario">
                        <h6><strong>Datos Generales:</strong></h6>    
                        <dl>
                            <dt>Lugar de Entrega y Devolución</dt>
                            <dd>{{$sucursal->nombre}}</dd>
                            <dt>Fecha / Hora de recolección:</dt>
                            <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_recogida))}} a las {{$datos_reserva->hora_recogida}} hrs</dd>
                            <dt>Fecha / Hora de devolución:</dt>
                            <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_devolucion))}} a las {{$datos_reserva->hora_devolucion}} hrs</dd>
                        </dl> 
                    </div>   
              </div>
            </aside>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-8 col-xl-9 mx-auto">
              @if(empty($vehiculos_disponibles)==false)
@foreach($vehiculos_disponibles as $vehiculo)
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h5><strong><span class="colored"> {{$vehiculo->marca}}  {{$vehiculo->modelo}}</span></strong></h5>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="post-slider">
                    <div class="flexslider">
                            <img src="{{ '/images/'.$vehiculo->foto}}"/>
                    </div>
                    <!-- end flexslider -->
                </div>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    
                    <h6><strong>{{$vehiculo->tipo}}</strong></h6>
                <ul>
                @if($vehiculo->tipo != "motoneta")
                <li><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</li>
                <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</li>
                <li><i class="fa fa-exchange"   aria-hidden="true"></i>Transmisión:  {{$vehiculo->transmicion}} </li>
                <li><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</li>
                <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</li>
                <li><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</li>
                <li><i class="fa fa-pencil-square"aria-hidden="true"></i>Color: {{$vehiculo->color}}</li>
                <li></i>{{$vehiculo->descripcion}}</li>
                @else
                <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->cilindros}} CC</li>
                <li><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</li>
                <li><i class="fa fa-pencil-square"aria-hidden="true"></i>Color: {{$vehiculo->color}}</li>
                <li></i>{{$vehiculo->descripcion}}</li>
                @endif
                </ul>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <dl>
                    <dd>Total a pagar:</dd>
                    <dd><h4><strong><span class="colored"> $ {{number_format($vehiculo->precio,2)}} MXN</span></strong></h4></dd>
                    <dd>Kilometraje Ilimitado</dd>
                    <dd>Incluye IVA</dd>
                    <dd><a a href="{{ route('reservar_servicios_extra',[
                                            'id_reserva'=>$datos_reserva->id,
                                            'id_vehiculo'=>$vehiculo->idvehiculo
                                            ]) }}" class="btn btn-warning btn-sm">Seleccionar</a></dd> 
                </dl> 
                
            </div>
        </div>
@endforeach
@else
<div class='col-sm-6 col-md-6 col-lg-8 col-xl-9 mx-auto'>
<h1> <b>  LO SENTIMOS </b> <br> NINGUN VEHICULO DISPONIBLE.</h1>
</div>
@endif
            </div>
        </div>
    </div>
</section>
@endsection
