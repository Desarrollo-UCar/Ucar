@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
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
                  <h3 class="box-title">Nuevo Usuario</h3>
                </div>
                             
                <form action="{{ route('user.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf                

                    {{-- FORMULARIO DE NOMBRES --}}
                    
                      <div class="form-group col-md-4">
                          <label>Nombres</label>
                          <input type="text" class="form-control" placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus required>
                      </div>
                        {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                        
                        <div class="form-group col-md-4">
                            <label>Primer Apellido</label>
                            <input type="text" class="form-control" placeholder="primerApellido" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        
                          {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                          
                          <div class="form-group col-md-4">
                              <label>Segundo Apellido</label>
                              <input type="text" class="form-control" placeholder="segundoApellido" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                          </div>


                          <div class="form-group col-md-4">
                              <label>Correo</label>
                              <input type="email" class="form-control" placeholder="Correo Eléctronico" name="email" required>
                          </div>

                          {{-- FORMULARIO DE LA CONTRASEÑA --}}
                          
                          <div class="form-group col-md-4">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" placeholder="Correo Eléctronico" name="password" required>
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
</body>
</html>
  
  
