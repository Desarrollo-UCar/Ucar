<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Ü-car Renta de vehículos</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSS -->    <!-- CSS -->
   
    <link href="css/bootstrap.css" rel="stylesheet" />
    
    <link href="css/style.css" rel="stylesheet" />
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
                                             document.getElementById('logout-form').submit();"style="color: white">
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
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="container">
                        <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
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
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div id="lista_itinerario">
                            <h6><strong>Datos Generales:</strong></h6>    
                            <dl>
                            <dt>Lugar de Entrega y Devolución</dt>
                            <dd>{{$sucursal->nombre}}</dd>
                            <dt>Fecha / Hora de recolección:</dt>
                            <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_recogida))}} a las {{$datos_reserva->hora_recogida}} hrs</dd>
                            <dt>Fecha / Hora de devolución:</dt>
                            <dd>{{date("d\-m\-Y", strtotime($datos_reserva->fecha_devolucion))}} a las {{$datos_reserva->hora_devolucion}} hrs</dd>
                            </dl> 
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div id="lista_itinerario">
                            <h6><strong><span class="colored" style="color:#FBAE17">*Documentos que deberá presentar obligatoriamente en mostrador al momento de la entrega del vehículo:</span></strong></h6>    
                            <dl>
                            <dt>- INE o pasaporte vigente de quien realizó la reserva</dt>
                            <dd>En el caso de nacionales se solicita INE y para extranjeros pasaporte.</dd>
                            <dt>- Licencia de conducir vigente</dt>
                            <dt>- Tarjeta de crédito</dt>
                            <dt>- Pago de garantía</dt>
                            <dd>De la tarjeta de crédito se retendrán $20,000.00 MXN como garantía en caso de cualquier siniestro o percance.</dd>  
                            <dt>- Pago total de la renta</dt>
                            <dd>El pago total de la renta se liquida en el momento de la entrega del vehículo.</dd>
                            <dd>Se requiere el pago mínimo de un día para realizar la reservación.</dd>
                            <dt>- En caso de dudas</dt>
                            <dd>Consultar los términos y condiciones del servicio.</dd>
                            </dl> 
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-4 col-md-2 col-lg-2 col-xl-2">    
                  <div id="lista_itinerario">
                      <h6><strong>Tu vehículo:</strong></h6>  
                      <dl>
                          @if($vehiculo->tipo != "motoneta")
                          <dt>{{$vehiculo->marca}} {{$vehiculo->modelo}}</dt>
                          <dd><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</dd>
                          <dd><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</dd>
                          <dd><i class="fa fa-car"   aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</dd>
                          <dd><i class="fa fa-exchange"aria-hidden="true"></i>Transmisión {{$vehiculo->transmicion}}</dd>
                          <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</dd>
                          <dd><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Km por litro</dd>
                          <dd><i class="fa fa-bolt"       aria-hidden="true"></i>Color: {{$vehiculo->color}}</dd>
                          <dt>Tarifa: ${{number_format($vehiculo->precio,2)}}</dt>
                      @else
                      <dt>{{$vehiculo->marca}} {{$vehiculo->modelo}}</dt>
                          <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i>{{$vehiculo->cilindros}} CC</dd>
                          <dd><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</dd>
                          <dd><i class="fa fa-bolt"       aria-hidden="true"></i>Color: {{$vehiculo->color}}</dd>
                          <dt>Tarifa: ${{number_format($vehiculo->precio,2)}}</dt>
                      @endif
                      </dl>   
                  </div>
              </div>
                            
                            <div class="col-sm-8 col-md-4 col-lg-4 col-xl-4">
                                {{-- <div class="container"> --}}
                                    <div class="row">
                                            
                                    
                                        <form action="{{ route('validar_logeo')}}" method="GET" enctype="multipart/form-data">
                                        @csrf    
                                        <input type="hidden" name="id_reserva" value="{{$datos_reserva->id}}">
                                            @if(!(Auth::user()))
                                            <img src="{{ '/images/'.$vehiculo->foto}}" />
                                            <div class="row">
                                                <div class="form-group col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                                    <button class="btn " style="background:#FBAE17" type="submit">Iniciar Sesión</button>
                                                </div>    
                                                <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
                                                    <a class="nav-link text" style="color:#FBAE17; cursor: pointer" data-toggle="modal" data-target=".bd-example-modal-lg" {{-- href="{{ route('register',['id_reserva'=>$datos_reserva->id]) }}"--}}>No tengo una cuenta.</a> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div style="margin-top: 2%;">
                                                    <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="."  required>
                                                    <label class="form-check-label" for="terminos_condiciones">HE LEÍDO Y ACEPTO </label>
                                                </div>
                                                <div>
                                                    <a class="nav-link text-danger" target="_blank" href="{{asset('pdf/terminos_condiciones/Terminos-y-Condiciones-de-renta.pdf')}}">TÉRMINOS Y CONDICIONES</a> 
                                                </div>
                                            </div>     
                                            @else
                                               <img src="{{ '/images/'.$vehiculo->foto}}" />
                                            <div class="form-row">
                                                <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                                    <button class="btn btn-primary" type="submit" style="margin-top: 15%;">Continuar</button>
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
                                            </div>          
                                                        
                                                        
                                                        
                                            @endif
                                        </form>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div id="lista_itinerario">
                                                
                                                <dt class = "text-danger"><strong>¡¡¡IMPORTANTE!!!</strong></dt>
                                                <dd>De no cumplir con los documentos aquí mostrados, no se le podrá hacer entrega del vehículo, ni devolución de su pago de reserva.</dd>
                                                </dl> 
                                            </div>
                                        </div>
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

