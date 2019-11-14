@extends("theme.$theme.layout")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="_token" content="{{ csrf_token() }}" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alta Sucursal</title>
  {{-- <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet"> --}}
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/flexslider.css" rel="stylesheet" />
    <link href="css/prettyPhoto.css" rel="stylesheet" />
    <link href="css/camera.css" rel="stylesheet" />
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    {{-- <link href="css/style.css" rel="stylesheet" /> --}}
    <link href="css/shortcodes.css" rel="stylesheet" />
    
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker.css" />
    <!-- Theme skin -->
    <link href="color/blue.css" rel="stylesheet" />
    <!-- iconos de materialice -->
    <style type="text/css">
      

      input:valid {
        border: 1px solid green;
      }
      input:invalid {
        border: 1px solid red;
      }
    </style>
  
  
 </head>
<body>
  
@section('contenido')
    <section class="content-header">
        <h1>
          Panel de administración |
          <small>Traslado</small>
        </h1>        
    </section>

    <section class="content"> 
      <div class="container">
        <div class="row">

                <!-- inicio card reserva -->
                <div class="card bg-light">
                <!--Card content-->
                <div class="card-body">
                    
      <div class="row">
{{--calculo de datos para el traslado--}}

<div class="col-sm-11 col-md-11 col-lg-11 col-xl-11">
    <form id="reserva_traslado" action="{{ route('vehiculos_por_sucursal')}}" method="post" enctype="multipart/form-data">
      @csrf
       <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <!-- inicio card reserva -->
              <!--Card content-->
                      <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                          <h6><strong>Información de contacto del cliente:</strong></h6>  
                          <input type="hidden" id='id_sol_traslado' name="id_sol_traslado" value={{$solicitud_traslado->id}}>
                      </div>
                          {{-- FORMULARIO DE NOMBRES --}}                     
                          <div class="form-group col-md-3 col-sm-3">
                                  <label>Nombres</label>
                                  <input id="nombres" type="text" class="form-control" value ="{{$solicitud_traslado->nombres}}" placeholder="nombres" name="nombres" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly = "readonly" required>
                                  
                              </div> 
                          {{-- FOMULARIO DEL PRIMER APELLIDO --}}
                          <div class="form-group col-md-2 col-sm-2">
                          <label>Primer Apellido </label>
                          <input type="text" class="form-control" placeholder="primer apellido" value ="{{$solicitud_traslado->primer_apellido}}" name="primerApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" id="primerApellido" readonly = "readonly" required>
                          
                          </div> 
                          {{-- FORMULARIO DEL SEGUNDO APELLIDO --}}
                          <div class="form-group col-md-2 col-sm-2">
                          <label>Segundo Apellido</label>
                          <input type="text" class="form-control" placeholder="segundo apellido" value ="{{$solicitud_traslado->segundo_apellido}}" name="segundoApellido" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly = "readonly" id="segundoApellido" required>

                          </div>
                          {{--DATOS PARA EL TELEFONO--}}
                          <div class="form-group col-md-2 col-sm-2">
                              <label>Teléfono</label>
                          <input type="text" class="form-control" placeholder="Teléfono" value ="{{$solicitud_traslado->telefono}}" name="telefono" id="telefono" pattern="[0-9]*" minlength = "10" maxlength="10" title="Número a 10 digitos" readonly = "readonly" required>
                          </div> 
                          {{--FORMULARIO DE CORREO EMAIL--}}
                          <div class="form-group col-md-3 col-sm-3">
                                  <label>Email</label>
                                  <input type="email" class="form-control" value ="{{$solicitud_traslado->email}}" placeholder="Correo Eléctronico" name="email" id="email" readonly = "readonly" required>

                              </div>
  
                  <div class="form-row">
                          <div class="form-group col-md-12 col-sm-12">
                            <h6><strong>Información de su cotización de viaje: (*Datos a rellenar)</strong></h6>  
                          </div>
                          <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <label for="lugar_salida">LUGAR DE SALIDA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                  </div>
                                  <input name = 'lugar_salida' id="origin-input" class="form-control form-control-lg" type="text" value ="{{$solicitud_traslado->lugar_salida}}" placeholder="Ingresa el lugar de salida" required>
                              </div>
                          </div>
                          <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                              <label for="lugar_llegada">LUGAR DE LLEGADA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                  </div>
                                  <input name = 'lugar_llegada' id="destination-input" class="form-control form-control-lg" type="text" value ="{{$solicitud_traslado->lugar_llegada}}" placeholder="Ingresa el lugar de llegada" required>
                              </div>
                          </div>

                          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <label for="fecha">*FECHA DE SALIDA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                </div>
                                @if(!$solicitud_traslado->fecha_salida == null)
                                <input id = 'fecha_salida' name = 'fecha_salida' class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida" value="{{date("d\-m\-Y", strtotime($solicitud_traslado->fecha_salida))}}" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY" onchange="validar_fecha();" required>
                                @else
                                <input id = 'fecha_salida' name = 'fecha_salida' class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida"  pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY" onchange="validar_fecha();" required>
                                @endif
                                <input id = 'fecha_salida_formato' name = 'fecha_salida_formato' class="form-control" value="{{$solicitud_traslado->fecha_salida}}" type="hidden" >
                            </div>
                        </div>
                        <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                            <label for="horaRecogida">*HORA DE SALIDA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                </div>
                                <select name = 'hora_salida' class="form-control" required>
                                    <option <?php if($solicitud_traslado->hora_salida == "00:00:00") echo "selected";?>>00:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "01:00:00") echo "selected";?>>01:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "02:00:00") echo "selected";?>>02:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "03:00:00") echo "selected";?>>03:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "04:00:00") echo "selected";?>>04:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "05:00:00") echo "selected";?>>05:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "06:00:00") echo "selected";?>>06:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "07:00:00") echo "selected";?>>07:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "08:00:00") echo "selected";?>>08:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "09:00:00") echo "selected";?>>09:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "10:00:00") echo "selected";?>>10:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "11:00:00") echo "selected";?>>11:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "12:00:00") echo "selected";?>>12:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "13:00:00") echo "selected";?>>13:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "14:00:00") echo "selected";?>>14:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "15:00:00") echo "selected";?>>15:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "16:00:00") echo "selected";?>>16:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "17:00:00") echo "selected";?>>17:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "18:00:00") echo "selected";?>>18:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "19:00:00") echo "selected";?>>19:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "20:00:00") echo "selected";?>>20:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "21:00:00") echo "selected";?>>21:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "22:00:00") echo "selected";?>>22:00</option>
                                    <option <?php if($solicitud_traslado->hora_salida == "23:00:00") echo "selected";?>>23:00</option>
                                </select>
                            </div>
                        </div>

                      
                          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                              <label for="fecha">FECHA DE LLEGADA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                  </div>
                                  @if(!$solicitud_traslado->fecha_llegada_solicitada == null)
                                  <input id = 'fecha_llegada_solicitada' name = 'fecha_llegada_solicitada' class="form-control" type="text" value ="{{date("d\-m\-Y", strtotime($solicitud_traslado->fecha_llegada_solicitada))}}" autocomplete="off" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY" onchange="validar_fecha();" required>
                                  @else
                                  <input id = 'fecha_llegada_solicitada' name = 'fecha_llegada_solicitada' class="form-control" type="text"  autocomplete="off"  placeholder="Fecha de llegada" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Formato: DD-MM-YYYY" onchange="validar_fecha();" required>
                                  @endif
                                  <input id = 'fecha_llegada_formato' name = 'fecha_llegada_formato' class="form-control"  value = "{{$solicitud_traslado->fecha_llegada_solicitada}}" type="hidden" >


                              </div>
                          </div>
                          <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                              <label for="horaRecogida">HORA DE LLEGADA</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                  </div>
                                  <select name = 'hora_llegada' class="form-control" required>
                                    <option <?php if($solicitud_traslado->hora_llegada == "00:00:00") echo "selected";?>>00:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "01:00:00") echo "selected";?>>01:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "02:00:00") echo "selected";?>>02:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "03:00:00") echo "selected";?>>03:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "04:00:00") echo "selected";?>>04:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "05:00:00") echo "selected";?>>05:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "06:00:00") echo "selected";?>>06:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "07:00:00") echo "selected";?>>07:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "08:00:00") echo "selected";?>>08:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "09:00:00") echo "selected";?>>09:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "10:00:00") echo "selected";?>>10:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "11:00:00") echo "selected";?>>11:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "12:00:00") echo "selected";?>>12:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "13:00:00") echo "selected";?>>13:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "14:00:00") echo "selected";?>>14:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "15:00:00") echo "selected";?>>15:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "16:00:00") echo "selected";?>>16:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "17:00:00") echo "selected";?>>17:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "18:00:00") echo "selected";?>>18:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "19:00:00") echo "selected";?>>19:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "20:00:00") echo "selected";?>>20:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "21:00:00") echo "selected";?>>21:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "22:00:00") echo "selected";?>>22:00</option>
                                    <option <?php if($solicitud_traslado->hora_llegada == "23:00:00") echo "selected";?>>23:00</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                  <label for="lugar_llegada">N° PASAJEROS</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                      </div>
                                      <input type="number" class="form-control" placeholder="N° Pasajeros" 
                                      value ="{{$solicitud_traslado->n_pasajeros}}" name="n_pasajeros" 
                                       id="telefono" pattern="[0-9]*" min = "1" max="40" title="Mínimo: 1. Máximo: 40" required>
                                  </div>
                            </div> 
                            <div class="form-group col-md-3 col-sm-3">
                              <div style="margin-top: 15%; margin-left: 10%;">
                                @if($solicitud_traslado->viaje_redondo == 1)
                                  <input type="checkbox" id="viaje_redondo" name="viaje_redondo" title="Desea regresar con nosotros?" checked>
                                @else
                                <input type="checkbox" id="viaje_redondo" value="0" title="Desea regresar con nosotros?" name="viaje_redondo">
                                @endif
                              <label class="form-check-label" for="viaje_redondo">VIAJE REDONDO? </label>
                              </div>
                            </div>
                            <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3"  style="display: none;" id="tiempo_espera">
                                <label for="dias_espera">DIAS DE ESPERA PARA RETORNO</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                    </div>
                                    <input name = 'dias_espera' id="dias_espera" class="form-control form-control-lg" type="number" 
                                    value ="{{$solicitud_traslado->dias_espera}}" placeholder="Dias de espera" pattern="[0-9]*" min = "0" max="40" title="Mínimo: 1. Máximo: 40" >
                                </div>
                            </div>     
                      </div>
                  </div>
          
          

          
      </div>
  </div>

       
