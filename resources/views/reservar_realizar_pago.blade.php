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
    {{-- <link href="css/camera.css" rel="stylesheet" /> --}}
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/shortcodes.css" rel="stylesheet" />
    
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
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
                    <li class="dropdown">
                        <a href="{{ route('register')}}">Registrarse </a>
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
    

    {{-- AQUI EMPIEZA EL CUERPO DE LA PAGINA --}}

    <section id="inner-headline">
        <div class="container">
        <div class="row nomargin">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="inner-heading">
                <h2>Revisa y Reserva </h2>
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
                            </dl> 
                        </div>
                    </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">    
                                <div id="lista_itinerario">
                                    <h6><strong>Tu vehículo:</strong></h6>  
                                    <dl>
                                    <dt>{{$vehiculo->marca}} {{$vehiculo->modelo}}</dt>
                                    <dd><i class="fa fa-male"       aria-hidden="true"></i>  {{$vehiculo->pasajeros}} Pasajeros</dd>
                                    <dd><i class="fa fa-suitcase"   aria-hidden="true"></i> {{$vehiculo->maletero}}</dd>
                                    <dd><i class="fa fa-car"   aria-hidden="true"></i> {{$vehiculo->puertas}} Puertas</dd>
                                    <dd><i class="fa fa-exchange"aria-hidden="true"></i> Transmisión {{$vehiculo->transmicion}}</dd>
                                    <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i> {{$vehiculo->cilindros}} Cilindros</dd>
                                    <dd><i class="fa fa-bolt"       aria-hidden="true"></i> {{$vehiculo->rendimiento}} Kilómetros por litro</dd>
                                    <dd><i class="fa fa-bolt"       aria-hidden="true"></i> Color: {{$vehiculo->color}}</dd>
                                    </dl>   
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                {{-- <div class="container"> --}}
                                    <div class="row">
                                            
                                    
                                        <form action="{{ route('validar_logeo')}}" method="GET" enctype="multipart/form-data">
                                        @csrf    
                                        <input type="hidden" name="id_reserva" value="{{$datos_reserva->id}}">
                                            @if(!(Auth::user()))
                                            <img src="{{ '/images/'.$vehiculo->foto}}" />
                                            <div class="row">
                                                <div class="form-group col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                                    <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                                                </div>    
                                                <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
                                                    <a class="nav-link text-success" href="{{ route('register',['id_reserva'=>$datos_reserva->id]) }}" data-toggle="modal" data-target=".bd-example-modal-lg" >No tengo una cuenta.</a> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div style="margin-top: 2%;">
                                                    <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="."  required>
                                                    <label class="form-check-label" for="terminos_condiciones">HE LEÍDO Y ACEPTO </label>
                                                </div>
                                                <div>
                                                    <a class="nav-link text-danger" target="_blank" href="{{asset('pdf/terminos_condiciones/Terminos-y-Condiciones-de-renta.pdf')}}" >TÉRMINOS Y CONDICIONES</a> 
                                                </div>
                                            </div>     
                                            @else
                                               <img src="{{ '/images/'.$vehiculo->foto}}" />
                                            <div class="form-row">
                                                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                                    <button class="btn btn-primary" type="submit" style="margin-top: 15%;">Continuar</button>
                                                </div>
                                        
                                                <div class="form-group col-sm-1 col-md-1 col-lg-1 col-xl-1">
                                                    <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="." style="margin-top: 100%; margin-left: 100%;"  required>
                                                </div>
                                                <div class="form-group col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                    <a class="nav-link text-danger" target="_blank" href="{{asset('pdf/terminos_condiciones/Terminos-y-Condiciones-de-renta.pdf')}}" >HE LEÍDO Y ACEPTO LOS TÉRMINOS Y CONDICIONES</a> 
                                                </div> 
                                            </div>          
                                                        
                                                        
                                                        
                                            @endif
                                        </form>
                                    </div>
                                {{-- </div> --}}
                            </div>
    </div>
    
    <!-- Large modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> --}}
    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <form method="POST" id="#upload_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                      <div class="row">
                            
                           
                            <div class="col-md-12 ml-auto">
                                <div class="col-md-3 ml-auto" style="margin-right: 40%;">
                                    <div class="alert" id="message" style="display: none"></div>
                                  <div id="preview" style="margin-left: 35%;">                               
                                    <img class="col-md-offset-4" src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 80px;height:80px;border-radius: 50%;">                
                                  
                                  </div>
                                  <input id="foto" type="file" name="foto">
                                </div>
                              </div>    
                                               
                                    {{-- FORMULARIO DE NOMBRES --}}
                                  
                                       <div class="form-group col-md-4 col-sm-4">
                                            <label>Nombres</label>
                                            <input type="text" class="form-control" placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nombres">
                    
                                            <span id="errornombres" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                            <span id="validonombres" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
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
                          <select class="form-control" id="nacionalidad" name="nacionalidad">
                            @foreach ($nacion as $nacion)
                            <option>{{$nacion->nombre}}</option>
                            @endforeach                             
                          </select>
        
                                <span id="errornacionalidad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validonacionalidad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div>
    
                            <div class="form-group col-md-4 col-sm-4">
                                    <label>INE</label>
                                  <input type="text" class="form-control" autofocus placeholder="Número de credencial de elector" name="ine" data-inputmask='"mask": "9999999999999"' data-mask id="ine">
                
                                  <span id="errorine" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validoine" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>   
                                                  
                                <div class="form-group col-md-4 col-sm-4">
                                        <label>Pasaporte</label>
                                      <input type="text" class="form-control" autofocus placeholder="Número de credencial de elector" name="pasaporte" data-inputmask='"mask": "9999999999999"' data-mask id="pasaporte">
                    
                                      <span id="errorine" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validoine" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
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
                                    <input id="password" type="password" class="form-control"  name="password" required autocomplete="new-password">
    
                                    <span id="errorpassword" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validopassword" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>
    
                            {{-- FORMULARIO PARA LA CONFIRMACION DEL CORREO --}}
                                <div class="form-group col-md-4 col-sm-4">
                                        <label>Confirmar Contraseña</label>
                                        <input id="password-confirm" type="password" class="form-control"  name="password-confirm" required autocomplete="new-password">
        
                                        <span id="errorpassword-confirm" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                        <span id="validopassword-confirm" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                    </div>
    
                                    <div class="modal-footer col-md-12">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar</button>
                                          </div>
                                  </div> {{-- aqui termina el div row --}}
                                 </form> {{-- AQUI TERMINA EL FORM --}}
                                 
                    </div>
                  </div>
         
        </div>
      </div>
    </div>
    </div> {{-- AQUI TERMINA EL MODAL  --}}
    
    </section>
   

{{-- TERMINA EL CUERPO DE LA PAGINA --}}


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
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script> --}}
      {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script> --}}

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- javascript================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  {{-- <script src="js/bootstrap.js"></script> --}}

  {{-- <script src="js/modernizr.custom.js"></script> --}}
  {{-- <script src="js/toucheffects.js"></script> --}}
  {{-- <script src="js/google-code-prettify/prettify.js"></script> --}}
  <script src="js/jquery.bxslider.min.js"></script>
  {{-- <script src="js/camera/camera.js"></script> --}}
  {{-- <script src="js/camera/setting.js"></script> --}}

  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/portfolio/jquery.quicksand.js"></script>
  {{-- <script src="js/portfolio/setting.js"></script> --}}

  {{-- <script src="js/jquery.flexslider.js"></script> --}}
  {{-- <script src="js/animate.js"></script> --}}
  {{-- <script src="js/inview.js"></script> --}}
  {{-- <script src="js/daterangepicker.js"></script> --}}
  <script src="js/custom.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script> --}}

</body>
</html>

