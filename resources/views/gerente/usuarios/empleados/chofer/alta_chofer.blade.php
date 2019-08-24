@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
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
        <div class="col-md-12" style="margin-top: 2%;">
            <div class="box box-primary">
             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo administrador</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
              <form role="form">
                  <div class="box-body">           
               <div class="col-md-4 col-md-offset-5  file-loading">
                        <div id="preview" >
                         <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 200px;height:200px;border-radius: 50%;">
                        </div>
                        <div class="col-md-1 col-md-offset-2  file-loading">
                        <span class="btn btn-primary btn-file"> Subir Foto
                        <input id="file" type="file"/>    </span>  
                        </div> 
                  </div>                
                                                                      
                         {{-- FORMULARIO DE ID PERSONA --}}  
                    <div class="row" style="margin-left: 0.1%;margin-right: 0.1%;">
                      <div class="form-group col-md-4">
                          <label>Curp</label>
                        <input type="text" class="form-control" autofocus placeholder="Curp" name="id" required>
                      </div>
                    </div>                  

                    {{-- FORMULARIO DE NOMBRES --}}
                    
                      <div class="form-group col-md-4">
                          <label>Nombres</label>
                          <input type="text" class="form-control" placeholder="Nombres" name="nombres" required>
                      </div>
                        {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                        
                        <div class="form-group col-md-4">
                            <label>Primer Apellido</label>
                            <input type="text" class="form-control" placeholder="Primer Apellido" name="ap_paterno" required>
                        </div>
                        
                          {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                          
                          <div class="form-group col-md-4">
                              <label>Segundo Apellido</label>
                              <input type="text" class="form-control" placeholder="Segundo Apellido" name="ap_materno" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Fecha de Nacimiento</label>
                              <input type="date" class="form-control" placeholder="Fecha nacimiento" name="fecha_nacimiento" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Cédula</label>
                              <input type="text" class="form-control" placeholder="Cedula" name="cedula" required>
                          </div>
                          {{-- FORMULARIO DIRECCION--}}
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-2 col-md-offset-5">
                                <label>-- Dirección -- </label>
                              </div>
                            </div>  
                          </div>

                          <div class="form-group col-md-4">
                              <label>Ciudad</label>
                              <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Colonia</label>
                              <input type="text" class="form-control" placeholder="Colonia" name="colonia" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Calle</label>
                              <input type="text" class="form-control" placeholder="Calle" name="calle" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Número</label>
                              <input type="number" class="form-control" placeholder="Número de casa" name="numero" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Teléfono</label>
                              <input type="number" class="form-control" placeholder="Teléfono" name="telefono" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Correo</label>
                              <input type="email" class="form-control" placeholder="Correo Eléctronico" name="correo" required>
                          </div>

                          {{--  --}}
                          
                            
                          <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-2 col-md-offset-5">
                                <label>-- Licencia -- </label>
                              </div>
                            </div>  
                          </div>

                          <div class="form-group col-md-4">
                            <label>Licencia</label>
                            <input type="text" class="form-control" placeholder="Licencia" name="licencia" required>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Fecha Licencia </label>
                          <input type="date" class="form-control" name="fechalicencia" required>
                      </div>

                      <div class="form-group col-md-4">
                        <label>Fecha de caducidad de la licencia </label>
                        <input type="date" class="form-control" name="caducidad" required>
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
         
         </div>
    </section>
   

@endsection


@section('scripts')
<script>
document.getElementById("file").onchange = function(e) {
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
    image.style.width="200px";
    image.style.height="200px";
    image.style.borderRadius="50%";
    preview.innerHTML = '';
    preview.append(image);
  };
}
</script>
@endsection

                  

</body>
</html>
  
  
