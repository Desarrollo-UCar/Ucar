<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Ucar Renta de vehículos</title>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/flexslider.css" rel="stylesheet" />
    <link href="css/prettyPhoto.css" rel="stylesheet" />
    <link href="css/camera.css" rel="stylesheet" />
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/shortcodes.css" rel="stylesheet" />
    <!-- Theme skin -->
    <link href="color/amarillo.css" rel="stylesheet" />
    <!-- iconos de materialice -->
   
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker.css" />
    <link rel="icon"  type="image/png" href="{{'/img/UCAR LOGO-02.png'}}">
  </head>
  <body>
    <div id="wrapper">
    <!-- INICIA header yyyyy -->
     <header>
     <div class="container"><div class="row"></div></div>
    <div class="container">
        <div class="row nomargin">
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <div class="logo">
                                    <a href="{{ route('index') }}"><img src="img/UCAR LOGO-09.png" alt="" style="width:60%"/></a>
                                    </div>
                                  </div>
        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
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
                          </ul>
                        </li>
                        <li><a href="{{ route('dashboard_cliente') }}">Ver tu Reservación</a></li>   
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#">Sucursales <i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                      @foreach($sucursales as $sucursal)
                            <li><a href="{{ route('sucursal_info',['idsucursal'=>$sucursal->idsucursal])}}">{{$sucursal->nombre}}</a></li>
                        @endforeach
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
                      <a href="{{ route('login')}}">Iniciar Sesión</a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
<li  class="dropdown">
    <a href="https://www.facebook.com/UcarMx/"><i class="ico icon-circled  fa fa-facebook-square fa-2x active icon-1x"></i></a>
</li>
<li  class="dropdown">
    <a href="https://www.instagram.com/ucar_mexico/"><i class="ico icon-circled  fa fa-instagram fa-2x active icon-1x"></i></a>
</li>
<li  class="dropdown">
    <a href="https://twitter.com/ucarmx"><i class="ico icon-circled  fa fa-twitter fa-2x active icon-1x"></i></a>
</li>
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
    <div class="container-fluid">
    @yield('seccion')
    </div>
    <div class="container-fluid">
        @yield('mapa')
        </div>
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
      <p>Somos una empresa dedicada al servicio de renta de autos, traslados. Especializados en flotillas</p>
    </div>
    <!-- Grid column -->
    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
      <h6 class="text-uppercase font-weight-bold">Reservaciones</h6>
      <p>
        <a href="{{ route('index') }}">Iniciar una reservación</a>
      </p>
      <p>
        <a href="{{ route('en_construccion') }}">Ver / Modificar / Cancelar una reservación</a>
      </p>
      
    </div>
    <!-- Grid column -->
    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
      <h6 class="text-uppercase font-weight-bold">Vehículos</h6>
      <p>
        <a href="{{ route('flota') }}">Toda la flota</a>
      </p>
    </div>
    <!-- Grid column -->
    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
      <h6 class="text-uppercase font-weight-bold">Promociones</h6>
      <p>
        <a href="{{ route('en_construccion') }}">Promociones</a>
      </p>
      <p>
        <a href="{{ route('en_construccion') }}">Acerca de las promociones</a>
      </p>
    </div>
    <!-- Grid column -->
    
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <h6 class="text-uppercase font-weight-bold">Servicios al cliente</h6>
            <p>
              <a href="{{ route('en_construccion') }}">Aviso de privacidad  </a></p>
            <p>
              <a href="{{ route('en_construccion') }}">Politicas de renta</a></p>
            <p>
              <a href="{{ route('en_construccion') }}">Protecciones</a></p>
            <p>
              <a href="{{ route('en_construccion') }}">Preguntas Frecuentes</a></p>
            <p>
              <a href="{{ route('en_construccion') }}">Contacto</a></p>
          </div>
          <!-- Grid column -->
          <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h6 class="text-uppercase font-weight-bold">Oficinas</h6>
            @foreach($sucursales as $sucursal)
            <p><a href="{{ route('sucursal_info',['idsucursal'=>$sucursal->idsucursal]) }}">{{$sucursal->nombre}}, {{$sucursal->colonia}}, <i class="fa fa-whatsapp text-success" aria-hidden="true" ></i>  {{$sucursal->telefono}} </a></p>
            @endforeach
        </div>
                        <!-- Grid column -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h6 class="text-uppercase font-weight-bold">Nuestras Redes sociales</h6>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="box flyRight">
                  <div class="icon">
                    <i class="ico icon-circled icon-bgdark fa fa-facebook-square fa-4x active icon-2x"></i><a href="https://www.facebook.com/UcarMx/"> Facebook</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="box flyRight">
                  <div class="icon">
                    <i class="ico icon-circled icon-bgdark fa fa-instagram fa-4x active icon-2x"></i><a href="https://www.instagram.com/ucar_mexico/"> Instagram</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="box flyRight">
                  <div class="icon">
                    <i class="ico icon-circled icon-bgdark fa fa-twitter fa-4x active icon-2x"></i><a href="https://twitter.com/ucarmx"> Twitter</a>
                  </div>
                </div>
              </div>         
        </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
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
  <script src="js/inview.js"></script>
  <script src="js/daterangepicker.js"></script>
  <!-- Template Custom JavaScript File -->
  
  <script src="js/custom.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>



  </body>
</html>