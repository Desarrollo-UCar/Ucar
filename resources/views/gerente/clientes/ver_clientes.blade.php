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
          Panel de administración |
          <small>Clientes</small>
        </h1>
        
    </section>


         <!-- Content Wrapper. Contains page content -->
 
         <?php //$clientes = DB::table('clientes')->get(); ?>

    <!-- Main content -->
    <section class="content">

        <div class="row">
           
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <div class="btn-group pull-right" >
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" >
                          Mas opciónes
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#" id="frecuentes" onclick="mostrar()"><b>clientes frecuentes</b></a></li>
                          <li><a href="#" onclick="ingresos()"><b>Por ingresos</b></a></li>
                        </ul>
                      </div>
                  <li class="pull-left header"><i class="fa fa-inbox"></i>Clientes </li>
                </ul>
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height:auto;">
                      <form action="{{ route('cli')}}" method="POST" enctype="multipart/form-data" >
                    <div class="col-md-6 col-xs-offset-6" id="clifre" style="display: none;">
                                                <div class="col-md-6 form-group">
                              <label>Fecha inicial</label>
                                  <input type="date" name="fecha_inicio" id="" class="form-control" autofocus>
                          </div>
                          <div class="col-md-6 form-group">
                              <label>Fecha final</label>
                                  <input type="date" name="fecha_final" id="" class="form-control" autofocus>
                          </div>
                          <div class="box-footer" style="float: right">
                              <button type="submit" class="btn btn-primary">Consultar</button>
                            </div>
                            <div class="box-footer" style="float: right">
                                <a href="#" class="btn btn-danger" onclick="deshabilitar()">Cancelar</a>
                              
                              </div>                   

                    </div>
                  </form>

                  <form action="{{ route('mantenimiento.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="col-md-6 col-xs-offset-6" id="ingresos1" style="display: none;">
                       
                            <div class="col-md-6 form-group">
                                <label>Cantidad inicial</label>
                                <input type="number" step="0.00" name="cant_inicial" id="" min="0.00" class="form-control" value="0.00"  required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Cantidad final</label>
                                <input type="number" step="0.00" name="costo_final" id="" min="0.00" class="form-control" value="0.00" required>
                            </div>
                            <div class="box-footer" style="float: right">
                                <button type="submit" class="btn btn-primary">Consultar</button>
                              </div>
                              <div class="box-footer" style="float: right">
                                  <a href="#" class="btn btn-danger" onclick="deshabilitaringresos()">Cancelar</a>
                                
                                </div>
                                                              
                        
  
                      </div>
                    </form>
                    
                      @if (count($clientes)==0)
                      <div style="display: none;">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning" id="<?php 
                        echo "boton";
                      ?>">
                          </button>
                        </div>
                        @endif 

                        <table id="example" class="display nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center;background: lightblue">Identificación/Pasaporte</th>
                                    <th style="text-align: center;background: lightblue">Nombre</th>
                                    <th style="text-align: center;background: lightblue">Apellido Paterno</th>                              
                                    <th style="text-align: center;background: lightblue">Apellido Materno</th>   
                                    <th style="text-align: center;background: lightblue">Fecha Nacimiento</th>
                                    <th style="text-align: center;background: lightblue">Nacionalidad</th>
                                    <th style="text-align: center;background: lightblue">Correo</th>
                                    <th style="text-align: center;background: lightblue">Teléfono</th>
                                    <th style="text-align: center;background: lightblue">País</th>
                                    <th style="text-align: center;background: lightblue">Estado</th>
                                    <th style="text-align: center;background: lightblue">Ciudad</th>
                                    <th style="text-align: center;background: lightblue">Colonia</th>
                                    <th style="text-align: center;background: lightblue">Calle</th>
                                    <th style="text-align: center;background: lightblue">Fecha Alta</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($clientes as $cliente)                      
                            <tr>
                                  @if ($cliente->credencial==null)
                                  <td style="text-align: center">{{$cliente->pasaporte}}</td>
                                  @else
                                  <td style="text-align: center">{{$cliente->credencial}}</td>
                                  @endif 
                                 
                              <td style="text-align: center">{{$cliente->nombre}}</td>
                              <td style="text-align: center">{{$cliente->primer_apellido}}</td>
                              @if ($cliente->segundo_apellido==null)
                              <td style="text-align: center">---------</td>
                              @else
                              <td style="text-align: center">{{$cliente->segundo_apellido}}</td>
                              @endif 
                              <td style="text-align: center">{{date("d\-m\-Y", strtotime($cliente->fecha_nacimiento))}}</td>
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


                
                </div>
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
        function mostrar(){
document.getElementById('clifre').style.display = 'block';
document.getElementById('ingresos1').style.display = 'none';
}

function deshabilitar(){
document.getElementById('clifre').style.display = 'none';
}

function ingresos(){
document.getElementById('clifre').style.display = 'none';
document.getElementById('ingresos1').style.display = 'block';
}

function deshabilitaringresos(){
document.getElementById('ingresos1').style.display = 'none';
}
        </script>

         <script>
         $(document).ready(function() {
              $('#example').DataTable( {
                "scrollY": "400px",
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
  
  
