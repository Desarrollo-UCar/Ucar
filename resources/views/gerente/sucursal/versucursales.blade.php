@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Sucursal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Sucursales</small>
        </h1>
        
    </section>


   

         <!-- Content Wrapper. Contains page content -->
 
  

    <!-- Main content -->
    <section class="content">
      
        @if (count($sucursals)==0)
        <div style="display: none;">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning" id="<?php 
          echo "boton";
        ?>">
              Cancelar
            </button>
          </div>
          @endif 


        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Datos de sucursales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="display nowrap " style="width:100%">
                  <thead>
                      <tr>
                          <th style="text-align: center">Nombre</th>
                          <th style="text-align: center">País</th>
                          <th style="text-align: center">Estado</th>
                          <th style="text-align: center">Ciudad</th>
                          <th style="text-align: center">Colonia</th>
                          <th style="text-align: center">Calle</th>
                          <th style="text-align: center">Num. Calle</th>
                          <th style="text-align: center">Teléfono</th>
                          <th style="text-align: center">Acción</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($sucursals as $sucursal)                      
                      <tr>
                      <td style="text-align: center">{{$sucursal->nombre}}</td>
                        <td style="text-align: center">{{$sucursal->pais}}</td>
                        <td style="text-align: center">{{$sucursal->estado}}</td>
                        <td style="text-align: center">{{$sucursal->ciudad}}</td>
                        <td style="text-align: center">{{$sucursal->colonia}}</td>
                        <td style="text-align: center">{{$sucursal->calle}}</td>
                        <td style="text-align: center">{{$sucursal->numero}}</td>
                        <td style="text-align: center">{{$sucursal->telefono}}</td>
                        <td style="text-align: center;"> 
                          <a href="{{ route('modificarsucursal',['idsucursal'=>$sucursal->idsucursal]) }}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span>
                          </td>
                  </tr> 
            @endforeach
                  
                  </tbody>
              </table>
            </div>
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
              <p>Para registrar una sucursal dale click en continuar :).&hellip;</p>
            </div>
            <div class="modal-footer">
              {{--<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>--}}
              <a href="{{ URL::previous()}}" class="btn btn-success pull-left">Regresar</a>
            <a href="{{route('sucursal.create')}}" class="btn btn-primary">Continuar</a>
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
  
  
