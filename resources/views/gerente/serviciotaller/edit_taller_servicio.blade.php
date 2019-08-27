@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Servicio Extra</title>
 
  <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tabla.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}">
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Servicios de mantenimiento</small>
        </h1>
        
    </section>



         <!-- Content Wrapper. Contains page content -->
 
  

    <!-- Main content -->
    <section class="content">
        <section class="content">
            @if ($errors->any())
            <div class="alert alert-danger">            
                   Por favor de rellenar los campos correctamente
            </div>
        @endif
        @if (session()->has('msj'))
        <div class="alert alert-info" role="alert">{{session('msj')}} 
        <a href="{{route('servicioe.index')}}" style="color:darkgreen"><b> ver todos los servicios extra </b></a>
        </div>  
        @endif  
        @if (count($taller )==0)
        <div style="display: none;">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-warning" id="<?php 
          echo "boton";
        ?>">
              Cancelar
            </button>
          </div>
          @endif 
          
              <!-- /.box-header -->
              <div class="box-body">

                  <form action="{{ route('tallerservicio.update',$datos->idserviciotaller)}}" method="POST">
                      {{-- FORMULARIO DE NOMBRES --}}
                      
                       @csrf
                       @method('PUT')
                         {{-- FORMULARIO DIRECCION--}}
                         <div class="row">
                            <div class="col-md-12">
                              <div class="col-md-8 col-md-offset-4">
                                <label>-- Nuevo servicio de mantenimiento -- </label>
                              </div>
                            </div>  
                          </div>
                         <div class="form-group col-md-4">
                          <label>Nombre del servicio</label>
                          <input type="text" class="form-control" placeholder="Nombre del servicio" name="nombreservicio" id="nombreservicio";  onkeyup="javascript:this.value=this.value.toUpperCase();" autofocus value="{{$datos->nombreservicio}}" required>
                      </div>
                              
    
                        <div class="form-group col-md-4">
                          <label>Descripción</label>
                          <input type="text" class="form-control" placeholder="Descripción" name="descripcion"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$datos->descripcion}}">
                      </div>
                      <div class="row">
                          <div class="col-md-8">
                              <div class="form-group col-md-2" style="float: right">
                                  <button type="submit" class="btn btn-primary">Modificar</button>
                                </div>
                              <div class="form-group col-md-2" style="float: right">
                                    <a href="{{ URL::previous() }}" class="btn btn-danger pull-left">Regresar</a>
                                </div>                       
                            </div>                    
                        </div>
                  </form>
                  
                  <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-8 col-md-offset-4">
                          <label>-- Servicios de mantenimiento existente-- </label>
                        </div>
                      </div>  
                    </div>

                  <table id="example" class="display nowrap " style="width:100%">
                      <thead>
                          <tr>
                              <th style="text-align: center">Número</th>
                              <th >Servicios</th>
                              <th >Descripción</th>
                              <th >Fecha Alta</th>
                              <th style="text-align: center">Editar</th>
                              <th style="text-align: center">Eliminar</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                           @foreach ($taller as $ser)                      
                <tr>
                        <td style="text-align: center">{{$ser->idserviciotaller}}</td>
                        <td >{{$ser->nombreservicio}}</td>
                        @if ($ser->descripcion==null)
                        <td >----------------</td>
                        @else
                        <td >{{$ser->descripcion}}</td>
                        @endif
                        @if ($ser->created_at==null)
                        <td >----------------</td>
                        @else
                        <td >{{$ser->created_at}}</td>
                        @endif                        

                        <td style="text-align: center"> <a href="{{ route('tallerservicio.edit',$ser->idserviciotaller) }}"> <span class="fa fa-edit fa-2x" style="color:goldenrod;" title="Modificar datos"></span></td>
                         
                          <td style="text-align: center">
                                <a href="{{ route('modificarservicio',['servicioextra'=>$ser->idserviciotaller]) }}" title="Eliminar"> <span class="fa fa-trash-o fa-2x" style="color:red;"></span>
                      </td>
                      </tr> 
                @endforeach
                      
                      </tbody>
                  </table>
              </div>
     
      </section>
   
      <div class="modal modal-warning fade" id="modal-warning">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">No se encuentra ningún registro. :( </b> </h4>
              </div>
              <div class="modal-body">
                <p>Para dar de alta un servicio extra dale click en continuar :).&hellip;</p>
              </div>
              <div class="modal-footer">
                {{--<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>--}}
                <a href="{{ URL::previous()}}" class="btn btn-success pull-left">Regresar</a>
              <a href="{{route('servicioe.create')}}" class="btn btn-primary">Continuar</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
   
@endsection    
     @section('scripts')

     <script>           
        $(document).ready(function() {

         var obj= document.getElementById("boton");
         obj.click();
         } );
        </script>

         <script>
         $(document).ready(function() {
               $table=$('#example').DataTable( { 
                "scrollY":"400px",              
                "scrollX": true,   
              //  "search": document.getElementById("nombreservicio").value,            
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
  
  
