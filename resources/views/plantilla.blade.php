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
    <link href="css/mapas.css" rel="stylesheet" />
    <!-- <link href="css/overwrite.css" rel="stylesheet" />  checar por el asunto del calendario -->
    <!-- Theme skin -->
    <link href="color/blue.css" rel="stylesheet" />
    <!-- iconos de materialice -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">

    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 80%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
        
  
        #origin-input:focus,
        #destination-input:focus {
          border-color: #4d90fe;
        }
  
        #mode-selector {
          color: #fff;
          background-color: #4d90fe;
          margin-left: 12px;
          padding: 5px 11px 0px 11px;
        }
  
        #mode-selector label {
          font-family: Roboto;
          font-size: 13px;
          font-weight: 300;
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
                    <li class="dropdown">
                      <a href="{{ route('en_construccion') }}">Iniciar Sesión </a>
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
      <p>Somos una empresa dedicada al servicio de renta de autos, traslados, especializados en flotillas</p>
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
              <a href="{{ route('en_construccion') }}">contacto</a></p>
          </div>
          <!-- Grid column -->
                    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                      <h6 class="text-uppercase font-weight-bold">Oficinas</h6>
                      <p>
                        <a href="{{ route('sucursal_Puerto_Escondido') }}">Puerto Escondido, Oaxaca, (954) 582-32-24 / + 52 954 149 0304 </a></p>
                      <p>
                        <a href="{{ route('sucursal_Ixtepec') }}">Aeropuerto, Ixtepec, Oaxaca, +52 954 149 0304 </a></p>
                      <p>
                        <a href="{{ route('sucursal_Istmo') }}">Istmo, Oaxaca, +52 954 149 0304 </a></p>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGDfu_8YDhR8k6LHqpGfQjCwC5YlxJ9Tk&libraries=places&callback=initMap" async defer></script>
    
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
  <!-- Template Custom JavaScript File -->
  <script src="js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>


  </body>
</html>