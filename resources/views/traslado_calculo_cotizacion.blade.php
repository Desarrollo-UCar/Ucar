<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Ü-car Renta de vehículos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/flexslider.css" rel="stylesheet" />
    <link href="css/prettyPhoto.css" rel="stylesheet" />
    <link href="css/camera.css" rel="stylesheet" />
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/shortcodes.css" rel="stylesheet" />
    
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker.css" />
    <!-- Theme skin -->
    <link href="color/blue.css" rel="stylesheet" />
    <!-- iconos de materialice -->
    <style type="text/css">
      

      input:valid {
        border: 1px solid green;
      }
      input:invalid {
        border: 1px solid red;
      }
    </style>
  </head>
  <body>

    <div id="wrapper">
    <!-- INICIA header -->
     <header>
     <div class="bg-white">
      </div>
    <div class="container">
        <div class="row nomargin">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="logo">
                <a href="{{ route('index') }}"><img src="img/logo.png" alt="" style="width:25%"/></a>
            </div>
        </div>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
            <div class="navbar">
              <div class="navigation">
                <nav>
                  <ul class="nav ">
                    <li class="dropdown active">
                      <a href="{{ route('index') }}"> Inicio</a>
                    </li>

                    <li class="dropdown">
                      <a href="#">Reservación <i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li class="dropdown"><a href="#">Reservar<i class="icon-angle-right"></i></a>
                          <ul class="dropdown-menu sub-menu-level1">
                            <li><a href="{{ route('index') }}">Automovil</a></li>
                            <li><a href="{{ route('renta_traslado') }}">Traslado</a></li>
                            <li><a href="{{ route('en_construccion') }}">Flotilla(Empresa)</a></li>
                          </ul>
                        </li>
                        <li><a href="{{ route('dashboard_cliente') }}">Ver Reservaciones</a></li>   
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#">Sucursales <i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('sucursal_P_Escondido') }}">Puerto Escondido</a></li>
                        <li><a href="{{ route('sucursal_Ixtepec') }}">Aeropuerto Ixtepec</a></li>
                        <li><a href="{{ route('sucursal_Istmo') }}">Istmo</a></li>
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="{{ route('flota') }}">Flota</a>
                    </li>

                    <li class="dropdown">
                      <a href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    @if(!(Auth::user()))
                    <li class="dropdown">
                      <a href="{{ route('login')}}">Iniciar Sesión </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                  </ul>
                </nav>
              </div>
              <!-- end navigation -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- end header -->

    

    <section id="formulario">
    <div class="container">
        <div class="row">

                <!-- inicio card reserva -->
                <div class="card bg-light">
                <!--Card content-->
                <div class="card-body">
                    
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="container">
                    <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div id="lista_itinerario">
                        <h5 class="text-center"><strong></strong>Solicitud: <strong>{{$solicitud_traslado->id}}</strong></h5>
                            <h6><strong><span class="colored">Datos de Contacto:</span></strong></h6>    
                            <dl>
                            <dt>- Nombre</dt>
                            <dd>{{$solicitud_traslado->nombres}} {{$solicitud_traslado->primer_apellido}} {{$solicitud_traslado->segundo_apellido}}</dd>
                            <dt>- Teléfono</dt>
                            <dd>{{$solicitud_traslado->telefono}}</dd>
                            <dt>- Email</dt>
                            <dd>{{$solicitud_traslado->email}}</dd>
                            </dl> 
                        </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div id="lista_itinerario">
                            <h6><strong><span class="colored">Datos de solicitud Traslado:</span></strong></h6>    
                            <dl>
                            <dt>- Origen</dt>
                            <dd>{{$solicitud_traslado->lugar_salida}} </dd>
                            <dt>- Fecha y Hora de Salida</dt>
                            <dd>{{$solicitud_traslado->fecha_salida}} a las {{$solicitud_traslado->hora_salida}}</dd>
                            <dt>- Destino</dt>
                            <dd>{{$solicitud_traslado->lugar_llegada}} </dd>
                            <dt>- Fecha y Hora de Llegada</dt>
                            <dd>{{$solicitud_traslado->fecha_llegada_solicitada}} a las {{$solicitud_traslado->hora_llegada}}</dd>
                            <dt>- N° de Pasajeros</dt>
                            <dd>{{$solicitud_traslado->n_pasajeros}} </dd>
                          @if($solicitud_traslado->viaje_redondo == 1)
                            <h6><strong><span class="colored">"Traslado Redondo"</span></strong></h6>    
                            <dt>- Dias extra de Espera</dt>
                            <dd>{{$solicitud_traslado->dias_espera}}</dd>
                          @endif
                            </dl>
                        </div>
                </div>
              </div>
            </div>
          </div>
{{--calculo de datos para el traslado  --}}

