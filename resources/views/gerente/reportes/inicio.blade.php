@extends("theme.$theme.layout")
@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
@endsection
@section('contenido')
<section class="content-header">
    <h1>Reportes<small>Graficas</small></h1>
</section>
<section class="content"> 
    <div class="row">
        <div class="col-md-12 ">
          <!-- Line chart -->
          <div class="box box-primary">
              <div class="box-body">
                  <div class="row">
                    <!-- -->
                    <div class="col-md-3 col-lg-3 col-xs-6">
                    <a href="#mantenimientos" data-toggle="modal" class="small-box-footer">
                        <div class="small-box bg-teal-gradient">
                            <div class="inner">
                                <h3> <br> </h3>
                                <p> <b>Mantenimientos</b></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-gear-b"></i>
                            </div>
                            <div class="small-box-footer">
                                    Ver mas <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </a>
                    </div>  
                    <!-- -->
                    <div class="col-md-3 col-lg-3 col-xs-6">
                    <a href="#vehiculos" data-toggle="modal" class="small-box-footer">
                        <div class="small-box bg-blue-gradient">
                            <div class="inner">
                                <h3> <br> </h3>
                                <p> <b>Vehiculos</b></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-car"></i>
                            </div>
                            <div class="small-box-footer">
                                    Ver mas <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!-- -->
                    <div class="col-md-3 col-lg-3 col-xs-6">
                    <a href="#clientes" data-toggle="modal" class="small-box-footer">
                        <div class="small-box bg-yellow-gradient">
                            <div class="inner">
                                <h3> <br> </h3>
                                <p> <b>Clientes</b></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <div class="small-box-footer">
                                    Ver mas <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!-- -->
                    <div class="col-md-3 col-lg-3 col-xs-6">
                    <a href="#sucursales" data-toggle="modal" class="small-box-footer">
                        <div class="small-box bg-purple-gradient">
                            <div class="inner">
                                <h3> <br> </h3>
                                <p> <b>Sucursal</b></p>
                            </div>
                            <div class="icon">
                                <i class="ion-ios-home"></i>
                            </div>
                            <div class="small-box-footer">
                                    Ver mas <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!-- -->
                    </div>    
              </div>
              </div>
            </div>
        </div>
    </section>

    <!-- modales -->
 <!-- MANTENIMIENTOS -->
<div class="modal fade in" id="mantenimientos">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Ver cantidad de mantenimientos por vehiculos'}} </b> </h4>
    </div>
    <form method="GET" action="{{ route('reporteMantenimientos') }}"  role="form">
    {{ csrf_field() }}
        <div class="modal-body">
            <div class="box-body">
                <div class="row">
                <div class="col-md-12 ">
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Si lo requiere ingrese los siguientes campos.</label>
                            <label>Si necesita un periodo indíquelo a continuación.</label>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Desde</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  value="">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Al</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"  value="">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Filtrar por servicio</label>
                        <select name= "servicio" id="servicio" class="form-control select2" style="width: 100%;">
                            <option value="ninguno">No filtrar por servicio</option>
                            @foreach($serviciost as $servicio)
                            <option value="{{$servicio->idserviciotaller}}">{{$servicio->nombreservicio}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12  form-group">
                        <p><b>Se mostraran los mantenimientos coincidentes</b>&hellip;</p>
                    </div>
                </div>
                </div>
                </div>
            </div>   
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span> {{ 'Ver'}}</button>
        </div>
    </form>
    </div>
</div>
</div>
<!-- VEHICULOS -->
<div class="modal fade in" id="vehiculos">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Rentas e ingresos por vehículo'}} </b> </h4>
            </div>
            <form method="GET" action="{{ route('reporteVehiculos') }}"  role="form">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="box-body">
                        <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <div class="col-md-8 ">
                                    <label>Si lo requiere ingrese los siguientes campos.</label>
                                    <label>Si necesita un periodo indíquelo a continuación.</label>
                                </div>
                                <div class="col-md-4">
                                    <label>Filtrar por:</label>
                                    <select name= "consulta" id="servicio" class="form-control select2" style="width: 100%;">
                                        <option value="rentas">Rentas</option>
                                        <option value="ingresos">Ingresos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Desde</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Al</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"  value="">
                            </div>
                            <div class="col-md-12 form-group">
                                <p><b>Se mostraran los vehículos coincidentes</b>&hellip;</p>
                            </div>
                        </div>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span> {{ 'Ver'}}</button>
                </div>
            </form>
            </div>
        </div>
        </div>
<!-- CLIENTES -->
<div class="modal fade in" id="clientes">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Rentas e ingresos por vehículo'}} </b> </h4>
        </div>
        <form method="GET" action="{{ route('reporteClientes') }}"  role="form">
        {{ csrf_field() }}
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <div class="col-md-8 ">
                                <label>Si lo requiere ingrese los siguientes campos.</label>
                                <label>Si necesita un periodo indíquelo a continuación.</label>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Desde</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Al</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"  value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <p><b>Se mostraran los clientes coincidentes</b>&hellip;</p>
                        </div>
                    </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span> {{ 'Ver'}}</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<!-- CLIENTES -->
<div class="modal fade in" id="sucursales">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Rentas e ingresos por vehículo'}} </b> </h4>
        </div>
        <form method="GET" action="{{ route('reporteSucursales') }}"  role="form">
        {{ csrf_field() }}
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-12 ">
                        <div class="col-md-12 form-group">
                            <label>Si lo requiere ingrese los siguientes campos.</label>
                            <label>Si necesita un periodo indíquelo a continuación.</label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Filtrar por:</label>
                            <select name= "sucursal" id="servicio" class="form-control select2" style="width: 100%;" required>
                                @foreach($sucursales as $sucursal)
                                    <option>{{$sucursal->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Límite:</label>
                            <select name= "limite" id="limite" class="form-control select2" style="width: 100%;" required>
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Año o mes:</label>
                            <select name= "aniomes" id="aniomes" class="form-control select2" style="width: 100%;" required>
                                <option>año</option>
                                <option>mes</option>
                                <option>semana</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Desde</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Al</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"  value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <p><b>Se mostraran los clientes coincidentes</b>&hellip;</p>
                        </div>
                    </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span> {{ 'Ver'}}</button>
            </div>
        </form>
        </div>
    </div>
    </div>
      <!-- fin de los modales -->

@endsection

@section('scripts')
@endsection