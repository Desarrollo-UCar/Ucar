
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
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">    
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
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <img src="{{$vehiculo->foto}}" />
                            <form action="{{ route('validar_logeo')}}" method="GET" enctype="multipart/form-data">
                            @csrf    
                            <input type="hidden" name="id_reserva" value="{{$datos_reserva->id}}">
                                @if(!(Auth::user()))
                                    <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                                    <a class="nav-link" href="{{ route('register',['id_reserva'=>$datos_reserva->id]) }}" >No tengo una cuenta.</a> 
                                    <label for="terminos_condiciones">
                                            <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="." required>
                                            HE LEÍDO Y ACEPTO LOS TÉRMINOS Y CONDICIONES
                                          </label>
                                @else
                                    <button class="btn btn-primary" type="submit">Continuar</button>
                                    <label for="terminos_condiciones">
                                            <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="." required>
                                            HE LEÍDO Y ACEPTO LOS TÉRMINOS Y CONDICIONES
                                          </label>
                                @endif
                            </form>
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">    
                                <style type="text/css">
                                    #global {
                                        height: 400px;
                                        width: 1100px;
                                        border: 1px solid #ddd;
                                        background: #f1f1f1;
                                        overflow-y: scroll;
                                    }
                                    #mensajes {
                                        height: auto;
                                    }
                                    .texto {
                                        padding:4px;
                                        background:#fff;
                                    }
                                    </style>
                                                                                <h6><strong>TÉRMINOS Y CONDICIONES:</strong></h6>  
                                    <div id="global">
                                      <div id="mensajes">
                                        <div class="texto">IMPORTANTE !!! DATOS DE EJEMPLO... EJEMPLO...</div><!-- utilizar para agregar parrafo por parrafo-->
                                        <div class="texto">Los precios señalados incluyen el IVA.

                                                El total aproximado del alquiler está basado en la información suministrada al momento de hacer su reservación. El conductor deberá presentar una tarjeta de crédito vigente con suficiente saldo disponible, licencia de conducir vigente y una identificación oficial a la hora de aperturar el contrato. Al momento de hacer valida la reservación se deberá suscribir la apertura del contrato de arrendamiento, y otorgar un deposito con cargo a la tarjeta de crédito, en garantía del cumplimiento fiel y puntual de todas y cada una de sus obligaciones adquiridas en el Contrato de Arrendamiento.
                                                
                                                Usted puede adquirir servicios adicionales que puede elegir al momento del alquiler, tales como recarga de combustible, protección LDW para el vehículo, sillas de bebe etc., pregunte a nuestros representantes, con gusto le darán los detalles.
                                                
                                                Si usted requiere un conductor adicional, es necesario que la persona esté presente en el momento de la apertura del contrato, sea mayor de edad (aplican cargos si es menor a 25 años de edad), tenga una licencia vigente y una identificación oficial con el fin de que sea registrado como conductor autorizado.
                                                
                                                La edad mínima para poder rentar o manejar una de nuestras unidades es de 18 años, habrá un cargo adicional si el conductor tiene entre 18 y 24 años de edad. En caso de devolución del vehículo posteriormente a la hora de devolución señalada en la reservación, aplicarán cargos adicionales por el tiempo excedente a la fecha de devolución, de acuerdo a la tarifa pública vigente exhibida a la vista del público en la localidad de devolución.
                                                
                                                El periodo mínimo de renta es de un día.
                                                
                                                El precio de su reservación incluye los servicios mencionados en esta reservación, y Cobertura de Protección de Responsabilidad Civil contra daños a terceros hasta por $700,000.00.00 Moneda Nacional, Incluye cuotas locales e IVA. Cualquier Cobertura de Protección y Servicios que no se encuentren mencionados como incluidos en esta reservación tienen un costo adicional de acuerdo a la tarifa pública vigente exhibida a la vista del público en la localidad de entrega de la Unidad.Aplican límites de protección y deducibles en algunas coberturas de protección, Aplica para todas las localidades Hertz AVASA de la República Mexicana.
                                                
                                                Su reservación es para tomar y devolver el auto en la ciudad y oficina de acuerdo a lo indicado en esta confirmación, si usted decide entregarlo en una oficina distinta a la pactada puede haber cargos adicionales, pregunte a nuestros representantes. El vehículo arrendado no podrá salir de los límites del Territorio de la República Mexicana, sin el previo consentimiento. Para poder ir a los Estados Unidos, además del previo consentimiento, se requiere la contratación de una cobertura de protección especial que deberá ser contratada al momento de la apertura del Contrato de acuerdo a la tarifa pública vigente exhibida a la vista del público en la localidad de entrega de la Unidad. No existe consentimiento y se encuentra prohibido salir de la República Mexicana por las fronteras del sur de la República Mexicana (ej. Guatemala y Belice). Le informamos que no aceptamos efectivo en ninguna de las oficinas de Hertz AVASA, sus tarjetas de crédito y débito son bienvenidas y aceptadas como forma de pago.</div>
                                        
                                      </div>
                                    </div>  
                            </div>
                   
            <!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->
</div>
</div>
</section>
@endsection

