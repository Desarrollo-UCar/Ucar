@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Servicio</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
 
</head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Gerente</small>
        </h1>        
    </section>
   
    <section class="content">
      
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Servicio Extra</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
                <form action="{{ route('servicioe.update',$servicio->idserviciosextra)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="box-body">           
                        @if (session()->has('msj'))
                        <div class="alert alert-success" role="alert">{{session('msj')}}</div>                                    
                                  @endif 
                                  @if (session()->has('errormsj'))
                        <div class="alert alert-danger" role="alert">{{session('msj')}}</div>                                    
                                  @endif                           
                    <div class="col-md-6">
                     
                        <div class="col-md-6 form-group">
                            <label>Nombre</label>
                        <input type="text" name="nombre" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$servicio->nombre}}" >
                        </div>
                        
                        <div class="form-group col-md-6">
                          <label>Estatus</label>
                          <select class="form-control"  name="disponibilidad" onchange="Tipo();">
                         @if ($servicio->disponibilidad!= 'DISPONIBLE')
                          <option>{{$servicio->disponibilidad}}</option>
                         <option>DISPONIBLE</option>
                         @endif
                         @if ($servicio->disponibilidad!= 'NO DISPONIBLE')
                          <option>{{$servicio->disponibilidad}}</option>
                         <option>NO DISPONIBLE</option>
                         @endif                                                       
                          </select>
                      </div> 

                        <div class="col-md-6 form-group">
                          <label>Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" min="0.00" placeholder="0.00" value="{{$servicio->precio}}" required>
                        </div>

                          <div class="form-group col-md-6">
                            <label>Sucursal</label>
                            <select class="form-control" id="example" name="sucursal">
                                    <option>{{$foranea->nombre}}</option>
                                    @foreach ($sucursal as $sucursal)
                                    @if ($sucursal->nombre!=$foranea->nombre)
                                    <option>{{$sucursal->nombre}}</option>                                  
                                    @endif                              
                                    @endforeach                             
                                  </select>
                        </div>
                        
                        <div class="col-md-6 form-group">
                          <label>Cantidad</label>
                        <input type="number" step="0.01" name="cantidad" class="form-control" min="0.00" placeholder="0.00" value="{{$serviciosucursal->cantidad}}" required>
                        </div>

                    <div class="col-md-6 form-group">
                        <label>Descripcion</label>
                    <textarea name="descripcion" id="" cols="30" rows="1" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">{{$servicio->descripcion}}</textarea>
                    </div>
                    </div>

                    

                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                            @if ($servicio->foto == null)
                            <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 450px; height: 400px;" >
                            @else
                            <img src="{{ asset('storage').'/'.$servicio->foto }}"style="width: 450px; height: 400px;" >
                            @endif
                         
                        </div>
                        <hr>
                        <div class="col-md-1 col-md-offset-5  file-loading">
                        <span class="btn btn-primary btn-file"> Subir Foto
                        <input id="foto"  type="file" name="foto" value="{{$servicio->foto }}"/></span>  
                        </div> 
                  </div>                 
                  <!-- /.box-body -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                          
                          <div class="box-footer" style="float: right">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">
                                        Cancelar
                                      </button>
                              </div>                  
                      </div>                    
                  </div>
                </form>
              </div>
    </section>

    <div class="modal modal-warning fade" id="modal-warning" style="color:gray">
            <div class="modal-dialog" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Esta seguro de cancelar el proceso? </b> </h4>
                </div>
                <div class="modal-body">
                  <p>La transaccion de los datos serán cancelados&hellip;</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>
                <a href="{{route('servicioe.index')}}" class="btn btn-danger"> Cancelar </a>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

@endsection


@section('scripts')
<script>
document.getElementById("foto").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let preview = document.getElementById('preview'),
            image = document.createElement('img');

    image.src = reader.result;
    image.getElementsByClassName('rounded-circle');
    image.style.width="400px";
    image.style.height="400px";
    preview.innerHTML = '';
    preview.append(image);
  };
}
</script>
@endsection

                  

</body>
</html>