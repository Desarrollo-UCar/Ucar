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

        <!-- slide 2 here -->
        <div data-src="{{'/images/'.$sucursal->foto1}}">
          <div class="camera_caption fadeFromLeft">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 text-center">
                  <h2 class="animated fadeInDown text-white"><strong>EL MEJOR <span class="colored">PERSONAL</span></strong></h2>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- slide 3 here -->
        <div data-src="{{'/images/'.$sucursal->foto2}}">
          <div class="camera_caption fadeFromLeft">
            <div class="container-fluid">
              <div class="row">
                 <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 text-center">
                  <h2 class="animated fadeInDown text-white"><strong>LOS MEJORES <span class="colored">DESTINOS TURÍSTICOS</span></strong></h2>
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
            <h4>Renta un automóvil en <strong>{{$sucursal->nombre}}</strong> </h4>
            <p>
            Ü-CAR tiene la mejor flota de vehículos para tus necesidades. Tenemos ofertas y promociones para ti.
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
    <iframe src="{{$sucursal->link}}" width="650" height="450" frameborder="0" style="border:0">
    </iframe>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
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