<div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <form id="reserva_traslado" action="{{ route('crear_reservacion_traslado')}}"  method="POST" enctype="multipart/form-data">
      @csrf
      <input type="text" class="form-control" value ="{{$solicitud_traslado->id}}" name="id_cotizacion" id="id_cotizacion" hidden>
      <input type="text" class="form-control" value ="{{$vehiculo->idvehiculo}}" name="id_vehiculo" id="id_vehiculo" hidden>
        <div class="row">
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                  <label for="lugar_llegada">DIAS DE RENTA</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Dias" value ="{{$dias}} viaje, {{$solicitud_traslado->dias_espera}} espera" name="dias" id="dias" readonly required>
                  </div>   
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                  <label for="lugar_llegada">HORAS DE RENTA</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Horas" value ="{{$horas}} hrs de viaje" name="horas" id="horas" title="Horas extra de viaje" readonly required>
                  </div>   
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">SUBTOTAL RENTA</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Subtotal" value ="{{number_format($subtotal,2)}}" name="subtotal_renta" id="subtotal_renta" title="Subtotal calculado en base a los dias y horas de renta por el precio de alquiler del auto por dia" readonly required>
              </div>   
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label>*Despues de 8 hrs se cobra el dia completo</label>  
          </div>
</div>
<div class="row">
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">N° DE CHOFERES</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="N° Choferes" name="n_choferes" id="n_choferes" pattern="[0-9]" min = "1" max="3" title="" onchange="total_sueldo_choferes();" required>
              </div>   
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">SUELDO POR CHOFER</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Por Chofer" name="sueldo_chofer" id="sueldo_chofer" pattern="[0-9]*"  title="El sueldo ingresado es por chofer" onchange="total_sueldo_choferes();" required>
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">TOTAL SUELDO CHOFER</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Total Sueldo Chofer" name="total_sueldo_chofer" id="total_sueldo_chofer" pattern="[0-9]*" title="" readonly required>
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              @if($solicitud_traslado->viaje_redondo == 1)
              <h6><strong><span class="colored">"Traslado Redondo"</span></strong></h6>    
              @endif
          </div>
</div>
<div class="row">
          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="fecha">SALIDA DE SUCURSAL</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                  </div>
                  <input id = 'fecha_salida_sucursal' name = 'fecha_salida_sucursal' class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Fecha de salida de la sucursal en Formato: DD-MM-YYYY"  required>
              </div>
          </div>
          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="horaRecogida">HORA DE SALIDA</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                  </div>
                  <select name = 'hora_salida' class="form-control" required>
                      <option>00:00</option><option>00:30</option>
                      <option>01:00</option><option>01:30</option>
                      <option>02:00</option><option>02:30</option>
                      <option>03:00</option><option>03:30</option>
                      <option>04:00</option><option>04:30</option>
                      <option>05:00</option><option>05:30</option>
                      <option>06:00</option><option>06:30</option>
                      <option>07:00</option><option>07:30</option>
                                      <option>08:00</option><option>08:30</option>
                                      <option>09:00</option><option>09:30</option>
                                      <option>10:00</option><option>10:30</option>
                                      <option>11:00</option><option>11:30</option>
                                      <option>12:00</option><option>12:30</option>
                                      <option>13:00</option><option>13:30</option>
                                      <option>14:00</option><option>14:30</option>
                                      <option>15:00</option><option>15:30</option>
                                      <option>16:00</option><option>16:30</option>
                                      <option>17:00</option><option>17:30</option>
                                      <option>18:00</option><option>18:30</option>
                                      <option>19:00</option><option>19:30</option>
                                      <option>20:00</option><option>20:30</option>
                                      <option>21:00</option><option>21:30</option>
                                      <option>22:00</option><option>22:30</option>
                                      <option>23:00</option><option>23:30</option>
                  </select>
              </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">KM SUCURSAL - ORIGEN</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="km a recorrer" name="km" id="km" pattern="[0-9]*" title="kilometros a recorrer para llegar al punto de salida del cliente desde la sucursal donde se encuentra el vehiculo" onchange="total_gastos_previos();" required>
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">PRECIO GASOLINA</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="$ gasolina" name="gasolina" id="gasolina" pattern="[0-9]*" title="Se requiere para calcular los gastos antes de llegar con el cliente" onchange="total_gastos_previos();" required>
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">OTROS GASTOS (Casetas)</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Posibles gastos" name="otros_gastos" id="otros_gastos" pattern="[0-9]*" title="Por si se generará algun gasto no especificado en este formulario. Ejemplo: casetas" onchange="total_gastos_previos();">
              </div>     
          </div>
         
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">TOTAL GASTOS PREVIOS</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Total gastos previos" name="total_previos" id="total_previos" pattern="[0-9]*" title=""  readonly required>
              </div>     
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label>*Los gastos previos estan calculados en base a la distancia(KM) entre sucursal-origen, multiplicado por dos, debido a el costo del viaje de regreso origen-sucursal.</label>  
          </div>

