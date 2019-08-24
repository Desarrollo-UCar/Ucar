@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Empleado</title>
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
        @if ($errors->any())
        <div class="alert alert-danger">            
               Por favor de rellenar los campos correctamente
        </div>
    @endif

    @if (session()->has('mensaje'))
    <div class="alert alert-danger" role="alert">{{session('mensaje')}}</div>                                    
    @endif 

    @if (session()->has('msj'))
    <div class="alert alert-" role="alert">{{session('msj')}}</div> <div class="alert alert-info" role="alert">{{session('msj')}} 
        <a href="{{route('empleado.index')}}" style="color:darkgreen"><b> ver todos los empleados</b></a>
        </div>                                                                    
    @endif 
            <div class="box box-primary">
             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo administrador</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                <!-- FORM PARA PREVISUALIZAR FOTO -->
              <form action="{{ route('empleado.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">           
                      <div class="col-md-4 col-md-offset-5  file-loading">
                        <div id="preview" >
                         <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" style="width: 200px;height:200px;border-radius: 50%;">
                        </div>
                        <div class="col-md-1 col-md-offset-2  file-loading">
                        <span class="btn btn-primary btn-file"> Subir Foto
                        <input id="foto" type="file" name="foto" value="null"></span>  
                        </div> 
                  </div>                
                                                                      
                         {{-- FORMULARIO DE ID PERSONA --}}  
                    <div class="row" style="margin-left: 0.1%;margin-right: 0.1%;">
                      <div class="form-group col-md-4">
                          <label>Curp</label>
                        <input type="text" class="form-control" autofocus placeholder="curp" name="curp" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('curp') }}" pattern="[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9|A-Z][0-9]" maxlength="18"  required>
                      </div>
                    </div>                  

                    {{-- FORMULARIO DE NOMBRES --}}
                    
                      <div class="form-group col-md-4">
                          <label>Nombres</label>
                          <input type="text" class="form-control" placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('nombres') }}" required>
                      </div>
                        {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                        
                        <div class="form-group col-md-4">
                            <label>Primer Apellido</label>
                            <input type="text" class="form-control" placeholder="primerApellido" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('primerApellido') }}" required>
                        </div>
                        
                          {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                          
                          <div class="form-group col-md-4">
                              <label>Segundo Apellido</label>
                              <input type="text" class="form-control" placeholder="segundoApellido" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('segundoApellido') }}" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Fecha de Nacimiento</label>
                              <input type="date" class="form-control" placeholder="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>nacionalidad</label>
                              <input type="text" class="form-control" placeholder="nacionalidad" name="nacionalidad" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('nacionalidad') }}" required>
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
                            <label>Pais</label>
                            <input type="text" class="form-control" placeholder="pais" name="pais" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('pais') }}" required>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Estado</label>
                          <input type="text" class="form-control" placeholder="estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('estado') }}" required>
                      </div>

                          <div class="form-group col-md-4">
                              <label>Ciudad</label>
                              <input type="text" class="form-control" placeholder="ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('ciudad') }}" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Colonia</label>
                              <input type="text" class="form-control" placeholder="colonia" name="colonia" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('colonia') }}" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Calle</label>
                              <input type="text" class="form-control" placeholder="calle" name="calle" value="{{ old('calle') }}" required>
                          </div>

                          <div class="form-group col-md-4">
                              <label>Número</label>
                              <input type="number" class="form-control" placeholder="Número de casa" name="numero" onkeyup="javascript:this.value=this.value.toUpperCase();"value="{{ old('numero') }}" min="0" required>
                          </div>

                          <div class="form-group col-md-4">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" placeholder="Teléfono" name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ old('telefono') }}" required>
                        </div> 

                          <div class="form-group col-md-4">
                              <label>Correo</label>
                              <input type="email" class="form-control" placeholder="Correo Eléctronico" name="correo" value="{{ old('correo') }}" required>
                          </div>

                          
                          <div class="form-group col-md-4">
                            <label>Tipo de empleado</label>
                            <select class="form-control" id="example" name="tipo" onchange="Tipo();">
                              <option>ADMINISTRADOR</option>
                              <option>CHOFER</option>
                              <option>EMPLEADO</option>
                            </select>
                        </div>

                       
                        <div class="form-group col-md-4">
                          <label>Sucursal</label>
                          <select class="form-control" id="example" name="sucursal" onchange="Tipo();">
                            @foreach ($sucursal as $sucursal)
                            <option>{{$sucursal->nombre}}</option>
                            @endforeach                             
                          </select>
                      </div>    
                      <div class="form-group col-md-4">
                        <label>Status</label>
                        <select class="form-control" name="status">
                          <option>ACTIVO</option> 
                          <option>INACTIVO</option>
                        </select>
                    </div>                      

                        <div class="row" id="uno" style="display: none;">
                          <div class="col-md-12">
                            <div class="col-md-2 col-md-offset-5">
                              <label>-- Datos de licencia -- </label>
                            </div>
                          </div>  
                        </div>

                        <div class="form-group col-md-4" style="display: none;" id="licencia">
                            <label>Número de licencia</label>
                            <input type="number" class="form-control" name="numLicencia" id="prueba" placeholder="Número de licencia" value="{{ old('numLicencia') }}">
                        </div>
                        
                        <div class="form-group col-md-4" style="display: none;" id="expedicion">
                          <label>Fecha de expedición</label>
                          <input type="date" class="form-control" name="licenciaFechaExpedicion" id="prueba"  placeholder="Fecha de expedición de licencia" value="{{ old('licenciaFechaExpedicion') }}">
                      </div>

                      <div class="form-group col-md-4" style="display: none;" id="vencimiento">
                        <label>Fecha de vencimiento</label>
                        <input type="date" class="form-control" name="licenciaFechaExpiracion" id="prueba"  placeholder="Fecha de expiración de licencia" value="{{ old('licenciaFechaExpiracion') }}">
                    </div>
                          {{--  --}}
                   
      
                  <!-- /.box-body -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer" style="float: right">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                        <div class="box-footer" style="float: right">
                            <a href="{{ route('empleado.create') }}" class="btn btn-danger">Cancelar</a>
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
    image.style.width="200px";
    image.style.height="200px";
    image.style.borderRadius="50%";
    preview.innerHTML = '';
    preview.append(image);
  };
}

</script>
 <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
 <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
 <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>

  <!-- Select2 -->
  <script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>

 <script>
   $(function () {
     //Initialize Select2 Elements
     $('.select2').select2() 
   
     $('[data-mask]').inputmask()
   })
 </script>
 <script>
   function Tipo(){
    var opcion= document.getElementById("example");
    var texto = opcion.options[opcion.selectedIndex].text;
    document.getElementById("prueba").value=texto;
    
    var row = document.getElementById("uno");
    var lice = document.getElementById("licencia");
    var expe = document.getElementById("expedicion");
    var venc = document.getElementById("vencimiento");
    
    if (texto=='CHOFER') {
      row.style.display='block';
      lice.style.display='block';      
      expe.style.display='block';
      venc.style.display='block';
    }else{
      row.style.display='none';
      lice.style.display='none';     
      expe.style.display='none';
      venc.style.display='none';
      }
  }
 </script>

@endsection

                  

</body>
</html>
  
  
