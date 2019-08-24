<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Ucar Renta de vehículos</title>
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
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    <!-- Theme skin -->
    <link href="color/blue.css" rel="stylesheet" />
    <!-- iconos de materialice -->
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
                        <li><a href="{{ route('en_construccion') }}">Ver tu Reservación</a></li>   
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#">Sucursales <i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('sucursal_Puerto_Escondido') }}">Puerto Escondido</a></li>
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
    <!-- section featured -->
    <section id="featured">
      <!-- slideshow start here -->
      <div class="camera_wrap" id="camera-slide">
        <!-- slide 1 here -->
        <div data-src="img/inicio/Puerto-Escondido.jpg">
          <div class="camera_caption fadeFromLeft">
          <div class="container">
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                  <h2 class="animated fadeInDown text-white text-center"><strong>   UN NUEVO VEHICULO <span class="colored"> HA LLEGADO!!!</span></strong></h2>
                  <p class="animated fadeInUp text-white text-center">    Reserva ahora mismo.</p>
                  <a href="#" class="btn btn-large btn-theme"><i class="icon-link"></i> Ver Vehículo</a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <img src="img/inicio/aveo.png" alt="" class="animated bounceInDown delay1" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- slide 2 here -->
        <div data-src="img/inicio/Puerto-Escondido2.jpg">
          <div class="camera_caption fadeFromLeft">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <img src="img/inicio/Honda_Dio_2019_sf.png" alt="" class="animated bounceInDown delay1" style="width:80%"/>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                  <h2 class="animated fadeInDown"><strong>ESTAMOS PARA ATENDERTE</strong></h2>
                  <h2 class="animated fadeInDown"><strong><span class="colored">LOS 365 DIAS AL AÑO</span></strong></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- slide 3 here -->
        <div data-src="img/inicio/Puerto-Escondido.jpg">
          <div class="camera_caption fadeFromLeft">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                  <h2 class="animated fadeInDown text-white"><strong>SEGURIDAD <span class="colored"> Y CONFIANZA</span></strong></h2>
                  <p class="animated fadeInUp text-white">Somos una empresa dedicada al servicio de renta de autos, especializados en flotillas.</p>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <img src="img/inicio/toyota-hilux.png" alt="" class="animated bounceInDown delay1" style="width:80%"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- slideshow end here -->
    </section>
    <!-- /section featured -->
    <!-- /inicio formulario para iniciar reservación -->
<section id="formulario">
        <div class="bg-white" id='formulario_reserva_vehiculo'>
            <h5 class="text-center"><strong>1. Reservar    </strong>Renta tu auto en 4 sencillos pasos</h5>
        </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- inicio card reserva -->
                <div class="card bg-light text-white">
                <!--Card content-->
                <div class="card-body">
                    <!-- inicio Formulario reserva-->
                    <form action="{{ route('postFormularioindex')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="inputLugar">LUGAR DE RENTA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-flag"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'lugarrecogida' id="inputLugar" class="form-control">
                                    <option selected>Aeropuerto Cd. Ixtepec</option>
                                    <option>Istmo</option>
                                    <option>Puerto Escondido</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="tipoVehiculo">TIPO DE VEHÍCULO</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-car"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'tipoVehiculo' id="tipo" class="form-control">
                                        <option selected>Automovil</option>
                                        <option>Camioneta</option>
                                        <option>Motoneta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="codigoPromocion">CÓDIGO DE PROMOCIÓN</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'codigoPromocion' type="text" class="form-control form-control-lg"  placeholder="Ingresa tu código de promocion" id='codigoPromocion'>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="fechaRecogida">FECHA DE RECOGIDA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'fechaRecogida' type="text" class="form-control form-control-lg" placeholder="{{date('Y\-m\-d ') }}" id='datetimepicker_fechaRecogida' required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="horaRecogida">HORA DE RECOGIDA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'horaRecogida' class="form-control">
                                        <option>08:00</option><option>08:30</option>
                                        <option>09:00</option><option>09:30</option>
                                        <option>10:00</option><option>10:30</option>
                                        <option selected>11:00</option><option>11:30</option>
                                        <option>12:00</option><option>12:30</option>
                                        <option>13:00</option><option>13:30</option>
                                        <option>14:00</option><option>14:30</option>
                                        <option>15:00</option><option>15:30</option>
                                        <option>16:00</option><option>16:30</option>
                                        <option>17:00</option><option>17:30</option>
                                        <option>18:00</option><option>19:30</option>
                                        <option>20:00</option><option>20:30</option>
                                        <option>21:00</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="fechaDevolucion">FECHA DE DEVOLUCIÓN</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'fechaDevolucion' type="text" class="form-control form-control-lg" placeholder="{{date('Y\-m\-d')}}" selected = "{{date('Y\-m\-d')}}" id='datetimepicker_fechaDevolucion' required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="horaDevolucion">HORA DE DEVOLUCIÓN</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'horaDevolucion'  class="form-control">
                                        <option>08:00</option><option>08:30</option>
                                        <option>09:00</option><option>09:30</option>
                                        <option>10:00</option><option>10:30</option>
                                        <option selected>11:00</option><option>11:30</option>
                                        <option>12:00</option><option>12:30</option>
                                        <option>13:00</option><option>13:30</option>
                                        <option>14:00</option><option>14:30</option>
                                        <option>15:00</option><option>15:30</option>
                                        <option>16:00</option><option>16:30</option>
                                        <option>17:00</option><option>17:30</option>
                                        <option>18:00</option><option>19:30</option>
                                        <option>20:00</option><option>20:30</option>
                                        <option>21:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="form-row">  
                                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <button class="btn btn-primary" type="submit">Reservar Ahora</button>
                                </div>    
                            </div>
                    </form>
                    <!-- fin formulario reserva -->
                </div>
            </div>       
        </div>
    </div>
