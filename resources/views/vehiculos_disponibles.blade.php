@extends('generar_cotizacion_traslado')
@section('contentPanel')
    <div class="row">
 
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
                                                'id_vehiculo'=>$vehiculo->idvehiculo
                                                ]) }}" class="btn btn-warning btn-sm">Seleccionar</a></dd> 
                    </dl> 
                    
                </div>
            </div>
    @endforeach
    </div>
@endsection