@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vehiculos</title>
 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Vehiculos</small>
        </h1>
        
    </section>


    <!-- Main content -->
    <section class="content">          
              <!-- /.box-header -->
              @if (count($vehiculo)==0)
            <div style="display: none;">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning" id="<?php 
              echo "boton";
            ?>">
                  Cancelar
                </button>
              </div>
              @endif 
                       

              <div class="box-body">
                  <table id="example" class="display nowrap">
                      <thead>
                          <tr>
                              <th style="text-align: center">Vin</th>
                              <th style="text-align: center">Matricula</th>
                              <th style="text-align: center">fecha Alta</th>
                              <th style="text-align: center">Marca</th>
                              <th style="text-align: center">Modelo</th>
                              <th style="text-align: center">Año</th>
                              <th style="text-align: center">Precio</th>
                              <th style="text-align: center">Costo</th>
                              <th style="text-align: center">No. Pasajeros</th>
                              <th style="text-align: center">Color</th>
                              <th style="text-align: center">Cilindros</th>
                              <th style="text-align: center">Kilometraje</th>
                              <th style="text-align: center">Tipo</th>
                              <th style="text-align: center">Sucursal</th>
                              <th style="text-align: center">Estatus</th>
                              <th style="text-align: center">Descripción</th>
                              <th style="text-align: center">Modificar</th>
                              <th style="text-align: center">Mantenimiento</th>
                              <th style="text-align: center">Eliminar</th>
                          </tr>
                      </thead>
                      <tbody>
                           @foreach ($vehiculo as $vehiculo)                      
                <tr>
                        <td style="text-align: center">{{$vehiculo->vin}}</td>
                        <td style="text-align: center">{{$vehiculo->matricula}}</td>
                        <td style="text-align: center">{{$vehiculo->created_at}}</td>
                        <td style="text-align: center">{{$vehiculo->marca}}</td>
                        <td style="text-align: center">{{$vehiculo->modelo}}</td>
                        <td style="text-align: center">{{$vehiculo->anio}}</td>
                        <td style="text-align: center">{{$vehiculo->precio}}</td>
                        <td style="text-align: center">{{$vehiculo->costo}}</td>                       
                        <td style="text-align: center">{{$vehiculo->pasajeros}}</td>
                        <td style="text-align: center">{{$vehiculo->color}}</td>
                        <td style="text-align: center">{{$vehiculo->cilindros}}</td>
                        <td style="text-align: center">{{$vehiculo->kilometraje}}</td>
                        <td style="text-align: center">{{$vehiculo->tipo}}</td>
                        <td style="text-align: center">{{$vehiculo->nombre}}</td>
                        <td style="text-align: center">{{$vehiculo->estatus}}</td>
                          @if ($vehiculo->descripcion==null)
                          <td style="text-align: center">------------</td>
                          @else
                          <td style="text-align: center">{{$vehiculo->descripcion}}</td>
                          @endif
                        

                        <td style="text-align: center"> 
                          <a href="{{ route('modificarvehiculo',['vehiculo'=>$vehiculo->idvehiculo,'sucursal'=>$vehiculo->idsucursal]) }}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span></td>
                            @if ($vehiculo->status=='MANTENIMIENTO')
                            <td style="text-align: center"> 
                                <a href="{{ route('mantenimiento.index') }}"> <span class="fa fa-external-link-square fa-2x" style="color:blue;" title="ver mantenimiento"></span></td>
                            @else
                            <td style="text-align: center"> 
                                <a href="{{ route('mantenimiento.create',['vehiculo'=>$vehiculo->vin]) }}"> <span class="fa fa-cog fa-2x" style="color:seagreen;" title="Mandar a mantenimiento"></span></td>
                            @endif
                            

                            <td style="text-align: center">
                                <a href="{{ route('modificarvehiculo',['vehiculo'=>$vehiculo->idvehiculo,'sucursal'=>$vehiculo->idsucursal]) }}" title="Eliminar"> <span class="fa fa-trash-o fa-2x" style="color:red;"></span>
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
                <p>Para registrar un vehículo dale click en continuar :).&hellip;</p>
              </div>
              <div class="modal-footer">
                {{--<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>--}}
                <a href="{{ URL::previous() }}" class="btn btn-success pull-left">Regresar</a>
              <a href="{{route('vehiculo.create')}}" class="btn btn-primary">Continuar</a>
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
        var table = $(document).ready(function() {
              $('#example').DataTable( {
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
           </script>
     @endsection
</body>
</html>
  
  
