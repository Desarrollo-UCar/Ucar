@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="inner-heading">
            <h2>Elige Servicios Adicionales (Paso 3 de 4)</h2>
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
                            <dt>Lugar de Recogida y Devolución</dt>
                            <dd>{{$datos_reserva->lugar_recogida}}</dd>
                            <dt>Fecha / Hora de recolección:</dt>
                            <dd>{{$datos_reserva->fecha_recogida}} a las {{$datos_reserva->hora_recogida}} hrs</dd>
                            <dt>Fecha / Hora de devolución:</dt>
                            <dd>{{$datos_reserva->fecha_devolucion}} a las {{$datos_reserva->hora_devolucion}} hrs</dd>
                            <dt>Vehiculo de Preferencia:</dt>
                            <dd>{{$datos_reserva->tipo_vehiculo}}</dd>
                            <dt>Descuentos y Tarifas</dt>
                            <dd>{{$datos_reserva->codigo_descuento}}</dd>
                            </dl> 
                        </div>
                        <a a href="{{ route('index') }}" class="btn btn-warning btn-sm">Modificar</a>   
                </div>
                <div class="widget">
                        <div id="lista_itinerario">
                            <h6><strong>Tu vehículo:</strong></h6>  
                            <img src="{{$vehiculo->foto}}" class="rounded mx-auto d-block" alt="" style="width:80%"/>  
                            <dl>
                                <dt>{{$vehiculo->marca}} {{$vehiculo->modelo}}</dt>
                                <dd><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</dd>
                                <dd><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</dd>
                                <dd><i class="fa fa-car"   aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</dd>
                                <dd><i class="fa fa-exchange"aria-hidden="true"></i>Transmisión {{$vehiculo->transmicion}}</dd>
                                <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</dd>
                                <dd><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</dd>
                                <dd><i class="fa fa-bolt"       aria-hidden="true"></i>Color: {{$vehiculo->color}}</dd>
                                <dt>Tarifa: ${{$vehiculo->precio}}</dt>
                            </dl> 
                        </div>
                        <a a href="{{ route('index') }}" class="btn btn-warning btn-sm">Modificar</a>   
                </div>
                </aside>
            </div>
            <!-- tabla de servicios extra -->
            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                <form action="{{ route('reservar_realizar_pago')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <input type="hidden" name="id_vehiculo" value="{{$vehiculo->idvehiculo}}">
                        <input type="hidden" name="id_reserva" value="{{$datos_reserva->id}}">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">Agregar</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($servicios_extra as $servicio)
                                    <tr>
                                    <th scope="row">
                                        <div class="text-center">
                                        <input class="form-check-input" name = "id[]" value = "{{$servicio->idserviciosextra}}" type="checkbox" >
                                        </div>     
                                    </th>
                                    <td><img src="{{$servicio->foto}}" class="rounded mx-auto d-block" alt=""/></td>
                                    <td>
                                        <h6>{{$servicio->nombre}}</h6>
                                        <p>{{$servicio->descripcion}}</p>
                                    </td>
                                    <td>
                                        <h6 class="text-center"><strong><span class="colored">{{$servicio->precio}}.00 MXN</span></strong></h6>
                                        <h6 class="text-center"><small>Por Día</small></h6>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-primary" type="submit">Reservar Ahora</button>
                        </div>
                    </div>
                </form>
            </div>
<!-- fin de tabla de servicios extra -->
        </div>
    </div>
</section>
@endsection
