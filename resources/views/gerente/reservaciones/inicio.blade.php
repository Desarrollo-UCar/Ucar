@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Empleados</title>
 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administracion |
          <small>Empleados</small>
        </h1>
        
    </section>


    <section class="content">

         <!-- Content Wrapper. Contains page content -->
         <div class="box-body ">
            <table id="example" class="display nowrap " style="width:100%">
                <thead>
                    <tr>
                      <th>Numero</th>
                      <th>Id Cliente</th>
                      <th>Fecha</th>
                      <th>Motivo</th>
                      <th>Total</th>
                      <th>Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if($reservaciones->count())  
                      @foreach($reservaciones as $reservacion)  
                      <tr>
                        <td>{{$reservacion->id}}</td>
                        <td>{{$reservacion->idCliente}}</td>
                        <td>{{$reservacion->fechaReservacion}}</td>
                        <td>{{$reservacion->motivoVisita}}</td>
                        <td>{{$reservacion->precioTotal}}</td>
                        <td>{{$reservacion->estatus}}</td>
                        <td>  
                          <form action ="{{route('reservacion.show',$reservacion)}}" method ="GET" enctype="multipart/form-data">
                                {{csrf_field()}}
                               <button type="sumbit" class="btn btn-primary btn-xs" type="sumbit">
                               {{'Detalles  '}}
                               <span class="glyphicon glyphicon-new-window"></span>
                               </button>
                          </form>

                      </td>
                        
                       </tr>
                       @endforeach 
                       @endif
                    </tbody>
                  </table>
                </div>

              </div>
     </section>   
     @endsection

     @section('scripts')
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script>
     $(document).ready(function() {
          $('#example').DataTable( {
            "scrollX": true,
            "language": {
              "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
            
          } );
      } );
     </script>

 @endsection
</body>
</html>
  
  