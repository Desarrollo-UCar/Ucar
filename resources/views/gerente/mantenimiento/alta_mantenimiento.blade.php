@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mantenimiento</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
 
</head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Mantenimiento</small>
        </h1>        
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
            <div class="box box-primary"> 
                          
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo mantenimiento</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
                <form action="{{ route('mantenimiento.store')}}" method="POST" enctype="multipart/form-data" id="form">
                  @csrf
                  <div class="box-body">   
                                 
                    <div class="col-md-6">

                        <div class="col-md-6 form-group">
                            <label>Sucursal</label>
                                <input type="text" name="sucursal" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->nombre}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Año</label>
                                <input type="text" name="anio" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->anio}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Marca vehiculo</label>
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
                            <label>No. Economico</label>
                                <input type="text" name="matricula" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehiculo->matricula}}" readonly>
                            </div>
                            <hr width="90%"/>


                        <div class="form-group col-md-6">
                          <label>Tipo de servicio</label>
                          <select class="form-control"  name="tipo"> 
                            <option>PREVENTIVO</option>
                            <option>CORRECTIVO</option>                                                       
                          </select>
                      </div> 

                        <div class="col-md-6 form-group">
                          <label>Fecha salida</label>
                          <input type="date" name="fecha_ingresa" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group">
                                <label>Fecha Regreso</label>
                                <input type="date" name="fecha_salida" class="form-control">
                              </div>

                        <div class="col-md-6 form-group">
                                <label>Kilometraje</label>
                                <input type="number" step="0.00" name="kilometraje" id="" min="0.00" class="form-control" value="{{$vehiculo->kilometraje}}"  required>
                        </div>

                         
                        
                        <div class="col-md-6 form-group">
                          <label>Costo</label>
                          <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00">
                        </div>

                    <div class="col-md-6 form-group">
                            <label>Agregar descripción</label>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-warning" id="boton">
                                Continuar
                              </button>
                    </div>                
                    </div>

                    

                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                                <img src="{{ asset('storage').'/'.$vehiculo->foto}}" style="width: 100%; height: 100%;" >  
                        </div>                
                  </div>    
                  
                  
                  <div class="modal" id="modal-warning">
                      <div class="modal-dialog" >
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:red;" title="Cerrar">
                              <span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                  
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"></th>
                          <th scope="col">Servicio</th>
                          <th scope="col">Seleccionar</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($taller as $tal)
                        <tr>
                          <th scope="row">o</th>
                          <td>{{$tal->nombreservicio}}</td>
                          <td><input type="checkbox" class="custom-control-input" id="{{$tal->nombreservicio}}" name="servicios[]" value="{{$tal->nombreservicio}}"></td>
                        </tr>
                        @endforeach
                      </tbody>
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


                  <!-- /.box-body -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                          </div>                       
                      </div>                    
                  </div>
                </form>
              </div>
    </section>
   

@endsection

@section('scripts')


@endsection

                  

</body>
</html>