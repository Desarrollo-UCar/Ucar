@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                                        
                                       
                    <div class="col-md-12">
                     
                      {{-- FORMULARIO DE NUMERO VIN DEL VEHICULO --}}
                      
                        <div class="col-md-4 form-group">
                            <label>Número VIN</label>
                          <input type="text" name="vin" id="vin" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" 
                         maxlength="17">

                         
                            <span id="errorvin" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validovin" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>


                        {{-- FORMULARIO PLACAS DEL VEHICULO --}}
                        
                        <div class="col-md-4 form-group">
                            <label>Placas</label>
                          <input type="text" name="matricula" id="matricula" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                          
                            <span id="errormatricula" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomatricula" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>

                        {{-- FORMULARIO DE MARCA DEL VEHICULO --}}
                        
                     
                           
                          <div class="form-group col-md-4">
                            <label>Marca</label>                            
                            <select class="form-control" name="marca" id="marca" onchange="consulta()">
                              @foreach ($marca as $marca)
                              <option>{{$marca->nombre}}</option>
                              @endforeach                             
                            </select>
                        

                          
                            <span id="errormarca" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomarca" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                        </div>

                          {{-- FORMULARIO DE MODELO DEL VEHICULO --}}
                          
                        <div class="col-md-4 form-group">
                            <label>Modelo</label>
                            <select class="form-control" name="modelo" id="modelo">
                              <option value="">Ninguno</option>                           
                            </select>

                            
                            <span id="errormodelo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validomodelo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                          </div>

                          {{-- FROMULARIO AÑO DEL VEHICULO --}}
                          
                          <div class="col-md-4 form-group">
                              <label>Año</label>
                              <?php
                                  $cont = date('Y')+1;
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
                            
                            <div class="form-group col-md-4">
                                <label>Transmisión </label>
                                <select class="form-control" id="transmision" name="transmision">            <option>MANUAL</option>
                                  <option>AUTOMÁTICO</option>
                                </select>  
                                  <span id="errortransmision" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validotransmision" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                            </div>

                            {{-- FORMULARIO RENDIMIENTO DEL VEHICULO --}}
                            
                                <div class="col-md-4 form-group">
                                    <label>Rendimiento (km/ltr)</label>
                                    <input type="number" name="rendimiento" id="rendimiento" class="form-control" min="0">

                                    <span id="errorrendimiento" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validorendimiento" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                  </div>

                                  {{-- FORMULARIO PUERTAS --}}
                                  <div class="form-group col-md-4">
                                    <label>Puertas</label>
                                    <select class="form-control" name="puertas" id="puertas">
                                      <option>2</option> 
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>                                              

                                        <span id="errorpuertas" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                        <span id="validopuertas" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                </div>  
                                  
                                        
                              {{-- FORMULARIO COLOR DEL VEHICULO --}}
                                                    
                              <div class="col-md-4 form-group">
                                  <label>Color</label>
                                  <input type="text" name="color" id="color" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">

                                  <span id="errorcolor" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                  <span id="validocolor" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                  
                                </div>
                                
                                {{-- FORMULARIO TIPO DEL VEHICULO --}}
                                
                                <div class="form-group col-md-4">
                                  <label>Tipo</label>
                                  <select class="form-control" name="tipo" id="tipo">
                                    @foreach ($categoria as $categoria)
                                    <option>{{$categoria->nombre}}</option>
                                    @endforeach 
                                  </select>                                              

                                      <span id="errorpuertas" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                      <span id="validopuertas" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                              </div> 

                                {{-- FORMULARIO CANTIDAD DE PASAJEROS DEL VEHICULO  --}}
                                
                                <div class="form-group col-md-4">
                                    <label>Pasajeros</label>
                                    <input type="number" name="pasajeros" id="pasajeros" class="form-control" max="99" min="0">      
                                    <span id="errorpasajeros" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validopasajeros" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
            
                                </div>
                                

                                {{-- FORMULARIO MALETERO DEL VEHICULO --}}
                                
                                  <div class="col-md-4 form-group">
                                      <label>Maletero</label>
                                      <input type="text" name="maletero" id="maletero" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">                                      

                                      <span id="errormaletero" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                      <span id="validomaletero" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                    </div>

                                    {{-- FORMULARIO CILINDROS DEL VEHICULO --}}
                                    
                                    <div class="form-group col-md-4">
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
                                    
                                      <div class="col-md-4 form-group">
                                          <label>Kilometraje</label>
                                          <input type="number" step="0.00" name="kilometraje" id="kilometraje" min="0.00" class="form-control" >

                                      <span id="errorkilometraje" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                      <span id="validokilometraje" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                        </div>

                                        {{-- FORMULARIO PRECIO COMPRA --}}
                                        
                                            <div class="col-md-4 form-group">
                                              <label>Precio compra</label>
                                              <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00" id="costo">                                 

                                              <span id="errorcosto" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                              <span id="validocosto" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                            </div>


                                            {{-- FORMULARIO PRECIO DE RENTA --}}
                                            
                                            <div class="col-md-4 form-group">
                                                <label>Precio renta</label>
                                                <input type="number" step="0.01" min="0" name="precio" id="precio" placeholder="0.00" min="0.00" class="form-control">

                                                <span id="errorprecio" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validoprecio" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>                                                 
                                              </div>

                                              {{-- FORMULARIO DESCRIPCION --}}
                                              
                                              <div class="col-md-4 form-group">
                                                <label>descripción</label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                

                                                <span id="errordescripcion" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validodescripcion" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                              </div>

                                              {{-- FORMULARIO SUCURSAL DEL VEHICULO --}}
                                              
                                             <div class="form-group col-md-4">
                                                <label>Sucursal</label>
                                                <select class="form-control" name="sucursal" id="sucursal">
                                                  @foreach ($sucursal as $sucursal)
                                                  <option>{{$sucursal->nombre}}</option>
                                                  @endforeach                             
                                                </select>
                                                

                                                <span id="errorsucursal" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                <span id="validosucursal" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                            </div>  
                                            
                                            {{-- FORMULARIO DE ESTATUS DEL VEHICULO
                                            
                                            <div class="form-group col-md-4">
                                              <label>Estatus</label>
                                              <select class="form-control" name="status" id="status">
                                                <option>ACTIVO</option> 
                                                 <option>INACTIVO</option>
                                              </select>                                              

                                                  <span id="errorstatus" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                                  <span id="validostatus" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span> 
                                          </div>  --}}
                    </div>


                    
                    <div class="modal modal-info fade" id="picture">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Alta Vehículo</h4>
                          </div>
                          <div class="modal-body">
                          
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                          <div class="alert" id="message" style="display: none"></div>
                         <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 200px; height: 200px;" >
                        </div>
                        <hr>
                        <div class="col-md-1 col-md-offset-3  file-loading">
                        <span class="btn btn-warning btn-file"> Subir Foto
                        <input id="foto" type="file" name="foto"/></span>  
                        </div> 
                  </div>
                  <div class="col-md-6">
                    <div id="preview_derecha" style="margin-top: 5%;">
                      <div class="alert" id="message_derecha" style="display: none"></div>
                     <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 200px; height: 200px;" >
                    </div>
                    <hr>
                    <div class="col-md-1 col-md-offset-3  file-loading">
                    <span class="btn btn-warning btn-file"> Subir Foto
                    <input id="foto_derecha" type="file" name="foto_derecha"/></span>  
                    </div> 
              </div>
              <div class="col-md-6">
                <div id="preview_izquierda" style="margin-top: 5%;">
                  <div class="alert" id="message_izquierda" style="display: none"></div>
                 <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 200px; height: 200px;" >
                </div>
                <hr>
                <div class="col-md-1 col-md-offset-3  file-loading">
                <span class="btn btn-warning btn-file"> Subir Foto
                <input id="foto_izquierda" type="file" name="foto_izquierda"/></span>  
                </div> 
          </div>
          <div class="col-md-6">
            <div id="preview_atras" style="margin-top: 5%;">
              <div class="alert" id="message_atras" style="display: none"></div>
             <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 200px; height: 200px;" >
            </div>
            <hr>
            <div class="col-md-1 col-md-offset-3  file-loading">
            <span class="btn btn-warning btn-file"> Subir Foto
            <input id="foto_atras" type="file" name="foto_atras"/></span>  
            </div> 
      </div>
    
                  </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-dismiss="modal">Continuar</button>
                            
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal ---->
                    

                    {{-- FORMULARIO PARA SUBIR FOTO DEL VEHICULO --}}
                     
                  <!-- /.box-body -->
                 
              <div class="row">
                <div class="col-md-12">
                    <div class="box-footer" style="float: right">
                      <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Agregar">
                      </div>
                      <div class="box-footer" style="float: right">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#picture" >Subir Foto</button>
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

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none" >

