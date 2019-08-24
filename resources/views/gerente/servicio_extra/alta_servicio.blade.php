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
                <form action="{{ route('servicioe.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
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
                          <input type="text" name="nombre" id="" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" >
                        </div>
                        
                        <div class="form-group col-md-6">
                          <label>Estatus</label>
                          <select class="form-control"  name="disponibilidad" onchange="Tipo();">
                         
                            <option>DISPONIBLE</option>
                            <option>NO DISPONIBLE</option>
                                                       
                          </select>
                      </div> 

                        <div class="col-md-6 form-group">
                          <label>Precio</label>
                          <input type="number" step="0.01" name="precio" class="form-control" min="0.00" placeholder="0.00" required>
                        </div>

                          <div class="form-group col-md-6">
                            <label>Sucursal</label>
                            <select class="form-control" id="example" name="sucursal" onchange="Tipo();">
                              @foreach ($sucursal as $sucursal)
                              <option>{{$sucursal->nombre}}</option>
                              @endforeach                             
                            </select>
                        </div> 
                        
                        <div class="col-md-6 form-group">
                          <label>Cantidad</label>
                          <input type="number" step="0.01" name="cantidad" class="form-control" min="0.00" placeholder="0.00" required>
                        </div>

                    <div class="col-md-6 form-group">
                        <label>Descripcion</label>
                      <textarea name="descripcion" id="" cols="30" rows="1" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"  ></textarea>
                    </div>
                    </div>

                    

                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                         <img src="https://www.superimanes.com/c/48-category_default/servicios-extras.jpg" style="width: 100%; height: 100%;" >
                        </div>
                        <hr>
                        <div class="col-md-1 col-md-offset-5  file-loading">
                        <span class="btn btn-primary btn-file"> Subir Foto
                        <input type="file" name="foto" id="foto"/>    </span>  
                        </div> 
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
    image.style.width="100%";
    image.style.height="100%";
    preview.innerHTML = '';
    preview.append(image);
  };
}
</script>
@endsection

                  

</body>
</html>