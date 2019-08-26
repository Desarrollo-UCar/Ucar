@extends('plantilla')
@section('seccion')
<section id="inner-headline">
    <div class="container">
    <div class="row nomargin">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="inner-heading">
            <h2>Selecciona tu forma de pago (Paso 4 de 4)</h2>
        </div>
        </div>
    </div>
    </div>
</section>
<section id = "forma-pago">
<!-- FINALIZA BARRA LATERAL DE INFORMACIÓN -->
<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
        <h5 >Datos Requeridos Para el Pago</h5>
        <form action="{{ route('pago_paypal')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 >Método de Pago</h5>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="pricing-box-wrap special animated-fast flyIn">
                        <div class="pricing-heading">
                        <h3>Prepaga en <strong>Linea</strong></h3>
                        <h6>El total del alquiler y llévate 5% de descuento</h6>
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
                            <h3>Prepaga en <strong>Linea</strong></h3>
                            <h6>El anticipo del alquiler</h6>
                            </div>
                            <div class="pricing-action">
                            </div>
                            <div class="pricing-action">
                                <button class="btn btn-primary btn-lg" type="submit" name = "btnAccion" value= "pago_anticipo">Reservar</button>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <input class="form-check-input" type="checkbox" value="" id="terminos_condiciones" name = 'terminos_condiciones' required>
                    <label for="terminos_condiciones">Debes estar de acuerdo con los terminos y condiciones.</label>
                    <p>El total se basa en la información disponible al momento de la reserva para los arrendatarios mayores de 25 años. Los servicios opcionales que puedes elegir al momento del alquiler, tales como recarga de combustible, protección LDW para el vehículo, etc., no están incluidos.</p>
                </div>
            </div>
        </form>


    </div>
</section>
@endsection

