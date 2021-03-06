@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Editar Sucursal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Modificar Sucursal</small>
        </h1>
        
    </section>


    <section class="content">
 
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Modificar Sucursal</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                  <form method="POST" id="datos" enctype="multipart/form-data">            
                       {{csrf_field()}}          
                     {{-- FORMULARIO DIRECCION--}}
                     <div class="col-md-4 form-group" style="display: none">
                     
                   <input type="text" name="idsucursal"class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$sucursal->idsucursal}}" id="idsucursal" >
                     </div>
                      
           {{--NOMBRE DE LA SUCURSAL--}}  
           <div class="form-group col-md-4">
                                       
            <label>Nombre de la sucursal
                </label>                      
                <input type="text" class="form-control"  placeholder="Nombre de la sucursal"
              name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nombre" value="{{$sucursal->nombre}}" autofocus >
           <span id="errornombre" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
           <span id="validonombre" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>

        </div>

                     {{--DATO DE DIRECCION--}}
                     <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-2 col-md-offset-5">
                          <label>-- Dirección -- 
                        </div>
                      </div>  
                    </div>
                    
                {{--CODIGO POSTAL--}}
                  <div class="form-group col-md-4">
                      <label>Código Postal</label>
                    <input type="text" class="form-control" placeholder="Codigo Postal" name="codigopostal" value="{{$sucursal->codigopostal}}"  data-inputmask='"mask": "99999"' data-mask id="codigo_postal">
                    
                    <span id="errorcodigopostal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validocodigopostal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                  </div>
                  
                      {{--DATOS PARA EL ESTADO--}}
                    <div class="form-group col-md-4">
                        <label>Estado</label>
                        <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$sucursal->estado}}" id="estado" readonly>

                        <span id="errorestado" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validoestado" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                    {{--DATOS PARA EL MUNICIPIO--}}
                    <div class="form-group col-md-4">
                      <label>Municipio</label>
                      <input type="text" id="municipio" class="form-control" placeholder="Municipio" name="municipio"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$sucursal->municipio}}" readonly>

                      <span id="errormunicipio" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomunicipio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                  </div>

                  {{--DATOS DE LA COLONIA--}}
                    <div class="form-group col-md-4">
                        <label>Colonia</label>
                        <select class="form-control" id="colonia" name="colonia" id="colonia">
                            <option value="{{$sucursal->colonia}}">{{$sucursal->colonia}}</option>
                          </select>

                          <span id="errorcolonia" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validocolonia" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                    {{--DATOS PARA EL DOMICILIO--}}
                    <div class="form-group col-md-4">
                        <label>Calle</label>
                        <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$sucursal->calle}}" id="calle" >

                        <span id="errorcalle" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validocalle" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>

                    {{-- DATOS DE NUMERO DE CALLE --}}
                    <div class="form-group col-md-4">
                        <label>Número </label>
                        <input type="text" class="form-control" placeholder="Número de casa" name="numero" value="{{$sucursal->numero}}" maxlength="5" id="numero">
                        
                    <span id="errornumero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validonumero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>


                    {{--DATOS PARA EL TELEFONO--}}
                    <div class="form-group col-md-4">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" placeholder="Teléfono" name="telefono" data-inputmask='"mask": "9999999999"' data-mask value="{{$sucursal->telefono}}" id="telefono" >

                        <span id="errortelefono" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validotelefono" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>                      
                    </div>     
                    
                    
                    <div class="col-md-8">
                      <label>link del mapa</label>
                      <input type="text" class="form-control" placeholder="link del mapa" name="link"   id="link" value="{{$sucursal->link}}">
  
                      <span id="errorlink" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                        <span id="validolink" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-4">
                          <div id="preview" style="margin-top: 5%;">
                            <div class="alert col-md-7 col-md-offset-1" id="message" style="display: none"></div>
                            @if ($sucursal->foto == null)
                            <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 200px; height: 100px;">
                            @else
                            <img src="{{'/images/'.$sucursal->foto}}" style="width: 200px;height:100px;">
                            @endif
                          </div>
                          <hr>
                          <div class="col-md-1 col-md-offset-2  file-loading">
                          <span class="btn btn-warning btn-file">Subir Foto
                          <input id="foto" type="file" name="foto"  value="{{$sucursal->foto}}"/>    </span>  
                          </div>                       
                    </div>   
                    <div class="col-md-4">
                      <div id="preview1" style="margin-top: 5%;">
                        <div class="alert col-md-7 col-md-offset-1" id="message1" style="display: none"></div>
                        @if ($sucursal->foto1 == null)
                        <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 200px; height: 100px;">
                        @else
                        <img src="{{'/images/'.$sucursal->foto1}}" style="width: 200px;height:100px;">
                        @endif
                      </div>
                      <hr>
                      <div class="col-md-1 col-md-offset-2  file-loading">
                      <span class="btn btn-warning btn-file">Subir Foto
                      <input id="foto1" type="file" name="foto1" value="{{$sucursal->foto1}}"/>    </span>  
                      </div>            
                </div>  
                <div class="col-md-4">
                  <div id="preview2" style="margin-top: 5%;">
                    <div class="alert col-md-7 col-md-offset-1" id="message2" style="display: none"></div>
                    @if ($sucursal->foto2 == null)
                    <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 200px; height: 100px;">
                    @else
                    <img src="{{'/images/'.$sucursal->foto2}}" style="width: 200px;height:100px;">
                    @endif
                  </div>
                  <hr>
                  <div class="col-md-1 col-md-offset-2  file-loading">
                  <span class="btn btn-warning btn-file">Subir Foto
                  <input id="foto2" type="file" name="foto2" value="{{$sucursal->foto2}}"/></span>  
                  </div>                       
            </div>                                   
                      </div>                    
                    </div>


                  <!-- /.box-body -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer" style="float: right">
                          <button type="submit" class="btn btn-primary">Modificar</button>
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
                <span style="color:red;" aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Está seguro de cancelar? </b> </h4>
            </div>
            <div class="modal-body">
              <p>Si cancela la operación sus datos no serán registrados&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cerrar</button>
            <a href="{{route('sucursal.index')}}" class="btn btn-warning">Aceptar</a>
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
              <h4 class="modal-title">Editar sucursal</h4>
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
          <h4 class="modal-title">Error </b> </h4>
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

