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
            <h5 class="text-center"><strong>Solicita la cotizacion de </strong>tu viaje de la manera mas rápida</h5>
        </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- inicio card reserva -->
                <div class="card bg-light text-white">
                <!--Card content-->
                <div class="card-body">
                    <!-- inicio Formulario reserva-->
                    <form action="{{ route('renta_traslado_vehiculo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <h6><strong>Información de contacto:</strong></h6>  
                            </div>
                            {{-- FORMULARIO DE NOMBRES --}}                     
                            <div class="form-group col-md-4 col-sm-4">
                                    <label>Nombres</label>
                                    <input id="nombres" type="text" class="form-control"  placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                    <span id="errornombres" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;" aria-hidden="true"></span>
                                    <span id="validonombres" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;" aria-hidden="true"></span>
                                </div> 
                            {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                            <div class="form-group col-md-4 col-sm-4">
                            <label>Primer Apellido </label>
                            <input type="text" class="form-control" placeholder="primer apellido" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="primerApellido" required>
                            <span id="errorprimerApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validoprimerApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div> 
                            {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                            <div class="form-group col-md-4 col-sm-4">
                            <label>Segundo Apellido</label>
                            <input type="text" class="form-control" placeholder="segundo apellido" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="segundoApellido">

                            <span id="errorsegundoApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validosegundoApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div>
                            {{--DATOS PARA EL TELEFONO--}}
                            <div class="form-group col-md-4 col-sm-4">
                                <label>Teléfono</label>
                            <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                                data-inputmask='"mask": "9999999999"' data-mask id="telefono" required>
            
                                <span id="errortelefono" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validotelefono" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div> 
                            {{--FORMULARIO DE CORREO EMAIL--}}
                            <div class="form-group col-md-4 col-sm-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Correo Eléctronico" name="email" id="email" required>

                                    <span id="erroremail" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validoemail" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>

                    <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                    <h6><strong>Información de su cotización de viaje:</strong></h6>  
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="lugar_salida">LUGAR DE SALIDA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'lugar_salida' id="origin-input" class="form-control form-control-lg" type="text" placeholder="Ingresa el lugar de salida" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="lugar_llegada">LUGAR DE LLEGADA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'lugar_llegada' id="destination-input" class="form-control form-control-lg" type="text" placeholder="Ingresa el lugar de llegada" required>
                                </div>
                            </div>
                        
                            <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <label for="fecha">CUANDO DESEA LLEGAR A SU DESTINO?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                    </div>
                                    <input id = 'fechas' name = 'fechas' class="form-control" type="button"   placeholder="Seleccione sus fechas" autocomplete="off" value="Selecciona tu fecha" required>
                                    <input type="hidden" id='fecha_salida' name="fecha_salida" value="0">
                                    <input type="hidden" id='fecha_solicitada' name="fecha_solicitada" value="0">
                                </div>
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="horaRecogida">A QUE HORA DESEA LLEGAR?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'hora_salida' class="form-control" required>
                                      <option>00:00</option><option>01:00</option>
                                      <option>02:00</option><option>03:00</option>
                                      <option>04:00</option><option>05:00</option>
                                      <option>06:00</option><option>07:00</option>
                                        <option>08:00</option><option>09:00</option>
                                        <option selected>10:00</option><option>11:00</option>
                                        <option>12:00</option><option>13:00</option>
                                        <option>14:00</option><option>15:00</option>
                                        <option>16:00</option><option>17:00</option>
                                        <option>18:00</option><option>19:00</option>
                                        <option>20:00</option><option>21:00</option>
                                        <option>22:00</option><option>23:00</option>
                                        <option>24:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label for="lugar_llegada">N° PASAJEROS</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="N° Pasajeros" name="n_pasajeros" 
                                        type="number" id="telefono" required>
                                    </div>
                              </div> 
                              <div class="form-group col-md-3 col-sm-3">
                                    <div style="margin-top: 15%; margin-left: 10%;">
                                        <input type="checkbox" id="viaje_redondo" name="viaje_redondo" value ="1">
                                        <label class="form-check-label" for="viaje_redond">VIAJE REDONDO?</label>
                                    </div>
                              </div>
                              <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3"  style="display: none;" id="tiempo_espera">
                                  <label for="dias_espera">DIAS DE ESPERA PARA RETORNO</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                      </div>
                                      <input name = 'dias_espera' id="dias_espera" class="form-control form-control-lg" type="text" placeholder="Dias de espera" type="number"  >
                                  </div>
                              </div> 
                              <div class="form-group col-md-4 col-sm-4">
                                  <div class = "row">
                                    <div style="margin-top: 10%; margin-left: 10%;">
                                        <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value = "1" required>
                                        <label class="form-check-label" for="terminos_condiciones"><small>HE LEÍDO Y ACEPTO LOS</small></label>
                                    </div>
                                    <div>
                                        <a style="margin-top: 17%; margin-left: -8%;" class="nav-link text-danger" target="_blank" href="{{asset('pdf/terminos_condiciones/Terminos-y-Condiciones-de-renta.pdf')}}" ><small>TÉRMINOS Y CONDICIONES</small></a> 
                                    </div>
                                  </div>
                                </div> 
                            <div class="form-group col-md-2 col-sm-2">
                                    <button type="submit" class="btn btn-medium btn-theme" style="margin-top: 13%;"> Continuar</button>
                            </div> 
                            @if(session('mensaje'))
                            <div class="alert aler-danger">
                                <h6><strong><span class="colored">{{session('mensaje')}}</span></strong></h6>
                            </div>
                            @endif     
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
    $('#fechas').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "singleDatePicker": true,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
  document.getElementById('fechas').value = 'Salida: ' + start.format('DD-MM-YYYY') + '  Llegada: ' + end.format('DD-MM-YYYY');
  document.getElementById('fecha_salida').value = start.format('YYYY-MM-DD');
  document.getElementById('fecha_solicitada').value = end.format('YYYY-MM-DD');
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
  if(checked)
    tiempo_espera.style.display = (tiempo_espera.style.display == 'none')?'block' : 'none';
  else
    tiempo_espera.style.display = (tiempo_espera.style.display == 'block')?'none' : 'block';
}
</script>
<script>
  $(document).ready(function() {
    var tiempo_espera= document.getElementById("tiempo_espera");
    if(document.getElementById('viaje_redondo').checked == true)
    tiempo_espera.style.display = (tiempo_espera.style.display == 'block')?'block' : 'none';
  else
    tiempo_espera.style.display = (tiempo_espera.style.display == 'none')?'none' : 'block';
  })
</script>
</body>
</html>

