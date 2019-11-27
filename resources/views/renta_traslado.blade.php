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
                          </ul>
                        </li>
                        <li><a href="{{ route('dashboard_cliente') }}">Ver Reservaciones</a></li>   
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#">Sucursales <i class="icon-angle-down"></i></a>
                      <ul class="dropdown-menu">
                      @foreach($sucursales as $sucursal)
                            <li><a href="{{ route('sucursal_info') }}">{{$sucursal->nombre}}</a></li>
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
    <!-- end header -->

    <section id="formulario">
        <div class="bg-white" id='formulario_reserva_vehiculo'>
            <h5 class="text-center"><strong>Solicita la cotizacion de tu viaje de la manera mas rápida</strong></h5>
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
                        @if(!(Auth::user()))
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
                          <input type="text" class="form-control" placeholder="segundo apellido" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="segundoApellido" required>

                          <span id="errorsegundoApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validosegundoApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                          </div>
                          {{--DATOS PARA EL TELEFONO--}}
                          <div class="form-group col-md-4 col-sm-4">
                              <label>Teléfono</label>
                          <input type="text" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" pattern="[0-9]*" minlength = "10" maxlength="10" title="Número a 10 digitos" required>
                          </div> 
                          {{--FORMULARIO DE CORREO EMAIL--}}
                          <div class="form-group col-md-4 col-sm-4">
                                  <label>Email</label>
                                  <input type="email" class="form-control" placeholder="Correo Eléctronico" name="email" id="email" required>

                                  <span id="erroremail" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validoemail" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                              </div>
                    </div>
                    @endif
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
                        
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <label for="fecha">FECHA DE LLEGADA</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                    </div>
                                    <input id = 'fecha_solicitada' name = 'fecha_solicitada' class="form-control" type="text" autocomplete="off"   placeholder="Seleccione su fecha" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label for="horaRecogida">HORA DE LLEGADA?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                    </div>
                                    <select name = 'hora_llegada' class="form-control" required>
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
                                        <input type="number" class="form-control" placeholder="N° Pasajeros" name="n_pasajeros" 
                                         id="n_pasajeros" pattern="[0-9]*" min = "1" max="40" title="Mínimo: 1. Máximo: 40" required>
                                    </div>
                              </div> 
                              <div class="form-group col-md-2 col-sm-2">
                                    <div style="margin-top: 20%; margin-left: 5%;">
                                        <input type="checkbox" id="viaje_redondo" name="viaje_redondo" value ="1">
                                        <label class="form-check-label" for="viaje_redond"><small><strong>VIAJE REDONDO?</strong></small></label>
                                    </div>
                              </div>
                              <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3"  style="display: none;" id="tiempo_espera">
                                  <label for="dias_espera">DIAS DE ESPERA</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                      </div>
                                      <input name = 'dias_espera' id="dias_espera" class="form-control form-control-lg" type="number" placeholder="Dias de Espera" pattern="[0-9]*" min = "1" max="40" title="Mínimo: 1. Máximo: 40" >
                                      <input name = 'mostrar_modal' id="mostrar_modal" value = "{{$estado}}" type="hidden"  >
                                    </div>
                              </div> 
                              
      </div>

      <div class="form-row">
          <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
              <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="." style="margin-top: 0%;" required>
              <a class="nav-link text-danger" target="_blank" href="{{asset('pdf/terminos_condiciones/Terminos-y-Condiciones-de-renta.pdf')}}"  style="margin-top: -7%; margin-left: 0%;">HE LEÍDO Y ACEPTO TÉRMINOS Y CONDICIONES</a> 
        </div>
      </div>
      
                    @if(!(Auth::user()))
                    <div class="form-row">
                        <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <button class="btn btn-primary" type="submit">Continuar</button>
                        </div>     
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <h5 class = "text-danger"><strong>¡¡¡IMPORTANTE!!!</strong></h5>
                            <h6>De no cumplir con los documentos solicitados, no se realizará el traslado solicitado.</h6>
                      </div>
                    </div>     
                    @else
                    <div class="form-row">
                        <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <button class="btn btn-primary" type="submit">Continuar</button>
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                            <h5 class = "text-danger"><strong>¡¡¡IMPORTANTE!!!</strong></h5>
                            <h6>De no cumplir con los documentos solicitados, no se realizará el traslado solicitado.</h6>
                      </div>
                    </div>                     
                    @endif
                    
                    </form>
                </div>
                </div>
            </div>       
        </div>
    </div>
    

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="primero" style="overflow-y: auto; display: block;margin-top: 3%;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header" style="background: cornflowerblue;">
                        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" style="color: red;">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                    <div class="container-fluid">
                            <form id="upload_form" method="POST" enctype="multipart/form-data">
                            {{-- {{ csrf_field() }} --}}
                            @csrf
                      <div class="row">
             
                                    {{-- FORMULARIO DE NOMBRES --}}
                                  
                                       <div class="form-group col-md-4 col-sm-4">
                                            <label>Nombres</label>
                                            <input id="nombres" type="text" class="form-control"  placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                            <input id="loge" type="hidden" class="form-control" value = "ok" >
                                            <span id="errornombres" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;" aria-hidden="true"></span>
                                            <span id="validonombres" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;" aria-hidden="true"></span>
                                        </div> 
                                     {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                          
                             <div class="form-group col-md-4 col-sm-4">
                                    <label>Primer Apellido </label>
                                    <input type="text" class="form-control" placeholder="primer apellido" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="primerApellido">
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
                                {{--FORMULARIO DE FECHA DE NACIMIENTO--}}
                          <div class="form-group col-md-4 col-sm-4">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control" placeholder="fechaNacimiento" name="fechaNacimiento" id="fechaNacimiento">
    
                            <span id="errorfechaNacimiento" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validofechaNacimiento" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>
          
                             
                                {{--FORMULARIO NACIONALIDAD--}}
                                <?php $nacion= DB::table('nacionalidades')
                                ->orderBy('nombre','asc')
                                ->get(); ?>
                        <div class="form-group col-md-4 col-sm-4">
                                <label>Nacionalidad</label>
                          <select class="form-control" id="nacionalidad" name="nacionalidad" onchange="cambio();">
                            @foreach ($nacion as $nacion)
                            <option>{{$nacion->nombre}}</option>
                            @endforeach                             
                          </select>
        
                                <span id="errornacionalidad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validonacionalidad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div>
    
                            <div class="form-group col-md-4 col-sm-4" id="identificacion" style="display: none">
                                    <label>INE</label>
                                  <input type="text" class="form-control" autofocus placeholder="Número de credencial de elector" name="ine" data-inputmask='"mask": "9999999999999"' data-mask id="ine">
                
                                  <span id="errorine" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validoine" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>   
                                                  
                                <div class="form-group col-md-4 col-sm-4"  id="pasa">
                                        <label>Pasaporte</label>
                                      <input type="text" class="form-control" autofocus placeholder="Pasaporte" name="pasaporte" data-inputmask='"mask": "9999999999999"' data-mask id="pasaporte">
                    
                                      <span id="errorpasaporte" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validopasaporte" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                    </div>   
    
                                  {{--DATOS PARA EL TELEFONO--}}
                            <div class="form-group col-md-4 col-sm-4">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                                    data-inputmask='"mask": "9999999999"' data-mask id="telefono">
                
                                    <span id="errortelefono" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validotelefono" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>  
    
                                {{-- FORMUALRIO PAIS PARA EL CLIENTE --}}
                            <div class="form-group col-md-4 col-sm-4">
                                  <label>País</label>
                                  <input type="text" class="form-control" placeholder="País" name="pais" onkeyup="javascript:this.value=this.value.toUpperCase();" id="pais">
          
                                  <span id="errorpais" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validopais" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                              </div>
    
                              {{-- FORMULARIO ESTADO DEL CLIENTE --}}
                              <div class="form-group col-md-4 col-sm-4">
                                    <label>Estado</label>
                                    <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" id="estado">
            
                                    <span id="errorestado" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validoestado" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>
                                           
                                {{-- FORMULARIO CIUDAD DEL CLIENTE --}}
                                <div class="form-group col-md-4 col-sm-4">
                                        <label>Ciudad</label>
                                        <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();" id="ciudad">
                
                                        <span id="errorciudad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                        <span id="validociudad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                    </div>
    
                                    {{-- FORMULARIO DE LOS DATOS DE LA COLONIA --}}
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label>Colonia</label>
                                        <input type="text" class="form-control" placeholder="Colonia" name="colonia" onkeyup="javascript:this.value=this.value.toUpperCase();" id="colonia">
                
                                        <span id="errorcolonia" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                        <span id="validocolonia" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                    </div>
    
                                    {{-- FORMULARIO DE LOS DATOS DE LA COLONIA --}}
                                    <div class="form-group col-md-4 col-sm-4">
                                            <label>Calle</label>
                                            <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" id="calle">
                    
                                            <span id="errorcalle" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                            <span id="validocalle" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                        </div>
    
                                        <div class="form-group col-md-4 col-sm-4">
                                                <label>Número</label>
                                                <input type="text" class="form-control" placeholder="Número de calle" name="numero" onkeyup="javascript:this.value=this.value.toUpperCase();" id="numero">
                        
                                                <span id="errornumero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validonumero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                            </div>
    
                        {{--FORMULARIO DE CORREO EMAIL--}}
                        <div class="form-group col-md-4 col-sm-4">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Correo Eléctronico" name="email" id="email">
        
                                <span id="erroremail" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validoemail" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div>
    
                          {{-- FORMULARIO DE CONTRASEÑA --}}
                            <div class="form-group col-md-4 col-sm-4">
                                    <label>Contraseña</label>
                                    <input id="password" type="password" class="form-control"  name="password"  autocomplete="new-password">
    
                                    <span id="errorpassword" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validopassword" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>
    
                            {{-- FORMULARIO PARA LA CONFIRMACION DEL CORREO --}}
                                <div class="form-group col-md-4 col-sm-4">
                                        <label>Confirmar Contraseña</label>
                                        <input id="passwordconfirm" type="password" class="form-control"  name="passwordconfirm"  autocomplete="new-password">
        
                                        <span id="errorpasswordconfirm" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                        <span id="validopasswordconfirm" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                    </div>
    
                                    <div class="modal-footer col-md-12">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Agregar">
                                          </div>
                                  </div> {{-- aqui termina el div row --}}
                                 </form> {{-- AQUI TERMINA EL FORM --}}
                                 
                    </div>
                  </div>
         
        </div>
      </div>
    </div>
   {{-- AQUI TERMINA EL MODAL  --}}
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#sele" style="display: none" id="sele1">    </button>
<div class="modal fade"  id="sele">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" >
              <h5 class="modal-title">Solicitud de Traslado</h5>
              <span aria-hidden="true" style="color: red;">&times;</span>
        </div>
        <div class="modal-body">
          <div class="container-fluid">  
            <div class="row">
              <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                  <h5 class = "text-danger"><strong>¡¡¡BIENVENIDO!!!</strong></h5>
                  <h6>¿Como deseas realizar tu solicitud de cotización?</h6>
              </div>
              <div class="modal-footer col-md-12">
                  <form action="{{ route('validar_logeo_traslado')}}" method="GET" enctype="multipart/form-data">
                    @csrf 
                      <input type="submit" name="con_cuenta" id="con_cuenta" class="btn btn-primary" value="Continuar con mi cuenta">
                  </form>
                  <form action="{{ route('validar_sin_logeo_traslado')}}" method="GET" enctype="multipart/form-data">
                    @csrf 
                      <input type="submit" name="sin_cuenta" id="sin_cuenta" class="btn btn-primary" value="Continuar sin cuenta">
                  </form>
                      <a class="nav-link text-success" data-toggle="modal" data-dismiss="modal" data-target="#primero" style="cursor:pointer">No tengo una cuenta.</a> 
              </div>
            </div> {{-- aqui termina el div row --}}        
          </div>
        </div>
    </div>
  </div>
</div>
    <!-- /.modal ---->
    {{-- MODAL PARA NOTIFICAR QUE NO SE PUEDE AGREGAR UN CLIENTE MENOR DE 18 AÑOS --}}

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rango" style="display: none" id="rango1">Cancelar</button>

  <div class="modal modal-danger fade" id="rango">
      <div class="modal-dialog">
        <div class="modal-content" style="background: red;">
          <div class="modal-header">
            <button type="button" style="color: white;" class="close" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-lg" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></b> </h4>
          </div>
          <div class="modal-body">
            <p style="color: white">No puede agregar un USUARIO menor de 18 años o mayor a 60 años&hellip;</p>
          </div>
          <div class="modal-footer">
            <a class="nav-link text-success" data-toggle="modal" data-dismiss="modal"  style="cursor:pointer">Aceptar</a> 
          
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#existe" style="display: none" id="existe1">Cancelar</button>
<div class="modal modal-danger fade" id="existe">
    <div class="modal-dialog" >
      <div class="modal-content" style="background: red;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-lg" data-toggle="modal" data-target=".bd-example-modal-lg" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></b> </h4>
        </div>
        <div class="modal-body">
          <p style="color: white">Usted ya se encuentra registrado&hellip;</p>
        </div>
        <div class="modal-footer">
          <a class="nav-link text-success" data-toggle="modal" data-dismiss="modal"  style="cursor:pointer">Aceptar</a> 
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    

  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none" id="bien">

  </button>
  <div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
      <div class="modal-content" style="background: cornflowerblue;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p style="color: white;">LOS DATOS FUERON AGREGADOS CORRECTAMENTE&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="recargar()">Continuar</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal ---->
    
    
    
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
    <p><a href="{{ route('sucursal_info') }}">{{$sucursal->nombre}}, {{$sucursal->colonia}}, {{$sucursal->telefono}} </a></p>
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
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>


  <!-- javascript================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>  
<script src="js/jquery.bxslider.min.js"></script>  
<script src="js/custom_p.js"></script>
<script src="js/daterangepicker.js"></script>
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
<script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<script>
    $('#fecha_solicitada').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "singleDatePicker": true,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  document.getElementById('fecha_solicitada').value = end.format('DD-MM-YYYY');
});
</script> 

