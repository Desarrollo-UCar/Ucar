@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
@endsection

@section('contenido')
<section class="content-header">
    <h1>
      Panel de administracion
      <small>Gerente</small>
    </h1>
</section>
<section class="content">

      <div class="box box-primary">
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                            <li><a href="#tab_3-2" data-toggle="tab">Tipo</a></li>
                            <li><a href="#tab_2-2" data-toggle="tab">Modelos</a></li>
                      <li class="active"><a href="#tab_1-1" data-toggle="tab">Marcas</a></li>

 
                      <li class="pull-left header"><i class="fa fa-th"></i>Datos de vehiculos</li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1-1">
                        <b>Registrar:</b>
                        <form id="upload_form" {{--action="{{ route('registrarMarca') }}"--}} method="POST">
                                 @csrf
                                   <div class="row">
                                      <div class="col-md-12">
                                        <div class="col-md-8 col-md-offset-4">
                                          <label>-- Nueva marca de vehiculo -- </label>
                                        </div>
                                      </div>  
                                    </div>
                                   <div class="form-group col-md-4">
                                    <label>Nombre de la marca</label>
                                    <input type="text" class="form-control" placeholder="Nombre de la marca" name="nombre"  autofocus required onkeyup="javascript:this.value=this.value.toUpperCase();" id="nombre">

                                    <span id="errornombre" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                    <span id="validonombre" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-2" style="float: right">
                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                          </div>                 
                                      </div>                    
                                  </div>
                            </form>

                            <table id="example" class="display nowrap " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Número</th>
                                            <th >Nombre Marca</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($marcas as $marca)                      
                              <tr>
                                      <td style="text-align: center">{{$marca->id}}</td>
                                      <td >{{$marca->nombre}}</td>
                     
              

                                       

                                    </tr> 
                              @endforeach
                                    
                                    </tbody>
                                </table>

                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2-2">
                            <b>Registrar:</b>
                            <form id="modeloform" {{--action="{{ route('registrarModelo') }}"--}} method="POST">
                                     @csrf
                                       <div class="row">
                                          <div class="col-md-12">
                                            <div class="col-md-8 col-md-offset-4">
                                              <label>-- Nuevo modelo de vehiculo -- </label>
                                            </div>
                                          </div>  
                                        </div>
                                       <div class="form-group col-md-4">
                                        <label>Marca</label>
                                        <select name= "marca" id="marca" class="form-control select2" style="width: 100%;" >
                                                @foreach($marcas as $marca)  
                                   <option value={{$marca->id}}>
                                {{$marca->nombre}}</option>
                                            @endforeach
                                              </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                            <label>Modelo</label>
                                            <input type="text" class="form-control" placeholder="Modelo del auto" name="modelo"  autofocus required onkeyup="javascript:this.value=this.value.toUpperCase();" id="modelo">

                                            <span id="errormodelo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                                            <span id="validomodelo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                                        </div>
    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group col-md-2" style="float: right">
                                                <button type="submit" class="btn btn-primary">Agregar</button>
                                              </div>                 
                                          </div>                    
                                      </div>
                                </form>
    
                                <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Marca</th>
                                                <th >Modelo</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($marcasm as $carro)                      
                                  <tr>
                                          <td style="text-align: center">{{$carro->nombre}}</td>
                                          <td >{{$carro->nombre2}}</td>
                         
                  
                                        </tr> 
                                  @endforeach
                                        
                                        </tbody>
                                    </table>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_3-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>

          <!-- /.box-body-->
        </div>

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" style="display: none" >

        </button>
        <div class="modal modal-info fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alta Marca</h4>
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
          <p>El dato que intenta agregar ya se encuentra registrado&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    </section>
@endsection

@section('scripts')

<script>
  function recargar(){
    location.reload(); 
  }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
  $(document).ready(function(){
  
   $('#upload_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
     url:"{{ route('registrarMarca') }}",
     method:"get",
     data:$('#upload_form').serialize(),//new FormData(this),
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

       $( '#nombre' ).css('borderColor', 'green');         
                     jQuery('#validonombre').show(); 
                     jQuery('#errornombre').hide(); 

     },
     error: function (data) {
         var err = JSON.parse(data.responseText);
         var arreglo = err.errors;
         /*jQuery.each(arreglo, function(key, value){
            console.log(arreglo);
                      });*/
                     console.log(arreglo);
           var nombre = arreglo.nombre;        
                       
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
                
     }
    })
   });
  
  });
  </script>

<script>
  $(document).ready(function(){
  
   $('#modeloform').on('submit', function(event){
    event.preventDefault();
    $.ajax({
     url:"{{ route('registrarModelo') }}",
     method:"get",
     data:$('#modeloform').serialize(),//new FormData(this),
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

       $( '#nombre' ).css('borderColor', 'green');         
                     jQuery('#validonombre').show(); 
                     jQuery('#errornombre').hide(); 

     },
     error: function (data) {
         var err = JSON.parse(data.responseText);
         var arreglo = err.errors;
         /*jQuery.each(arreglo, function(key, value){
            console.log(arreglo);
                      });*/
                     console.log(arreglo);
           var modelo = arreglo.modelo;        
                       
           if (modelo == undefined){  
                     $( '#modelo' ).css('borderColor', 'green');         
                     jQuery('#validomodelo').show(); 
                     jQuery('#errormodelo').hide(); 
                     }else{
                       jQuery('#validomodelo').hide(); 
                     jQuery('#errormodelo').show();          
                    $('#modelo' ).css('borderColor', 'red');
                     //console.log(nombre);
                   }       
                
     }
    })
   });
  
  });
  </script>
@endsection