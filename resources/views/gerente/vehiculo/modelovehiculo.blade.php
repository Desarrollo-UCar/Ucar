@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Servicio Extra</title>
 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Modelos de vehículos</small>
        </h1>
        
    </section>



         <!-- Content Wrapper. Contains page content -->
 
  

    <!-- Main content -->
    <section class="content">
        <section class="content">
          
          
              <!-- /.box-header -->
              <div class="box-body">

                  <form id="datos"{{--action="{{ route('tallerservicio.store') }}"--}} method="POST">
                      {{-- FORMULARIO DE NOMBRES --}}
                      
                       @csrf
                         {{-- FORMULARIO DIRECCION--}}
                         <div class="row">
                            <div class="col-md-12 ">
                              <div class="col-md-8 col-md-offset-2">
                                <label>-- Agregar Nuevo Modelo -- </label>
                              </div>
                            </div>  
                          </div>
                         <div class="form-group col-md-4">
                          <label>Modelo</label>
                          <input type="text" class="form-control" placeholder="Modelo del vehiculo" name="modelo"  onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus required id="modelo">

                          <span id="errormodelo" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                          <span id="validomodelo" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>
                              
    
                        <div class="form-group col-md-4">
                          <label>Descripción</label>
                          <input type="text" class="form-control" placeholder="Descripción" name="descripcion" id="descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();">

                          <span id="errordescripcion" class="glyphicon glyphicon-remove form-control-feedback" style="color:red;display: none;"></span>
                            <span id="validodescripcion" class="glyphicon glyphicon-ok  form-control-feedback" style="color:green;display: none;"></span>
                      </div>
                      <div class="row">
                          <div class="col-md-8">
                              <div class="form-group col-md-2" style="float: right">
                                  <button type="submit" id="enviar" class="btn btn-primary">Agregar</button>
                                </div>
                              <div class="form-group col-md-2" style="float: right">
                                  <button type="submit" class="btn btn-danger">Cancelar</button>
                                </div>                       
                            </div>                    
                        </div>
                  </form>
                  
                  <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-8 col-md-offset-4">
                          <label>-- Servicios de mantenimiento existente-- </label>
                        </div>
                      </div>  
                    </div>

                  <table id="example" class="display nowrap " style="width:100%">
                      <thead>
                          <tr>
                              <th style="text-align: center">Número</th>
                              <th >Servicios</th>
                              <th >Descripción</th>
                              <th >Fecha Alta</th>
                              <th style="text-align: center">Editar</th>
                              <th style="text-align: center">Eliminar</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          <?php $modelo= DB::table('modelos')
                          ->orderBy('idmodelo','asc')
                          ->get(); ?>
                        
                           @foreach ($modelo as $modelo)                      
                <tr>
                        <td style="text-align: center">{{$modelo->idmodelo}}</td>
                        <td >{{$modelo->nombremodelo}}</td>
                        @if ($modelo->descripcion==null)
                        <td >----------------</td>
                        @else
                        <td >{{$modelo->descripcion}}</td>
                        @endif
                        @if ($modelo->created_at==null)
                        <td >----------------</td>
                        @else
                        <td >{{$modelo->created_at}}</td>
                        @endif                        

                        <td style="text-align: center"> <a href="{{ route('tallerservicio.edit',$modelo->idmodelo) }}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span></td>
                         
                          <td style="text-align: center">
                                <a href="{{ route('modificarservicio',['servicioextra'=>$modelo->idmodelo]) }}" title="Eliminar"> <span class="fa fa-trash-o fa-2x" style="color:red;"></span>
                      </td>
                      </tr> 
                @endforeach
                      
                      </tbody>
                  </table>
              </div>
     
      </section>
   
   
   
@endsection    
     @section('scripts')

    

         <script>
         $(document).ready(function() {
              var $table=$('#example').DataTable( {   
                "scrollY":"400px",            
                "scrollX": true,                
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
                
              } );
              new $.fn.dataTable.FixedHeader( table );
          } );
         </script>
         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
         <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


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
                  url: "{{ route('insertmodelo') }}",
                  type: "POST",
                  dataType: 'json',
                  success: function (data) {
                   var mensaje=data.success;
                    console.log(data);
              //      if(mensaje=='EXISTE'){
              //  $('#existe1').click();
              //   }else{
              //      $('.btn-info').click();
              //      }
                     $( '#modelo' ).css('borderColor', 'green');         
                     jQuery('#validomodelo').show(); 
                     jQuery('#errormodelo').hide(); 

                     $( '#descripcion' ).css('borderColor', 'green');         
                     jQuery('#validodescripcion').show(); 
                     jQuery('#errordescripcion').hide(); 
                  },
                  error: function (data) {
                  var err = JSON.parse(data.responseText);
                  var arreglo = err.errors;
                
                   console.log(arreglo);
                   var modelo = arreglo.modelo;
                   var descripcion = arreglo.descripcion;
                  
         
                   
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
                      $('#enviar').html('guardar cambios');
                  }
              });
            });
            
           
             
          });
          </script>

     @endsection
</body>
</html>
  
  
