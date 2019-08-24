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
          Panel de administracion |
          <small>Servicio Extra</small>
        </h1>
        
    </section>



         <!-- Content Wrapper. Contains page content -->
 
  

    <!-- Main content -->
    <section class="content">
        @if (count($serviciosextra )==0)
        <div style="display: none;">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning" id="<?php 
          echo "boton";
        ?>">
              Cancelar
            </button>
          </div>
          @endif 
          
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="example" class="display nowrap " style="width:100%">
                      <thead>
                          <tr>
                              <th style="text-align: center">Nombre</th>
                              <th style="text-align: center">Precio</th>
                              <th style="text-align: center">Estatus</th>
                              <th style="text-align: center">Descripcion</th>
                              <th style="text-align: center">Sucursal</th>
                              <th style="text-align: center">Cantidad</th>
                              <th style="text-align: center">Fecha Alta</th>
                              <th style="text-align: center">Editar</th>
                              <th style="text-align: center">Eliminar</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                           @foreach ($serviciosextra as $ser)                      
                <tr>
                        <td style="text-align: center">{{$ser->nombre}}</td>
                        <td style="text-align: center">{{$ser->precio}}</td>
                        <td style="text-align: center">{{$ser->disponibilidad}}</td>
                        <td style="text-align: center">{{$ser->descripcion}}</td>
                        <td style="text-align: center">{{$ser->sucursal}}</td>
                        <td style="text-align: center">{{$ser->cantidad}}</td>
                        <td style="text-align: center">{{$ser->created_at}}</td>
                        <td style="text-align: center"> <a href="{{ route('modificarservicio',['servicioextra'=>$ser->idserviciosextra,'sucursal'=>$ser->idsucursal]) }}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span></td>
                          <td style="text-align: center">
                                <a href="{{ route('modificarservicio',['servicioextra'=>$ser->idserviciosextra]) }}" title="Eliminar"> <span class="fa fa-trash-o fa-2x" style="color:red;"></span>
                      </td>
                      </tr> 
                @endforeach
                      
                      </tbody>
                  </table>
              </div>
              <div class="form-group">
                <a href="{{ route('empleado.create')}}" class="btn  float-left btn-primary" style="float: right">Nuevo</a>
              </div>
     
      </section>
   
      <div class="modal modal-warning fade" id="modal-warning">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">No se encuentra ningún registro. :( </b> </h4>
              </div>
              <div class="modal-body">
                <p>Para dar de alta un servicio extra dale click en continuar :).&hellip;</p>
              </div>
              <div class="modal-footer">
                {{--<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>--}}
                <a href="{{ URL::previous()}}" class="btn btn-success pull-left">Regresar</a>
              <a href="{{route('servicioe.create')}}" class="btn btn-primary">Continuar</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
   
@endsection    
     @section('scripts')

     <script>           
        $(document).ready(function() {

         var obj= document.getElementById("boton");
         obj.click();
         } );
        </script>

         <script>
         $(document).ready(function() {
              $('#example').DataTable( {
                "scrollX": true,
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
                
              } );
          } );
         </script>
         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
         <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     @endsection
</body>
</html>
  
  
