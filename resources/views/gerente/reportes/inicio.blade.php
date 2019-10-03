@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
  <style>
  table { 
    display: table;
    border-collapse: separate;
    border-spacing: 1px;
    border-color: :teal;
    border: 1px ;
  }

  table, th, td {
  border: 1px solid gray;
}
  </style>
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

@endsection

@section('scripts')
@endsection