<div class="row">
          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="inputLugar">SUCURSAL DE RENTA</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-flag"aria-hidden="true"></i></span>
                  </div>
                  <select id="sucursal" name='sucursal' class="form-control" required>
                  @foreach($sucursales as $sucursal)
                      <option <?php if($solicitud_traslado->sucursal == $sucursal->id) echo "selected";?> >{{$sucursal->nombre}}</option>
                  @endforeach
              </select>
              </div>
          </div>
          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="fecha">FECHA SALIDA DE SUCURSAL</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                  </div>
                  @if(!$solicitud_traslado->fecha_salida_de_sucursal == null)
                  <input id = "fecha_salida_sucursal" name = "fecha_salida_sucursal" class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Fecha de salida de la sucursal en Formato: DD-MM-YYYY" value ="{{date("d\-m\-Y", strtotime($solicitud_traslado->fecha_salida_de_sucursal))}}" onchange="validar_fecha();" required>
                  @else
                  <input id = "fecha_salida_sucursal" name = "fecha_salida_sucursal" class="form-control" type="text" autocomplete="off" placeholder="Fecha de salida de sucursal" pattern="[0-3][0-9]-[0-1][0-9]-2[0-9][0-9][0-9]" minlength = "10" maxlength="10" title="Fecha de salida de la sucursal en Formato: DD-MM-YYYY" onchange="validar_fecha();" required>
                  @endif 
                  <input id = 'fecha_salida_sucursal_formato' name = 'fecha_salida_sucursal_formato' class="form-control" value = "{{$solicitud_traslado->fecha_salida_de_sucursal}}" type="hidden" >
              </div>
          </div>
          <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="horaRecogida">HORA SALIDA DE SUCURSAL</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                  </div>
                  <select name = "hora_salida_sucursal" class="form-control" required>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "00:00:00") echo "selected";?>>00:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "01:00:00") echo "selected";?>>01:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "02:00:00") echo "selected";?>>02:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "03:00:00") echo "selected";?>>03:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "04:00:00") echo "selected";?>>04:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "05:00:00") echo "selected";?>>05:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "06:00:00") echo "selected";?>>06:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "07:00:00") echo "selected";?>>07:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "08:00:00") echo "selected";?>>08:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "09:00:00") echo "selected";?>>09:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "10:00:00") echo "selected";?>>10:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "11:00:00") echo "selected";?>>11:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "12:00:00") echo "selected";?>>12:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "13:00:00") echo "selected";?>>13:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "14:00:00") echo "selected";?>>14:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "15:00:00") echo "selected";?>>15:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "16:00:00") echo "selected";?>>16:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "17:00:00") echo "selected";?>>17:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "18:00:00") echo "selected";?>>18:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "19:00:00") echo "selected";?>>19:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "20:00:00") echo "selected";?>>20:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "21:00:00") echo "selected";?>>21:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "22:00:00") echo "selected";?>>22:00</option>
                      <option <?php if($solicitud_traslado->hora_salida_de_sucursal == "23:00:00") echo "selected";?>>23:00</option>
                  </select>
              </div>
          </div>
          <div class="form-group col-md-3 col-sm-3">
              <button type="submit" class="btn btn-medium btn-theme" style="margin-top: 6%;"> Vehiculos Disponibles</button>
      </div> 
          

          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">KM SUCURSAL - ORIGEN</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  @if($solicitud_traslado->km_sucursal_origen != null)
                  <input type="number" class="form-control" placeholder="km a recorrer" name="km" id="km" pattern="[0-9]*" title="kilometros a recorrer para llegar al punto de salida del cliente desde la sucursal donde se encuentra el vehiculo" value ={{$solicitud_traslado->km_sucursal_origen}} onchange="total_gastos_previos();" required>
                  @else
                  <input type="number" class="form-control" placeholder="km a recorrer" name="km" id="km" pattern="[0-9]*" title="kilometros a recorrer para llegar al punto de salida del cliente desde la sucursal donde se encuentra el vehiculo" onchange="total_gastos_previos();" required>
                  @endif
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">PRECIO GASOLINA</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  @if($solicitud_traslado->gasolina != null)
                  <input type="number" class="form-control" placeholder="$ gasolina" name="gasolina" id="gasolina" pattern="[0-9]*" title="Se requiere para calcular los gastos antes de llegar con el cliente" value = {{$solicitud_traslado->gasolina}} onchange="total_gastos_previos();" required>
                  @else
                  <input type="number" class="form-control" placeholder="$ gasolina" name="gasolina" id="gasolina" pattern="[0-9]*" title="Se requiere para calcular los gastos antes de llegar con el cliente" onchange="total_gastos_previos();" required>
                  @endif
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">OTROS GASTOS (Casetas)</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  @if($solicitud_traslado->gasolina != null)
                  <input type="number" class="form-control" placeholder="Posibles gastos" name="otros_gastos" id="otros_gastos" pattern="[0-9]*" value = {{$solicitud_traslado->otros_gastos}} onchange="total_gastos_previos();" title="Por si se generará algun gasto no especificado en este formulario. Ejemplo: casetas">
                  @else
                  <input type="number" class="form-control" placeholder="Posibles gastos" name="otros_gastos" id="otros_gastos" pattern="[0-9]*" onchange="total_gastos_previos();" title="Por si se generará algun gasto no especificado en este formulario. Ejemplo: casetas">
                  @endif
              </div>     
          </div>
    @if($vehiculos_disponibles != null & $solicitud_traslado->id_vehiculo != null)
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">TOTAL GASTOS PREVIOS</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Total gastos previos" name="total_previos" id="total_previos" pattern="[0-9]*" title=""  readonly required>
              </div>     
          </div>
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> 
              <h5></h5> 
              <h5><strong>Vehiculo Elegido: <span class="colored"> {{$vehiculo_elegido->marca}}  {{$vehiculo_elegido->modelo}} </span></strong></h5>
          </div>
          <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <div class="post-slider">
                  <div class="flexslider">
                          <img src="{{ '/images/'.$vehiculo_elegido->foto}}"/>
                  </div>
                  <!-- end flexslider -->
              </div>
          </div>
          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
              <label>*Los gastos previos estan calculados en base a la distancia(KM) entre sucursal-origen, multiplicado por dos, debido a el costo del viaje de regreso origen-sucursal.</label>  
          </div>
    @endif