</div>
<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <label for="lugar_llegada">SUBTOTAL</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
            </div>
            <input type="number" class="form-control" placeholder="subtotal"  name="subtotal" id="subtotal" pattern="[0-9]*" title="Subtotal renta + Total sueldo chofer + Total gastos previos" onchange="costo_total();" required>
        </div>     
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <label for="lugar_llegada">% DESCUENTO</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
            </div>
            <input type="number" class="form-control" placeholder="Descuento"  name="descuento" id="descuento" pattern="[0-9]*" title="valor ingresado en porcentaje" min = "0" max="100" onchange="costo_total();">
        </div>     
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <label for="lugar_llegada">COSTO TOTAL</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
            </div>
            <input type="number" class="form-control" placeholder="Total" name="total" id="total" pattern="[0-9]*" title="Subtotal - porcentaje de descuento"  required>
        </div>     
    </div>
    <div class="form-group col-md-3 col-sm-3">
        <button type="submit" class="btn btn-medium btn-theme" style="margin-top: 6%;"> Confirmar</button>
</div> 
</div>                
<div class="row">
        <div class="form-group col-md-12 col-sm-12">
            <h6><strong>Vehiculo seleccionado:</strong></h6>  
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h5><strong><span class="colored"> {{$vehiculo->marca}}  {{$vehiculo->modelo}} </span>{{$vehiculo->nombre}}</strong></h5>
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
            <dd>Costo por dia:</dd>
            <dd><h4><strong><span class="colored"> $ {{number_format($vehiculo->precio,2)}} MXN</span></strong></h4></dd>
            <dd>Incluye IVA</dd>

        </dl> 
        
    </div>
    </div>
    </div>

</div>


</form>
</div>


    </div>

   {{--termina lateral de datos ya obtenidos  --}}
</div>
</div> 

           

  



    </div>
    </div>
    
    
    </section>
<!-- Footer -->
<footer class=" font-small bg-dark text-white">
<!-- Footer Links -->
<div class="container">
<!-- Footer links -->
<div class="row">
<!-- Grid column -->
<div class="col-sm-1 col-md-1 col-lg-1 col-xl-1">
<a href="{{ route('index') }}"><img src="img/logo.png" alt="Logo ucar" style="width:90%"/></a>
</div>  
<!-- Grid column -->
<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Nosotros</h6>
    <p>Somos una empresa dedicada al servicio de renta de automóviles, traslados, especializados en flotillas</p>
</div>
<!-- Grid column -->
<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Reservaciones</h6>
    <p><a href="{{ route('index') }}">Iniciar una reservación</a></p>
    <p><a href="{{ route('en_construccion') }}">Ver / Modificar / Cancelar una reservación</a></p>
  
</div>
<!-- Grid column -->
<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Vehículos</h6>
    <p><a href="{{ route('flota') }}">Toda la flota</a></p>
</div>
<!-- Grid column -->
<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Promociones</h6>
    <p><a href="{{ route('en_construccion') }}">Promociones</a></p>
    <p><a href="{{ route('en_construccion') }}">Acerca de las promociones</a></p>
</div>
<!-- Grid column -->

