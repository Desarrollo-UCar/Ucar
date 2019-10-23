@extends('plantilla')
@section('seccion')
<!-- section featured -->
<section id="featured">
      <!-- slideshow start here -->
      <div class="camera_wrap" id="camera-slide">
        <!-- slide 1 here -->
        <div data-src="{{'/images/'.$sucursal->foto}}">
          <div class="camera_caption fadeFromLeft">
            <div class="container-fluid">
              <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                  <h2 class="animated fadeInDown text-white"><strong>LAS MEJORES <span class="colored">OFICINAS</span></strong></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- slideshow end here -->
    </section>
    <!-- /section featured -->

<!-- /section INTERMEDIA -->
<section id="mensaje-intermedio">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
            <h4>Renta un automovil en <strong>{{$sucursal->nombre}}</strong> </h4>
            <div><img src={{'/public/images/'.$sucursal->foto}} /></div>
            <p>
            Ü-CAR tiene la mejor flota de vehiculos para tus necesidades. Tenemos ofertas y promociones para ti.
            </p>
        </div>
    </div>
</section>
<!-- /section INTERMEDIA -->

<section id="mapa">
<!--Google map-->
<div class="row">
    <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1">
    </div>
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 google-maps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.9583969482856!2d-95.0425274856098!3d16.4776441327409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85eaaab5997ee615%3A0x7bdf285ff65ccf77!2sDe+Los+Maestros%2C+2da+Secc%2C+El+Espinal%2C+Oax.!5e0!3m2!1ses!2smx!4v1561654004250!5m2!1ses!2smx" width="750" height="450" frameborder="0" style="border:0">
    </iframe>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <h4>U-CAR <strong>{{$sucursal->nombre}}</strong></h4>
            <p>
            {{$sucursal->calle}}, NUMERO: {{$sucursal->numero}}<br><br>
            {{$sucursal->colonia}},<br><br>
            {{$sucursal->municipio}}, {{$sucursal->estado}}
            </p>
            <h5>{{$sucursal->telefono}}</h5>
    </div>
</div>
<!--Google Maps-->
</section>
@endsection