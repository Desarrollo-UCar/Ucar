@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="_token" content="{{ csrf_token() }}" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Empleado</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Alta Empleado</small>
        </h1>
        
    </section>

    <section class="content"> 
    
        <div class="box box-primary">             
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Sucursal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

             
              <form method="post" id="upload_form" enctype="multipart/form-data">
               {{ csrf_field() }}
               <!-- FORM PARA PREVISUALIZAR FOTO -->             
                    <div class="box-body"> 
                                
                        
            
               {{-- FORMULARIO DE ID PERSONA --}}  
               <div class="row" style="display:none">
                <div class="form-group col-md-4">
                    <label>idempleado</label>
                  <input type="text" class="form-control" name="idempleado" value="{{$emp->idempleado}}" id="idempleado">
                </div>   
              </div> 



               <div class="row" style="margin-left: 0.1%;margin-right: 0.1%;">
                <div class="form-group col-md-4">
                    <label>INE</label>
                  <input type="text" class="form-control" autofocus placeholder="Número de credencial de elector" name="ine" data-inputmask='"mask": "9999999999999"' data-mask id="ine" value="{{ $emp->ine }}">

                  <span id="errorine" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                <span id="validoine" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div>
                
                <div class="form-group col-md-4">
                    <label>RFC</label>
                  <input type="text" class="form-control" autofocus placeholder="Número de RFC" name="rfc"  id="rfc" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="13" value="{{ $emp->rfc }}">

                  <span id="errorfc" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                <span id="validorfc" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div> 
              </div> 

              
                       {{-- FORMULARIO DE NOMBRES --}}
                  
                       <div class="form-group col-md-4">
                        <label>Nombres</label>
                        <input type="text" class="form-control" placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nombres"  value="{{ $emp->nombres }}">

                        <span id="errornombres" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validonombres" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>  
                         {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                      
                         <div class="form-group col-md-4">
                          <label>Primer Apellido </label>
                          <input type="text" class="form-control" placeholder="primer apellido" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="primerApellido"  value="{{ $emp->primerApellido }}">
                          <span id="errorprimerApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validoprimerApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div> 

                       {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                        
                       <div class="form-group col-md-4">
                        <label>Segundo Apellido</label>
                        <input type="text" class="form-control" placeholder="segundo apellido" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="segundoApellido"  value="{{ $emp->segundoApellido }}">

                        <span id="errorsegundoApellido" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validosegundoApellido" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                      {{--FORMULARIO DE FECHA DE NACIMIENTO--}}
                      <div class="form-group col-md-4">
                          <label>Fecha de Nacimiento</label>
                          <input type="date" class="form-control" placeholder="fechaNacimiento" name="fechaNacimiento" id="fechaNacimiento"  value="{{ $emp->fechaNacimiento }}">

                          <span id="errorfechaNacimiento" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validofechaNacimiento" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>
                      
                    {{--FORMULARIO NACIONALIDAD--}}
                    <div class="form-group col-md-4">
                        <label>Nacionalidad</label>
                        <input type="text" class="form-control" placeholder="Nacionalidad" name="nacionalidad" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nacionalidad"  value="{{ $emp->Nacionalidad }}">

                        <span id="errornacionalidad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validonacionalidad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                      {{--FORMULARIO DE GENERO--}}
                      <div class="form-group col-md-4">
                          <label>Género</label>
                          <select class="form-control" name="genero" id="genero">
                              <option>{{$emp->genero}}</option>
                            @if ($emp->nombres == 'HOMBRE' )
                            <option>MUJER</option>                                
                            @else
                            <option>HOMBRE</option> 
                            @endif
                            
                          </select>

                          <span id="errorgenero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validogenero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>      {{--DATO DE DIRECCION--}}
                      <div class="row">
                       <div class="col-md-12">
                         <div class="col-md-2 col-md-offset-5">
                           <label>-- Dirección -- </label>
                         </div>
                       </div>  
                     </div>
     
                     {{--CODIGO POSTAL--}}
                     <div class="form-group col-md-4">
                         <label>Código Postal</label>
                         <input type="text" class="form-control" placeholder="Codigo postal" name="codigopostal"  data-inputmask='"mask": "99999"' data-mask  id="codigo_postal" value="{{ $emp->codigopostal }}">
     
                           <span id="errorcodigopostal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                           <span id="validocodigopostal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                         
                     </div>
                             {{--DATOS PARA EL ESTADO--}}
                         <div class="form-group col-md-4">
                             <label>Estado</label>
                             <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" id="estado" value="{{ $emp->estado }}">
                                 <span id="errorestado" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                 <span id="validoestado" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                         </div>
                            
                           {{--DATOS PARA EL MUNICIPIO--}}
                           <div class="form-group col-md-4">
                               <label>Municipio</label>
                               <input type="text" class="form-control" placeholder="Municipio" name="municipio" onkeyup="javascript:this.value=this.value.toUpperCase();" id="municipio" value="{{ $emp->municipio}}" >
     
                                 <span id="errormunicipio" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                 <span id="validomunicipio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                           </div>
     
                           {{--DATOS DE LA COLONIA--}}
                     <div class="form-group col-md-4">
                         <label>Colonia</label>
                         <select class="form-control" id="colonia" name="colonia" id="colonia">
                            <option value="{{$emp->colonia}}">{{$emp->colonia}}</option>
                         </select>
     
                         <span id="errorcolonia" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                         <span id="validocolonia" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                     </div>   
     
                       {{--DATOS PARA EL DOMICILIO--}}
                     <div class="form-group col-md-4">
                         <label>Calle</label>
                         <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" id="calle" value="{{ $emp->calle}}">
     
                         <span id="errorcalle" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                         <span id="validocalle" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                     </div>
     
                     {{-- DATOS DE NUMERO DE CALLE --}}
                     
                     <div class="form-group col-md-4">
                         <label>Número</label>
                         <input type="text" class="form-control" placeholder="Número de casa" name="numero"  maxlength="5" id="numero" value="{{ $emp->numero}}"> 
     
                         <span id="errornumero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                         <span id="validonumero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                     </div>

                       {{--DATOS PARA EL TELEFONO--}}
                <div class="form-group col-md-4">
                  <label>Teléfono</label>
                  <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                  data-inputmask='"mask": "9999999999"' data-mask id="telefono" value="{{$emp->telefono}}">

                  <span id="errortelefono" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                  <span id="validotelefono" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
              </div>  
              
              
                    {{--FORMULARIO DE CORREO EMAIL--}}
                    <div class="form-group col-md-4">
                        <label>Correo</label>
                        <input type="email" class="form-control" onkeyup="javascript:this.value=this.value.toLowerCase();" placeholder="Correo Eléctronico" name="correo" id="correo" value="{{ $emp->correo}}" >

                        <span id="errorcorreo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validocorreo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                    {{--FORMULARIO TIPO DE EMPLEADO---}}
                    <div class="form-group col-md-4">
                        <label>Tipo de empleado</label>
                        <select class="form-control" id="tipo" name="tipo" onchange="Tipo()">
                          <option>{{$emp->tipo}}</option>
                          @if ($emp->tipo=='CHOFER')
                          <option>ADMINISTRADOR</option>
                          <option>EMPLEADO</option>
                          @endif
                          @if ($emp->tipo=='ADMINISTRADOR')
                          <option>CHOFER</option>
                          <option>EMPLEADO</option>
                          @endif
                          @if ($emp->tipo=='EMPLEADO')
                          <option>ADMINISTRADOR</option>
                          <option>CHOFER</option>
                          @endif
                        </select>

                        <span id="errortipo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validotipo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                  {{-- FORMULARIO SUCURSAL --}}

                  
                  <div class="form-group col-md-4">
                      <label>Sucursal</label>
                      <select class="form-control" id="sucursal" name="sucursal">
                        <option>{{$foranea->nombre}}</option>
                        @foreach ($sucursal as $sucursal)
                        @if ($sucursal->nombre!=$foranea->nombre)
                        <option>{{$sucursal->nombre}}</option>                                  
                        @endif                              
                        @endforeach                             
                      </select>

                      <span id="errorsucursal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                      <span id="validosucursal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                  </div>    
                  
                  {{-- FORMULARIO STATUS EMPLEADO --}}

                  <div class="form-group col-md-4">
                      <label>Status  </label>
                      <select class="form-control" id="tipo" name="status">
                        <option>{{$empleadosucursal->status}}</option>
                        @if ($empleadosucursal->status=='ACTIVO')
                        <option>INACTIVO</option>                      
                        @else
                        <option>ACTIVO</option>
                      @endif                    
                      </select>

                      <span id="errorstatus" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                      <span id="validostatus" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                  </div>     
                  
                  {{-- DATOS DE LA LICENCIA --}}

                  <div class="row" id="uno" style="display: none;">
                    <div class="col-md-12">
                      <div class="col-md-4 col-md-offset-5">
                        <label>-- Datos de licencia -- </label>
                      </div>
                    </div>  
                  </div>
                
                  {{-- NUMERO DE LICENCIA --}}
                  
                <div class="form-group col-md-4" style="display: none;" id="licencia">
                    <label>Número de licencia</label>
                <input type="text" class="form-control" name="numLicencia" placeholder="Número de licencia" id="numLicencia" value="{{ $emp->numLicencia}}"  data-inputmask='"mask": "9999999999999"' data-mask>

                    <span id="errornumlicencia" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validonumlicencia" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div>
                
                {{-- FORMULARIO DE FECHA DE EXPEDICION --}}
                
                <div class="form-group col-md-4" style="display: none;" id="expedicion">
                  <label>Fecha de expedición </label>
                  <input type="date" class="form-control" name="licenciaFechaExpedicion"  placeholder="Fecha de expedición de licencia" id="licenciaFechaExpedicion" value="{{ $emp->licenciaFechaExpedicion}}">

                  <span id="errorlicenciaFechaExpedicion" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                  <span id="validolicenciaFechaExpedicion" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
              </div>

              {{-- FORMULARIO DE LA FECHA DE VENCIMIENTO --}}
              
              <div class="form-group col-md-4" style="display: none;" id="vencimiento">
                <label>Fecha de vencimiento</label>
                <input type="date" class="form-control" name="licenciaFechaExpiracion" id="licenciaFechaExpiracion"  placeholder="Fecha de expiración de licencia" value="{{ $emp->licenciaFechaExpiracion}}">

                <span id="errorlicenciaFechaExpiracion" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                <span id="validolicenciaFechaExpiracion" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
            </div>
                          
            <div class="form-group col-md-4" style="display: none;" id="contrasenia">
              <label>Contraseña</label>
            <input type="password" class="form-control" name="contra" id="contra"  placeholder="Introduzca su contraseña"<?php if($emp->tipo== 'ADMINISTRADOR'){ ?> value="{{$usuario->password}}" <?php } ?>>

              <span id="errorcontra" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
              <span id="validocontra" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
          </div>

          <div class="form-group col-md-4" style="display: none;" id="confcontrasenia">
            <label>Confirmar Contraseña</label>
            <input type="password" class="form-control" name="confcontra" id="confcontra"  placeholder="Introduzca su contraseña"<?php if($emp->tipo== 'ADMINISTRADOR'){ ?> value="{{$usuario->password}}" <?php } ?>>

            <span id="errorconfcontra" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
            <span id="validoconfcontra" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
        </div>
        <div class="form-group col-md-4">
          
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#picture" id="botonpicture">Subir foto</button>
        </div>
          
  
  <div class="modal modal-dialog-centered fade" id="picture">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <div class="col-md-offset-4  file-loading">
                  <div class="alert col-md-10" id="message" style="display: none"></div> 
                <div id="preview" >
                  @if ($emp->foto == null)
                  <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 200px;height:200px;">
                  @else
                  <img src="{{'/images/'.$emp->foto}}" style="width: 200px;height:200px;">
                  @endif
              
                </div>
                <div class="col-md-1 col-md-offset-2  file-loading">
                <span class="btn btn-primary btn-file"> Subir Foto
                <input id="foto" type="file" name="foto" value="{{$emp->foto}}"></span>  
                </div> 
            </div> 
               
          
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

              <div class="row">
                <div class="col-md-12">
                    <div class="box-footer" style="float: right">
                      <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Agregar">
                      </div>
                    <div class="box-footer" style="float: right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">Cancelar</button>
                      </div>                       
                  </div>                    
              </div>
              
             

              
             
              
              </form>
             
        </div>
     
     
</section> 


<div class="modal modal-danger fade" id="modal-warning">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Está seguro de cancelar? </b> </h4>
      </div>
      <div class="modal-body">
        <p>Si cancela la operación sus datos no serán registrados&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cerrar</button>
      <a href="{{route('sucursal.create')}}" class="btn btn-warning">Aceptar</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rango" style="display: none" id="rango1">Cancelar</button>
  <div class="modal modal-danger fade" id="rango">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Mensaje </b> </h4>
          </div>
          <div class="modal-body">
            <p>No puede agregar un empleado menor de 18 años o mayor a 60 años&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Aceptar</button>
          
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modificar Empleado</h4>
      </div>
      <div class="modal-body">
        <p>LOS DATOS FUERON AGREGADOS CORRECTAMENTE&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal" onclick="recargar()">Continuar</button>
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal ---->



<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#error" style="display: none" id="error1">Cancelar</button>
<div class="modal modal-warning fade" id="error">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">No se pudo modificar </b> </h4>
        </div>
        <div class="modal-body">
          <p>Verifique los campos necesarios&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#errorepite" style="display: none" id="repite">Cancelar</button>
<div class="modal modal-warning fade" id="errorepite">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">No se pudo modificar </b> </h4>
        </div>
        <div class="modal-body">
          <p>UN EMPLEADO YA SE ENCUENTRA REGISTRADO CON EL MISMO INE&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection   



  
</body>
</html>

@section('scripts')
<!-- InputMask -->
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
<script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>

 <!-- Select2 -->
 <script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>

{{--script para municpios--}}
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
     image.style.width="200px";
     image.style.height="200px";
     preview.innerHTML = '';
     preview.append(image);
   };
 }
  </script>