<script>



var checkbox = document.getElementById('viaje_redondo');
checkbox.addEventListener("change", validaCheckbox, true);

function validaCheckbox(){
  var checked = checkbox.checked;
  var tiempo_espera= document.getElementById("tiempo_espera");
  if(checked){
    tiempo_espera.style.display = (tiempo_espera.style.display == 'none')?'block' : 'none';
    document.getElementById("dias_espera").required = true;
  }
  else{
    tiempo_espera.style.display = (tiempo_espera.style.display == 'block')?'none' : 'block';
    document.getElementById("dias_espera").required = false;
  }
}
</script>
<script>
  $(document).ready(function() {
    var mostrar= document.getElementById("mostrar_modal").value;
    if(mostrar  == "inicio")
        $('#sele1').click(); 
    // console.log(mostrar);
    // console.log(log);

    var tiempo_espera= document.getElementById("tiempo_espera");
    if(document.getElementById('viaje_redondo').checked == true){
    tiempo_espera.style.display = 'block';
    document.getElementById("dias_espera").required = true;
    }
  else{
    tiempo_espera.style.display = 'none';
    document.getElementById("dias_espera").required = false;
  }
  });
</script>

 
<script>

  function cambio(){
    var nacionalidad = document.getElementById("nacionalidad");
    text = nacionalidad.options[nacionalidad.selectedIndex].innerText;
    console.log(text);
    var ide= document.getElementById("identificacion");
    var pas =document.getElementById("pasa");
    if(text == 'MEXICANA'){
      ide.style.display='block';
      pas.style.display='none';
    }
    else{
      ide.style.display='none';
      pas.style.display='block';
    }
  }
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
  function recargar(){
    location.reload(); 
  }
