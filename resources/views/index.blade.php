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
    <link href="color/amarillo.css" rel="stylesheet" />
    <link rel="icon"  type="image/png" href="{{'/img/UCAR LOGO-02.png'}}">
    <!-- iconos de materialice -->
  </head>
  <body>
    <div id="wrapper">
    <!-- INICIA header -->
<header>
    <div class="container">
        <div class="row nomargin">
        
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('index') }}">
                            <img src="img/UCAR LOGO-09.png"  width="120" height="60" class="d-inline-block align-top" alt="">
                          </a> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span><i class="fa fa-bars"> Menu</i></span>
                </button>
              
                <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto h5">
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('index') }}"> Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Reservación
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('index') }}">Automovil</a>
                        <a class="dropdown-item" href="{{ route('renta_traslado') }}">Traslado</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('dashboard_cliente') }}">Ver tu Reservación</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sucursales
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          @foreach($sucursales as $sucursal)
                            <a class="dropdown-item" href="{{ route('sucursal_info',['idsucursal'=>$sucursal->idsucursal])}}">{{$sucursal->nombre}}</a>
                        @endforeach
                          </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('flota') }}">Flota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    @if(!(Auth::user()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}">Iniciar Sesión</a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"style="color: white">
                                {{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.facebook.com/UcarMx/"><i class="ico icon-circled  fa fa-facebook-square fa-2x active icon-1x"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.instagram.com/ucar_mexico/"><i class="ico icon-circled  fa fa-instagram fa-2x active icon-1x"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://twitter.com/ucarmx"><i class="ico icon-circled  fa fa-twitter fa-2x active icon-1x"></i></a>

                    </li>
                  </ul>
                </div>
              </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- end header -->
    <!-- section featured -->
    <section id="carrusel">
            <div class="container" style="position: relative;">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4" style="position: absolute; left: 10px; top: 5px; z-index: 2;">
                            <!-- inicio card reserva -->
                            <div class="card bg-white text-black font-weight-bold border-1">
                            <!--Card content-->
                            <div class="card-body">
                                <!-- inicio Formulario reserva-->
                                <form action="{{ route('postFormularioindex')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <label for="inputLugar">SUCURSAL DE RENTA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-flag"aria-hidden="true"></i></span>
                                                </div>
                                                <select id="lugarrecogida" name='lugarrecogida' class="form-control" value = "{{ old('lugarrecogida') }}" required>
                                                @foreach($sucursales as $sucursal)
                                                    <option>{{$sucursal->nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <label for="fecha">SELECCIONA TUS FECHAS</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                                </div>
                                                <input id = 'fechas' name = 'fechas' class="form-control" type="button"   placeholder="Seleccione sus fechas" autocomplete="off" value="Selecciona tus fechas" required>
                                                <input type="hidden" id='fechaRecogida' name="fechaRecogida" value="0">
                                                <input type="hidden" id='fechaDevolucion' name="fechaDevolucion" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-12 col-xl-12">
                                            <label for="horaRecogida">HORA ENTREGA</label>
                                            <div class="input-group input-group-sm mb-0">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                                </div>
                                                <select name = 'horaRecogida' id ='horaRecogida' class="form-control" required onchange="checar_horas();">
                                                    <option value = "08:00">08:00</option><option value = "08:30">08:30</option>
                                                    <option value = "09:00">09:00</option><option value = "09:30">09:30</option>
                                                    <option value = "10:00">10:00</option><option value = "10:30">10:30</option>
                                                    <option value = "11:00">11:00</option><option value = "11:30">11:30</option>
                                                    <option value = "12:00">12:00</option><option value = "12:30">12:30</option>
                                                    <option value = "13:00">13:00</option><option value = "13:30">13:30</option>
                                                    <option value = "14:00">14:00</option><option value = "14:30">14:30</option>
                                                    <option value = "15:00">15:00</option><option value = "15:30">15:30</option>
                                                    <option value = "16:00">16:00</option><option value = "16:30">16:30</option>
                                                    <option value = "17:00">17:00</option><option value = "17:30">17:30</option>
                                                    <option value = "18:00">18:00</option><option value = "18:30">18:30</option>
                                                    <option value = "19:00">19:00</option><option value = "19:30">19:30</option>
                                                    <option value = "20:00">20:00</option><option value = "20:30">20:30</option>
                                                    <option value = "21:00">21:00</option>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-12 col-xl-12">
                                            <label for="horaDevolucion">HORA DEVOLUCIÓN</label>
                                            <div class="input-group input-group-sm mb-0">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                                </div>
                                                <select name = 'horaDevolucion' id = 'horaDevolucion' class="form-control" required onchange="checar_horas();">
                                                  <option value = "08:00">08:00</option><option value = "08:30">08:30</option>
                                                  <option value = "09:00">09:00</option><option value = "09:30">09:30</option>
                                                  <option value = "10:00">10:00</option><option value = "10:30">10:30</option>
                                                  <option value = "11:00">11:00</option><option value = "11:30">11:30</option>
                                                  <option value = "12:00">12:00</option><option value = "12:30">12:30</option>
                                                  <option value = "13:00">13:00</option><option value = "13:30">13:30</option>
                                                  <option value = "14:00">14:00</option><option value = "14:30">14:30</option>
                                                  <option value = "15:00">15:00</option><option value = "15:30">15:30</option>
                                                  <option value = "16:00">16:00</option><option value = "16:30">16:30</option>
                                                  <option value = "17:00">17:00</option><option value = "17:30">17:30</option>
                                                  <option value = "18:00">18:00</option><option value = "18:30">18:30</option>
                                                  <option value = "19:00">19:00</option><option value = "19:30">19:30</option>
                                                  <option value = "20:00">20:00</option><option value = "20:30">20:30</option>
                                                  <option value = "21:00">21:00</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
                                            <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 0%;">Continuar</button>
                                        </div> 
                                        
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="display: none;" id="hora_extra">
                                          <h6 class = "text-success"><strong>* NOTA:</strong></h6>
                                          <h6><small>Si se pasa <strong>dos</strong> horas en la hora de <strong>devolución</strong> de la hora de <strong>recogida</strong> se cobrará el dia completo.</small></h6>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="display: none;" id="dias_iguales">
                                          <h6 class = "text-danger"><strong>* Error:</strong></h6>
                                          <h6><small>En días iguales, la fecha de devolución no puede ser menor a la de entrega.</small></h6>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="display: none;" id="hora_menor">
                                          <h6 class = "text-danger"><strong>* Error:</strong></h6>
                                          <h6><small>Para reservas del día de hoy, no puede seleccionar una hora menor a la actual.</small></h6>
                                        </div>
                                        @if(session('mensaje'))
                                        <div class="alert aler-danger">
                                            <h6><strong><span class="colored">{{session('mensaje')}}</span></strong></h6>
                                        </div>
                                        @endif 
                                    </div>
                                </form>
                                <!-- fin formulario reserva -->
                            </div>
                        </div>       
                    </div>
                    <div class="col-sm-0 col-md-12 col-lg-12 col-xl-12">
                    <div class="camera_wrap" id="camera-slide">
                            <!-- slide 1 here -->
                            <div data-src="img/inicio/Puerto-Escondido.jpg">
                              <div class="camera_caption fadeFromLeft">
                              <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                                      
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                            <h2 class="animated fadeInDown text-white text-center"><strong>VE LOS VEHICULOS <br> <span class="colored"> QUE TENEMOS PARA TI!!!</span></strong></h2>
                                            <p class="animated fadeInUp text-white text-center">Reserva ahora mismo.</p>
                                            <a href="{{ route('flota') }}" class="btn btn-large btn-theme"><i class="icon-link"></i> Ver Flota</a>
                                            <img src="img/inicio/aveo.png" alt="" class="animated bounceInDown delay1" style="width:70%"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!-- slide 2 here -->
                            <div data-src="img/inicio/XV-2020.jpg">
                              <div class="camera_caption fadeFromLeft">
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                      <img src="img/inicio/Honda_Dio_2019_sf.png" alt="" class="animated bounceInDown delay1" style="width:80%"/>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                                        <h2 class="animated fadeInDown text-white"><strong>CREA<span class="colored"> UNA CUENTA </span></strong></h2>
                                        <p class="animated fadeInUp text-white">Se requiere tener una cuenta de cliente con nosotros para poder realizar una reservación .</p>
                                        <a href="{{ route('register') }}" class="btn btn-large btn-theme"><i class="icon-link"></i> Registrarme</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- slide 3 here -->
                            <div data-src="img/inicio/itsmo.jpg">
                              <div class="camera_caption fadeFromLeft">
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-sm-4 col-md-6 col-lg-4 col-xl-4"></div>
                                    <div class="col-sm-6 col-md-6 col-lg-8 col-xl-6 text-center">
                                        <h2 class="animated fadeInDown"><strong>ESTAMOS PARA ATENDERTE</strong></h2>
                                        <h2 class="animated fadeInDown"><strong><span class="colored">LOS 365 DIAS AL AÑO</span></strong></h2>
                                    </div>
                                    <div class="col-sm-2 col-md-0 col-lg-0 col-xl-2"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
</div>


                </div>
              </div>
      <!-- slideshow start here -->
      
      <!-- slideshow end here -->
    </section>
    <!-- /section featured -->
    <!-- /inicio formulario para iniciar reservación -->
    <section id="formulario">
      <div class="bg-white" id='formulario_reserva_vehiculo'>
          <h5 class="text-center"><strong>Reserva </strong>tu vehículo en sencillos pasos</h5>
      </div>
  
<!-- fin del card reserva --> 
</section>
<section id="caracteristicas">
<!-- inicio caracteristicas de la empresa -->
    <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="box flyLeft">
                <div class="icon">
                  <i class="ico icon-circled icon-bgdark active icon-3x fas fa-car"></i>
                </div>
                <div class="text">
                  <h4>Autos <strong>Nuevos</strong></h4>
                  <p>
                    Remodelamos nuestra flota continuamente para tu comodidad.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="box flyIn">
                <div class="icon">
                  <i class="ico icon-circled icon-bgdark active icon-3x fa-3x fa fa-diamond"></i>
                </div>
                <div class="text">
                  <h4>Atención <strong>De calidad</strong></h4>
                  <p>
                    Trabajamos siempre para brindarte un servicio de excelencia.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <div class="box flyRight">
                <div class="icon">
                  <i class="ico icon-circled icon-bgdark icon-laptop active icon-3x"></i>
                </div>
                <div class="text">
                  <h4>Reserva <strong>En línea</strong></h4>
                  <p>
                    Te brindamos nuestros servicios a traves de reservaciones en línea.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="box flyRight">
                    <div class="icon">
                    <i class="ico icon-circled icon-bgdark active icon-3x fa-3x fa fa-rocket"></i>
                    </div>
                    <div class="text">
                    <h4>Variedad <strong>De servicios</strong></h4>
                    <p>
                        Variedad de servicios para tus necesidades de movilidad.
                    </p>
                    </div>
                </div>
            </div>
          </div>
    </div>
</section><!-- fin Reserva y caracteristicas de la empresa -->
<!-- inicio descripcion de servicios-->
<section id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 aligncenter">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="aligncenter">
                  <h3>Nuestros <strong>Servicios</strong></h3>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="pricing-box-wrap special animated-fast flyIn">
                  <div class="pricing-heading">
                    <h3><strong> Vehículo</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Muévete libremente cuando viajas, sin problemas por transporte</h6>
                  </div>
                  <div class="pricing-action">
                    <a href="{{ route('flota') }}" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="pricing-box-wrap animated-fast flyIn">
                  <div class="pricing-heading">
                    <h3>Auto<strong>+Chofer</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Viaja cómodamente con un chofer con amabilidad y experiencia</h6>
                  </div>
                  <div class="pricing-action">
                    <a href="{{ route('flota') }}" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="pricing-box-wrap animated-slow flyIn">
                  <div class="pricing-heading">
                    <h3><strong>Traslado</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Solicita un traslado a cualquier parte del país a los mejores precios</h6>
                  </div>
                  <div class="pricing-action">
                    <a href="{{ route('renta_traslado') }}" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
</section>

<section id="destinos_turisticos">
    <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h4 class="title">Destinos turísticos <strong>  para visitar</strong></h4>
        <div class="row">    
            <div class="grid cs-style-5 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="item">
                <figure>
                    <div><img src="img/destinos_turisticos/tehuana.jpg" alt="" /></div>
                    <figcaption>
                    <div>
                        <span><a href="img/destinos_turisticos/big.png" data-pretty="prettyPhoto[gallery1]" title="Portfolio caption here"><i class="icon-plus icon-circled icon-bglight icon-2x"></i></a></span>
                        <span><a href="#"><i class="icon-file icon-circled icon-bglight icon-2x"></i></a></span>
                    </div>
                    </figcaption>
                </figure>
                </div>
            </div>
            <div class="grid cs-style-5 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="item">
                <figure>
                    <div><img src="img/destinos_turisticos/mazunte.jpg" alt="" /></div>
                    <figcaption>
                    <div>
                        <span><a href="img/destinos_turisticos/big.png" data-pretty="prettyPhoto[gallery1]" title="Portfolio caption here"><i class="icon-plus icon-circled icon-bglight icon-2x"></i></a></span>
                        <span><a href="#"><i class="icon-file icon-circled icon-bglight icon-2x"></i></a></span>
                    </div>
                    </figcaption>
                </figure>
                </div>
            </div>
            <div class="grid cs-style-5 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="item">
                <figure>
                    <div><img src="img/destinos_turisticos/estacahuite.jpg" alt="" /></div>
                    <figcaption>
                    <div>
                        <span><a href="img/destinos_turisticos/big.png" data-pretty="prettyPhoto[gallery1]" title="Portfolio caption here"><i class="icon-plus icon-circled icon-bglight icon-2x"></i></a></span>
                        <span><a href="#"><i class="icon-file icon-circled icon-bglight icon-2x"></i></a></span>
                    </div>
                    </figcaption>
                </figure>
                </div>
            </div>
            <div class="grid cs-style-5 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <div class="item">
                <figure>
                    <div><img src="img/destinos_turisticos/tehuana.jpg" alt="" /></div>
                    <figcaption>
                        <div>
                            <span><a href="img/destinos_turisticos/big.png" data-pretty="prettyPhoto[gallery1]" title="Portfolio caption here"><i class="icon-plus icon-circled icon-bglight icon-2x"></i></a></span>
                            <span><a href="#"><i class="icon-file icon-circled icon-bglight icon-2x"></i></a></span>
                        </div>
                    </figcaption>
                </figure>
                </div>
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
<div class="col-sm-5 col-md-4 col-lg-3 col-xl-2">
<a href="{{ route('index') }}"><img src="img/UCAR LOGO-05.png" alt="Logo ucar" style="width:90%"/></a>
</div>  
<!-- Grid column -->
<div class="col-sm-7 col-md-4 col-lg-3 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Nosotros</h6>
    <p>Somos una empresa dedicada al servicio de renta de automóviles, traslados, especializados en flotillas</p>
</div>
<!-- Grid column -->
<div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Reservaciones</h6>
    <p><a href="{{ route('index') }}">Iniciar una reservación</a></p>
    <p><a href="{{ route('dashboard_cliente') }}">Ver mis reservaciones</a></p>
    <h6 class="text-uppercase font-weight-bold">Vehículos</h6>
    <p><a href="{{ route('flota') }}">Toda la flota</a></p>
</div>
<!-- Grid column -->
<div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
    <h6 class="text-uppercase font-weight-bold">Generalidades</h6>
    <p><a href="{{ route('en_construccion') }}">Aviso de privacidad  </a></p>
    <p><a href="{{ route('en_construccion') }}">Politicas de renta</a></p>
    <p><a href="{{ route('en_construccion') }}">Protecciones</a></p>
    <p><a href="{{ route('en_construccion') }}">Preguntas Frecuentes</a></p>
    <p><a href="{{ route('en_construccion') }}">Contacto</a></p>
</div>
<!-- Grid column -->
<div class="col-sm-12 col-md-8 col-lg-12 col-xl-4">
    <h6 class="text-uppercase font-weight-bold">Oficinas</h6>
    @foreach($sucursales as $sucursal)
    <p><a href="{{ route('sucursal_info',['idsucursal'=>$sucursal->idsucursal]) }}">{{$sucursal->nombre}}, {{$sucursal->colonia}}, <i class="fa fa-whatsapp text-success" aria-hidden="true" ></i>  {{$sucursal->telefono}} </a></p>
    @endforeach
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
            <p><span>&copy;2020 Ü-CAR. Todos los derechos reservados.</span></p>
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
    $('#fechas').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  //console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
  document.getElementById('fechas').value = 'Del ' + start.format('DD-MM-YYYY') + '  al ' + end.format('DD-MM-YYYY');
  document.getElementById('fechaRecogida').value = start.format('YYYY-MM-DD');
  document.getElementById('fechaDevolucion').value = end.format('YYYY-MM-DD');
  checar_horas();
});
</script> 
<script>
function checar_horas(){
  //accedemos a los valores de los elementos horarecogida y hora devolucion
    var horaRecogida    = document.getElementById("horaRecogida");
    var horaDevolucion  = document.getElementById("horaDevolucion");
    var diaRecogida     = document.getElementById("fechaRecogida").value;
    var diaDevolucion   = document.getElementById("fechaDevolucion").value;
    var hora_extra      = document.getElementById("hora_extra");
    var dias_iguales    = document.getElementById("dias_iguales");
    var hora_menor      = document.getElementById("hora_menor");
    recogida = horaRecogida.options[horaRecogida.selectedIndex].value;
    devolucion = horaDevolucion.options[horaDevolucion.selectedIndex].value;
   //hacemos los calculos para validar horas y checar si se pasa mas de dos horas
   //validar que si selecciona el dia de hoy como salida, no se pueda seleccionar horas menores a la actual en un rango de una hora 
   //si selecciona el mismo dia de salida y llegada, checar que la hora de devolucion no sea menor a la de recogida
   //enviar mensaje de advertencia si selecciona dos horas mas de la hora de recogida en cualquier otro dia para decirle que si se pasa dos horas se le cobrara el dia completo
    var expresionRegular = /\s*:\s*/;
    var recogidaD = recogida.split(expresionRegular);
    var devolucionD = devolucion.split(expresionRegular);
    reco = new Date(0,0,0,recogidaD[0],recogidaD[1],0,0);
    devo = new Date(0,0,0,devolucionD[0],devolucionD[1],0,0);

    hoy = new Date();
    var dia = parseInt(hoy.getDate()) ;
    var mes = (parseInt(hoy.getMonth()) + 1) ;
    var hora = parseInt(hoy.getHours());
    var hora_1 = parseInt(hoy.getHours()) +1;
    var hora_2 = parseInt(hoy.getHours()) +2;

    var minutos = hoy.getMinutes();
    hoyy = hoy.getFullYear() +'-'+ ((mes < 10) ? '0'+mes : mes) +'-'+  ((dia < 10) ? '0'+dia : dia) ;
    hora_actual   = ((hora < 10) ? '0'+hora : hora) +':'+  ((minutos < 10) ? '0'+minutos : minutos) ;
    hora_actual_1 = ((hora_1 < 10) ? '0'+hora_1 : hora_1) +':'+  ((minutos <= 30) ? '00': '30') ;
    hora_actual_2 = ((hora_2 < 10) ? '0'+hora_2 : hora_2) +':'+  ((minutos <= 30) ? '00': '30') ;

    console.log(horaRecogida.value);
    console.log(hora_actual_1);
   
    //////////////////////
    if(diaRecogida == hoyy){
      console.log("recogida hoy");
      if(hora_actual >= horaRecogida.value){
        console.log("recogida menor a la actual");//consultar la hora actual en el formato necesario-----IMPORTANTE PARA MAÑANA
         // hora_menor.style.display = 'block';
          document.getElementById("horaRecogida").value = hora_actual_1;
      }else{
        //hora_menor.style.display = 'none';
      }
    }
    //----
    if(diaDevolucion == hoyy){
      console.log("Devolucion hoy");
      if(hora_actual >= horaDevolucion.value){
        console.log("recogida menor a la actual");//consultar la hora actual en el formato necesario-----IMPORTANTE PARA MAÑANA
          //hora_menor.style.display = 'block';
          document.getElementById("horaDevolucion").value = hora_actual_2;
      }else{
       // hora_menor.style.display = 'none';
      }
    }
    ///
    if(diaRecogida == diaDevolucion){
      if(devo <= reco){
          dias_iguales.style.display = 'block';
          document.getElementById("horaRecogida").value = hora_actual;
          document.getElementById("horaDevolucion").value = hora_actual_2;
        }else{
            dias_iguales.style.display = 'none';
        }
      if(diaRecogida == hoyy){
        console.log("iguales fechas de recogida");
        if(hora_actual >= horaRecogida.value){
            console.log("recogida menor a la actual");//consultar la hora actual en el formato necesario-----IMPORTANTE PARA MAÑANA
            hora_menor.style.display = 'block';
            document.getElementById("horaRecogida").value = hora_actual_1;
        }else{
            hora_menor.style.display = 'none';
        }
        if(hora_actual >= horaDevolucion.value){
            console.log("recogida menor a la actual");//consultar la hora actual en el formato necesario-----IMPORTANTE PARA MAÑANA
            hora_menor.style.display = 'block';
            document.getElementById("horaDevolucion").value = hora_actual_2;
        }else{
            hora_menor.style.display = 'none';
        }
    }
    }else{
      if(devo - reco >= 7200000){
          hora_extra.style.display = 'block';
      }else{
        hora_extra.style.display = 'none';
      }
    }
  
  }
  </script>
</body>
</html>

