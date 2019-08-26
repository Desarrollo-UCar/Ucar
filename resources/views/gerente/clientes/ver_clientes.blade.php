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

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                 
                  <li><a href="#sales-chart" data-toggle="tab">Frecuentes</a></li>
                  <li class="active"><a href="#revenue-chart" data-toggle="tab">Todos</a></li>
                  <li class="pull-left header"><i class="fa fa-inbox"></i>Clientes </li>
                </ul>
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height:auto;   ">
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
                                    <th style="text-align: center;background: lightblue">Credencial</th>
                                    <th style="text-align: center;background: lightblue">Pasaporte</th>
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


                  {{-- SECCION DE CLIENTES FRECUENTES--}}
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height:auto;">
                      CLIENTES FRECUENTES
                      <?php $frecuentes = DB::table('reservacions')                                    
                                    ->join('clientes','idCliente','=','reservacions.id_cliente')
                                    ->select(DB::raw('count(*) as cantidad, reservacions.id_cliente,clientes.*'))
                                      ->groupBy('reservacions.id_cliente')
                                      ->orderBy('cantidad','desc')
                                      //->limit(10)
                                      ->get()
                                      ; 
                                    //  $frecuentes=array_reverse($frecuentes,true)
                      ?>
                        <table id="example2" class="display nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center;background: lightblue">Frecuencia</th>
                                    <th style="text-align: center;background: lightblue">Credencial</th>
                                    <th style="text-align: center;background: lightblue">Pasaporte</th>
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
                                 @foreach ($frecuentes as $fre)                      
                            <tr>
                                <td style="text-align: center">{{$fre->cantidad}}</td>
                                  @if ($fre->credencial==null)
                                  <td style="text-align: center">---------</td>
                                  @else
                                  <td style="text-align: center">{{$fre->credencial}}</td>
                                  @endif 
                                  @if ($fre->pasaporte==null)
                                  <td style="text-align: center">---------</td>
                                  @else
                                  <td style="text-align: center">{{$fre->pasaporte}}</td>
                                  @endif 
                              <td style="text-align: center">{{$fre->nombre}}</td>
                              <td style="text-align: center">{{$fre->primer_apellido}}</td>
                              @if ($fre->segundo_apellido==null)
                              <td style="text-align: center">---------</td>
                              @else
                              <td style="text-align: center">{{$fre->segundo_apellido}}</td>
                              @endif 
                              <td style="text-align: center">{{$fre->fecha_nacimiento}}</td>
                              <td style="text-align: center">{{$fre->nacionalidad}}</td>
                              <td style="text-align: center">{{$fre->correo}}</td>
                              <td style="text-align: center">{{$fre->telefono}}</td>
                              <td style="text-align: center">{{$fre->pais}}</td>
                              <td style="text-align: center">{{$fre->estado}}</td>
                              <td style="text-align: center">{{$fre->ciudad}}</td>
                              <td style="text-align: center">{{$fre->colonia}}</td>
                              <td style="text-align: center">{{$fre->calle}}</td>
                              <td style="text-align: center">{{$fre->created_at}}</td>
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
         $(document).ready(function() {
              $('#example').DataTable( {
                "scrollX": true,
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
                
              } );
          } );
         </script>
         <script>
            $(document).ready(function() {
                 $('#example2').DataTable( {
                   "scrollX": true,
                   "order": [[ 3, "desc" ]],
                   "language": {
                     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                   },                   
                 } );
             } );
            </script>
         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
         <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     @endsection
</body>
</html>
  
  
