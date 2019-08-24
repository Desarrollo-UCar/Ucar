@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Sucursal</title>
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
        <section class="content">
            @if ($errors->any())
            <div class="alert alert-danger">            
                   Por favor de rellenar los campos correctamente
            </div>
        @endif
        @if (session()->has('msj'))
        <div class="alert alert-info" role="alert">{{session('msj')}} 
        <a href="{{route('sucursal.index')}}" style="color:darkgreen"><b> ver todos los sucursales </b></a>
        </div>  
        @endif    
        <div class="col-md-12" style="margin-top: 2%;">
            <div class="box box-primary">             
                <div class="box-header with-border">
                  <h3 class="box-title">Nuevo Sucursal</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->


                       
                <form action="{{ route('sucursal.store') }}" method="POST">
                  {{-- FORMULARIO DE NOMBRES --}}
                  
                   @csrf
                     {{-- FORMULARIO DIRECCION--}}

                     <div class="form-group col-md-4">
                      <label>Nombre</label>
                      <input type="text" class="form-control" placeholder="Nombre de la sucursal" name="nombre"  onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus required>
                  </div>
                          
                     <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-2 col-md-offset-5">
                          <label>-- Dirección -- </label>
                        </div>
                      </div>  
                    </div>

                    <div class="form-group col-md-4">
                      <label>Pais</label>
                      <input type="text" class="form-control" placeholder="País" name="pais"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                  </div>
                  

                    <div class="form-group col-md-4">
                        <label>Estado</label>
                        <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label>Ciudad</label>
                      <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                  </div>

                    <div class="form-group col-md-4">
                        <label>Colonia</label>
                        <input type="text" class="form-control" placeholder="Colonia" name="colonia" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Calle</label>
                        <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Número</label>
                        <input type="number" class="form-control" placeholder="Número de casa" name="numero" min="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" placeholder="Teléfono" name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
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
       <!-- InputMask -->
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
       @endsection   
</body>
</html>
  
  
