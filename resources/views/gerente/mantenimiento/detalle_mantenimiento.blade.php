@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mantenimiento</title>
  <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.9.0/d3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
</head>
<body>
@section('contenido')
<section class="content-header">
    <h1>Panel de administración |<small>Detalle Mantenimiento</small></h1>        
</section>
<section class="content">
<div class="box box-primary">              
    <div class="box-header with-border">
        <h3 class="box-title">Nuevo mantenimiento</h3>
    </div>
    <!-- /.box-header -->
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-4"><label>--Lista de servicios realizados al vehículo--<label></div>
        </div>  
    </div>
    <div class="box-body">
        <table id="example" class="display nowrap " style="width:100%">
            <thead>
                <tr>
                    <th style="text-align: center">Número</th>
                    <th >Servicios</th>
                    <th >Descripción</th>
                    <th >Fecha Alta</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;?>
                    @foreach ($servicios as $ser)    
            <tr>
                <td style="text-align: center"><?php 
                echo $i=$i+1;
                ?></td>
                <td >{{$ser->nombreservicio}}</td>
                @if ($ser->descripcion==null)
                <td style="text-align: center;" >----------------</td>
                @else
                <td >{{$ser->descripcion}}</td>
                @endif
                @if ($ser->fecha==null)
                <td style="text-align: center;">----------------</td>
                @else
                <td >{{$ser->fecha}}</td>
                @endif                        
            </tr> 
        @endforeach
            </tbody>
        </table>
    </div>
</div>  
</section>
@endsection

@section('scripts')
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
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection
</body>
</html>