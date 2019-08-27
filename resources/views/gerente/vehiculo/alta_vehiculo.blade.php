@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta vehiculo</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
 
</head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Alta vehículo</small>
        </h1>
        
    </section>


    <section class="content">
       
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Vehículo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
              <form action="{{ route('vehiculo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">           
                                                        
                                       
                    <div class="col-md-6">
                     
                        <div class="col-md-6 form-group">
                            <label>Número VIN</label>
                          <input type="text" name="vin" id="primero" class="form-control" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" 
                         pattern="[0-9|A-Z]{17}" required maxlength="17">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Placas</label>
                          <input type="text" name="matricula" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" pattern="[A-Z]{3}-[0-9]{2}-[0-9]{2}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label>Marca</label>
                          <input type="text" name="marca" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                          </div>

                          <div class="col-md-6 form-group">
                              <label>Año</label>
                              <?php
                                  $cont = date('Y');
                              ?>
                                  <select id="sel1" name="anio" class="form-control">
                                      <?php while ($cont >= 2000) { ?>
                                        <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                      <?php $cont = ($cont-1); } 
                                      ?>
                                  </select>
                          
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label>Transmisión</label>
                                <input type="text" name="transmicion" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                              </div>
                              <div class="col-md-6 form-group">
                                  <label>Puertas</label>
                                  <input type="number" name="puertas" id="" class="form-control" max="10" min="0" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Rendimiento</label>
                                    <input type="text" name="rendimiento" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                  </div>
                                                    
                              <div class="col-md-6 form-group">
                                  <label>Color</label>
                                  <input type="text" name="color" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>

                                <div class="col-md-6 form-group">
                                  <label>Tipo</label>
                                  <input type="text" name="tipo" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Número de pasajeros</label>
                                    <input type="number" min="0" name="pasajeros" id="" class="form-control">
                                  </div>

                                  <div class="col-md-6 form-group">
                                      <label>Maletero</label>
                                      <input type="text" name="maletero" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Cilindros</label>
                                        <input type="number" min="0" name="cilindros" class="form-control" required>
                                      </div>
                                      
                                      <div class="col-md-6 form-group">
                                          <label>Kilometraje</label>
                                          <input type="number" step="0.00" name="kilometraje" id="" min="0.00" class="form-control"  required>
                                        </div>

                                            <div class="col-md-6 form-group">
                                              <label>Precio compra</label>
                                              <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00" required>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Precio renta</label>
                                                <input type="number" step="0.01" min="0" name="precio" id="" placeholder="0.00" min="0.00" class="form-control" required>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label>descripción</label>
                                                <input type="text" name="descripcion" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                              </div>
                                             <div class="form-group col-md-6">
                                                <label>Sucursal</label>
                                                <select class="form-control" name="sucursal">
                                                  @foreach ($sucursal as $sucursal)
                                                  <option>{{$sucursal->nombre}}</option>
                                                  @endforeach                             
                                                </select>
                                            </div>    
                                            <div class="form-group col-md-6">
                                              <label>Estatus</label>
                                              <select class="form-control" name="status">
                                                <option>ACTIVO</option> 
                                                <option>INACTIVO</option>
                                              </select>
                                          </div>  
                    </div>

                    <div class="col-md-6">
                        <div id="preview" style="margin-top: 5%;">
                         <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 400px; height: 400px;" >
                        </div>
                        <hr>
                        <div class="col-md-1 col-md-offset-5  file-loading">
                        <span class="btn btn-primary btn-file"> Subir Foto
                        <input id="foto" type="file" name="foto"/>    </span>  
                        </div> 
                  </div> 
                   
                    
              
                    

                  <!-- /.box-body -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                        <div class="box-footer" style="float: right">
                          <a href="{{ route('vehiculo.create') }}" class="btn btn-danger">Cancelar</a>
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
    image.style.width="450px";
    image.style.height="450px";
    preview.innerHTML = '';
    preview.append(image);
  };
}
</script>
@endsection

                  

</body>
</html>
  
  
