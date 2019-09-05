
@extends('plantilla')
@section('seccion')
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
                                        <div class="form-row">
                                            <div class="form-group col-sm-5 col-md-5 col-lg-5 col-xl-5">
                                                <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                                            </div>    
                                            <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
                                                <a class="nav-link text-success" href="{{ route('register',['id_reserva'=>$datos_reserva->id]) }}" data-toggle="modal" data-target=".bd-example-modal-lg" >No tengo una cuenta.</a> 
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                <input type="checkbox" id="terminos_condiciones" name="terminos_condiciones" value="."  required>
                                                <label class="form-check-label" for="terminos_condiciones">HE LEÍDO Y ACEPTO </label>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
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
                        <form method="post" id="upload_form" enctype="multipart/form-data">
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

                                        <div class="form-group col-md-4 col-sm-4">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();" id="ciudad">
                        
                                                <span id="errorciudad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validociudad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                            </div>

                                        {{--FORMULARIO DE CORREO EMAIL--}}
                    <div class="form-group col-md-4 col-sm-4">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Correo Eléctronico" name="email" id="email">
    
                            <span id="erroremail" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validoemail" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>


                        <div class="form-group col-md-4 col-sm-4">
                                <label>Contraseña</label>
                                <input id="password" type="password" class="form-control"  name="password" required autocomplete="new-password">

                                <span id="errorpassword" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                <span id="validopassword" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div>

                        
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

{{-- SCRIPT PARA VISUALIZAR FOTO --}}
<script>
        document.getElementById("foto").onchange = function(e) {
         // Creamos el objeto de la clase FileReader
         let reader = new FileReader();
       
         // Leemos el archivo subido y se lo pasamos a nuestro fileReader
         reader.readAsDataURL(e.target.files[0]);
       
         // Le decimos que cuando este listo ejecute el código interno
         reader.onload = function(){
           let preview = document.getElementById('preview'),
                   image = document.createElement('img');
       
           image.src = reader.result;
           image.getElementsByClassName('rounded-circle');
           image.style.width="80px";
           image.style.height="80px";
           image.style.borderRadius="50%";
           preview.innerHTML = '';
           preview.append(image);
         };
       }
        </script>



{{-- AJAX PARA LA PETICION AGREGAR CLIENTES --}}

