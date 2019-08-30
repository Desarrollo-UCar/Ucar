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
          Panel de administración |
          <small>Alta sucursal</small>
        </h1>
        
    </section>

    <section class="content">


      {{--CODIGO PHP PARA LA VALIDACION DE ESTADOS POR CODIGO POSTAL--}}



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
            
              
               @csrf
                

                 {{--NOMBRE DE LA SUCURSAL--}}  
                 <div class="form-group col-md-4">
                                       
                  <label>Nombre de la sucursal
                      @error('nombre')                           
                        <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i>
                        @enderror </label>                      
                  <input type="text" class="form-control"  placeholder="Nombre de la sucursal"
                 name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('nombre')}}" autofocus >
              </div>
                    {{--DATO DE DIRECCION--}}
                 <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-2 col-md-offset-5">
                      <label>-- Dirección -- </label>
                    </div>
                  </div>  
                </div>

                {{--CODIGO POSTAL--}}
                <div class="form-group col-md-4">
                    <label>Código Postal
                        @error('codigopostal')                       
                        <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i>                      
                      @enderror 
                    </label>
                    <input type="text" class="form-control" placeholder="Codigo postal" name="codigopostal"  data-inputmask='"mask": "99999"' data-mask value="{{old('codigopostal')}}" id="codigo_postal">
                    
                    
                </div>
                        {{--DATOS PARA EL ESTADO--}}
                    <div class="form-group col-md-4">
                        <label>Estado
                            @error('estado')                         
                            <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i>
                          @enderror
                        </label>
                        <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('estado')}}" id="estado">
                    </div>
                       
                      {{--DATOS PARA EL MUNICIPIO--}}
                      <div class="form-group col-md-4">
                          <label>Municipio
                              @error('municipio')                      
                              <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i>                      
                            @enderror
                          </label>
                          <input type="text" class="form-control" placeholder="Municipio" name="municipio" onkeyup="javascript:this.value=this.value.toUpperCase();"  value="{{old('municipio')}}"id="municipio" >
                      </div>

                      {{--DATOS DE LA COLONIA--}}
                <div class="form-group col-md-4">
                    <label>Colonia
                        @error('colonia')                           
                        <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i> 
                       @enderror
                    </label>
                    <select class="form-control" id="colonia" name="colonia" id="colonia">
                      <option value="">Ninguno</option>
                    </select>
                </div>   

                  {{--DATOS PARA EL DOMICILIO--}}
                <div class="form-group col-md-4">
                    <label>Calle</label>
                    <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('calle')}}">
                </div>

                <div class="form-group col-md-4">
                    <label>Número
                        @error('numero') 
                        <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i>  
                      @enderror
                    </label>
                    <input type="text" class="form-control" placeholder="Número de casa" name="numero" value="{{old('numero')}}" maxlength="5"> 
                </div>
                
                {{--DATOS PARA EL TELEFONO--}}
                <div class="form-group col-md-4">
                    <label>Teléfono
                        @error('telefono')                        
                        <i class="fa fa-exclamation-triangle" style="color:red;" aria-hidden="true">{{ $message }}</i>
                        @enderror
                    </label>
                    <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                    data-inputmask='"mask": "9999999999"' data-mask value="{{old('telefono')}}">
                </div>                             
                              

              <!-- /.box-body -->
              <div class="row">
                <div class="col-md-12">
                    <div class="box-footer" style="float: right">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                      </div>
                    <div class="box-footer" style="float: right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning">Cancelar</button>
                      </div>                       
                  </div>                    
              </div>
              

            </form>
          </div>
     
     </div>
</section> 

<div class="modal modal-danger fade" id="modal-warning">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Está seguro de cancelar? </b> </h4>
        </div>
        <div class="modal-body">
          <p>Si cancela la operación sus datos no serán registrados&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Cerrar</button>
        <a href="{{route('sucursal.create')}}" class="btn btn-warning">Aceptar</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection    
       @section('scripts')
       <!-- InputMask -->
       <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.js")}}"></script>
       <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
       <script src= "{{asset("assets/$theme/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
   
        <!-- Select2 -->
        <script src= "{{asset("assets/$theme/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
     
  {{--script para municpios--}}
  <script src="{{URL::asset('/js/heroku.js')}}"></script>
       <script>
         $(function () {
           //Initialize Select2 Elements
           $('.select2').select2()           
           $('[data-mask]').inputmask()
           $("#example2").inputmask("Regex");
         })
       </script>


       @endsection   
</body>
</html>
  
  
