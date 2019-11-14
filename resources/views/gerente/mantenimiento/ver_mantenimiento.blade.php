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
          Panel de administración |
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
                                <th style="text-align: center">Número</th>
                                <th >Tipo</th>
                                <th >Costo</th>
                                <th >Fecha salida</th>
                                <th >Fecha regreso</th>
                                <th >Estatus</th>
                                <th >Enviar/Finalizar</th>
                                <th >Cancelar</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i = 0;?>
                             @foreach ($mantenimiento as $mante)  
                  <tr>
                          <td style="text-align: center"><?php 
                            echo $i=$i+1;
                          ?></td>
                          <td >{{$mante->tipo}}</td>
                          @if ($mante->total==null)
                          <td style="text-align: center;" >----------------</td>
                          @else
                          <td>{{$mante->total}}</td>
                          @endif
                          @if ($mante->fecha_ingresa==null)
                          <td style="text-align: center;">----------------</td>
                          @else
                          <td >{{date("d\-m\-Y", strtotime($mante->fecha_ingresa))}}</td>
                          @endif 
                          @if ($mante->fecha_salida==null)
                          <td style="text-align: center;">----------------</td>
                          @else
                          <td >{{date("d\-m\-Y", strtotime($mante->fecha_salida))}}</td>
                          @endif
                          <td >{{$mante->status}}</td>
@if($mante->status == 'ESPERA' & $mante->fecha_ingresa >= date("Y-m-d"))
<td style="text-align: center"><span class="fa fa-arrow-right fa-2x" style="color:rgb(90, 69, 69);" title="Accion no permitida"></span></td>
@endif
@if($mante->status == 'ESPERA' & $mante->fecha_ingresa <= date("Y-m-d"))
<td style="text-align: center"> <a href="{{ route('enviarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-arrow-right fa-2x" style="color:rgb(226, 247, 34);" title="Enviar a mantenimiento"></span></td>
@endif
@if($mante->status == 'TERMINADO')
<td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-eye fa-2x" style="color:rgb(90, 69, 69);" title="Ver detalles"></span></td>
@endif
@if($mante->status == 'CURSO')
<td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-arrow-left fa-2x" style="color:greenyellow;" title="Finalizar mantenimiento"></span></td>
@endif
@if($mante->status == 'CANCELADO')
<td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-eye fa-2x" style="color:rgb(90, 69, 69);" title="Ver Detalles"></span></td>
@endif
<!-- si esta en espera se puede cancelar, debera aparecer el boton de cancelar -->
@if($mante->status == 'ESPERA')
<td style="text-align: center"> <a href="{{ route('cancelarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-trash-o fa-2x" style="color:red;" title="Eliminar"></span></td>   
@else
<td style="text-align: center"><span class="fa fa-trash-o fa-2x" style="color:rgb(90, 69, 69);" title="Acción no permitida"></span></td>   
@endif
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
                <p>Para dar de alta un mantenimiento extra dale click en continuar :).&hellip;</p>
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
                "scrollY":"400px",
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
  
  
