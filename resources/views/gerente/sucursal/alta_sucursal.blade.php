@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Sucursal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
  
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Alta sucursal</small>
        </h1>
        
    </section>

    <section class="content"> 
    <div class="col-md-12" style="margin-top: 2%;">
        <div class="box box-primary">             
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Sucursal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->


                   
            <form {{-- action="{{ route('sucursal.store') }}" --}}
            id="datos">
            
              
               @csrf
                

                 {{--NOMBRE DE LA SUCURSAL--}}  
                 <div class="form-group col-md-4">
                                       
                  <label>Nombre de la sucursal
                      </label>                      
                      <input type="text" class="form-control"  placeholder="Nombre de la sucursal"
                 name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nombre" autofocus >
                 <span id="errornombre" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                 <span id="validonombre" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>

              </div>
                    {{--DATO DE DIRECCION--}}
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
                    <input type="text" class="form-control" placeholder="Codigo postal" name="codigopostal"  data-inputmask='"mask": "99999"' data-mask  id="codigo_postal">

                      <span id="errorcodigopostal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                      <span id="validocodigopostal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    
                </div>
                        {{--DATOS PARA EL ESTADO--}}
                    <div class="form-group col-md-4">
                        <label>Estado</label>
                        <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" id="estado">
                            <span id="errorestado" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validoestado" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                    </div>
                       
                      {{--DATOS PARA EL MUNICIPIO--}}
                      <div class="form-group col-md-4">
                          <label>Municipio</label>
                          <input type="text" class="form-control" placeholder="Municipio" name="municipio" onkeyup="javascript:this.value=this.value.toUpperCase();" id="municipio" >

                            <span id="errormunicipio" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomunicipio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>

                      {{--DATOS DE LA COLONIA--}}
                <div class="form-group col-md-4">
                    <label>Colonia</label>
                    <select class="form-control" id="colonia" name="colonia" id="colonia">
                      <option value="">Ninguno</option>
                    </select>

                    <span id="errorcolonia" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validocolonia" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div>   

                  {{--DATOS PARA EL DOMICILIO--}}
                <div class="form-group col-md-4">
                    <label>Calle</label>
                    <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" id="calle">

                    <span id="errorcalle" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validocalle" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div>

                {{-- DATOS DE NUMERO DE CALLE --}}
                
                <div class="form-group col-md-4">
                    <label>Número</label>
                    <input type="text" class="form-control" placeholder="Número de casa" name="numero"  maxlength="5" id="numero"> 

                    <span id="errornumero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validonumero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div>
                
                {{--DATOS PARA EL TELEFONO--}}
                <div class="form-group col-md-4">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                    data-inputmask='"mask": "9999999999"' data-mask id="telefono">

                    <span id="errortelefono" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                    <span id="validotelefono" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                </div>                             
                              

              <!-- /.box-body -->
              <div class="row">
                <div class="col-md-12">
                    <div class="box-footer" style="float: right">
                        <button type="submit" id="enviar" class="btn btn-primary">Agregar</button>
                      </div>
                    <div class="box-footer" style="float: right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">Cancelar</button>
                      </div>                       
                  </div>                    
              </div>
              

            </form>
          </div>
     
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

@endsection   

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none" >

</button>
<div class="modal modal-info fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alta sucursal</h4>
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


<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#existe" style="display: none" id="existe1">Cancelar</button>
<div class="modal modal-danger fade" id="existe">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Error </b> </h4>
        </div>
        <div class="modal-body">
          <p>La sucursal que intenta agregar ya se encuentra en el sistema&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

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
<script src="{{URL::asset('/js/heroku.js')}}"></script>
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
 $(function () {
     
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
   });
     
   $('#enviar').click(function (e) {
       e.preventDefault();
   
       $.ajax({
         data: $('#datos').serialize(),
         url: "{{ route('sucursal.store') }}",
         type: "POST",
         dataType: 'json',
         success: function (data) {
          var mensaje=data.success;
           console.log(data);
          if(mensaje=='EXISTE'){
      $('#existe1').click();
       }else{
          $('.btn-info').click();
          }
         },
         error: function (data) {
         var err = JSON.parse(data.responseText);
         var arreglo = err.errors;
         /*jQuery.each(arreglo, function(key, value){
            console.log(arreglo);
                      });*/
                      console.log(arreglo);
          var nombre = arreglo.nombre;
          var codigo = arreglo.codigopostal;
          var estado = arreglo.estado;
          var municipio = arreglo.municipio;
          var colonia = arreglo.colonia;
          var calle = arreglo.calle;
          var numero = arreglo.numero;
          var telefonono = arreglo.telefono;

          
          if (nombre == undefined){  
            $( '#nombre' ).css('borderColor', 'green');         
            jQuery('#validonombre').show(); 
            jQuery('#errornombre').hide(); 
            }else{
              jQuery('#validonombre').hide(); 
            jQuery('#errornombre').show();          
           $( '#nombre' ).css('borderColor', 'red');
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
             $('#enviar').html('guardar cambios');
             $('#error1').click();
         }
     });
   });
   
  
    
 });
 </script>
@endsection  