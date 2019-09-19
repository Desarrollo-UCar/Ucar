@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
@endsection

@section('contenido')
<section class="content-header">
    <h1>
      Panel de administracion
      <small>Gerente</small>
    </h1>
</section>
<section class="content">

      <div class="box box-primary">
            <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                            <li><a href="#tab_3-2" data-toggle="tab">Categorias</a></li>
                            <li><a href="#tab_2-2" data-toggle="tab">Modelos</a></li>
                      <li class="active"><a href="#tab_1-1" data-toggle="tab">Marcas</a></li>

 
                      <li class="pull-left header"><i class="fa fa-th"></i>Datos de vehiculos</li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1-1">
                        <b>Registrar:</b>
                        <form action="{{ route('registrarMarca') }}" method="POST">
                                 @csrf
                                   <div class="row">
                                      <div class="col-md-12">
                                        <div class="col-md-8 col-md-offset-4">
                                          <label>-- Nueva marca de vehiculo -- </label>
                                        </div>
                                      </div>  
                                    </div>
                                   <div class="form-group col-md-4">
                                    <label>Nombre de la marca</label>
                                    <input type="text" class="form-control" placeholder="Nombre de la marca" name="nombre"  autofocus required>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-2" style="float: right">
                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                          </div>                 
                                      </div>                    
                                  </div>
                            </form>

                            <table id="example" class="display nowrap " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Número</th>
                                            <th >Nombre Marca</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($marcas as $marca)                      
                              <tr>
                                      <td style="text-align: center">{{$marca->id}}</td>
                                      <td >{{$marca->nombre}}</td>
                     
              

                                       

                                    </tr> 
                              @endforeach
                                    
                                    </tbody>
                                </table>

                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2-2">
                            <b>Registrar:</b>
                            <form action="{{ route('registrarModelo') }}" method="POST">
                                     @csrf
                                       <div class="row">
                                          <div class="col-md-12">
                                            <div class="col-md-8 col-md-offset-4">
                                              <label>-- Nuevo modelo de vehiculo -- </label>
                                            </div>
                                          </div>  
                                        </div>
                                       <div class="form-group col-md-4">
                                        <label>Marca</label>
                                        <select name= "marca" id="vehiculo" class="form-control select2" style="width: 100%;">
                                                @foreach($marcas as $marca)  
                                   <option value={{$marca->id}}>
                                {{$marca->nombre}}</option>
                                            @endforeach
                                              </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                            <label>Modelo</label>
                                            <input type="text" class="form-control" placeholder="Modelo del auto" name="modelo"  autofocus required>
                                        </div>
    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group col-md-2" style="float: right">
                                                <button type="submit" class="btn btn-primary">Agregar</button>
                                              </div>                 
                                          </div>                    
                                      </div>
                                </form>
    
                                <table id="example" class="display nowrap " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Marca</th>
                                                <th >Modelo</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($marcasm as $carro)                      
                                  <tr>
                                          <td style="text-align: center">{{$carro->nombre}}</td>
                                          <td >{{$carro->nombre2}}</td>
                         
                  
                                        </tr> 
                                  @endforeach
                                        
                                        </tbody>
                                    </table>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_3-2">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>

          <!-- /.box-body-->
        </div>


    </section>
@endsection

@section('scripts')

@endsection