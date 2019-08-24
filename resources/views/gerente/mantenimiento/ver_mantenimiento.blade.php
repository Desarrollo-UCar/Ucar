@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mantenimiento</title>
 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Mantenimiento</small>
        </h1>
        
    </section>


         <!-- Content Wrapper. Contains page content -->
 
  

    <!-- Main content -->
    <section class="content">
        @if (count($mantenimiento )==0)
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
                              <th style="text-align: center">Vin</th>
                              <th style="text-align: center">Matricula</th>
                              <th style="text-align: center">Marca</th>
                              <th style="text-align: center">Modelo</th>                              
                              <th style="text-align: center">Tipo Mantenimiento</th>   
                              <th style="text-align: center">Fecha Salida</th>
                              <th style="text-align: center">Fecha Ingreso</th>
                              <th style="text-align: center">Estatus</th>
                              <th style="text-align: center">Modificar</th>
                              <th style="text-align: center">Ver detalle</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                           @foreach ($mantenimiento as $ser)                      
                      <tr>
                        <td style="text-align: center">{{$ser->vin}}</td>
                        <td style="text-align: center">{{$ser->matricula}}</td>
                        <td style="text-align: center">{{$ser->marca}}</td>
                        <td style="text-align: center">{{$ser->modelo}}</td>
                        <td style="text-align: center">{{$ser->servicio}}</td>
                        <td style="text-align: center">{{$ser->fecha_ingresa}}</td>
                        @if ($ser->fecha_salida==null)
                        <td style="text-align: center">---------</td>
                        @else
                        <td style="text-align: center">{{$ser->fecha_salida}}</td>
                        @endif  
                        
                        <td style="text-align: center">{{$ser->status}}</td>

                        <td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$ser->idmantenimiento,'vehiculo'=>$ser->idvehiculo])}}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar"></span></td> 
                        
                        <td style="text-align: center"> <a href="{{ route('modificarmantenimiento',['mantenimiento'=>$ser->idmantenimiento,'vehiculo'=>$ser->idvehiculo])}}"> <span class="fa fa-external-link-square fa-2x" style="color:blue;" title="ver detalles"></span></td> 
                      </tr> 
                @endforeach
                      
                      </tbody>
                  </table>
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
              <a href="{{route('vehiculo.index')}}" class="btn btn-primary">Continuar</a>
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
  
  
