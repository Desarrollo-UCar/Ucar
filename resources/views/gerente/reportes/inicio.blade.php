@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">

@endsection

@section('contenido')
<section class="content-header">
    <h1>
      Reportes      <small>Graficas</small>
    </h1>
</section>


<section class="content"> 


    <div class="row">
        <div class="col-md-12 ">
          <!-- Line chart -->
          <div class="box box-primary">
              <div class="box-body">

                  <div class="row">
      
                      <div class="col-md-3 col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue-gradient">
                          <div class="inner">
                            <h3> <br> </h3>
                    
                           <p> <b>Mantenimientos Vehiculos</b></p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-gear-b"></i>
                          </div>
                          <a href="#mantenimientos" data-toggle="modal" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>  
                      <!-- ./col -->
                    </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-7">
                    <table>
                      <tr>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Accion</th>
                      </tr>
                      <tr>
                        <td>Fecha de reservacion</td>
                        <td>Se puede ver la fecha en que se realizan las reservaciones </td>
                        
                            <td>  
                                <form action ="{{route('reportesFechaReservacion')}}" method ="GET" enctype="multipart/form-data">
                                      {{csrf_field()}}
                                     <button type="sumbit" class="btn btn-primary btn-xs" type="sumbit">
                                     {{'Detalles  '}}
                                     <span class="glyphicon glyphicon-new-window"></span>
                                     </button>
                                </form>
                            </td>
                        
                      </tr>

                      <tr>
                        <td>Fecha de recogida</td>
                        <td>Ver las fechas en que son mas/menos concurridas</td>
                        <td>  
                            <form action ="{{route('fechaAlquiler')}}" method ="GET" enctype="multipart/form-data">
                                  {{csrf_field()}}
                                 <button type="sumbit" class="btn btn-primary btn-xs" type="sumbit">
                                 {{'Detalles  '}}
                                 <span class="glyphicon glyphicon-new-window"></span>
                                 </button>
                            </form>
                        </td>
                      </tr> 

                      <tr>
                        <td>Ingresos</td>
                        <td>Ver cuando hubo mas/menos ingresos</td>
                        <td>  
                            <form action ="{{route('fechaCobro')}}" method ="GET" enctype="multipart/form-data">
                                  {{csrf_field()}}
                                 <button type="sumbit" class="btn btn-primary btn-xs" type="sumbit">
                                 {{'Detalles  '}}
                                 <span class="glyphicon glyphicon-new-window"></span>
                                 </button>
                            </form>
                        </td>
                      </tr>
                      </tr>

                    </table>

                  </div>
                
              </div>
              </div>
            </div>
        </div>
    </section>

    
    <div class="modal fade in" id="mantenimientos">

        <div class="modal-dialog">
          <div class="modal-content">
  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> <span class="glyphicon glyphicon-warning"></span> <b> {{'Ver cantidad de mantenimientos por vehiculox'}} </b> </h4>
            </div>
            <div class="modal-body">
  
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12 ">
                        <div class="form-group">
                          Si lo requiere ingrese los siguientes campos.
                            <form method="GET" action="{{ route('reporteMantenimientos') }}"  role="form">
                                {{ csrf_field() }}
  
                                <label>Si necesita un periodo indiquelo a continuacion</label>
                                <div class="col-md-6 form-group">
                                    <label>Desde</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  value="">
                                  </div>
                                  <div class="col-md-6 form-group">
                                      <label>Al</label>
                                      <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"  value="">
                                    </div>
                                    <div class="row">
                                    <label>Filtrar por servicio</label>
                                    <select name= "servicio" id="servicio" class="form-control select2" style="width: 100%;">
                                        <option value="ninguno">No filtrar por servicio</option>
                                      @foreach($serviciost as $servicio)
                                    <option value="{{$servicio->idserviciotaller}}">{{$servicio->nombreservicio}}</option>
                                        @endforeach
                                        </select>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    
              <p><b>{{'Se mostraran los mantenimientos coincidentes'}} {{' '}} </b>&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span>{{'Ver'}}</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

@endsection

@section('scripts')
@endsection