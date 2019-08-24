@extends('plantilla')
@section('seccion')

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
                            <tr><td><small>        Kilometraje Estimado</small></td>                            <td><small>{{$datos_reserva_traslado->km_recorridos}}</small></td></tr>
                            <tr><td><small><strong>Alquiler de Vehiculo</strong></small></td></tr>
                            <tr><td><small>        1 dia:  {{number_format($vehiculo->precio,2)}}</small> </td><td><small>3 Dia(s): ${{number_format($vehiculo->precio,2)}}</small></td>
                            <tr><td><small><strong>Viáticos y pago del conductor</strong></small></td></tr>
                            <tr><td><small>        1 dia: ${{number_format($vehiculo->precio,2)}}</small> </td><td><small>3 Dia(s):  ${{number_format($vehiculo->precio,2)}}</small></td>
                            <tr><td><small><strong>Casetas estimadas: </strong></small></td>                    <td><small><strong>$ 500.00</strong></small></td></tr>
                            <tr><td><small><strong>Consumo Estimado de Gasolina: </strong></small></td>         <td><small><strong>$ 500.00</strong></small></td></tr>
                            <tr><td><small>        IVA / TAX</small></td>                                       <td><small>$300.00</small></td></tr>
                            <tr><td><small><strong>Total</strong></small></td>                                  <td><small><strong>$4,000.00</strong></small></td></tr>
                        </tbody>
                        </table>
                    </div>
                </div>
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
                                <dt>Tarifa por dia: ${{$vehiculo->precio}}</dt>
                            </dl> 
                        </div>
                        <a a href="{{ route('index') }}" class="btn btn-warning btn-sm">Modificar</a>   
                </div>
                </aside>
            </div>
            <!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->
    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
        <h2 class="animated fadeInDown "><strong><span class="colored">IMPORTANTE!!!</span></strong></h2>
        <h5 class="animated fadeInDown ">Los datos aqui mostrados solo son de informacion</h5>
        <h6 class="animated fadeInDown ">Para poder ofercerle una cotizacion mas elaborada favor de añexar los siguientes datos</h6>
        <form action="{{ route('solicita_informacion_traslado')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                    <div class="form-row" style="display: none;" id="datos_enviados">
                            <input name ="id"  type="text" id = "id" value = {{$datos_reserva_traslado->id}} readonly = "readonly">
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
                <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
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
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="pricing-box-wrap special animated-fast flyIn">
                        <div class="pricing-heading">
                        <h3>solicitar <strong>información</strong></h3>
                        <h6>Uno de nuestros administradores se pondrá en contacto a la brevedad</h6>
                        </div>
                        <div class="pricing-action">
                        </div>
                        <div class="pricing-action">
                            <button class="btn btn-primary btn-lg" type="submit" name = "btnAccion" value= "solitud_de_traslado">Reservar</button>
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

