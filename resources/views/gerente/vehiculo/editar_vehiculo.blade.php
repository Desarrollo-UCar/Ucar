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
          Panel de administracion |
          <small>Gerente</small>
        </h1>
        
    </section>


    <section class="content">
       
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Vehiculo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
              <form action="{{ route('vehiculo.update',$vehi->idvehiculo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="box-body">           
                                                        
                                       
                    <div class="col-md-6">
                     
                        <div class="col-md-6 form-group">
                            <label>Número VIN</label>
                          <input type="text" name="vin" id="" class="form-control" autofocus value="{{$vehi->vin}}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Matricula</label>
                        <input type="text" name="matricula" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->matricula}}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label>Marca</label>
                          <input type="text" name="marca" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{$vehi->marca}}" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->modelo}}" required>
                          </div>

                          <div class="col-md-6 form-group">
                            <label>Año</label>
                            <?php
                                $cont = date('Y');
                            ?>
                                <select id="sel1" name="anio" class="form-control">
                                    <option value="{{$vehi->anio}}">{{$vehi->anio}}</option>
                                    <?php while ($cont >= 2000) { ?>
                                      @if ($cont!=$vehi->anio)
                                      <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>                            
                                      @endif
                                      <?php $cont = ($cont-1); } 
                                      ?>
                                     
                                </select>
                        
                          </div>

                          <div class="col-md-6 form-group">
                              <label>Transmisión</label>
                              <input type="text" name="transmicion" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->transmicion}}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Puertas</label>
                                <input type="number" name="puertas" id="" class="form-control" max="10" min="0" value="{{$vehi->puertas}}" required>
                              </div>

                              <div class="col-md-6 form-group">
                                  <label>Rendimiento</label>
                                  <input type="text" name="rendimiento" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                  value="{{$vehi->rendimiento}}" required>
                                </div>
                                                    
                              <div class="col-md-6 form-group">
                                  <label>Color</label>
                                  <input type="text" name="color" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->color}}" required>
                                </div>

                                <div class="col-md-6 form-group">
                                  <label>Tipo</label>
                                  <input type="text" name="tipo" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->tipo}}" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Número de pasajeros</label>
                                    <input type="number" min="0" name="pasajeros" id="" class="form-control" value="{{$vehi->pasajeros}}" required>
                                  </div>

                                  <div class="col-md-6 form-group">
                                      <label>Maletero</label>
                                      <input type="text" name="maletero" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->maletero}}" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Cilindros</label>
                                        <input type="number" min="0" name="cilindros" class="form-control"  value="{{$vehi->cilindros}}" required>
                                      </div>
                                      
                                      <div class="col-md-6 form-group">
                                          <label>Kilometraje</label>
                                          <input type="number" step="0.00" name="kilometraje" id="" min="0.00" class="form-control" value="{{$vehi->kilometraje}}"  required>
                                        </div>

                                            <div class="col-md-6 form-group">
                                              <label>Precio compra</label>
                                              <input type="number" step="0.01" name="costo" class="form-control" min="0.00" placeholder="0.00" value="{{$vehi->costo}}" required>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Precio renta</label>
                                                <input type="number" step="0.01" min="0" name="precio" id="" placeholder="0.00" min="0.00" class="form-control" value="{{$vehi->precio}}" required>
                                              </div>
                                              <div class="col-md-6 form-group">
                                                <label>descripción</label>
                                                <input type="text" name="descripcion" id="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$vehi->descripcion}}" required>
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
                                            <div class="form-group col-md-6">
                                                <label>Status</label>
                                                <select class="form-control" id="tipo" name="status">
                                                  <option>{{$vehi->estatus}}</option>
                                                  @if ($vehi->estatus=='ACTIVO')
                                                  <option>INACTIVO</option>                      
                                                  @else
                                                  <option>ACTIVO</option>
                                                @endif                          
                                                  
                                                </select>
                                            </div>
                    </div>

                    <div class="col-md-6 ">
                        <div id="preview" style="margin-top: 5%;">
                          :@if ($vehi->foto == null)
                          <img src="http://www.cespcampeche.gob.mx/repuve/images/chip-blanco-2.png" style="width: 100%; height: 100%;">
                          @else
                          <img src="{{ asset('storage').'/'.$vehi->foto}}" style="width: 100%; height: 100%;" >   
                          @endif
                        
                        </div>
                        <hr>
                        <div class="col-md-1 col-md-offset-5  file-loading">
                        <span class="btn btn-primary btn-file"> Subir Foto
                            <input id="foto" type="file" name="foto" value="{{$vehi->foto}}"></span>  
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
  
  
