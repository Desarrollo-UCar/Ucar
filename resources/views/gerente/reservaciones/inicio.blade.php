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
          <small>Reservaciones</small>
        </h1>
        
    </section>


    <section class="content">

         <!-- Content Wrapper. Contains page content -->
         <div class="box-body ">
            <table id="example" class="display nowrap " style="width:100%">
                <thead>
                    <tr>
                      <th>Número</th>
                      <th>Fecha de reservacion</th>
                      <th>Cliente</th>
                      <th>identificación/Pasaporte</th>
                      <th>Vehiculo</th>
                      <th>Placas</th>
                      <th>Fecha entrega</th>
                      <th>Fecha devolucion</th>
                      <th>Motivo</th>
                      <th>Total</th>
                      <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if($reservaciones->count())  
                      @foreach($reservaciones as $reservacion)  
                      <tr>
                        <td>{{$reservacion->id}}</td> <!--Datos de la reservacion -->
                        <td>{{date("d\-m\-Y", strtotime($reservacion->fecha_reservacion))}}</td>
                      <td>{{$reservacion->nombre}} {{$reservacion->primer_apellido}} {{$reservacion->segundo_apellido}}</td>
                        <td> @if($reservacion->credencial==null)
                            {{$reservacion->pasaporte}}
                            @else
                            {{$reservacion->credencial}}
                            @endif </td>
                        <td>{{$reservacion->marca}} {{$reservacion->modelo}} {{$reservacion->anio}} </td>
                        <td>{{$reservacion->matricula}} </td>
                        <td>{{date("d\-m\-Y", strtotime($reservacion->fecha_recogida))}}</td>
                        <td>{{date("d\-m\-Y", strtotime($reservacion->fecha_devolucion))}} </td>
                        <td>{{$reservacion->motivo_visita}}</td>
                        <td>{{$reservacion->total}}</td>  
                       <!-- <td>{{$reservacion->estatus}}</td> -->
                        <td>  
<<<<<<< HEAD
                          <form action ="{{route('reservacion',$reservacion)}}" method ="GET" enctype="multipart/form-data">
=======
<<<<<<< HEAD
                        {{--  <form action ="{{route('reservacion.show',$reservacion)}}" method ="GET" enctype="multipart/form-data">
=======
<<<<<<< HEAD
                          <form action ="{{route('reservacion',$reservacion)}}" method ="GET" enctype="multipart/form-data">
=======
                         <form action ="{{route('reservacion.show',$reservacion)}}" method ="GET" enctype="multipart/form-data">
>>>>>>> 2e0f0facbcbeb1c82bfffaa62a8a4e412a3f5296
>>>>>>> 7bf245220d3b95f0aaadb18b85ff5b2e9b69ee92
>>>>>>> 6632bcdaf22919943eea11d38a36b6dbd9ba279d
                                {{csrf_field()}}
                               <button type="sumbit" class="btn btn-primary btn-xs" type="sumbit">
                               {{'Detalles  '}}
                               <span class="glyphicon glyphicon-new-window"></span>
                               </button>
                          </form>--}}
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
  
  