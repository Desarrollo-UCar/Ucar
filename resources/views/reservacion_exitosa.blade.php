@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
            <div class="jumbotron text-center">
                    <img src="img/exito.jpg" class="rounded mx-auto d-block" alt="" style="width:25%"/>  
                    <h1>Pago exitoso: </h1>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                            <h2 class="animated fadeInDown "><strong><span class="text-success">PAGO EXITOSO!!!</span></strong></h2>
                            <h6></h6>
                            <h6> <strong>{{$cliente->nombre}} {{$cliente->apellidos}}</strong> Tu reserva fue procesada exitosamente.</h6>
                            <h6>Acude a la Oficina U-car que elegiste y presenta tu número de reserva</h6>
                            <h6>La información sobre su reserva se enviará a esta dirección de correo electrónico: <strong> {{$cliente->correo}}</strong></h6>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">                
                                        <img src="{{$vehiculo->foto}}" class="rounded mx-auto d-block" alt="" style="width:100%"/> 
                        </div>

                        <div class="card bg-light text-white">
                            <!--Card content-->
                            <div class="card-body">
                                <!-- inicio Formulario reserva-->
                                <form id="reserva_traslado" action="{{ route('correo_confirmacion_reserva')}}"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12 col-sm-12">
                                        <h6><strong>Ver mis reservaciones:</strong></h6>  
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12">
                                                <button class="btn btn-primary" type="submit" style="margin-top: 0%;">Continuar</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- fin formulario reserva -->
                            </div>
                        </div> 

                    </p><strong>(Dudas y aclaraciones: desarolloucar@gmail.com)</strong></p>
            </div>
        
    </div>
    </div>
</section>
@endsection

