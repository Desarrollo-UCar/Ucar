@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta vehiculo</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
 
</head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Alta vehículo</small>
        </h1>
        
    </section>


    <section class="content">
       
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Vehículo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
                <form method="post" id="upload_form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">           
                                                        
                                       
                    <div class="col-md-6">
                     
                      {{-- FORMULARIO DE NUMERO VIN DEL VEHICULO --}}
                      
                        <div class="col-md-6 form-group">
                            <label>Número VIN</label>
                          <input type="text" name="vin" id="vin" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" 
                         pattern="[0-9|A-Z]{17}" maxlength="17">

                         
                          <span id="errorvin" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validovin" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>


                        {{-- FORMULARIO PLACAS DEL VEHICULO --}}
                        
                        <div class="col-md-6 form-group">
                            <label>Placas</label>
                          <input type="text" name="matricula" id="matricula" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" pattern="[A-Z]{3}-[0-9]{2}-[0-9]{2}">
                          
                            <span id="errormatricula" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomatricula" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>

                        {{-- FORMULARIO DE MARCA DEL VEHICULO --}}
                        
                        <div class="col-md-6 form-group">
                          <label>Marca</label>
                          <input type="text" name="marca" id="marca" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">

                          
                            <span id="errormarca" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomarca" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>

                          {{-- FORMULARIO DE MODELO DEL VEHICULO --}}
                          
                        <div class="col-md-6 form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">

                            
                            <span id="errormodelo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomodelo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                          </div>

                          {{-- FROMULARIO AÑO DEL VEHICULO --}}
                          
                          <div class="col-md-6 form-group">
                              <label>Año</label>
                              <?php
                                  $cont = date('Y');
                                  $aux = $cont;
                              ?>
                                  <select id="anio" name="anio" class="form-control">
                                      <?php while ($cont >=($aux-15) ){ ?>
                                        <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                      <?php $cont = ($cont-1); } 
                                      ?>
                                  </select>
                          
                              <span id="erroranio" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                              <span id="validoanio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                            </div>
                            
                            {{-- FROMULARIO TRANSMISION DEL VEHICULO --}}
                            
                            <div class="form-group col-md-6">
                                <label>Transmisión </label>
                                <select class="form-control" id="transmision" name="transmision">            <option>MANUAL</option>
                                  <option>AUTOMÁTICO</option>
                                </select>  
                                  <span id="errortransmision" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validotransmision" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                            </div>

                            {{-- FORMULARIO RENDIMIENTO DEL VEHICULO --}}
                            
                                <div class="col-md-6 form-group">
                                    <label>Rendimiento</label>
                                    <input type="text" name="rendimiento" id="rendimiento" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">

                                    <span id="errorrendimiento" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validorendimiento" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                  </div>
                                        
                              {{-- FORMULARIO COLOR DEL VEHICULO --}}
                                                    
                              <div class="col-md-6 form-group">
                                  <label>Color</label>
                                  <input type="text" name="color" id="color" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">

                                  <span id="errorcolor" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validocolor" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                  
                                </div>
                                
                                {{-- FORMULARIO TIPO DEL VEHICULO --}}
                                
                                <div class="col-md-6 form-group">
                                  <label>Tipo</label>
                                  <input type="text" name="tipo" id="tipo" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">

                                  <span id="errortipo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validotipo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                </div>

                                {{-- FORMULARIO CANTIDAD DE PASAJEROS DEL VEHICULO  --}}
                                
                                <div class="form-group col-md-6">
                                    <label>Pasajeros</label>
                                    <select class="form-control" id="pasajeros" name="pasajeros">            <option>2</option>
                                      <option>4</option>
                                      <option>6</option>
                                      <option>8</option>
                                    </select>
                                    

                                    <span id="errorpasajeros" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validopasajeros" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
            
                                </div>
                                

                                {{-- FORMULARIO MALETERO DEL VEHICULO --}}
                                
                                  <div class="col-md-6 form-group">
                                      <label>Maletero</label>
                                      <input type="text" name="maletero" id="maletero" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">                                      

                                      <span id="errormaletero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                      <span id="validomaletero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                    </div>

                                    {{-- FORMULARIO CILINDROS DEL VEHICULO --}}
                                    
                                    <div class="form-group col-md-6">
                                        <label>Cilindros</label>
                                        <select class="form-control" id="cilindros" name="cilindros"> 
                                          <option>4</option>
                                          <option>6</option>
                                          <option>8</option>
                                        </select>
                
                                        <span id="errorcilindros" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                        <span id="validocilindros" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                    </div>
                                      
                                    {{-- FORMULARIO KILOMETRAJE DEL VEHICULO --}}
                                    
                                      <div class="col-md-6 form-group">
                                          <label>Kilometraje</label>
                                          <input type="number" step="0.00" name="kilometraje" id="kilometraje" min="0.00" class="form-control" >

                                      <span id="errorkilometraje" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                      <span id="validokilometraje" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                        </div>

                                        {{-- FORMULARIO PRECIO COMPRA --}}
                                        
                                            <div class="col-md-6 form-group">
                                              <label>Precio compra</label>
                                              <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00" id="costo">                                 

                                              <span id="errorcosto" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                              <span id="validocosto" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                            </div>


                                            {{-- FORMULARIO PRECIO DE RENTA --}}
                                            
                                            <div class="col-md-6 form-group">
                                                <label>Precio renta</label>
                                                <input type="number" step="0.01" min="0" name="precio" id="precio" placeholder="0.00" min="0.00" class="form-control">

                                                <span id="errorprecio" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validoprecio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>                                                 
                                              </div>

                                              {{-- FORMULARIO DESCRIPCION --}}
                                              
                                              <div class="col-md-6 form-group">
                                                <label>descripción</label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                

                                                <span id="errordescripcion" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validodescripcion" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                              </div>

                                              {{-- FORMULARIO SUCURSAL DEL VEHICULO --}}
                                              
                                             <div class="form-group col-md-6">
                                                <label>Sucursal</label>
                                                <select class="form-control" name="sucursal" id="sucursal">
                                                  @foreach ($sucursal as $sucursal)
                                                  <option>{{$sucursal->nombre}}</option>
                                                  @endforeach                             
                                                </select>
                                                

                                                <span id="errorsucursal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validosucursal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                            </div>  
                                            
                                            {{-- FORMULARIO DE ESTATUS DEL VEHICULO --}}
                                            
                                            <div class="form-group col-md-6">
                                              <label>Estatus</label>
                                              <select class="form-control" name="status" id="status">
                                                <option>ACTIVO</option> 
                                                <option>INACTIVO</option>
                                              </select>                                              

                                                  <span id="errorstatus" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                  <span id="validostatus" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                          </div>  
                    </div>


                    {{-- FORMULARIO PARA SUBIR FOTO DEL VEHICULO --}}
                    
                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                          <div class="alert" id="message" style="display: none"></div>
                         <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 400px; height: 400px;" >
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
      <a href="{{route('vehiculo.create')}}" class="btn btn-warning">Aceptar</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

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
    image.style.width="450px";
    image.style.height="450px";
    preview.innerHTML = '';
    preview.append(image);
  };
}
</script>


