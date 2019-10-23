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
                          </ul>
                        </li>
                        <li><a href="{{ route('dashboard_cliente') }}">Ver Reservaciones</a></li>   
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#">Sucursales <i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        @foreach($sucursales as $sucursal)
                            <li><a href="{{ route('sucursal_info',['idsucursal'=>$sucursal->idsucursal]) }}">{{$sucursal->nombre}}</a></li>
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
                                             document.getElementById('logout-form').submit();" style="color: white">
                                {{ __('Cerrar sesión') }}
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
    <section id="formulario">
      <div class="bg-white" id='formulario_reserva_vehiculo'>
          <h5 class="text-center"><strong>Reserva </strong>tu vehículo en sencillos pasos</h5>
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
                      <input type="hidden" id='reserva_anterior' name="reserva_anterior" value="{{$alquiler->id_reservacion}}">
                      <div class="form-row">
                          <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                              <label for="inputLugar">SUCURSAL DE RENTA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-flag"aria-hidden="true"></i></span>
                                  </div>
                                  <select id="lugarrecogida" name='lugarrecogida' class="form-control" value = "{{ old('lugarrecogida') }}" required>
                                  @foreach($sucursales as $sucursal)
                                      <option <?php if($alquiler->lugar_recogida == $sucursal->idsucursal) echo "selected";?>>{{$sucursal->nombre}}</option>
                                  @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="form-group col-sm-4 col-md-4 col-lg-4 col-xl-4">
                              <label for="fecha">SELECCIONA TUS FECHAS</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                  </div>
                                  <input id = 'fechas' name = 'fechas' class="form-control" type="button"   placeholder="Seleccione sus fechas" autocomplete="off" value="Del {{$alquiler->fecha_recogida}} al {{$alquiler->fecha_devolucion}}" required>
                                  <input type="hidden" id='fechaRecogida' name="fechaRecogida" value="{{$alquiler->fecha_recogida}}">
                                  <input type="hidden" id='fechaDevolucion' name="fechaDevolucion" value="{{$alquiler->fecha_devolucion}}">
                              </div>
                          </div>
                          <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                              <label for="horaRecogida">HORA DE ENTREGA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                  </div>
                                  <select name = 'horaRecogida' id ='horaRecogida' class="form-control" required onchange="checar_horas();">
                                  <option <?php if($alquiler->hora_recogida == "00:00:00") echo "selected";?>>00:00</option>
                                  <option <?php if($alquiler->hora_recogida == "08:00:00") echo "selected";?>>08:00</option>
                                  <option <?php if($alquiler->hora_recogida == "08:30:00") echo "selected";?>>08:30</option>
                                  <option <?php if($alquiler->hora_recogida == "09:00:00") echo "selected";?>>09:00</option>
                                  <option <?php if($alquiler->hora_recogida == "09:30:00") echo "selected";?>>09:30</option>
                                  <option <?php if($alquiler->hora_recogida == "10:00:00") echo "selected";?>>10:00</option>
                                  <option <?php if($alquiler->hora_recogida == "10:30:00") echo "selected";?>>10:30</option>
                                  <option <?php if($alquiler->hora_recogida == "11:00:00") echo "selected";?>>11:00</option>
                                  <option <?php if($alquiler->hora_recogida == "11:30:00") echo "selected";?>>11:30</option>
                                  <option <?php if($alquiler->hora_recogida == "12:00:00") echo "selected";?>>12:00</option>
                                  <option <?php if($alquiler->hora_recogida == "12:30:00") echo "selected";?>>12:30</option>
                                  <option <?php if($alquiler->hora_recogida == "13:00:00") echo "selected";?>>13:00</option>
                                  <option <?php if($alquiler->hora_recogida == "13:30:00") echo "selected";?>>13:30</option>
                                  <option <?php if($alquiler->hora_recogida == "14:00:00") echo "selected";?>>14:00</option>
                                  <option <?php if($alquiler->hora_recogida == "14:30:00") echo "selected";?>>14:30</option>
                                  <option <?php if($alquiler->hora_recogida == "15:00:00") echo "selected";?>>15:00</option>
                                  <option <?php if($alquiler->hora_recogida == "15:30:00") echo "selected";?>>15:30</option>
                                  <option <?php if($alquiler->hora_recogida == "16:00:00") echo "selected";?>>16:00</option>
                                  <option <?php if($alquiler->hora_recogida == "16:30:00") echo "selected";?>>16:30</option>
                                  <option <?php if($alquiler->hora_recogida == "17:00:00") echo "selected";?>>17:00</option>
                                  <option <?php if($alquiler->hora_recogida == "17:30:00") echo "selected";?>>17:30</option>
                                  <option <?php if($alquiler->hora_recogida == "18:00:00") echo "selected";?>>18:00</option>
                                  <option <?php if($alquiler->hora_recogida == "18:30:00") echo "selected";?>>18:30</option>
                                  <option <?php if($alquiler->hora_recogida == "19:00:00") echo "selected";?>>19:00</option>
                                  <option <?php if($alquiler->hora_recogida == "19:30:00") echo "selected";?>>19:30</option>
                                  <option <?php if($alquiler->hora_recogida == "20:00:00") echo "selected";?>>20:00</option>
                                  <option <?php if($alquiler->hora_recogida == "20:30:00") echo "selected";?>>20:30</option>
                                  <option <?php if($alquiler->hora_recogida == "21:00:00") echo "selected";?>>21:00</option>
                                  </select>
                              </div> 
                          </div>
                          <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                              <label for="horaDevolucion">HORA DE DEVOLUCIÓN</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                  </div>
                                  <select name = 'horaDevolucion' id = 'horaDevolucion' class="form-control" required onchange="checar_horas();">
                                      <option <?php if($alquiler->hora_devolucion == "08:00:00") echo "selected";?>>08:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "08:30:00") echo "selected";?>>08:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "09:00:00") echo "selected";?>>09:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "09:30:00") echo "selected";?>>09:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "10:00:00") echo "selected";?>>10:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "10:30:00") echo "selected";?>>10:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "11:00:00") echo "selected";?>>11:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "11:30:00") echo "selected";?>>11:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "12:00:00") echo "selected";?>>12:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "12:30:00") echo "selected";?>>12:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "13:00:00") echo "selected";?>>13:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "13:30:00") echo "selected";?>>13:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "14:00:00") echo "selected";?>>14:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "14:30:00") echo "selected";?>>14:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "15:00:00") echo "selected";?>>15:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "15:30:00") echo "selected";?>>15:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "16:00:00") echo "selected";?>>16:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "16:30:00") echo "selected";?>>16:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "17:00:00") echo "selected";?>>17:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "17:30:00") echo "selected";?>>17:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "18:00:00") echo "selected";?>>18:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "18:30:00") echo "selected";?>>18:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "19:00:00") echo "selected";?>>19:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "19:30:00") echo "selected";?>>19:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "20:00:00") echo "selected";?>>20:00</option>
                                      <option <?php if($alquiler->hora_devolucion == "20:30:00") echo "selected";?>>20:30</option>
                                      <option <?php if($alquiler->hora_devolucion == "21:00:00") echo "selected";?>>21:00</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                              <button class="btn btn-primary" type="submit" style="margin-top: 0%;">Consulta Vehiculos Disponibles</button>
                          </div> 
                          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <h6 class = "text-danger"><strong>* NOTA:</strong></h6>
                            <h6><small>El vehículo debe ser entregado en la misma sucursal.</small></h6>
                          </div>
                          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" style="display: none;" id="hora_extra">
                            <h6 class = "text-success"><strong>* NOTA:</strong></h6>
                            <h6><small>Si se pasa <strong>dos</strong> horas en la hora de <strong>devolución</strong> de la hora de <strong>recogida</strong> se cobrará el dia completo.</small></h6>
                          </div>
                          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" style="display: none;" id="dias_iguales">
                            <h6 class = "text-danger"><strong>* Error:</strong></h6>
                            <h6><small>En días iguales, la fecha de devolución no puede ser menor a la de entrega.</small></h6>
                          </div>
                          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" style="display: none;" id="hora_menor">
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
  </div>
</div>
<!-- fin del card reserva --> 
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
    @foreach($sucursales as $sucursal)
    <p><a href="{{ route('sucursal_info',['idsucursal'=>$sucursal->idsucursal]) }}">{{$sucursal->nombre}}, {{$sucursal->colonia}}, {{$sucursal->telefono}} </a></p>
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
   //si selecciona el mismo dia de salida y recogida, checar que la hora de devolucion no sea menor a la de recogida
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