</div>
<!-- fin del card reserva --> 
</section>
<section id="caracteristicas">
<!-- inicio caracteristicas de la empresa -->
    <div class="container">
          <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <div class="box flyRight">
                <div class="icon">
                  <i class="ico icon-circled icon-bgdark icon-laptop active icon-3x"></i>
                </div>
                <div class="text">
                  <h4>Reserva <strong>En linea</strong></h4>
                  <p>
                    Te brindamos nuestros servicios a traves de reservaciones en linea.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
              <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <div class="pricing-box-wrap special animated-fast flyIn">
                  <div class="pricing-heading">
                    <h3><strong> Vehículo</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Muévete libremente cuando viajas, sin problemas por transporte</h6>
                  </div>
                  <div class="pricing-action">
                    <a href="#" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <div class="pricing-box-wrap animated-fast flyIn">
                  <div class="pricing-heading">
                    <h3>Auto<strong>+Chofer</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Viaja comodamente con un chofer con amabilidad y experiencia</h6>
                  </div>
                  <div class="pricing-action">
                    <a href="#" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <div class="pricing-box-wrap animated-slow flyIn">
                  <div class="pricing-heading">
                    <h3><strong>Traslado</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Solicita un traslado a cualquier parte del país a los mejores precios</h6>
                  </div>
                  <div class="pricing-action">
                    <a href="#" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>

              <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <div class="pricing-box-wrap animated flyIn">
                  <div class="pricing-heading">
                    <h3><strong>Flotilla</strong></h3>
                  </div>
                  <div class="pricing-terms">
                    <h6>Servicio especial para empresas, renta de flotilla para asuntos de negocios </h6>
                  </div>
                  <div class="pricing-action">
                    <a href="#" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i>Ver Mas</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 aligncenter ">
            <h3 class="title">Nuestros<strong> vehículos</strong></h3>
            <ul class="bxslider">
              <li>
                <div class="testimonial-autor">
                <img src="img/flota/Chevrolet-Aveo-2018.jpg" alt="" style="width:32%"/>
                  <h4>Compactos</h4>
                  <p>Elige entre una variada gama de autos en renta en esta categoría, que incluye vehículos económicos, grandes o de lujo.</p>
                </div>
              </li>
              <li>
                <div class="testimonial-autor">
                <img src="img/flota/Toyota-Hilux-2014.jpg" alt="" style="width:50%"/>
                  <h4>Camionetas</h4>
                  <p>Elige entre una variada gama de autos en renta en esta categoría, que incluye vehículos económicos, grandes o de lujo.</p>
                </div>
              </li>
              <li>
                <div class="testimonial-autor">
                <img src="img/flota/Honda-Dio-2019.jpg" alt="" style="width:38%"/>
                  <h4>Motoneta</h4>
                  <p>Elige entre una variada gama de autos en renta en esta categoría, que incluye vehículos económicos, grandes o de lujo.</p>
                </div>
              </li>
              <li>
                <li>
                    <div class="testimonial-autor">
                    <img src="img/flota/Chevrolet-Suburban-2018.jpg" alt="" style="width:38%"/>
                      <h4>Suburban</h4>
                      <p>Elige entre una variada gama de autos en renta en esta categoría, que incluye vehículos económicos, grandes o de lujo.</p>
                    </div>
                  </li>
            </ul>
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
            <div class="grid cs-style-5 col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
            <div class="grid cs-style-5 col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
            <div class="grid cs-style-5 col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
            <div class="grid cs-style-5 col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
    <p><a href="{{ route('sucursal_Puerto_Escondido') }}">Puerto Escondido, Oaxaca, (954) 582-32-24 / + 52 954 149 0304 </a></p>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- javascript
    ================================================== -->
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
  <script src="js/datatimeconfig.js"></script>
  <script src="js/inview.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
    <!-- Template Custom JavaScript File -->
    <script src="js/custom.js"></script>
  </body>
</html>