{{--script para municpios--}}
<script >
   $(document).ready(function () {
    var value = $("#codigo_postal").val();
            obtenerDatos(value);
  $("#codigo_postal").keyup(function () {
       var value = $(this).val();
      obtenerDatos(value);
      
    });
    
  function obtenerDatos(datos){
    var cadena = datos;

    var url= 'https://api-codigos-postales.herokuapp.com/v2/codigo_postal/' + cadena;
    var api = new XMLHttpRequest();
    api.open('GET',url,true);
    api.send();

    api.onreadystatechange= function(){

      if(this.status == 200 && this.readyState==4){
        var arreglo=JSON.parse(this.responseText);
       
       aux=0;
        for(var i=0;i<5;i++){
          aux=0;
          if(cadena[i]==0)aux=1;
          if(cadena[i]==1)aux=1;
          if(cadena[i]==2)aux=1;
          if(cadena[i]==3)aux=1;
          if(cadena[i]==4)aux=1;
          if(cadena[i]==5)aux=1;
          if(cadena[i]==6)aux=1;
          if(cadena[i]==7)aux=1;
          if(cadena[i]==8)aux=1;
          if(cadena[i]==9)aux=1;
          if(aux == 0){
            break;
          }
          
        }

       var municipio = arreglo.municipio;
        municipio= municipio.toUpperCase();
        $("#municipio").val(municipio);

        var estado = arreglo.estado;
        estado = estado.toUpperCase();
        $("#estado").val(estado);

        var select = document.getElementById("colonia");
        var colonia = arreglo.colonias;
        var opcion = $("#colonia").val();
        if(aux==0){
        var selected = select.options[select.selectedIndex].text;
        
        select.options.length = 0;     
          var select = document.getElementById("colonia");            
          select.options[select.options.length] = new Option(selected, selected);
        }
              if(aux == 0){         
              select.options.length = 0; 
              }
        for(var item of colonia){
          item = item.toUpperCase();
          if(item != opcion){
            var select = document.getElementById("colonia");            
              select.options[select.options.length] = new Option(item, item);
          }
        }
      }
    }
  }  
    
});
</script>

