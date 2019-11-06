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
              @if (session()->has('mensaje'))
              <div style="display: none;">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#encurso" id="<?php 
                echo "botoncurso";
              ?>">
                    Cancelar
                  </button>
                </div>             
              @endif   
              @if (session()->has('curso'))
              <div style="display: none;">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#espera" id="<?php 
                echo "botonespera";
              ?>">
                    Cancelar
                  </button>
                </div>             
              @endif    
              
              @if (session()->has('baja'))
              <div style="display: none;">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminado" id="<?php 
                echo "botonbaja";
              ?>">
                    Cancelar
                  </button>
                </div>             
              @endif

              @if (session()->has('alta'))
              <div style="display: none;">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#altavehiculo" id="<?php 
                echo "botonalta";
              ?>">
                    Cancelar
                  </button>
                </div>             
              @endif
              <div class="box-body ">
                <table id="example" class="display nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align: center">Placas</th>
                            <th style="text-align: center">Marca</th>
                            <th style="text-align: center">Modelo</th>
                            <th style="text-align: center">Color</th>
                            <th style="text-align: center">Estatus</th>
                            <th style="text-align: center">Modificar</th>
                            <th style="text-align: center">Mantenimiento</th>
                            <th style="text-align: center">Alta/Baja</th>
                            <th style="text-align: center">Reservaciones</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($vehiculo as $vehiculo)                      
              <tr>
                <td >{{$vehiculo->matricula}}</td>
                <td >{{$vehiculo->marca}}</td>
                <td >{{$vehiculo->modelo}}</td>
                <td >{{$vehiculo->color}}</td>
                <td >{{$vehiculo->estatus}}</td>
                <td style="text-align: center"> 
                  <a href="{{ route('modificarvehiculo',['vehiculo'=>$vehiculo->idvehiculo,'sucursal'=>$vehiculo->idsucursal]) }}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span></td>
                   
                    @if ($vehiculo->estatus=='MANTENIMIENTO')
                    <td style="text-align: center"> 
                        <a href="{{ route('mantenimiento.index') }}"> <span class="fa fa-external-link-square fa-2x" style="color:blue;" title="ver mantenimiento"></span></td>
                    @else
                    <td style="text-align: center"> 
                        <a href="{{ route('mantenimiento.create',['vehiculo'=>$vehiculo->vin]) }}"> <span class="fa fa-cog fa-2x" style="color:seagreen;" title="Mandar a mantenimiento"></span></td>
                    @endif                  
                    @if($vehiculo->estatus=='ACTIVO' || $vehiculo->estatus=='activo')
                    <td style="text-align: center">
                      <a href="{{ route('EliminarVehiculo',['vehiculo'=>$vehiculo->idvehiculo,'sucursal'=>$vehiculo->idsucursal]) }}"title="Eliminar"> <span class="fa fa-trash-o fa-2x" style="color:red;"></span>
                    @else
                    <td style="text-align: center">
                        <a href="{{ route('UpVehiculo',['vehiculo'=>$vehiculo->idvehiculo,'sucursal'=>$vehiculo->idsucursal]) }}"title="Activar"> <span class="fa fa-external-link-square fa-2x" style="color:blue;"></span>
                    @endif
            </td>

            
            <td style="text-align: center">
              <a href="{{ route('porVehiculo',['vehiculo'=>$vehiculo->idvehiculo]) }}" title="Ver reservaciones"> <span class="fa fa-tags fa-2x" style="color:yellowgreen;"></span>
    </td>  
                    </tr> 
              @endforeach
                    
                    </tbody>
                </table>
            </div>
            
      </section>

      <div class="modal modal-info fade" id="altavehiculo">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alta Vehículo</h4>
              </div>
              <div class="modal-body">
                <p>EL VEHÍCULO SE DIÓ DE ALTA EXITOSAMENTE&hellip;</p>
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

        <div class="modal modal-warning fade" id="eliminado">
            <div class="modal-dialog" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">ELIMINADO!</b> </h4>
                </div>
                <div class="modal-body">
                    
                  <p>EL VEHICULO SE DIÓ DE BAJA EXITOSAMENTE.&hellip;</p>
                
                </div>
                <div class="modal-footer">
                  {{--<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>--}}<button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Continuar</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

        <div class="modal modal-warning fade" id="encurso">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EL VEHÍCULO SE ENCUENTRA EN RENTA</b> </h4>
              </div>
              <div class="modal-body">
                <p>Para mandar un vehículo a mantenimiento es necesario cancelar su renta.&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                {{-- <a href="{{ URL::previous() }}" class="btn btn-success pull-left">Regresar</a> --}}
              {{-- <a href="{{route('vehiculo.create')}}" class="btn btn-primary">Continuar</a> --}}
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


        <div class="modal modal-success fade" id="espera">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EL VEHÍCULO TIENE RESERVAS PRÓXIMAS</b> </h4>
              </div>
              <div class="modal-body">
                <p>Para mandar un vehículo a mantenimiento es necesario verificar sus próximas reservas.&hellip;</p>
                @if (session()->has('curso'))
                
<table class="table">
  <thead>
    <tr>
      <th scope="col">No reserva</th>
      <th scope="col">Fecha Entrega</th>
      <th scope="col">Fecha Devolución</th>
      <th scope="col">Conductor</th>
    </tr>
  </thead>
  <tbody>
      @foreach (Session::get('curso') as $alquiler)
    <tr>
    <th>{{$alquiler->id_reservacion}}</th>
    <td>{{date("d\-m\-Y", strtotime($alquiler->fecha_recogida))}}</td>
    <td>{{date("d\-m\-Y", strtotime($alquiler->fecha_devolucion))}}</td>
    <td>{{$alquiler->nombreConductor}}</td>
    <td><form action ="{{route('reservacion',$alquiler->id_reservacion)}}" method ="GET" enctype="multipart/form-data">
      {{csrf_field()}}
     <button type="sumbit" class="btn btn-primary btn-xs" type="sumbit"> 
       <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span>
     </button>
</form></td>
    </tr>
    @endforeach   
  </tbody>
</table>
                </div>                                    
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <a href="{{ route('DeleteVehiculo',['vehiculo'=>$alquiler->id_vehiculo]) }}" class="btn btn-primary" >
                  Continuar</a>
              </div>
            </div>
            @endif 
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
    
             var obj= document.getElementById("botoncurso");
             obj.click();
             } );
            </script>
            <script>           
              $(document).ready(function() {
      
               var obj= document.getElementById("botonespera");
               obj.click();
               } );
              </script>

    <script>           
    $(document).ready(function() {

     var obj= document.getElementById("botonalta");
     obj.click();
     } );
    </script>

<script>           
    $(document).ready(function() {

     var obj= document.getElementById("botonbaja");
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
      
         <script>
           </script>
     @endsection
</body>
</html>
  
  