</script>
<script>
  $(document).ready(function(){
 
 
  $('#upload_form').on('submit', function(event){
          event.preventDefault();      

      event.preventDefault();
      $.ajax({      
       method:"POST",
       url:"{{route('agregarcliente')}}",
       data:$('#upload_form').serialize(),//new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        
         var mensaje=data.success;
          console.log(mensaje);
         if(mensaje=='EXITO'){
      $('#bien').click();
       }
         if(mensaje=='ERRORCONTRA'){
          $( '#password' ).css('borderColor', 'red');         
                 jQuery('#validopassword').hide(); 
                 jQuery('#errorpassword').show(); 
                 $( '#passwordconfirm' ).css('borderColor', 'red');
                 jQuery('#validopasswordconfirm').hide(); 
                 jQuery('#errorpasswordconfirm').show(); 
                 $('#errorpasswordconfirm').html('la contraseña no coincide');
                 $('#errorpassword').html('la contraseña no coincide');                 
         }else{
          $( '#password' ).css('borderColor', 'green');         
            jQuery('#validopassword').show(); 
            jQuery('#errorpassword').hide();
          $('#passwordconfirm' ).css('borderColor', 'green');
          jQuery('#validopasswordconfirm').show(); 
                 jQuery('#errorpasswordconfirm').hide(); 
         }

         if(mensaje=='ERROR1'){
      $('#existe1').click();
       }

         if(mensaje=='ERROR2'){
      $('#rango1').click();
      jQuery('#validofechaNacimiento').hide(); 
               jQuery('#errorfechaNacimiento').show();          
              $( '#fechaNacimiento' ).css('borderColor', 'red');
       }
       
       },
       error: function (data) {
        // console.log(data);
           var err = JSON.parse(data.responseText);
           var arreglo = err.errors;

           console.log(arreglo);
            var nombres = arreglo.nombres;
            var primerApellido = arreglo.primerApellido;
            var segundoApellido = arreglo.segundoApellido;
            var fechaNacimiento = arreglo.fechaNacimiento;
            var nacionalidad = arreglo.nacionalidad;      
             var ine = arreglo.ine;
            var pasaporte = arreglo.pasaporte; 
            var pais = arreglo.pais;
            var estado = arreglo.estado;
            var ciudad = arreglo.ciudad;
            var colonia = arreglo.colonia;
            var calle = arreglo.calle;
            var telefono = arreglo.telefono;
            var numero = arreglo.numero;
            var email = arreglo.email;
            var password = arreglo.password;
            var passwordconfirm = arreglo.passwordconfirm;
             
               if (nombres == undefined){  
                 $( '#nombres' ).css('borderColor', 'green');         
                 jQuery('#validonombres').show(); 
                 jQuery('#errornombres').hide(); 
                 }else{
                   jQuery('#validonombres').hide(); 
                 jQuery('#errornombres').show();          
                $( '#nombres' ).css('borderColor', 'red');
                 //console.log(nombre);
               }
  
               if (primerApellido == undefined){  
                 $( '#primerApellido' ).css('borderColor', 'green');         
                 jQuery('#validoprimerApellido').show(); 
                 jQuery('#errorprimerApellido').hide(); 
                 }else{
                   jQuery('#validoprimerApellido').hide(); 
                 jQuery('#errorprimerApellido').show();          
                $( '#primerApellido' ).css('borderColor', 'red');
                 //console.log(nombre);
               }
  
              if (segundoApellido == undefined){  
                 $( '#segundoApellido' ).css('borderColor', 'green');         
                 jQuery('#validosegundoApellido').show(); 
                 jQuery('#errorsegundoApellido').hide(); 
                 }else{
                   jQuery('#validosegundoApellido').hide(); 
                 jQuery('#errorsegundoApellido').show();          
                $( '#segundoApellido' ).css('borderColor', 'red');
                 //console.log(nombre);
               }
     
               if (fechaNacimiento == undefined){  
                 $( '#fechaNacimiento' ).css('borderColor', 'green');         
                 jQuery('#validofechaNacimiento').show(); 
                 jQuery('#errorfechaNacimiento').hide(); 
                 }else{
                   jQuery('#validofechaNacimiento').hide(); 
                 jQuery('#errorfechaNacimiento').show();          
                $( '#fechaNacimiento' ).css('borderColor', 'red');
                 //console.log(nombre);
               }
  
               if (nacionalidad == undefined){  
                 $( '#nacionalidad' ).css('borderColor', 'green');         
                 jQuery('#validonacionalidad').show(); 
                 jQuery('#errornacionalidad').hide(); 
                 }else{
                   jQuery('#validonacionalidad').hide(); 
                 jQuery('#errornacionalidad').show();          
                $( '#nacionalidad' ).css('borderColor', 'red');
                 //console.log(nombre);
               }

               if (email == undefined){  
                 $( '#email' ).css('borderColor', 'green');         
                 jQuery('#validoemail').show(); 
                 jQuery('#erroremail').hide(); 
                 }else{
                   jQuery('#validoemail').hide(); 
                 jQuery('#erroremail').show();          
                $( '#email' ).css('borderColor', 'red');
                 //console.log(nombre);
               }

               if (pasaporte == undefined){  
                 $( '#pasaporte' ).css('borderColor', 'green');         
                 jQuery('#validopasaporte').show(); 
                 jQuery('#errorpasaporte').hide(); 
                 }else{
                   jQuery('#validopasaporte').hide(); 
                 jQuery('#errorpasaporte').show();          
                $( '#pasaporte' ).css('borderColor', 'red');
                 //console.log(nombre);
               }
  
            if (ine == undefined){  
                 $( '#ine' ).css('borderColor', 'green');         
                 jQuery('#validoine').show(); 
                 jQuery('#errorine').hide(); 
                 }else{
                   jQuery('#validoine').hide(); 
                 jQuery('#errorine').show();          
                $( '#ine' ).css('borderColor', 'red');
                 //console.log(nombre);
               }          
            
  
            if (pais == undefined){  
              $( '#pais' ).css('borderColor', 'green');         
              jQuery('#validopais').show(); 
              jQuery('#errorpais').hide(); 
              }else{
                jQuery('#validopais').hide(); 
              jQuery('#errorpais').show();          
             $( '#pais' ).css('borderColor', 'red');
              //console.log(nombre);
            }
            if (estado == undefined){  
              $( '#estado' ).css('borderColor', 'green');         
              jQuery('#validoestado').show(); 
              jQuery('#errorestado').hide(); 
              }else{
                jQuery('#validoestado').hide(); 
              jQuery('#errorestado').show();          
             $( '#estado' ).css('borderColor', 'red');
              //console.log(nombre);
            }
            if (ciudad == undefined){  
              $( '#ciudad' ).css('borderColor', 'green');         
              jQuery('#validociudad').show(); 
              jQuery('#errorciudad').hide(); 
              }else{
                jQuery('#validociudad').hide(); 
              jQuery('#errorciudad').show();          
             $( '#ciudad' ).css('borderColor', 'red');
              //console.log(nombre);
            }
  
            if (calle == undefined){  
              $( '#calle' ).css('borderColor', 'green');         
              jQuery('#validocalle').show(); 
              jQuery('#errorcalle').hide(); 
              }else{
                jQuery('#validocalle').hide(); 
              jQuery('#errorcalle').show();          
             $( '#calle' ).css('borderColor', 'red');
              //console.log(nombre);
            }
            if (numero == undefined){  
              $( '#numero' ).css('borderColor', 'green');         
              jQuery('#validonumero').show(); 
              jQuery('#errornumero').hide(); 
              }else{
                jQuery('#validonumero').hide(); 
              jQuery('#errornumero').show();          
             $( '#numero' ).css('borderColor', 'red');
              //console.log(nombre);
            }
            if (telefono == undefined){  
              $( '#telefono' ).css('borderColor', 'green');         
              jQuery('#validotelefono').show(); 
              jQuery('#errortelefono').hide(); 
              }else{
                jQuery('#validotelefono').hide(); 
              jQuery('#errortelefono').show();          
             $( '#telefono' ).css('borderColor', 'red');
              //console.log(nombre);
            }
  
            if (colonia == undefined){  
              $( '#colonia' ).css('borderColor', 'green');         
              jQuery('#validocolonia').show(); 
              jQuery('#errorcolonia').hide(); 
              }else{
                jQuery('#validocolonia').hide(); 
              jQuery('#errorcolonia').show();          
             $( '#colonia' ).css('borderColor', 'red');
              //console.log(nombre);
            }

            if (email == undefined){  
                 $( '#email' ).css('borderColor', 'green');         
                 jQuery('#validoemail').show(); 
                 jQuery('#erroremail').hide(); 
                 }else{
                   jQuery('#validoemail').hide(); 
                 jQuery('#erroremail').show();          
                $( '#email' ).css('borderColor', 'red');
                 //console.log(nombre);
               }

               if (password == undefined){  
                 $( '#password' ).css('borderColor', 'green');         
                 jQuery('#validopassword').show(); 
                 jQuery('#errorpassword').hide(); 
                 }else{
                   jQuery('#validopassword').hide(); 
                 jQuery('#errorpassword').show();          
                $( '#password' ).css('borderColor', 'red');
                 //console.log(nombre);
               }

               if (passwordconfirm == undefined){  
                 $( '#passwordconfirm' ).css('borderColor', 'green');         
                 jQuery('#validopasswordconfirm').show(); 
                 jQuery('#errorpasswordconfirm').hide(); 
                 }else{
                   jQuery('#validopasswordconfirm').hide(); 
                 jQuery('#errorpasswordconfirm').show();          
                $( '#passwordconfirm' ).css('borderColor', 'red');
                $('#errorpasswordconfirm').html('la contraseña no coincide');
                 //console.log(nombre);
               }

            $('#updload').val('guardar cambios');
       }
      })
     });
    
    });
    </script>
</body>
</html>