</div>
<div class="row">
      @if($vehiculos_disponibles != null & $solicitud_traslado->id_vehiculo == null)
      <div class="form-group col-md-12 col-sm-12">
                <h6><strong>Selecciona el vehiculo:</strong></h6>  
        @foreach($vehiculos_disponibles as $vehiculo)
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h5><strong><span class="colored"> {{$vehiculo->marca}}  {{$vehiculo->modelo}} </span></strong></h5>
        </div>
        <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="post-slider">
                <div class="flexslider">
                        <img src="{{ '/images/'.$vehiculo->foto}}"/>
                </div>
                <!-- end flexslider -->
            </div>
        </div>
        <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                
                <h6><strong>{{$vehiculo->tipo}}</strong></h6>
            <ul>
            @if($vehiculo->tipo != "motoneta")
            <li><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</li>
            <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</li>
            <li><i class="fa fa-exchange"   aria-hidden="true"></i>Transmisión:  {{$vehiculo->transmicion}} </li>
            <li><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</li>
            <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</li>
            <li><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</li>
            <li><i class="fa fa-pencil-square"aria-hidden="true"></i>Color: {{$vehiculo->color}}</li>
            <li></i>{{$vehiculo->descripcion}}</li>
            @else
            <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->cilindros}} CC</li>
            <li><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</li>
            <li><i class="fa fa-pencil-square"aria-hidden="true"></i>Color: {{$vehiculo->color}}</li>
            <li></i>{{$vehiculo->descripcion}}</li>
            @endif
            </ul>
        </div>
        <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <dl>
                <dd>Costo por dia:</dd>
                <dd><h4><strong><span class="colored"> $ {{number_format($vehiculo->precio,2)}} MXN</span></strong></h4></dd>
                <dd>Incluye IVA</dd>
                <dd><a href="{{ route('vehiculos_por_sucursal',[
                                        'id_vehiculo'    =>$vehiculo->idvehiculo,
                                        'id_sol_traslado'=> $solicitud_traslado->id,
                                        
                                        'fecha_salida_sucursal' => $solicitud_traslado->fecha_salida_de_sucursal,
                                        'hora_salida_sucursal'  => $solicitud_traslado->hora_salida_de_sucursal,
                                        'km'                    => $solicitud_traslado->km_sucursal_origen,
                                        'gasolina'              => $solicitud_traslado->gasolina,
                                        'otros_gastos'          => $solicitud_traslado->otros_gastos,
                                        'sucursal'              => $solicitud_traslado->sucursal,

                                        'lugar_salida'            => $solicitud_traslado->lugar_salida,
                                        'fecha_salida'            => $solicitud_traslado->fecha_salida,
                                        'hora_salida'             =>$solicitud_traslado->hora_salida,
                                        'lugar_llegada'           => $solicitud_traslado->lugar_llegada,
                                        'fecha_llegada_solicitada'=>$solicitud_traslado->fecha_llegada_solicitada,
                                        'hora_llegada'            => $solicitud_traslado->hora_llegada,
                                        'n_pasajeros'             => $solicitud_traslado->n_pasajeros,
                                        'viaje_redondo'           => $solicitud_traslado->viaje_redondo,
                                        'dias_espera'             => $solicitud_traslado->dias_espera

                                        ]) }}" class="btn btn-warning btn-sm">Seleccionar</a></dd> 
            </dl> 
        </div>
        </div>
        @endforeach
        </div>
        @endif
