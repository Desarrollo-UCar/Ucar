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
      <div class="bg-white" id='formulario_reserva_vehiculo'>
        <h5 class="text-center"><strong>Generar cotización </strong>del tralado --- Solicitud: <strong>{{$solicitud_traslado->id}}</strong></h5>
        <h5 class="text-center"></h5>
    </div>
    <div class="container">


      
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- inicio card reserva -->
                <div class="card bg-light text-white">
                <!--Card content-->
                <div class="card-body">
                    <!-- inicio Formulario reserva-->
                    <form id="reserva_traslado" action="{{ route('vehiculos_disponibles')}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-12 col-sm-12">
                            <h6><strong>Información de contacto del cliente:</strong></h6>  
                            <input type="hidden" id='id' name="id" value={{$solicitud_traslado->id}}>
                        </div>
                            {{-- FORMULARIO DE NOMBRES --}}                     
                            <div class="form-group col-md-3 col-sm-3">
                                    <label>Nombres</label>
                                    <input id="nombres" type="text" class="form-control" value ="{{$solicitud_traslado->nombres}}" placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly = "readonly" required>
                                    
                                </div> 
                            {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                            <div class="form-group col-md-2 col-sm-2">
                            <label>Primer Apellido </label>
                            <input type="text" class="form-control" placeholder="primer apellido" value ="{{$solicitud_traslado->primer_apellido}}" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="primerApellido" readonly = "readonly" required>
                            
                            </div> 
                            {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                            <div class="form-group col-md-2 col-sm-2">
                            <label>Segundo Apellido</label>
                            <input type="text" class="form-control" placeholder="segundo apellido" value ="{{$solicitud_traslado->segundo_apellido}}" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly = "readonly" id="segundoApellido" required>

                            </div>
                            {{--DATOS PARA EL TELEFONO--}}
                            <div class="form-group col-md-2 col-sm-2">
                                <label>Teléfono</label>
                            <input type="text" class="form-control" placeholder="Teléfono" value ="{{$solicitud_traslado->telefono}}" name="telefono" id="telefono" pattern="[0-9]*" minlength = "10" maxlength="10" title="Número a 10 digitos" readonly = "readonly" required>
                            </div> 
                            {{--FORMULARIO DE CORREO EMAIL--}}
                            <div class="form-group col-md-3 col-sm-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value ="{{$solicitud_traslado->email}}" placeholder="Correo Eléctronico" name="email" id="email" readonly = "readonly" required>

                                </div>

                    <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                              <h6><strong>Información de su cotización de viaje: (*Datos a rellenar)</strong></h6>  
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="lugar_salida">LUGAR DE SALIDA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'lugar_salida' id="origin-input" class="form-control form-control-lg" type="text" value ="{{$solicitud_traslado->lugar_salida}}" placeholder="Ingresa el lugar de salida" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="lugar_llegada">LUGAR DE LLEGADA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'lugar_llegada' id="destination-input" class="form-control form-control-lg" type="text" value ="{{$solicitud_traslado->lugar_llegada}}" placeholder="Ingresa el lugar de llegada" required>
                                </div>
                            </div>



                            <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                              <label for="fecha">*FECHA DE SALIDA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                  </div>
                                  @if(!$solicitud_traslado->fecha_salida == null)
                                  <input id = 'fecha_salida' name = 'fecha_salida' class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida" value="{{date("d\-m\-Y", strtotime($solicitud_traslado->fecha_salida))}}" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY"  required>
                                  @else
                                  <input id = 'fecha_salida' name = 'fecha_salida' class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida"  pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY"  required>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                              <label for="horaRecogida">*HORA DE SALIDA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                  </div>
                                  <select name = 'hora_salida' class="form-control" required>
                                      <option <?php if($solicitud_traslado->hora_salida == "00:00:00") echo "selected";?>>00:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "01:00:00") echo "selected";?>>01:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "02:00:00") echo "selected";?>>02:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "03:00:00") echo "selected";?>>03:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "04:00:00") echo "selected";?>>04:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "05:00:00") echo "selected";?>>05:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "06:00:00") echo "selected";?>>06:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "07:00:00") echo "selected";?>>07:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "08:00:00") echo "selected";?>>08:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "09:00:00") echo "selected";?>>09:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "10:00:00") echo "selected";?>>10:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "11:00:00") echo "selected";?>>11:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "12:00:00") echo "selected";?>>12:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "13:00:00") echo "selected";?>>13:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "14:00:00") echo "selected";?>>14:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "15:00:00") echo "selected";?>>15:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "16:00:00") echo "selected";?>>16:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "17:00:00") echo "selected";?>>17:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "18:00:00") echo "selected";?>>18:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "19:00:00") echo "selected";?>>19:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "20:00:00") echo "selected";?>>20:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "21:00:00") echo "selected";?>>21:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "22:00:00") echo "selected";?>>22:00</option>
                                      <option <?php if($solicitud_traslado->hora_salida == "23:00:00") echo "selected";?>>23:00</option>
                                  </select>
                              </div>
                          </div>

                        
                            <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="fecha">FECHA DE LLEGADA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                    </div>
                                    <input id = 'fecha_llegada_solicitada' name = 'fecha_llegada_solicitada' class="form-control" type="text" value ="{{date("d\-m\-Y", strtotime($solicitud_traslado->fecha_llegada_solicitada))}}" autocomplete="off" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY"  required>
                                </div>
                            </div>
                            <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label for="horaRecogida">HORA DE LLEGADA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'hora_llegada' class="form-control" required>
                                      <option <?php if($solicitud_traslado->hora_llegada == "00:00:00") echo "selected";?>>00:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "01:00:00") echo "selected";?>>01:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "02:00:00") echo "selected";?>>02:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "03:00:00") echo "selected";?>>03:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "04:00:00") echo "selected";?>>04:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "05:00:00") echo "selected";?>>05:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "06:00:00") echo "selected";?>>06:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "07:00:00") echo "selected";?>>07:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "08:00:00") echo "selected";?>>08:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "09:00:00") echo "selected";?>>09:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "10:00:00") echo "selected";?>>10:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "11:00:00") echo "selected";?>>11:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "12:00:00") echo "selected";?>>12:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "13:00:00") echo "selected";?>>13:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "14:00:00") echo "selected";?>>14:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "15:00:00") echo "selected";?>>15:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "16:00:00") echo "selected";?>>16:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "17:00:00") echo "selected";?>>17:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "18:00:00") echo "selected";?>>18:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "19:00:00") echo "selected";?>>19:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "20:00:00") echo "selected";?>>20:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "21:00:00") echo "selected";?>>21:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "22:00:00") echo "selected";?>>22:00</option>
                                      <option <?php if($solicitud_traslado->hora_llegada == "23:00:00") echo "selected";?>>23:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label for="lugar_llegada">N° PASAJEROS</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="N° Pasajeros" 
                                        value ="{{$solicitud_traslado->n_pasajeros}}" name="n_pasajeros" 
                                         id="telefono" pattern="[0-9]*" min = "1" max="40" title="Mínimo: 1. Máximo: 40" required>
                                    </div>
                              </div> 
                              <div class="form-group col-md-3 col-sm-3">
                                <div style="margin-top: 15%; margin-left: 10%;">
                                  @if($solicitud_traslado->viaje_redondo == 1)
                                    <input type="checkbox" id="viaje_redondo" name="viaje_redondo" title="Desea regresar con nosotros?" checked>
                                  @else
                                  <input type="checkbox" id="viaje_redondo" value="0" title="Desea regresar con nosotros?" name="viaje_redondo">
                                  @endif
                                <label class="form-check-label" for="viaje_redondo">VIAJE REDONDO? </label>
                                </div>
                              </div>
                              <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3"  style="display: none;" id="tiempo_espera">
                                  <label for="dias_espera">DIAS DE ESPERA PARA RETORNO</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                      </div>
                                      <input name = 'dias_espera' id="dias_espera" class="form-control form-control-lg" type="number" 
                                      value ="{{$solicitud_traslado->dias_espera}}" placeholder="Dias de espera" pattern="[0-9]*" min = "0" max="40" title="Mínimo: 1. Máximo: 40" >
                                  </div>
                              </div> 
 
                            <div class="form-group col-md-2 col-sm-2">
                                    <button type="submit" class="btn btn-medium btn-theme" style="margin-top: 13%;"> Continuar</button>
                            </div>     
                        </div>
                    </div>
                    </form>
                    <!-- fin formulario reserva -->
                </div>
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
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
  <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
  <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
  <script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
  <script>
    $('#fecha_llegada_solicitada').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "singleDatePicker": true,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  document.getElementById('fecha_llegada_solicitada').value = end.format('DD-MM-YYYY');
});
$('#fecha_salida').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "singleDatePicker": true,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  document.getElementById('fecha_salida').value = end.format('DD-MM-YYYY');
});
</script>
<script>
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()           
          $('[data-mask]').inputmask()
          $("#example2").inputmask("Regex");
        })
      </script>
<script>



var checkbox = document.getElementById('viaje_redondo');
checkbox.addEventListener("change", validaCheckbox, true);

function validaCheckbox(){
  var checked = checkbox.checked;
  var tiempo_espera= document.getElementById("tiempo_espera");
  if(checked){
    tiempo_espera.style.display = 'block';
    document.getElementById("dias_espera").required = true;
    console.log("1");
  }
  else{
    tiempo_espera.style.display = 'none';
    document.getElementById("dias_espera").required = false;
    console.log("2");
  }
}
</script>
<script>
  $(document).ready(function() {
    var tiempo_espera= document.getElementById("tiempo_espera");    
    if(document.getElementById('viaje_redondo').checked == true){
    tiempo_espera.style.display = 'block';
    document.getElementById("dias_espera").required = true;
    console.log("3");
    }
  else{
    tiempo_espera.style.display = 'none';
    document.getElementById("dias_espera").required = false;
    console.log("4");
  }
  });
</script>
</body>
</html>