<script>
        $(document).ready(function(){
        
         $('#upload_form').on('submit', function(event){
          event.preventDefault();
          $.ajax({
           url:"{{route('register')}}",
           method:"POST",
           data:new FormData(this),
           dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
            
             var mensaje=data.success;
             console.log('hola');
             if(mensaje=='EXITO'){
            $('.btn-info').click();
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
               var err = JSON.parse(data.responseText);
               var arreglo = err.errors;
               /*jQuery.each(arreglo, function(key, value){
                  console.log(arreglo);
                            });*/
                            console.log(arreglo);
                var ine = arreglo.ine;
                var estado = arreglo.estado;
                var municipio = arreglo.municipio;
                var colonia = arreglo.colonia;
                var calle = arreglo.calle;
                var numero = arreglo.numero;
                var telefono = arreglo.telefono;
                var nombres = arreglo.nombres;
                var primerApellido = arreglo.primerApellido;
                var segundoApellido = arreglo.segundoApellido;
                   var fechaNacimiento = arreglo.fechaNacimiento;
                   var nacionalidad = arreglo.nacionalidad;                                       
                   var genero = arreglo.genero;           
                   var correo = arreglo.correo;
                   var tipo = arreglo.tipo;
                   var sucursal = arreglo.sucursal;
                   var status = arreglo.status;
                   var numLicencia = arreglo.numLicencia;
                   var licenciaFechaExpedicion = arreglo.licenciaFechaExpedicion;
                   var licenciaFechaExpiracion = arreglo.licenciaFechaExpiracion;
                   var foto = arreglo.foto;
                   
                   
                   if (foto == undefined){  
                    
                     }else{
                      $('#message').css('display', 'block');
                    $('#message').html('AGREGA UNA FOTO DE EMPLEADO');
                    $('#message').addClass("alert alert-danger");
                     //console.log(nombre);
                   }
                 
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
      
                   if (genero == undefined){  
                     $( '#genero' ).css('borderColor', 'green');         
                     jQuery('#validogenero').show(); 
                     jQuery('#errorgenero').hide(); 
                     }else{
                       jQuery('#validogenero').hide(); 
                     jQuery('#errorgenero').show();          
                    $( '#genero' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (correo == undefined){  
                     $( '#correo' ).css('borderColor', 'green');         
                     jQuery('#validocorreo').show(); 
                     jQuery('#errorcorreo').hide(); 
                     }else{
                       jQuery('#validocorreo').hide(); 
                     jQuery('#errorcorreo').show();          
                    $( '#correo' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (tipo == undefined){  
                     $( '#tipo' ).css('borderColor', 'green');         
                     jQuery('#validotipo').show(); 
                     jQuery('#errortipo').hide(); 
                     }else{
                       jQuery('#validotipo').hide(); 
                     jQuery('#errortipo').show();          
                    $( '#tipo' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (sucursal == undefined){  
                     $( '#sucursal' ).css('borderColor', 'green');         
                     jQuery('#validosucursal').show(); 
                     jQuery('#errorsucursal').hide(); 
                     }else{
                       jQuery('#validosucursal').hide(); 
                     jQuery('#errorsucursal').show();          
                    $( '#sucursal' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (status == undefined){  
                     $( '#status' ).css('borderColor', 'green');         
                     jQuery('#validostatus').show(); 
                     jQuery('#errorstatus').hide(); 
                     }else{
                       jQuery('#validostatus').hide(); 
                     jQuery('#errorstatus').show();          
                    $( '#status' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (numLicencia == undefined){  
                     $( '#numLicencia' ).css('borderColor', 'green');         
                     jQuery('#validonumLicencia').show(); 
                     jQuery('#errornumLicencia').hide(); 
                     }else{
                       jQuery('#validonumLicencia').hide(); 
                     jQuery('#errornumLicencia').show();          
                    $( '#numLicencia' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (licenciaFechaExpedicion == undefined){  
                     $( '#licenciaFechaExpedicion' ).css('borderColor', 'green');         
                     jQuery('#validolicenciaFechaExpedicion').show(); 
                     jQuery('#errorlicenciaFechaExpedicion').hide(); 
                     }else{
                       jQuery('#validolicenciaFechaExpedicion').hide(); 
                     jQuery('#errorlicenciaFechaExpedicion').show();          
                    $( '#licenciaFechaExpedicion' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }
      
                   if (licenciaFechaExpiracion == undefined){  
                     $( '#licenciaFechaExpiracion' ).css('borderColor', 'green');         
                     jQuery('#validolicenciaFechaExpiracion').show(); 
                     jQuery('#errorlicenciaFechaExpiracion').hide(); 
                     }else{
                       jQuery('#validolicenciaFechaExpiracion').hide(); 
                     jQuery('#errorlicenciaFechaExpiracion').show();          
                    $( '#licenciaFechaExpiracion' ).css('borderColor', 'red');
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
                
      
                if (codigo == undefined){  
                  $( '#codigo_postal' ).css('borderColor', 'green');         
                  jQuery('#validocodigopostal').show(); 
                  jQuery('#errorcodigopostal').hide(); 
                  }else{
                    jQuery('#validocodigopostal').hide(); 
                  jQuery('#errorcodigopostal').show();          
                 $( '#codigo_postal' ).css('borderColor', 'red');
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
                if (municipio == undefined){  
                  $( '#municipio' ).css('borderColor', 'green');         
                  jQuery('#validomunicipio').show(); 
                  jQuery('#errormunicipio').hide(); 
                  }else{
                    jQuery('#validomunicipio').hide(); 
                  jQuery('#errormunicipio').show();          
                 $( '#municipio' ).css('borderColor', 'red');
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
           }
          })
         });
        
        });
        </script>
@endsection