<script>
  $(document).ready(function(){
    Tipo();
  });
  </script>

<script >
function Tipo(){
    var opcion= document.getElementById("tipo");
    var texto = opcion.options[opcion.selectedIndex].text;
    document.getElementById("tipo").value=texto;
    
    var row = document.getElementById("uno");
    var lice = document.getElementById("licencia");
    var expe = document.getElementById("expedicion");
    var venc = document.getElementById("vencimiento");
    var contra = document.getElementById("contrasenia");
    var confcontra = document.getElementById("confcontrasenia");
    
    if (texto=='CHOFER') {
      row.style.display='block';
      lice.style.display='block';      
      expe.style.display='block';
      venc.style.display='block';
      contra.style.display='none';
        confcontra.style.display='none';
    }else{
      row.style.display='none';
      lice.style.display='none';     
      expe.style.display='none';
      venc.style.display='none';
      if(texto=='ADMINISTRADOR'){
        contra.style.display='block';
        confcontra.style.display='block';
      }else{
        contra.style.display='none';
        confcontra.style.display='none';
      }
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
    $.ajax({
     url:"{{ route('datosempleado') }}",
     method:"POST",
     data:new FormData(this),
     dataType:'JSON',
     contentType: false,
     cache: false,
     processData: false,
     success:function(data)
     {
      
       var mensaje=data.success;
      console.log(mensaje);
       if(mensaje=='EXITO'){
      $('.btn-info').click();
       }
       
       if(mensaje=='ERROR2'){
      $('#rango1').click();
      jQuery('#validofechaNacimiento').hide(); 
               jQuery('#errorfechaNacimiento').show();          
              $( '#fechaNacimiento' ).css('borderColor', 'red');
       }

       if(mensaje=='ERRORCONTRA'){     
              jQuery('#validocontra').hide(); 
            jQuery('#errorcontra').show();          
           $( '#contra' ).css('borderColor', 'red');               
      
              jQuery('#validoconfcontra').hide(); 
            jQuery('#errorconfcontra').show();          
           $( '#confcontra' ).css('borderColor', 'red');
            //console.log(nombre);
         
       }

       if(mensaje=='ERROR'){     
        jQuery('#validolicenciaFechaExpedicion').hide(); 
               jQuery('#errorlicenciaFechaExpedicion').show();          
              $( '#licenciaFechaExpedicion' ).css('borderColor', 'red');              
      
              jQuery('#validolicenciaFechaExpiracion').hide(); 
               jQuery('#errorlicenciaFechaExpiracion').show();          
              $( '#licenciaFechaExpiracion' ).css('borderColor', 'red');
         
       }

       if(mensaje=='REPITE'){   
        $('#repite').click();  
        jQuery('#validoine').hide(); 
               jQuery('#errorine').show();          
              $( '#ine' ).css('borderColor', 'red');
       }
     },
     error: function (data) {
         var err = JSON.parse(data.responseText);
         var arreglo = err.errors;
         /*jQuery.each(arreglo, function(key, value){
            console.log(arreglo);
                      });*/
                    
          var ine = arreglo.ine;
          var rfc = arreglo.rfc;
          var codigo = arreglo.codigopostal;
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
               jQuery('#errornumlicencia').show();          
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

             if (rfc == undefined){  
               $( '#rfc' ).css('borderColor', 'green');         
               jQuery('#validorfc').show(); 
               jQuery('#errorfc').hide(); 
               }else{
                 jQuery('#validorfc').hide(); 
               jQuery('#errorfc').show();          
              $( '#rfc' ).css('borderColor', 'red');
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

          // $('#existe1').click();
          $('#error1').click();
     }
    })
   });
  
  });
  </script>
@endsection  