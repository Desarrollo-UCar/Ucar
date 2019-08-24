@extends('plantilla')
@section('seccion')
<!-- section featured -->
<section id="featured">
      <!-- slideshow start here -->
      <div class="camera_wrap" id="camera-slide">
        <!-- slide 1 here -->
        <div data-src="img/sucursales/oficinas-puerto-escondido.jpg">
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
        <div data-src="img/sucursales/personal-puerto-escondido.png">
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
        <div data-src="img/inicio/Puerto-Escondido.jpg">
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
            <h4>Renta un automovil en Puerto Escondido: </h4>
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
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d959.4924581898888!2d-97.05973667083039!3d15.858182789377102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85b8f7028ef8b609%3A0xfc688a4b415cb11f!2sU-CAR+PUERTO+ESCONDIDO!5e0!3m2!1ses!2smx!4v1561619281009!5m2!1ses!2smx" width="750" height="450" frameborder="0" style="border:0">
    </iframe>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <h4>U-CAR <strong>Puerto escondido</strong></h4>
        <p>
        Calle del Morro S/N
        Col. Marinero, Santa María Colotepec
        Pochutla, Oaxaca.
            </p>
            <h5>(954) 582-32-24 + 52 954 149 0304</h5>
    </div>
</div>
<!--Google Maps-->
</section>
@endsection