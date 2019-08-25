@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Clientes</title>
 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Clientes</small>
        </h1>
        
    </section>


         <!-- Content Wrapper. Contains page content -->
 
         <?php //$clientes = DB::table('clientes')->get(); ?>

    <!-- Main content -->
    <section class="content">
        @if (count($clientes)==0)
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
                              <th style="text-align: center">Credencial</th>
                              <th style="text-align: center">Pasaporte</th>
                              <th style="text-align: center">Nombre</th>
                              <th style="text-align: center">Apellido Paterno</th>                              
                              <th style="text-align: center">Apellido Materno</th>   
                              <th style="text-align: center">Fecha Nacimiento</th>
                              <th style="text-align: center">Nacionalidad</th>
                              <th style="text-align: center">Correo</th>
                              <th style="text-align: center">Teléfono</th>
                              <th style="text-align: center">País</th>
                              <th style="text-align: center">Estado</th>
                              <th style="text-align: center">Ciudad</th>
                              <th style="text-align: center">Colonia</th>
                              <th style="text-align: center">Calle</th>
                              <th style="text-align: center">Fecha Alta</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                           @foreach ($clientes as $cliente)                      
                      <tr>
                            @if ($cliente->credencial==null)
                            <td style="text-align: center">---------</td>
                            @else
                            <td style="text-align: center">{{$cliente->credencial}}</td>
                            @endif 
                            @if ($cliente->pasaporte==null)
                            <td style="text-align: center">---------</td>
                            @else
                            <td style="text-align: center">{{$cliente->pasaporte}}</td>
                            @endif 
                        <td style="text-align: center">{{$cliente->nombre}}</td>
                        <td style="text-align: center">{{$cliente->primer_apellido}}</td>
                        @if ($cliente->segundo_apellido==null)
                        <td style="text-align: center">---------</td>
                        @else
                        <td style="text-align: center">{{$cliente->segundo_apellido}}</td>
                        @endif 
                        <td style="text-align: center">{{$cliente->fecha_nacimiento}}</td>
                        <td style="text-align: center">{{$cliente->nacionalidad}}</td>
                        <td style="text-align: center">{{$cliente->correo}}</td>
                        <td style="text-align: center">{{$cliente->telefono}}</td>
                        <td style="text-align: center">{{$cliente->pais}}</td>
                        <td style="text-align: center">{{$cliente->estado}}</td>
                        <td style="text-align: center">{{$cliente->ciudad}}</td>
                        <td style="text-align: center">{{$cliente->colonia}}</td>
                        <td style="text-align: center">{{$cliente->calle}}</td>
                        <td style="text-align: center">{{$cliente->created_at}}</td>
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
  
  