</div>
</form>
@if($vehiculos_disponibles != null & $solicitud_traslado->id_vehiculo != null)
<form id="ultimos_traslado" action="{{ route('guardar_confirmacion_traslado')}}" method="get" enctype="multipart/form-data">
  <input type="hidden" id='id_sol_traslado' name="id_sol_traslado" value={{$solicitud_traslado->id}}>
<div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <label for="lugar_llegada">DIAS DE RENTA</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Dias" value ="{{$dias}} viaje, {{$solicitud_traslado->dias_espera}} espera" name="dias" id="dias" readonly required>
                </div>   
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                <label for="lugar_llegada">HORAS DE RENTA</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Horas" value ="{{$horas}} hrs de viaje" name="horas" id="horas" title="Horas extra de viaje" readonly required>
                </div>   
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <label for="lugar_llegada">SUBTOTAL RENTA</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Subtotal" value ="{{number_format($subtotal,2)}}" name="subtotal_renta" id="subtotal_renta" title="Subtotal calculado en base a los dias y horas de renta por el precio de alquiler del auto por dia" readonly required>
            </div>   
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <label>*Despues de 8 hrs se cobra el dia completo</label>  
        </div>
</div>
<div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <label for="lugar_llegada">N° DE CHOFERES</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="N° Choferes" name="n_choferes" id="n_choferes" pattern="[0-9]" min = "1" max="3" title="" onchange="total_sueldo_choferes();" required>
            </div>   
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <label for="lugar_llegada">SUELDO POR CHOFER</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="Por Chofer" name="sueldo_chofer" id="sueldo_chofer" pattern="[0-9]*"  title="El sueldo ingresado es por chofer" onchange="total_sueldo_choferes();" required>
            </div>     
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <label for="lugar_llegada">TOTAL SUELDO CHOFER</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="Total Sueldo Chofer" name="total_sueldo_chofer" id="total_sueldo_chofer" pattern="[0-9]*" title="" readonly required>
            </div>     
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            @if($solicitud_traslado->viaje_redondo == 1)
            <h6><strong><span class="colored">"Traslado Redondo"</span></strong></h6>    
            @endif
        </div>
