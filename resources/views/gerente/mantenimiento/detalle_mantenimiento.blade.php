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
          Panel de administracion |
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
                                <input type="text" name="sucursal" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->nombre}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Año</label>
                                <input type="text" name="anio" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->anio}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Marca vehiculo</label>
                                <input type="text" name="marca" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->marca}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Servicio</label>
                                <input type="text" name="vin" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->vin}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Modelo</label>
                                <input type="text" name="nombre" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->modelo}}" readonly>
                        </div>

                        
                        <div class="col-md-6 form-group">
                            <label>No. Economico</label>
                                <input type="text" name="matricula" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->matricula}}" readonly>
                            </div>
                            <hr width="90%"/>


                        <div class="form-group col-md-6">
                          <label>Tipo de servicio</label>
                          <select class="form-control"  name="tipo" disabled> 
                            <option>{{$mantenimiento->serv}}</option>
                                                                                  
                          </select>
                      </div> 

                        <div class="col-md-6 form-group">
                          <label>Fecha salida</label>
                        <input type="date" name="fecha_ingresa" class="form-control" required value="{{$mantenimiento->fecha_ingresa}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                                <label>Fecha Regreso</label>
                                <input type="date" name="fecha_salida" class="form-control" value="{{$mantenimiento->fecha_regreso}}" readonly>
                              </div>

                        <div class="col-md-6 form-group">
                                <label>Kilometraje</label>
                                <input type="number" step="0.00" name="kilometraje" id="" min="0.00" class="form-control" value="{{$mantenimiento->kilometraje}}"  required readonly>
                        </div>

                         
                        
                        <div class="col-md-6 form-group">
                          <label>Costo</label>
                          <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00" value="{{$mantenimiento->costo_total}}" required readonly>
                        </div>

                                  
                    </div>

                    

                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                                <img src="{{ asset('storage').'/'.$mantenimiento->foto}}" style="width: 100%; height: 100%;" >  
                        </div>                
                  </div>    
                  
                  
                          <!-- /.box-body -->
                </form>

                <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6 col-md-offset-4">
                           <label>--Lista de servicios realizados al vehículo--<label>
                          </div>
                        </div>  
                      </div>

                <div class="box-body">
                        <table id="example" class="display nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Número</th>
                                    <th >Servicios</th>
                                    <th >Descripción</th>
                                    <th >Fecha Alta</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($servicios as $ser)                      
                      <tr>
                              <td style="text-align: center">{{$ser->idserviciotaller}}</td>
                              <td >{{$ser->nombreservicio}}</td>
                              @if ($ser->descripcion==null)
                              <td style="text-align: center;" >----------------</td>
                              @else
                              <td >{{$ser->descripcion}}</td>
                              @endif
                              @if ($ser->fecha==null)
                              <td style="text-align: center;">----------------</td>
                              @else
                              <td >{{$ser->fecha}}</td>
                              @endif                        
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