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
        <section class="content">
            {{--@if ($errors->any())
            <div class="alert alert-danger">            
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif--}}
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
                      <input type="text" class="form-control"  placeholder="Nombre de la sucursal"
                     name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('nombre')}}" autofocus  required>
                     @error('nombre') 
                     <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                     @enderror                      
                  </div>
                          
                     <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-2 col-md-offset-5">
                          <label>-- Dirección -- </label>
                        </div>
                      </div>  
                    </div>
                    <div id="locationField">
                       
                      </div>
                      <div class="form-group col-md-4">
                          <label>Dirección</label>
                          <input id="autocomplete"  class="form-control"
                          placeholder="Introduzca su direccion"
                          onFocus="geolocate()" 
                          type="text" name="dire" value="{{old('dire')}}"/>
                      </div>

                    <table id="address">
                        <tr>   
                                              
                            <div class="form-group col-md-4">
                                <label>País</label>
                                <input type="text" class="form-control" placeholder="País" name="pais"  onkeyup="javascript:this.value=this.value.toUpperCase();" id="country" value="{{old('pais')}}" disabled="true" >

                                @error('pais') 
                                <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                                @enderror 
                            </div>
                         
                        </tr>

                        <tr>
                            
                        <div class="form-group col-md-4">
                            <label>Estado</label>
                            <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" id="administrative_area_level_1" value="{{old('estado')}}" disabled="true">
                            @error('estado') 
                            <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                            @enderror 
                        </div>
                           
                          </tr>

                      <tr>
                          <div class="form-group col-md-4">
                              <label>Ciudad</label>
                              <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();" id="locality" value="{{old('ciudad')}}" disabled="true">

                              @error('ciudad') 
                              <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                              @enderror 
                          </div>
                      </tr>
                     
                      
                    </table>
                   

                    <div class="form-group col-md-4">
                        <label>Colonia</label>
                        <input type="text" class="form-control" placeholder="Colonia" name="colonia" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('colonia')}}" required>
                        @error('colonia') 
                        <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                        @enderror 
                    </div>

                    <div class="form-group col-md-4">
                        <label>Calle</label>
                        <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('calle')}}">
                        @error('calle') 
                        <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                        @enderror 
                    </div>

                    <div class="form-group col-md-4">
                        <label>Número</label>
                        <input type="text" class="form-control" placeholder="Número de casa" name="numero" value="{{old('numero')}}" required>
                        @error('numero') 
                        <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                        @enderror 
                    </div>

                    <div class="form-group col-md-4">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" placeholder="Teléfono" name="telefono" 
                        data-inputmask='"mask": "9999999999"' data-mask value="{{old('telefono')}}" required>

                        @error('telefono') 
                     <strong class="col-md-12" style="color:red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $message }}</strong>
                     @enderror
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
        <script src="{{URL::asset('/js/apigoogle.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGDfu_8YDhR8k6LHqpGfQjCwC5YlxJ9Tk&libraries=places&callback=initAutocomplete"
        async defer></script>
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
  
  