</div>

<div class="row">
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">SUBTOTAL</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="subtotal"  name="subtotal" id="subtotal" pattern="[0-9]*" title="Subtotal renta + Total sueldo chofer + Total gastos previos" onchange="costo_total();" readonly required>
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">% DESCUENTO</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Descuento"  name="descuento" id="descuento" pattern="[0-9]*" title="valor ingresado en porcentaje" min = "0" max="100" onchange="costo_total();" required>
              </div>     
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
              <label for="lugar_llegada">COSTO TOTAL</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="Total" name="total" id="total" pattern="[0-9]*" title="Subtotal - porcentaje de descuento" readonly required>
              </div>     
          </div>
          <div class="form-group col-md-3 col-sm-3">
              <button type="submit" class="btn btn-medium btn-theme" style="margin-top: 6%;"> Confirmar Traslado</button>
        </div> 
</div> 
</form>
@endif


</div>
    </div>
   {{--termina lateral de datos ya obtenidos  --}}
</div>
</div> 
    </div>
    </div>                   
           

</section> 


@endsection   



</body>
</html>

@section('scripts')
<!-- Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    <!-- javascript================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

  <script src="js/daterangepicker.js"></script>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script>
    $('#fecha_salida_sucursal').daterangepicker({
    "autoApply": true,
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "showCustomRangeLabel": false,
    "singleDatePicker": true,
    "startDate": new Date(),
    "minDate": new Date()
}, function(start, end, label) {
  document.getElementById('fecha_salida_sucursal').value = end.format('DD-MM-YYYY');
  document.getElementById('fecha_salida_sucursal_formato').value = end.format('YYYY,MM,DD');
  validar_fecha();
});
$('#fecha_llegada_solicitada').daterangepicker({
      "autoApply": true,
      "linkedCalendars": false,
      "autoUpdateInput": false,
      "showCustomRangeLabel": false,
      "singleDatePicker": true,
      "startDate": new Date(),
      "minDate": new Date()
  }, function(start, end, label) {
    document.getElementById('fecha_llegada_solicitada').value = end.format('DD-MM-YYYY');
    document.getElementById('fecha_llegada_formato').value = end.format('YYYY,MM,DD');
    validar_fecha();
  });
  $('#fecha_salida').daterangepicker({
      "autoApply": true,
      "linkedCalendars": false,
      "autoUpdateInput": false,
      "showCustomRangeLabel": false,
      "singleDatePicker": true,
      "startDate": new Date(),
      "minDate": new Date()
  }, function(start, end, label) {
    document.getElementById('fecha_salida').value = end.format('DD-MM-YYYY');
    document.getElementById('fecha_salida_formato').value = end.format('YYYY,MM,DD');
  validar_fecha();
  });
