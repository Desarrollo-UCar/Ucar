@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mantenimiento</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
</head>
<body>
@section('contenido')
    <section class="content-header">
        <h1>Panel de administración |<small>Mantenimiento</small></h1>        
    </section>
    <section class="content">
        @if ($errors->any())
        <div class="alert alert-danger">            
               Por favor de rellenar los campor correctamente
        </div>
    @endif
    @if (session()->has('msj'))
    <div class="alert alert-info" role="alert">{{session('msj')}} 
    <a href="{{route('mantenimiento.index')}}" style="color:darkgreen"><b> ver todos los mantenimientos </b></a>
    </div>                                    
    @endif 
    @if (session()->has('mensaje'))
    <div class="alert alert-danger" role="alert">{{session('mensaje')}}</div>                              
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
            <div class="box box-primary">            
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo mantenimiento</h3>
                </div>
                <!-- FORM PARA PREVISUALIZAR FOTO -->
                <div class="row">
                    <div class="col-md-8">
                            <form action="{{ route('mantenimiento.store')}}" method="POST" enctype="multipart/form-data" id="form">                              
                                @csrf

                                <div class="row" style="display:none">
                                    <div class="form-group col-md-4">
                                        <label>idvehiculo</label>
                                      <input type="text" class="form-control" name="idvehiculo" value="{{$vehiculo->idvehiculo}}" id="idvehiculo">
                                    </div>   
                                  </div> 

                                    <div class="col-md-5 form-group">
                                        <label>Sucursal</label>
                                            <input type="text" name="sucursal" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->nombre}}" readonly>
                                    </div>
            
                                    <div class="col-md-4 form-group">
                                        <label>Vehículo</label>
                                            <input type="text" name="anio" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->marca}} {{$vehiculo->modelo}} {{$vehiculo->anio}}" readonly>
                                    </div>
            
                                    <div class="col-md-3 form-group">
                                        <label>Placas</label>
                                            <input type="text" name="matricula" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->matricula}}" readonly>
                                    </div>
                                        <hr width="90%"/>
            
                                    <div class="form-group col-md-3">
                                        <label>Tipo de servicio</label>
                                        <select class="form-control"  name="tipo"> 
                                            <option>PREVENTIVO</option>
                                            <option>CORRECTIVO</option>                                                       
                                        </select>
                                    </div> 
            
                                    <div class="col-md-3 form-group">
                                        <label>Fecha salida</label>
                                        <input type="date" name="fecha_ingresa" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                                    </div>
                                    
                                    <div class="col-md-3 form-group">
                                        <label>Fecha Regreso</label>
                                        <input type="date" name="fecha_salida" class="form-control" required>
                                    </div>
            
                                    <div class="col-md-3 form-group">
                                        <label>Kilometraje</label>
                                        <input type="number" step="0.00" name="kilometraje" id="" min="0.00" class="form-control" value="{{$vehiculo->kilometraje}}"  required>
                                    </div>
            
                                    <div class="col-md-12 form-group" style="margin-left: 70%;">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-warning" id="boton">Elegir Servicios</button>
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>           
                                <!-- /.box-body -->
                              </form>
                    </div>
                    <div class="col-md-4">
                                    <div id="preview">
                                            <img src="{{ '/images/'.$vehiculo->foto }}"  style="width: 90%; height: 90%;" >  
                                    </div>                 
                    </div>

                </div>   

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 col-md-offset-4">
                    <label>--Lista de mantenimientos realizados al vehículo--<label>
                    </div>
                </div>  
            </div>

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
                             @foreach ($mantenimientos as $mante)  
                  <tr>
                          <td style="text-align: center"><?php 
                            echo $i=$i+1;
                          ?></td>
                          <td >{{$mante->tipo}}</td>
                          @if ($mante->costo==null)
                          <td style="text-align: center;" >----------------</td>
                          @else
                          <td>{{$mante->costo}}</td>
                          @endif
                          @if ($mante->fecha_ingresa==null)
                          <td style="text-align: center;">----------------</td>
                          @else
                          <td >{{$mante->fecha_ingresa}}</td>
                          @endif 
                          @if ($mante->fecha_salida==null)
                          <td style="text-align: center;">----------------</td>
                          @else
                          <td >{{$mante->fecha_salida}}</td>
                          @endif
                          <td >{{$mante->status}}</td>
@if($mante->status == 'ESPERA' & $mante->fecha_ingresa >= date("Y-m-d"))
<td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-arrow-right fa-2x" style="color:rgb(90, 69, 69);" title="Accion no permitida"></span></td>
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
<td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-window-close fa-2x" style="color:rgb(255, 47, 47);" title="Finalizar mantenimiento"></span></td>
@endif
<!-- si esta en espera se puede cancelar, debera aparecer el boton de cancelar -->
@if($mante->status == 'ESPERA')
<td style="text-align: center"> <a href="{{ route('modificarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-trash-o fa-2x" style="color:red;" title="Eliminar"></span></td>   
@else
<td style="text-align: center"><span class="fa fa-trash-o fa-2x" style="color:rgb(90, 69, 69);" title="Acción no permitida"></span></td>   
@endif
                        </tr> 
                  @endforeach      
                        </tbody>
                    </table>
          </div>
          <div class="modal" id="modal-warning">
                <div class="modal-dialog modal-lg" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:red;" title="Cerrar">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <table class="table">
                            @foreach ($taller as $tal)
                          <tr class="col-md-4">                       
                            <td class="col-md-6">{{$tal->nombreservicio}}</td>
                            <td class="col-md-1"><input type="checkbox" class="custom-control-input" id="{{$tal->nombreservicio}}" name="servicios[]" value="{{$tal->nombreservicio}}"></td>
                          </tr>
                          @endforeach
                      </table>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary " data-dismiss="modal">Agregar</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              </div>
    </section>



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
  <td><form action ="{{route('reservacion',$alquiler->id_reservacion)}}" method ="GET" enctype="multipart/form-data" target="_blank">
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
              <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Cerrar</button>
              {{-- <a href="{{ route('DeleteVehiculo',['vehiculo'=>$alquiler->id_vehiculo]) }}" class="btn btn-primary" > --}}
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

     var obj= document.getElementById("botonespera");
     obj.click();
     } );
    </script>
<script>
        $(document).ready(function() {
             $('#example').DataTable( {
              "scrollY":"300px",
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