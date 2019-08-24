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
               Por favor de rellenar los campos correctamente
        </div>
    @endif
    @if (session()->has('msj'))
    <div class="alert alert-info" role="alert">{{session('msj')}}</div>                                    
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
                <form action="{{ route('mantenimiento.update',$mantenimiento->idmantenimiento)}}" method="POST" enctype="multipart/form-data" id="form">
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
                                <input type="text" name="modelo" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->modelo}}" readonly>
                        </div>

                        
                        <div class="col-md-6 form-group">
                            <label>No. Economico</label>
                                <input type="text" name="matricula" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$mantenimiento->matricula}}" readonly>
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
                        <input type="date" name="fecha_ingresa" class="form-control" required value="{{$mantenimiento->fecha_ingresa}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                                <label>Fecha Regreso</label>
                                <input type="date" name="fecha_salida" class="form-control" value="{{$mantenimiento->fecha_salida}}">
                              </div>

                        <div class="col-md-6 form-group">
                                <label>Kilometraje</label>
                                <input type="number" step="0.00" name="kilometraje" id="" min="0.00" class="form-control" value="{{$mantenimiento->kilometraje}}"  required>
                        </div>

                         
                        
                        <div class="col-md-6 form-group">
                          <label>Costo</label>
                          <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00" value="{{$mantenimiento->costo_total}}" required>
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
                                <img src="{{ asset('storage').'/'.$mantenimiento->foto}}" style="width: 100%; height: 100%;" >  
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
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
                            <button type="submit" class="btn btn-primary">Finalizar</button>
                          </div>
                        <div class="box-footer" style="float: right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal"> Cancelar</button>
                          </div>                       
                      </div>                    
                  </div>
                </form>
              </div>
    </section>
   
    <div class="modal modal-warning fade" id="modal">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Cancelar mantenimiento </b> </h4>
            </div>
            <div class="modal-body">
              <p>Está seguro cancelar&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>
            <a href="{{ URL::previous()}}" class="btn btn-danger">Continuar</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

@endsection

@section('scripts')


@endsection

                  

</body>
</html>