</script>
<script>
  var checkbox = document.getElementById('viaje_redondo');
  checkbox.addEventListener("change", validaCheckbox, true);
  
  function validaCheckbox(){
    var checked = checkbox.checked;
    var tiempo_espera= document.getElementById("tiempo_espera");
    if(checked){
      tiempo_espera.style.display = 'block';
      document.getElementById("dias_espera").required = true;
      // console.log("1");
    }
    else{
      tiempo_espera.style.display = 'none';
      document.getElementById("dias_espera").required = false;
      // console.log("2");
    }
  }
  </script>
  <script>
    $(document).ready(function() {
      var tiempo_espera= document.getElementById("tiempo_espera");    
      if(document.getElementById('viaje_redondo').checked == true){
      tiempo_espera.style.display = 'block';
      document.getElementById("dias_espera").required = true;
      //console.log("3");
      }
    else{
      tiempo_espera.style.display = 'none';
      document.getElementById("dias_espera").required = false;
      //console.log("4");
    }
    });
  </script>
  <script>
  $(document).ready(function(){
      total_gastos_previos();
      costo_total();
  });
  </script>
  <script>
      function total_sueldo_choferes(){
        @if($dias != null)
          var n_choferes = document.getElementById("n_choferes").value;
          var sueldo_chofer = document.getElementById("sueldo_chofer").value;
          if(n_choferes != "" & sueldo_chofer != ""){
            document.getElementById("total_sueldo_chofer").value = n_choferes * sueldo_chofer * {{$dias}};
            obtener_subtotal();
            costo_total();
          }else{
            document.getElementById("total_sueldo_chofer").value = null;
            obtener_subtotal();
            costo_total();
          }
          @endif
        };
        //
        function total_gastos_previos(){
          var km = document.getElementById("km").value;
          var gasolina = document.getElementById("gasolina").value;
          var otros_gastos = document.getElementById("otros_gastos").value
          @if($vehiculos_disponibles != null & $solicitud_traslado->id_vehiculo != null)
          if(km != "" & gasolina != ""){
            if(otros_gastos != ""){
              document.getElementById("total_previos").value = ((parseInt(km) / parseInt({{$vehiculo_elegido->rendimiento}})) * parseInt(gasolina) + parseInt(otros_gastos) * 2);
              obtener_subtotal();
            }else{
              document.getElementById("total_previos").value = ( (parseInt(km) / parseInt({{$vehiculo_elegido->rendimiento}})) * parseInt(gasolina) * 2) ;
              obtener_subtotal();
            }
          }else{
            document.getElementById("total_previos").value = null;
            obtener_subtotal();
          }
          @endif
        };
        //
        function obtener_subtotal(){
          var total_previos = document.getElementById("total_previos").value;
          var total_sueldo_chofer = document.getElementById("total_sueldo_chofer").value;
          var otros_gastos = document.getElementById("otros_gastos").value;
          //preguntar antes por los nullos
          if(total_previos != "" & total_sueldo_chofer != ""){
            document.getElementById("subtotal").value =   parseInt(total_previos) + parseInt(total_sueldo_chofer) + parseInt({{$subtotal}});
            document.getElementById("total").value =   parseInt(total_previos) + parseInt(total_sueldo_chofer) + parseInt({{$subtotal}});
            costo_total();
          }else{
            document.getElementById("subtotal").value =  null;
            document.getElementById("total").value =  null;
            costo_total();
          }
        };
        // 
        function costo_total(){
          @if($subtotal != null)
            var subtotal = document.getElementById("subtotal").value;
            var descuento = document.getElementById("descuento").value;
                document.getElementById("total").value = subtotal - (parseInt( subtotal) / 100 * parseInt( descuento)) ;
          @endif
        };

        function validar_fecha(){
          var fecha_salida = document.getElementById("fecha_salida").value;
          var fecha_llegada = document.getElementById("fecha_llegada_solicitada").value;
          var fecha_salida_sucursal = document.getElementById("fecha_salida_sucursal").value;

          var fecha_salida_formato = document.getElementById("fecha_salida_formato").value;
          var fecha_llegada_formato = document.getElementById("fecha_llegada_formato").value;
          var fecha_salida_sucursal_formato = document.getElementById("fecha_salida_sucursal_formato").value;
         
          if(fecha_salida != "" & fecha_llegada != ""){
            var salida  = new Date(fecha_salida_formato);
            var llegada = new Date(fecha_llegada_formato);
            var salida_sucursal  = new Date(fecha_salida_sucursal_formato);
            //--------------
            console.log(salida);
            console.log(llegada);
            console.log(salida_sucursal);
            if(salida > llegada ){
                alert("Fecha invalida!! La fecha de salida no puede ser mayor a la de llegada");
                document.getElementById("fecha_salida").value = "";
            }
            if(salida_sucursal > salida ){
              alert("Fecha invalida!! La fecha de salida de la sucursal no puede ser mayor a la de salida del cliente");
                document.getElementById("fecha_salida_sucursal").value = "";
            }
            

          }
                    
        };

      </script>

@endsection  