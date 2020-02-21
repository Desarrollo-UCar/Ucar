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
    <link rel="icon"  type="image/png" href="img/UCAR LOGO-02.png">
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
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {{-- <div class="container"> --}}
                                    <div class="row">
                                        <form id="upload_form" method="POST" enctype="multipart/form-data">
                                            {{-- {{ csrf_field() }} --}}
                                            @csrf
                                      <div class="row">
                             
                                                    {{-- FORMULARIO DE NOMBRES --}}
                                                  
                                                       <div class="form-group col-md-3 col-sm-3">
                                                            <label>Nombres</label>
                                                            <input id="nombres" type="text" class="form-control"  placeholder="Nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                    
                                                            <span id="errornombres" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;" aria-hidden="true"></span>
                                                            <span id="validonombres" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;" aria-hidden="true"></span>
                                                        </div> 
                                                     {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                                          
                                             <div class="form-group col-md-3 col-sm-3">
                                                    <label>Primer Apellido </label>
                                                    <input type="text" class="form-control" placeholder="Primer apellido" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="primerApellido">
                                                    <span id="errorprimerApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                    <span id="validoprimerApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                </div> 
                          
                                                 {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                                                  
                                                 <div class="form-group col-md-3 col-sm-3">
                                                  <label>Segundo Apellido</label>
                                                  <input type="text" class="form-control" placeholder="Segundo apellido" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="segundoApellido">
                          
                                                  <span id="errorsegundoApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                  <span id="validosegundoApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                              </div>
                                                {{--FORMULARIO DE FECHA DE NACIMIENTO--}}
                                          <div class="form-group col-md-3 col-sm-3">
                                            <label>Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" placeholder="fechaNacimiento" name="fechaNacimiento" id="fechaNacimiento">
                    
                                            <span id="errorfechaNacimiento" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                            <span id="validofechaNacimiento" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                        </div>
                          
                                             
                                                {{--FORMULARIO NACIONALIDAD--}}
                                                <?php $nacion= DB::table('nacionalidades')
                                                ->orderBy('nombre','asc')
                                                ->get(); ?>
                                        <div class="form-group col-md-3 col-sm-3">
                                                <label>Nacionalidad</label>
                                          <select class="form-control" id="nacionalidad" name="nacionalidad" onchange="cambio();">
                                            @foreach ($nacion as $nacion)
                                            <option>{{$nacion->nombre}}</option>
                                            @endforeach                             
                                          </select>
                        
                                                <span id="errornacionalidad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validonacionalidad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                            </div>
                    
                                            <div class="form-group col-md-3 col-sm-3" id="identificacion" style="display: none">
                                                    <label>INE</label>
                                                  <input type="text" class="form-control" autofocus placeholder="Número de credencial de elector" name="ine" data-inputmask='"mask": "9999999999999"' data-mask id="ine">
                                
                                                  <span id="errorine" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validoine" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                </div>   
                                                                  
                                                <div class="form-group col-md-3 col-sm-3"  id="pasa">
                                                        <label>Pasaporte</label>
                                                      <input type="text" class="form-control" autofocus placeholder="Pasaporte" name="pasaporte" data-inputmask='"mask": "9999999999999"' data-mask id="pasaporte">
                                    
                                                      <span id="errorpasaporte" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                    <span id="validopasaporte" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                    </div>   
                    
                                                  {{--DATOS PARA EL TELEFONO--}}
                                            <div class="form-group col-md-3 col-sm-3">
                                                    <label>Teléfono</label>
                                                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                                                    data-inputmask='"mask": "9999999999"' data-mask id="telefono">
                                
                                                    <span id="errortelefono" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                    <span id="validotelefono" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                </div>  
                    
                                                {{-- FORMUALRIO PAIS PARA EL CLIENTE --}}
                                            <div class="form-group col-md-3 col-sm-3">
                                                  <label>País</label>
                                                  <input type="text" class="form-control" placeholder="País" name="pais" onkeyup="javascript:this.value=this.value.toUpperCase();" id="pais">
                          
                                                  <span id="errorpais" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                  <span id="validopais" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                              </div>
                    
                                              {{-- FORMULARIO ESTADO DEL CLIENTE --}}
                                              <div class="form-group col-md-3 col-sm-3">
                                                    <label>Estado</label>
                                                    <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" id="estado">
                            
                                                    <span id="errorestado" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                    <span id="validoestado" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                </div>
                                                           
                                                {{-- FORMULARIO CIUDAD DEL CLIENTE --}}
                                                <div class="form-group col-md-3 col-sm-3">
                                                        <label>Ciudad</label>
                                                        <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();" id="ciudad">
                                
                                                        <span id="errorciudad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                        <span id="validociudad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                    </div>
                    
                                                    {{-- FORMULARIO DE LOS DATOS DE LA COLONIA --}}
                                                    <div class="form-group col-md-3 col-sm-3">
                                                        <label>Colonia</label>
                                                        <input type="text" class="form-control" placeholder="Colonia" name="colonia" onkeyup="javascript:this.value=this.value.toUpperCase();" id="colonia">
                                
                                                        <span id="errorcolonia" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                        <span id="validocolonia" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                    </div>
                    
                                                    {{-- FORMULARIO DE LOS DATOS DE LA COLONIA --}}
                                                    <div class="form-group col-md-3 col-sm-3">
                                                            <label>Calle</label>
                                                            <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" id="calle">
                                    
                                                            <span id="errorcalle" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                            <span id="validocalle" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                        </div>
                    
                                                        <div class="form-group col-md-3 col-sm-3">
                                                                <label>Número</label>
                                                                <input type="text" class="form-control" placeholder="Número de calle" name="numero" onkeyup="javascript:this.value=this.value.toUpperCase();" id="numero">
                                        
                                                                <span id="errornumero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                                <span id="validonumero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                            </div>
                    
                                                        
                    
                                        {{--FORMULARIO DE CORREO EMAIL--}}
                                        <div class="form-group col-md-3 col-sm-3">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Correo Eléctronico" name="email" id="email">
                        
                                                <span id="erroremail" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validoemail" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                            </div>
                    
                                          {{-- FORMULARIO DE CONTRASEÑA --}}
                                            <div class="form-group col-md-3 col-sm-3">
                                                    <label>Contraseña</label>
                                                    <input id="password" type="password" class="form-control"  name="password"  autocomplete="new-password">
                    
                                                    <span id="errorpassword" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                    <span id="validopassword" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                </div>
                    
                                            {{-- FORMULARIO PARA LA CONFIRMACION DEL CORREO --}}
                                                <div class="form-group col-md-3 col-sm-3">
                                                        <label>Confirmar Contraseña</label>
                                                        <input id="passwordconfirm" type="password" class="form-control"  name="passwordconfirm"  autocomplete="new-password">
                        
                                                        <span id="errorpasswordconfirm" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                        <span id="validopasswordconfirm" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                                    </div>
                                                          <div class="row">
                                                            <div style="margin-top: 2%;">
                                                                <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="."  required>
                                                                <label class="form-check-label" for="terminos_condiciones">HE LEÍDO Y ACEPTO </label>
                                                            </div>
                                                            <div>
                                                                <a class="nav-link text-danger" target="_blank" href="{{asset('pdf/terminos_condiciones/Terminos-y-Condiciones-de-renta.pdf')}}">TÉRMINOS Y CONDICIONES</a> 
                                                            </div>
                                                            <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Agregar">
                                                        </div> 
                                                  </div> {{-- aqui termina el div row --}}
                                                 </form> {{-- AQUI TERMINA EL FORM --}}
                                        
                                    </div>
                                {{-- </div> --}}
                            </div>
    </div>
    
    <!-- Large modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> --}}
    <section id="inner-headline" >
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto;margin-top: 3%;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header" style="background: #FBAE17;">
                        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" style="color: red;">&times;</span>
                        </button>
            </div>
           
         
        </div>
      </div>
    </div>
    </div> {{-- AQUI TERMINA EL MODAL  --}}
  </section>
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
            <button type="button" class="btn btn-success pull-left" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-lg">Aceptar</button>
          
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
          <p style="color: white">Ustede ya se encuentra registrado&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal"  data-toggle="modal" data-target=".bd-example-modal-lg">Aceptar</button>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    

  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none" >

  </button>
  <div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
      <div class="modal-content" style="background: cornflowerblue;"">
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
   

