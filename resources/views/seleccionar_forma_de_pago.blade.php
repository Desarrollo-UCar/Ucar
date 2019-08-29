@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="inner-heading">
            <h2>Selecciona tu forma de pago (Paso 4</h2>
        </div>
        </div>
    </div>
    </div>
</section>
<section id = "forma-pago">
<!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->
<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
        <form action="{{ route('pago_paypal')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="pricing-box-wrap special animated-fast flyIn">
                        <div class="pricing-heading">
                        <h3>Paga el <strong>Total de la reserva</strong></h3>
                        <h3> <strong>MXN {{$datos_reserva->total}} </strong></h3>
                        </div>
                        <div class="pricing-action">
                        </div>
                        <div class="pricing-action">
                            <button class="btn btn-primary btn-lg" type="submit" name = "btnAccion" value= "pago_total">Reservar</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="pricing-box-wrap special animated-fast flyIn">
                            <div class="pricing-heading">
                            <h3>Paga solo <strong>El anticipo</strong></h3>
                            <h3> <strong>MXN {{number_format($anticipo,2)}}</strong></h3>
                            </div>
                            <div class="pricing-action">
                            </div>
                            <div class="pricing-action">
                                <button class="btn btn-primary btn-lg" type="submit" name = "btnAccion" value= "pago_anticipo">Reservar</button>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
    </div>
</section>
@endsection