@endsection    
       @section('scripts')
       <!-- InputMask -->
       <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
       <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
       <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
   
        <!-- Select2 -->
        <script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>

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
             image.style.height="100px";
             preview.innerHTML = '';
             preview.append(image);
           };
         }
          </script>
        <script>
          document.getElementById("foto1").onchange = function(e) {
           // Creamos el objeto de la clase FileReader
           let reader = new FileReader();
         
           // Leemos el archivo subido y se lo pasamos a nuestro fileReader
           reader.readAsDataURL(e.target.files[0]);
         
           // Le decimos que cuando este listo ejecute el código interno
           reader.onload = function(){
             let preview = document.getElementById('preview1'),
                     image = document.createElement('img');
         
             image.src = reader.result;
             image.getElementsByClassName('rounded-circle');
             image.style.width="200px";
             image.style.height="100px";
             preview.innerHTML = '';
             preview.append(image);
           };
         }
          </script>
          <script>
            document.getElementById("foto2").onchange = function(e) {
             // Creamos el objeto de la clase FileReader
             let reader = new FileReader();
           
             // Leemos el archivo subido y se lo pasamos a nuestro fileReader
             reader.readAsDataURL(e.target.files[0]);
           
             // Le decimos que cuando este listo ejecute el código interno
             reader.onload = function(){
               let preview = document.getElementById('preview2'),
                       image = document.createElement('img');
           
               image.src = reader.result;
               image.getElementsByClassName('rounded-circle');
               image.style.width="200px";
               image.style.height="100px";
               preview.innerHTML = '';
               preview.append(image);
             };
           }
            </script>


        <script>
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
         $(function () {           
           $('.select2').select2()
           $('[data-mask]').inputmask()
         })
       </script>

<script>
  function recargar(){
    location.reload(); 
  }
</script>

