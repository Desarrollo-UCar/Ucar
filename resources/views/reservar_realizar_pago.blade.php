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
                <aside class="left-sidebar">
                <div class="widget">
                    <div id="lista_itinerario">
                        <h6><strong>Tu Cotización:</strong></h6>    
                        <table class="table table-sm">
                        <tbody>
                            <tr><td><small>Kilometraje incluido</small></td>                    <td><small>Ilimitado</small></td></tr>
                            <tr><td><small>1 Día</small></td>                                   <td><small>${{number_format($vehiculo->precio,2)}}</small></td></tr>
                            <tr><td><small><strong>Subtotal MXN {{$dias}} Dia(s)</strong></small></td> <td><small><strong>${{number_format($alquiler,2)}}</strong></small></td></tr>
                            @foreach($servicios_extra as $servicio)
                            <tr><td><small>{{$servicio->nombre}}</small></td>                   <td><small>${{$servicio->precioRenta}}.00</small></td></tr>
                            @endforeach
                            <tr><td><small><strong>Cargos Adicionales</strong></small></td>     <td><small></small></td></tr>
                            <tr><td><small>Cuota Aeropuerto</small></td>                        <td><small>$130.00</small></td></tr>
                            <tr><td><small>Cargo Por Servicio</small></td>                      <td><small>$10.00</small></td></tr>
                            <tr><td><small>IVA / TAX</small></td>                               <td><small>${{$iva}}</small></td></tr>
                            <tr><td><small><strong>Total</strong></small></td>                  <td><small><strong>${{$total}}</strong></small></td></tr>
                            <tr><td><small><strong>Pagando con Prepago</strong></small></td>    <td><small><strong>${{$prepago}}</strong></small></td></tr>
                        </tbody>
                        </table>
                    </div>
                </div>
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
                            <img src="{{$vehiculo->imagen}}" class="rounded mx-auto d-block" alt="" style="width:80%"/>  
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
                <div class="widget">
                        <div id="lista_extra">
                            <h6><strong>Servicios Extra:</strong></h6>    
                            <dl>
                            @foreach($servicios_extra as $servicio) 
                            <dd><img src="{{$servicio->imagen}}" class="rounded mx-auto" alt=""/>   {{$servicio->nombre}}</dd>
                            @endforeach
                            </dl> 
                        </div>
                </div>
                </aside>
            </div>
            <!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->
    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
        <h5 >Datos Requeridos Para el Pago</h5>
        <form action="{{ route('pago_paypal')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                    <div class="form-row" style="display: none;" id="datos_enviados">
                            <input name ="id"  type="text" id = "id" value = {{$datos_reserva->id}} readonly = "readonly">
                    </div>
                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <label for="nombre">NOMBRE</label>
                    <input type="text" class="form-control" id="nombre" name = "nombre" required>
                </div>
                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <label for="primer_apellido">PRIMER APELLIDO</label>
                    <input type="text" class="form-control" id="primer_apellido" name = "primer_apellido" required>
                </div>
                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <label for="segundo_apellido">SEGUNDO APELLIDO</label>
                    <input type="text" class="form-control" id="segundo_apellido" name = "segundo_apellido">
                </div>
                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <label for="nacionalidad">NACIONALIDAD</label>
                    <input type="text" class="form-control" id="nacionalidad" name = "nacionalidad" required>
                </div>
                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <label for="celular">CELULAR</label>
                    <input type="text" class="form-control" id="celular" name = "celular" required>
                </div>
                <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label for="email">EMAIL</label>
                    <input type="email" class="form-control" id="email" name = "email" required>
                </div>
                <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label for="confirma_email">CONFIRMAR EMAIL</label>
                    <input type="email" class="form-control" id="confirma_email" name = "confirma_email" required>
                </div>
            </div>
            <h5 >Método de Pago</h5>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="pricing-box-wrap special animated-fast flyIn">
                        <div class="pricing-heading">
                        <h3>Prepaga en <strong>Linea</strong></h3>
                        <h6>Tarjeta de crédito o débito y llévate 10% de descuento</h6>
                        </div>
                        <div class="pricing-action">
                        </div>
                        <div class="pricing-action">
                            <button class="btn btn-primary btn-lg" type="submit" name = "btnAccion" value= "pago_linea">Reservar</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="pricing-box-wrap animated-fast flyIn">
                        <div class="pricing-heading">
                        <h3>Paga en <strong>Mostrador</strong></h3>
                        <h6></h6>
                        <h6 class="text-white text-center">Paga la totalidad al momento de recoger tu vehÍculo en sucursal</h6>
                        </div>
                        <div class="pricing-action">
                        </div>
                        <div class="pricing-action">
                            <button class="btn btn-primary btn-lg" type="submit" name = "btnAccion" value= "pago_mostrador">Reservar</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <input class="form-check-input" type="checkbox" value="" id="terminos_condiciones" name = 'terminos_condiciones' required>
                    <label for="terminos_condiciones">Debes estar de acuerdo con los terminos y condiciones.</label>
                    <p>El total se basa en la información disponible al momento de la reserva para los arrendatarios mayores de 25 años. Los servicios opcionales que puedes elegir al momento del alquiler, tales como recarga de combustible, protección LDW para el vehículo, etc., no están incluidos.</p>
                </div>
            </div>
        </form>


    </div>

</div>
</div>
</section>
@endsection