</button>
<div class="modal modal-info fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Alta Vehículo</h4>
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
          <p>El Vehículo que intenta agregar ya se encuentra registrado&hellip;</p>
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
          <h4 class="modal-title">No se pudo agregar </b> </h4>
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
            btn=document.getElementById('foto');
    image.src = reader.result;
    btn.getElementsByClassName('btn btn-success');
    image.style.width="200px";
    image.style.height="200px";
    preview.innerHTML = '';
    preview.append(image);
  };
}
</script>

<script>
  document.getElementById("foto_derecha").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
  
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
  
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function(){
      let preview = document.getElementById('preview_derecha'),
              image = document.createElement('img');
  
      image.src = reader.result;
      // image.getElementsByClassName('rounded-circle');
      image.style.width="200px";
      image.style.height="200px";
      preview.innerHTML = '';
      preview.append(image);
    };
  }
  </script>
  
  <script>
    document.getElementById("foto_izquierda").onchange = function(e) {
      // Creamos el objeto de la clase FileReader
      let reader = new FileReader();
    
      // Leemos el archivo subido y se lo pasamos a nuestro fileReader
      reader.readAsDataURL(e.target.files[0]);
    
      // Le decimos que cuando este listo ejecute el código interno
      reader.onload = function(){
        let preview = document.getElementById('preview_izquierda'),
                image = document.createElement('img');
    
        image.src = reader.result;
        // image.getElementsByClassName('rounded-circle');
        image.style.width="200px";
        image.style.height="200px";
        preview.innerHTML = '';
        preview.append(image);
      };
    }
    </script>
    <script>
      document.getElementById("foto_atras").onchange = function(e) {
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();
      
        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(e.target.files[0]);
      
        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function(){
          let preview = document.getElementById('preview_atras'),
                  image = document.createElement('img');
      
          image.src = reader.result;
          // image.getElementsByClassName('rounded-circle');
          image.style.width="200px";
          image.style.height="200px";
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
      // console.log(mensaje);
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
                      // console.log(arreglo);
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
            //  var status = arreglo.status;
             var sucursal = arreglo.sucursal;
             var puertas = arreglo.puertas;
             var foto = arreglo.foto;       
             var foto_derecha = arreglo.foto_derecha;
             var foto_izquierda = arreglo.foto_izquierda;
             var foto_atras = arreglo.foto_atras;
             
             if (foto == undefined){  
              
               }else{
                $('#message').css({"display": "block", "color":"red"});
           $('#message').html('AGREGA UNA FOTO');;
               //console.log(nombre);
             }
             if (foto_derecha == undefined){  
              
            }else{
              $('#message_derecha').css({"display": "block", "color":"red"});
           $('#message_derecha').html('AGREGA UNA FOTO');
            //console.log(nombre);
          }

          if (foto_izquierda == undefined){  
              
            }else{
              $('#message_izquierda').css({"display": "block", "color":"red"});
           $('#message_izquierda').html('AGREGA UNA FOTO');
            //console.log(nombre);
          }
           
          if (foto_atras == undefined){  
              
            }else{
              $('#message_atras').css({"display": "block", "color":"red"});
           $('#message_atras').html('AGREGA UNA FOTO');
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

             if (puertas == undefined){  
               $( '#puertas' ).css('borderColor', 'green');         
               jQuery('#validopuertas').show(); 
               jQuery('#errorpuertas').hide(); 
               }else{
                 jQuery('#validopuertas').hide(); 
               jQuery('#errorpuertas').show();          
              $( '#puertas' ).css('borderColor', 'red');
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

          // if (status == undefined){  
          //   $( '#status' ).css('borderColor', 'green');         
          //   jQuery('#validostatus').show(); 
          //   jQuery('#errorstatus').hide(); 
          //   }else{
          //     jQuery('#validostatus').hide(); 
          //   jQuery('#errorstatus').show();          
          //  $( '#status' ).css('borderColor', 'red');
          //   //console.log(nombre);
          // }
          $('#error1').click();
     }
    })
   });
  
  });
  </script>


<script>
$(document).ready(function(){
  
  consulta();



});
  </script>

<script>
function consulta(){
  // console.log(dato);
  var opcion= document.getElementById("marca");
  var dato = opcion.options[opcion.selectedIndex].text;
var formData = new FormData();
formData.append("text",dato)
  // event.preventDefault();
  $.ajax({ 
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
     url:"{{ route('marcasmodelos') }}",
     type: "POST",
     data:formData,
     dataType:'JSON',
     contentType: false,
     cache: false,
     processData: false,
     success:function(data)
     {      
       var mensaje=data.success;     
        var select = document.getElementById("modelo");
        select.options.length = 0;
        mensaje.forEach(function(item){
          var arr = item.nombre;
          select.options[select.options.length] = new Option(arr, arr);
        // console.log(item.nombre);
        });
     },
     error: function (data) {

     }
  });
}
</script>

@endsection

                  

</body>
</html>
  
  
