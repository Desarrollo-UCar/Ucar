
@extends('plantilla')
@section('seccion')
<section id="content">
    <div class="container">
        <div class="form-row"> 
            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                <h2>Hola <strong>{{$cliente->nombre}} {{$cliente->primer_apellido}}</strong> Consulta tu Historial de Reservas</h2>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <a href="{{ route('mi_perfil') }}" class="btn btn-primary"><i class="icon-chevron-down"></i>Mi Perfil</a>
            </div>
        </div>
@foreach($reservas_cliente as $reserva)
<div class="row border border-primary">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12"> <h3 class = "text-primary">Folio: <strong>{{$reserva->id}}</strong></h3></div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div id="lista_itinerario">
                <h6><strong>Tu Cotización:</strong></h6>    
                <table class="table table-sm">
                <tbody>
                    <tr><td><small>Kilometraje incluido</small></td>            <td><small>Ilimitado</small></td></tr>
                    <tr><td><small>Alquiler del automovil por 1 dia</small></td><td><small>${{number_format($reserva->precio,2)}}</small></td></tr>
                    <tr><td><small><strong>Subtotal MXN {{$reserva->dias}} Dia(s)</strong></small></td> <td><small><strong>${{number_format($reserva->precio*$reserva->dias,2)}}</strong></small></td></tr>
                    @foreach($cliente_serv_extra as $servicio)
                    @if($servicio->alquiler == $reserva->id_alquiler)
                    <tr><td><small>{{$servicio->nombre}}</small></td>           <td><small>${{$servicio->precio*$reserva->dias}}.00</small></td></tr>
                    @endif
                    @endforeach
                    <tr><td><small><strong>Total</strong></small></td>          <td><small><strong>${{number_format($reserva->total,2)}}</strong></small></td></tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div id="lista_itinerario">
                <h6><strong>Datos Generales:</strong></h6>    
                <dl>
                <dt>Lugar de Recogida y Devolución</dt>
                <dd>{{$reserva->nombre}}</dd>
                <dt>Fecha / Hora de recolección:</dt>
                <dd>{{date("d\-m\-Y", strtotime($reserva->fecha_recogida))}} a las {{$reserva->hora_recogida}} hrs</dd>
                <dt>Fecha / Hora de devolución:</dt>
                <dd>{{date("d\-m\-Y", strtotime($reserva->fecha_devolucion))}} a las {{$reserva->hora_devolucion}} hrs</dd>
                </dl> 
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"></div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="container">
                @if($reserva->saldo != 0 )
                <div class="row">
                        <h6><strong>Saldo pendiente:  <i class="ico icon-circled active icon-1x fa-1x fa fa-usd text-success" ></i> {{number_format($reserva->saldo,2)}} MXN</strong></h6>    
                </div>
                @else
                <div class="row">
                    <h5><strong>Pagado:</strong> <i class="ico icon-circled active icon-3x fa-3x fa fa-check text-success" ></i></h5>       
                    </div>
                    @endif
            </div>
        </div>
        </div>
    </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">    
                    <div id="lista_itinerario">
                        <h6><strong>Tu vehículo:</strong></h6>  
                        <dl>
                        <dt>{{$reserva->marca}} {{$reserva->modelo}}</dt>
                        @if($reserva->tipo != "motoneta")
                        <dd><i class="fa fa-male"       aria-hidden="true"></i> <small> {{$reserva->pasajeros}} Pasajeros </small></dd>
                        <dd><i class="fa fa-suitcase"   aria-hidden="true"></i><small> {{$reserva->maletero}}</small></dd>
                        <dd><i class="fa fa-car"   aria-hidden="true"></i> <small>{{$reserva->puertas}} Puertas</small></dd>
                        <dd><i class="fa fa-exchange"aria-hidden="true"></i> <small>Transmisión {{$reserva->transmicion}}</small></dd>
                        <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i> <small>{{$reserva->cilindros}} Cilindros</small></dd>
                        <dd><i class="fa fa-bolt"       aria-hidden="true"></i> <small>{{$reserva->rendimiento}} Kilómetros por litro</small></dd>
                        <dd><i class="fa fa-bolt"       aria-hidden="true"></i> <small>Color: {{$reserva->color}}</small></dd>
                        @else
                        <dd><i class="fa fa-snowflake-o"aria-hidden="true"></i> <small>{{$reserva->cilindros}} Cilindros</small></dd>
                        <dd><i class="fa fa-bolt"       aria-hidden="true"></i> <small>{{$reserva->rendimiento}} Kilómetros por litro</small></dd>
                        <dd><i class="fa fa-bolt"       aria-hidden="true"></i> <small>Color: {{$reserva->color}}</small></dd>
                        @endif
                        </dl>   
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="container">
                        <div class="row">
                                <img src="{{$reserva->foto}}" style="width:80%" />
                                <h6><i class="ico icon-circled active icon-1x fa-1x fa fa-window-close text-danger" ></i><strong> Cancelar:</strong> Favor de ponerse en contacto con la sucursal al número: {{$reserva->telefono}}</h6>       
                        </div>
                    </div>
                </div>
    </div>
@endforeach
</div>
</section>
@endsection

