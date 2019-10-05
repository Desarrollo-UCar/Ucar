@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reservas</title> 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Solicitudes traslados</small>
        </h1>
        
    </section>


    <section class="content">

         <!-- Content Wrapper. Contains page content -->
         <div class="box-body ">
            <table id="example" class="display nowrap " style="width:100%">
                <thead>
                    <tr>
                      <th>Número</th>
                      <th>Fecha de solicitud</th>
                      <th>Lugar de salida</th>
                      <th>Lugar de llegada</th>
                      <th>Fecha llegada</th>
                      <th>Hora Llegada</th>
                      <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if($traslados->count())  
                      @foreach($traslados as $traslado)  
                      <tr>
                        <td>{{$traslado->id}}</td> <!--Datos de la reservacion -->
                        <td>{{date("d\-m\-Y", strtotime($traslado->fecha_hora_reserva))}}</td>
                      <td>{{$traslado->lugar_salida}}</td>
                      <td>{{$traslado->lugar_llegada}}</td>
                        <td> {{$traslado->fecha_llegada_solicitada}}</td>
                        <td>{{$traslado->hora_llegada}}</td>
                        <td>  
                          <a href="{{route('calculo_costos_traslado',['id_sol_traslado' => $traslado->id])}}" class="btn btn-warning btn-sm">seleccionar </a>

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
            "scrollY":"400px",
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
  
  