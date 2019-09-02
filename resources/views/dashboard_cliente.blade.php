@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="inner-heading">
            <h2>Consulta tus Reservaciones</h2>
        </div>
        </div>
    </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
@foreach($vehiculos_disponibles as $vehiculo)
        <div class="row">
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <h6><strong>Datos Generales:</strong></h6>    
                <dl>
                    <dt>Lugar de Recogida y Devolución</dt>
                    <dd>{{$datos_reserva->lugar_recogida}}</dd>
                    <dt>Fecha / Hora de recolección:</dt>
                    <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_recogida))}} a las {{$datos_reserva->hora_recogida}} hrs</dd>
                    <dt>Fecha / Hora de devolución:</dt>
                    <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_devolucion))}} a las {{$datos_reserva->hora_devolucion}} hrs</dd>
                    <dt>Servicios extra:</dt>
                    <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_devolucion))}} a las {{$datos_reserva->hora_devolucion}} hrs</dd>
                </dl> 
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <div class="post-slider">
                    <div class="flexslider">
                            <h5><strong><span class="colored"> {{$vehiculo->marca}}  {{$vehiculo->modelo}}</span></strong></h5>
                            <img src="{{$vehiculo->foto}}" />
                    </div>
                    <!-- end flexslider -->
                </div>
            </div>
            <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    >>> {{$vehiculo->tipo}}
                <ul>
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
                    <dd><h4><strong><span class="colored"> $ {{number_format($vehiculo->precio,2)}} MXN</span></strong></h4></dd>
                    <dd>Kilometraje Ilimitado</dd>
                    <dd>Incluye IVA</dd>
                    <dd><a a href="{{ route('reservar_servicios_extra',[
                                            'id_reserva'=>$datos_reserva->id,
                                            'id_vehiculo'=>$vehiculo->idvehiculo
                                            ]) }}" class="btn btn-warning btn-sm">reservar Ahora</a></dd> 
                </dl> 
            </div>
        </div>
@endforeach
        </div>
    </div>
</section>
@endsection
