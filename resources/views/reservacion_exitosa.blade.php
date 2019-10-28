@extends('plantilla')
@section('seccion')
<section id="inner-headline">
<div class="container">
<div class="jumbotron">
<div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center">                
                <img src="img/exito.jpg" class="rounded mx-auto d-block" alt="" style="width:80%"/>  
                <h2 class="animated fadeInDown "><strong><span class="text-success">PAGO EXITOSO!!!</span></strong></h2>
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">                
                <h6> <strong>{{$cliente->nombre}} {{$cliente->apellidos}},</strong> Tu reserva fue procesada exitosamente.</h6>
                <h6>Acude a la Oficina U-car que elegiste y presenta tu número de reserva</h6>
                <h6>La información sobre su reserva se enviará a la dirección de correo electrónico: <strong> {{$cliente->correo}}</strong></h6>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">                
                <img src="{{$vehiculo->foto}}" class="rounded mx-auto d-block" alt="" style="width:100%"/> 
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">                
                <div class="card bg-light text-white">
                    <div class="card-body">
                        <form id="reserva_traslado" action="{{ route('correo_confirmacion_reserva')}}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                            <h6><strong>Ver mis reservaciones:</strong></h6>  
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <button class="btn btn-primary btn-lg" type="submit" style="margin-top: 0%;">Continuar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div> 
                            </p><strong>(Dudas y aclaraciones: desarolloucar@gmail.com)</strong></p>
        </div>
</div>    
</div>
</div>
</section>
@endsection

