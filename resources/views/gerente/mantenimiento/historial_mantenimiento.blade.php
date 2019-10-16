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
        <h1>
          Panel de administración |
          <small>Detalle Mantenimiento</small>
        </h1>        
    </section>
   
    <section class="content">
      
            <div class="box box-primary"> 
                          
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo mantenimiento</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
                <form action="#" method="POST" enctype="multipart/form-data" id="form">
                  @csrf
                  @method('PUT')
                  <div class="box-body">   
                                 
                    <div class="col-md-6">

                        <div class="col-md-6 form-group">
                            <label>Sucursal</label>
                                <input type="text" name="sucursal" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->sucursal}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Año</label>
                                <input type="text" name="anio" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->anio}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Marca vehículo</label>
                                <input type="text" name="marca" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->marca}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Servicio</label>
                                <input type="text" name="vin" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->vin}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Modelo</label>
                                <input type="text" name="nombre" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->modelo}}" readonly>
                        </div>

                        
                        <div class="col-md-6 form-group">
                            <label>Placas</label>
                                <input type="text" name="matricula" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->matricula}}" readonly>
                            </div>
                            <hr width="90%"/>
                                  
                    </div>

                    

                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                                <img src="{{'/images/'.$vehiculo->foto}}" style="width: 100%; height: 100%;" >  
                        </div>                
                  </div>    
                  
                  
                          <!-- /.box-body -->
                </form>

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
                                    <th >Modificar</th>
                                    <th >Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                                   $i = 0;
                                ?>
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

                              <td style="text-align: center"> <a href="{{ route('mostrarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar"></span></td>

                              <td style="text-align: center"> <a href="{{ route('modificarmantenimiento',['mantenimiento'=>$mante->idmantenimiento,'vehiculo'=>$mante->vehiculo])}}"> <span class="fa fa-external-link-square fa-2x" style="color:blue;" title="ver detalles"></span></td> 
                                
                            </tr> 
                      @endforeach
                            
                            </tbody>
                        </table>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="box-footer" style="float: right">
                                        <a href="{{ URL::previous()}}" class="btn btn-success pull-left">Regresar</a>
                                      </div>                       
                                  </div>                    
                              </div>
              </div>
              
    </section>

@endsection

@section('scripts')

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