<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
    <h6 class="text-uppercase font-weight-bold">Servicios al cliente</h6>
    <p><a href="{{ route('en_construccion') }}">Aviso de privacidad  </a></p>
    <p><a href="{{ route('en_construccion') }}">Politicas de renta</a></p>
    <p><a href="{{ route('en_construccion') }}">Protecciones</a></p>
    <p><a href="{{ route('en_construccion') }}">Preguntas Frecuentes</a></p>
    <p><a href="{{ route('en_construccion') }}">Contacto</a></p>
</div>
<!-- Grid column -->
<div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
    <h6 class="text-uppercase font-weight-bold">Oficinas</h6>
    <p><a href="{{ route('sucursal_P_Escondido') }}">Puerto Escondido, Oaxaca, (954) 582-32-24 / + 52 954 149 0304 </a></p>
    <p><a href="{{ route('sucursal_Ixtepec') }}">Aeropuerto, Ixtepec, Oaxaca, +52 954 149 0304 </a></p>
    <p><a href="{{ route('sucursal_Istmo') }}">Istmo, Oaxaca, +52 954 149 0304 </a></p>
</div>
                <!-- Grid column -->
</div>
<!-- Footer links -->
<!-- Grid row -->
</div>
  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="copyright">
            <p><span>&copy;2019 Ü-CAR. Todos los derechos reservados.</span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Footer Links -->
</footer>
</div>
<!-- Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- javascript================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap.js"></script>

  <script src="js/modernizr.custom.js"></script>
  <script src="js/toucheffects.js"></script>
  <script src="js/google-code-prettify/prettify.js"></script>
  <script src="js/jquery.bxslider.min.js"></script>
  <script src="js/camera/camera.js"></script>
  <script src="js/camera/setting.js"></script>

  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/portfolio/jquery.quicksand.js"></script>
  <script src="js/portfolio/setting.js"></script>

  <script src="js/jquery.flexslider.js"></script>
  <script src="js/animate.js"></script>
  <script src="js/inview.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/custom.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script>
    $('#fecha_salida_sucursal').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "singleDatePicker": true,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  document.getElementById('fecha_salida_sucursal').value = end.format('DD-MM-YYYY');
});
</script>
<script>
function total_sueldo_choferes(){
    var n_choferes = document.getElementById("n_choferes").value;
    var sueldo_chofer = document.getElementById("sueldo_chofer").value;
    if(n_choferes != "" & sueldo_chofer != ""){
      document.getElementById("total_sueldo_chofer").value = n_choferes * sueldo_chofer;
      obtener_subtotal();
    }else{
      document.getElementById("total_sueldo_chofer").value = null;
      obtener_subtotal();
    }
  };
  //
  function total_gastos_previos(){
    var km = document.getElementById("km").value;
    var gasolina = document.getElementById("gasolina").value;
    var otros_gastos = document.getElementById("otros_gastos").value
    if(km != "" & gasolina != ""){
      if(otros_gastos != ""){
        document.getElementById("total_previos").value = ((parseInt(km) / parseInt({{$vehiculo->rendimiento}})) * parseInt(gasolina) + parseInt(otros_gastos));
        obtener_subtotal();
      }else{
        document.getElementById("total_previos").value = ( (parseInt(km) / parseInt({{$vehiculo->rendimiento}})) * parseInt(gasolina) ) ;
        obtener_subtotal();
      }
    }else{
      document.getElementById("total_previos").value = null;
      obtener_subtotal();
    }
  };
  //
  function obtener_subtotal(){
    var total_previos = document.getElementById("total_previos").value;
    var total_sueldo_chofer = document.getElementById("total_sueldo_chofer").value;
    var otros_gastos = document.getElementById("otros_gastos").value;
    //preguntar antes por los nullos
    if(total_previos != "" & total_sueldo_chofer != "")
      document.getElementById("subtotal").value =   parseInt(total_previos) + parseInt(total_sueldo_chofer) + parseInt({{$subtotal}});
      else
      document.getElementById("subtotal").value =  null;
  };
  // 
  function costo_total(){
    var subtotal = document.getElementById("subtotal").value;
    var descuento = document.getElementById("descuento").value;
    if(subtotal != ""){
      document.getElementById("total").value = subtotal - (parseInt( subtotal) / 100 * parseInt( descuento)) ;
    }
  };
</script>
</body>
</html>