{{-- TERMINA EL CUERPO DE LA PAGINA --}}


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
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- javascript================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/jquery.js"></script>  
  <script src="js/jquery.bxslider.min.js"></script>  
  <script src="js/custom_p.js"></script>
  <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
  <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
  <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
  <script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>

 
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
        //  console.log(mensaje);
         if(mensaje=='EXITO'){           
      $('.btn-info').click();
       }
         if(mensaje=='ERRORCONTRA'){
          $( '#password' ).css('borderColor', 'red');         
                 jQuery('#validopassword').hide(); 
                 jQuery('#errorpassword').show(); 
                 $( '#password-cofirm' ).css('borderColor', 'red');
                 jQuery('#validopasswordconfirm').hide(); 
                 jQuery('#errorpasswordconfirm').show(); 
                 $('#errorpasswordconfirm').html('la contraseña no coincide');
                 $('#errorpassword').html('la contraseña no coincide');                 
         }else{
          $( '#password' ).css('borderColor', 'red');         
            jQuery('#validopassword').show(); 
            jQuery('#errorpassword').hide();
          $('#password-cofirm' ).css('borderColor', 'green');
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
           /*jQuery.each(arreglo, function(key, value){
              console.log(arreglo);
                        });*/
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
  
              /* if (genero == undefined){  
                 $( '#genero' ).css('borderColor', 'green');         
                 jQuery('#validogenero').show(); 
                 jQuery('#errorgenero').hide(); 
                 }else{
                   jQuery('#validogenero').hide(); 
                 jQuery('#errorgenero').show();          
                $( '#genero' ).css('borderColor', 'red');
                 //console.log(nombre);
               }*/
  
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