<script>
  $(document).ready(function(){
  
   $('#upload_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
     url:"{{ route('vehiculo.store') }}",
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
     },
     error: function (data) {
         var err = JSON.parse(data.responseText);
         var arreglo = err.errors;
         /*jQuery.each(arreglo, function(key, value){
            console.log(arreglo);
                      });*/
                      console.log(arreglo);
          var vin = arreglo.vin;
          var matricula = arreglo.matricula;
          var marca = arreglo.marca;
          var modelo = arreglo.modelo;
          var anio = arreglo.anio;
          var transmision = arreglo.transmision;
          var rendimiento = arreglo.rendimiento;
          var color = arreglo.color;
          var tipo = arreglo.tipo;
             var pasajeros = arreglo.pasajeros;
             var maletero = arreglo.maletero;
             var cilindros = arreglo.cilindros;
             var kilometraje = arreglo.kilometraje;                                       
             var costo = arreglo.costo;           
             var precio = arreglo.precio;
             var status = arreglo.status;
             var sucursal = arreglo.sucursal;
                       
             
             if (foto == undefined){  
              
               }else{
                $('#message').css('display', 'block');
              $('#message').html('AGREGA UNA FOTO DEl VEHICULO');
              $('#message').addClass("alert alert-danger");
               //console.log(nombre);
             }
           
             if (vin == undefined){  
               $( '#vin' ).css('borderColor', 'green');         
               jQuery('#validovin').show(); 
               jQuery('#errorvin').hide(); 
               }else{
                 jQuery('#validovin').hide(); 
               jQuery('#errorvin').show();          
              $( '#vin' ).css('borderColor', 'red');
               //console.log(nombre);
             }

             if (matricula == undefined){  
               $( '#matricula' ).css('borderColor', 'green');         
               jQuery('#validomatricula').show(); 
               jQuery('#errormatricula').hide(); 
               }else{
                 jQuery('#validomatricula').hide(); 
               jQuery('#errormatricula').show();          
              $( '#matricula' ).css('borderColor', 'red');
               //console.log(nombre);
             }

            if (marca == undefined){  
               $( '#marca' ).css('borderColor', 'green');         
               jQuery('#validomarca').show(); 
               jQuery('#errormarca').hide(); 
               }else{
                 jQuery('#validomarca').hide(); 
               jQuery('#errormarca').show();          
              $( '#marca' ).css('borderColor', 'red');
               //console.log(nombre);
             }
   
             if (modelo == undefined){  
               $( '#modelo' ).css('borderColor', 'green');         
               jQuery('#validomodelo').show(); 
               jQuery('#errormodelo').hide(); 
               }else{
                 jQuery('#validomodelo').hide(); 
               jQuery('#errormodelo').show();          
              $( '#modelo' ).css('borderColor', 'red');
               //console.log(nombre);
             }

             if (anio == undefined){  
               $( '#anio' ).css('borderColor', 'green');         
               jQuery('#validoanio').show(); 
               jQuery('#erroranio').hide(); 
               }else{
                 jQuery('#validoanio').hide(); 
               jQuery('#erroranio').show();          
              $( '#anio' ).css('borderColor', 'red');
               //console.log(nombre);
             }

             if (transmision == undefined){  
               $( '#transmision' ).css('borderColor', 'green');         
               jQuery('#validotransmision').show(); 
               jQuery('#errortransmision').hide(); 
               }else{
                 jQuery('#validotransmision').hide(); 
               jQuery('#errortransmision').show();          
              $( '#transmision' ).css('borderColor', 'red');
               //console.log(nombre);
             }

             if (rendimiento == undefined){  
               $( '#rendimiento' ).css('borderColor', 'green');         
               jQuery('#validorendimiento').show(); 
               jQuery('#errorrendimiento').hide(); 
               }else{
                 jQuery('#validorendimiento').hide(); 
               jQuery('#errorrendimiento').show();          
              $( '#rendimiento' ).css('borderColor', 'red');
               //console.log(nombre);
             }

             if (color == undefined){  
               $( '#color' ).css('borderColor', 'green');         
               jQuery('#validocolor').show(); 
               jQuery('#errorcolor').hide(); 
               }else{
                 jQuery('#validocolor').hide(); 
               jQuery('#errorcolor').show();          
              $( '#color' ).css('borderColor', 'red');
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

             if (pasajeros == undefined){  
               $( '#pasajeros' ).css('borderColor', 'green');         
               jQuery('#validopasajeros').show(); 
               jQuery('#errorpasajeros').hide(); 
               }else{
                 jQuery('#validopasajeros').hide(); 
               jQuery('#errorpasajeros').show();          
              $( '#pasajeros' ).css('borderColor', 'red');
               //console.log(nombre);
             }

          if (maletero == undefined){  
               $( '#maletero' ).css('borderColor', 'green');         
               jQuery('#validomaletero').show(); 
               jQuery('#errormaletero').hide(); 
               }else{
                 jQuery('#validomaletero').hide(); 
               jQuery('#errormaletero').show();          
              $( '#maletero' ).css('borderColor', 'red');
               //console.log(nombre);
             }          
          

          if (cilindros == undefined){  
            $( '#cilindros' ).css('borderColor', 'green');         
            jQuery('#validocilindros').show(); 
            jQuery('#errorcilindros').hide(); 
            }else{
              jQuery('#validocilindros').hide(); 
            jQuery('#errorcilindros').show();          
           $( '#cilindros' ).css('borderColor', 'red');
            //console.log(nombre);
          }
          if (kilometraje == undefined){  
            $( '#kilometraje' ).css('borderColor', 'green');         
            jQuery('#validokilometraje').show(); 
            jQuery('#errorkilometraje').hide(); 
            }else{
              jQuery('#validokilometraje').hide(); 
            jQuery('#errorkilometraje').show();          
           $( '#kilometraje' ).css('borderColor', 'red');
            //console.log(nombre);
          }
          if (costo == undefined){  
            $( '#costo' ).css('borderColor', 'green');         
            jQuery('#validocosto').show(); 
            jQuery('#errorcosto').hide(); 
            }else{
              jQuery('#validocosto').hide(); 
            jQuery('#errorcosto').show();          
           $( '#costo' ).css('borderColor', 'red');
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

          
     }
    })
   });
  
  });
  </script>

@endsection

                  

</body>
</html>
  
  