<script>
  $(document).ready(function(){
   
  $('#datos').on('submit', function(event){
   event.preventDefault();
       $.ajax({      
         url: "{{ route('modificardatos') }}",
         type: "POST",
         data:new FormData(this),
         dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
         success: function (data) {
          var mensaje=data.success;
          console.log(mensaje);
          if(mensaje=='EXISTE'){
      $('#existe1').click();
       }else{
          $('.btn-info').click();
          }
         },
         error: function (data) {
         var err = JSON.parse(data.responseText);
         var arreglo = err.errors;
          var nombre = arreglo.nombre;
          var codigo = arreglo.codigopostal;
          var estado = arreglo.estado;
          var municipio = arreglo.municipio;
          var colonia = arreglo.colonia;
          var calle = arreglo.calle;
          var numero = arreglo.numero;
          var telefono = arreglo.telefono;
          var link = arreglo.link;
          var foto = arreglo.foto;
          var foto1 = arreglo.foto1;
          var foto2 = arreglo.foto2;
  
          if (foto == undefined){  
              
            }else{
             $('#message').css({"display": "block", "color":"red"});
           $('#message').html('AGREGA UNA FOTO');
          }
          if (foto1 == undefined){  
              
            }else{
             $('#message1').css({"display": "block", "color":"red"});
           $('#message1').html('AGREGA UNA FOTO');
          }
          if (foto2 == undefined){  
              
            }else{
             $('#message2').css({"display": "block", "color":"red"});
           $('#message2').html('AGREGA UNA FOTO');
          }
          
          if (nombre == undefined){  
            $( '#nombre' ).css('borderColor', 'green');         
            jQuery('#validonombre').show(); 
            jQuery('#errornombre').hide(); 
            }else{
              jQuery('#validonombre').hide(); 
            jQuery('#errornombre').show();          
           $( '#nombre' ).css('borderColor', 'red');
          }

          if (link == undefined){  
            $( '#link' ).css('borderColor', 'green');         
            jQuery('#validolink').show(); 
            jQuery('#errorlink').hide(); 
            }else{
              jQuery('#validolink').hide(); 
            jQuery('#errorlink').show();          
           $( '#link' ).css('borderColor', 'red');
          }

          if (codigo == undefined){  
            $( '#codigo_postal' ).css('borderColor', 'green');         
            jQuery('#validocodigopostal').show(); 
            jQuery('#errorcodigopostal').hide(); 
            }else{
              jQuery('#validocodigopostal').hide(); 
            jQuery('#errorcodigopostal').show();          
           $( '#codigo_postal' ).css('borderColor', 'red');
          }
          if (estado == undefined){  
            $( '#estado' ).css('borderColor', 'green');         
            jQuery('#validoestado').show(); 
            jQuery('#errorestado').hide(); 
            }else{
              jQuery('#validoestado').hide(); 
            jQuery('#errorestado').show();          
           $( '#estado' ).css('borderColor', 'red');
          }
          if (municipio == undefined){  
            $( '#municipio' ).css('borderColor', 'green');         
            jQuery('#validomunicipio').show(); 
            jQuery('#errormunicipio').hide(); 
            }else{
              jQuery('#validomunicipio').hide(); 
            jQuery('#errormunicipio').show();          
           $( '#municipio' ).css('borderColor', 'red');
          }

          if (calle == undefined){  
            $( '#calle' ).css('borderColor', 'green');         
            jQuery('#validocalle').show(); 
            jQuery('#errorcalle').hide(); 
            }else{
              jQuery('#validocalle').hide(); 
            jQuery('#errorcalle').show();          
           $( '#calle' ).css('borderColor', 'red');
          }
          if (numero == undefined){  
            $( '#numero' ).css('borderColor', 'green');         
            jQuery('#validonumero').show(); 
            jQuery('#errornumero').hide(); 
            }else{
              jQuery('#validonumero').hide(); 
            jQuery('#errornumero').show();          
           $( '#numero' ).css('borderColor', 'red');
          }
          if (telefono == undefined){  
            $( '#telefono' ).css('borderColor', 'green');         
            jQuery('#validotelefono').show(); 
            jQuery('#errortelefono').hide(); 
            }else{
              jQuery('#validotelefono').hide(); 
            jQuery('#errortelefono').show();          
           $( '#telefono' ).css('borderColor', 'red');
          }

          if (colonia == undefined){  
            $( '#colonia' ).css('borderColor', 'green');         
            jQuery('#validocolonia').show(); 
            jQuery('#errorcolonia').hide(); 
            }else{
              jQuery('#validocolonia').hide(); 
            jQuery('#errorcolonia').show();          
           $( '#colonia' ).css('borderColor', 'red');
          }
             $('#enviar').html('guardar cambios');
             $('#error1').click();
         }
     });
   });   
 });
 </script>
       @endsection   
</body>
</html>
  
  
