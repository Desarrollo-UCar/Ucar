@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Servicio</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
 
</head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Servicios</small>
        </h1>        
    </section>
   
    <section class="content">
      
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Servicio Extra</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
                <form method="post" id="upload_form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">           
                                   
                    <div class="col-md-6">
                     
                        <div class="col-md-6 form-group">
                            <label>Nombre</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" >

                          <span id="errornombre" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validonombre" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>
                        
                        <div class="form-group col-md-6">
                          <label>Estatus</label>
                          <select class="form-control"  name="disponibilidad" id="disponibilidad">
                         
                            <option>DISPONIBLE</option>
                            <option>NO DISPONIBLE</option>                           
                                                       
                          </select>

                          <span id="errordisponibilidad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validodisponibilidad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div> 

                        <div class="col-md-6 form-group">
                          <label>Precio</label>
                          <input type="number" step="0.01" name="precio" class="form-control" min="0.00" placeholder="0.00" id="precio">

                          <span id="errorprecio" class="glyphicon glyphicon-remove form-control-feedback" id="precio" style="color:red;display: none;"></span>
                          <span id="validoprecio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>

                          <div class="form-group col-md-6">
                            <label>Sucursal</label>
                            <select class="form-control" id="sucursal" name="sucursal">
                              @foreach ($sucursal as $sucursal)
                              <option>{{$sucursal->nombre}}</option>
                              @endforeach                             
                            </select>

                            <span id="errorsucursal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validosucursal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div> 
                        
                        <div class="col-md-6 form-group">
                          <label>Cantidad</label>
                          <input type="number"  name="cantidad" class="form-control" min="0" id="cantidad">

                          <span id="errorcantidad" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validocantidad" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>

                    <div class="col-md-6 form-group">
                        <label>Descripción</label>
                      <textarea name="descripcion" id="descripcion" cols="30" rows="1" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"  ></textarea>
                    </div>
                    </div>

                   
                  <div class="col-md-6">
                    <div id="preview" style="margin-top: 5%;">
                      <div class="alert" id="message" style="display: none"></div>
                      <img src="https://www.superimanes.com/c/48-category_default/servicios-extras.jpg" style="width: 100%; height: 100%;" >
                    </div>
                    <hr>
                    <div class="col-md-1 col-md-offset-5  file-loading">
                    <span class="btn btn-primary btn-file"> Subir Foto
                    <input id="foto" type="file" name="foto"/>    </span>  
                    </div> 
              </div> 
              
                  <!-- /.box-body -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                          </div>                       
                      </div>                    
                  </div>
                </form>
              </div>
    </section>
    
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none">
    </button>
    <div class="modal modal-info fade" id="modal-info">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Alta servicios extras</h4>
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
          <p>El Articulo que desea agregar ya se encuetra registrado&hellip;</p>
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
    image.style.width="100%";
    image.style.height="100%";
    preview.innerHTML = '';
    preview.append(image);
  };
}
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
     url:"{{ route('servicioe.store') }}",
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
      if(mensaje=='ERROR1'){
      $('#existe1').click();
       }
       if(mensaje=='EXITO'){
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
          var descripcion = arreglo.descripcion;
          var disponibilidad = arreglo.disponibilidad;
          var precio = arreglo.precio;
          var foto = arreglo.foto;
          var sucursal = arreglo.sucursal;
          var cantidad = arreglo.caantidad;
          
             
             if (foto == undefined){  
              
               }else{
              $('#message').css('display', 'block');
              $('#message').html('AGREGA UNA FOTO DEl SERVICIO EXTRA');
              $('#message').addClass("alert alert-danger");
               //console.log(nombre);
             }
           
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

             if (descripcion == undefined){  
               $( '#descripcion' ).css('borderColor', 'green');         
               jQuery('#validodescripcion').show(); 
               jQuery('#errordescripcion').hide(); 
               }else{
                 jQuery('#validodescripcion').hide(); 
               jQuery('#errordescripcion').show();          
              $( '#descripcion' ).css('borderColor', 'red');
               //console.log(nombre);
             }

            if (disponibilidad == undefined){  
               $( '#disponibilidad' ).css('borderColor', 'green');         
               jQuery('#validodisponibilidad').show(); 
               jQuery('#errordisponibilidad').hide(); 
               }else{
                 jQuery('#validodisponibilidad').hide(); 
               jQuery('#errordisponibilidad').show();          
              $( '#disponibilidad' ).css('borderColor', 'red');
               //console.log(nombre);
             }
   
             if (precio == undefined){  
               $( '#precio' ).css('borderColor', 'green');         
               jQuery('#validoprecio').show(); 
               jQuery('#errorprecio').hide(); 
               }else{
                 jQuery('#validoprecio').hide(); 
               jQuery('#errorprecio').show();          
              $( '#precio' ).css('borderColor', 'red');
               //console.log(nombre);
             }

             if (cantidad == undefined){  
               $( '#cantidad' ).css('borderColor', 'green');         
               jQuery('#validocantidad').show(); 
               jQuery('#errorcantidad').hide(); 
               }else{
                 jQuery('#validocantidad').hide(); 
               jQuery('#errorcantidad').show();          
              $( '#cantidad' ).css('borderColor', 'red');
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
     }
    })
   });
  
  });
  </script>

@endsection

                  

</body>
</html>