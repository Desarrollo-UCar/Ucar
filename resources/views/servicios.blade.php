@extends('plantilla')
@section('seccion')
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
            <aside class="left-sidebar">
              <div class="widget">
                <div class="tabs">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#one" data-toggle="tab"><i class="icon-star"></i> Popular</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="one">
                      <ul class="popular">
                        <li>
                        @foreach($popular as $popu)
                          <img src="{{'/images/'.$popu->foto}}" alt="" class="thumbnail pull-left" />
                          <p>{{$popu->marca}} {{$popu->modelo}} {{$popu->anio}}</p>
                          <p>{{$mes}}, {{$anio}}</p>
                        @endforeach
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="widget">

                <h5 class="widgetheading">Estimado cliente</h5>
                <p>
                  Contamos con una amplia gama de servicios para tu comodidad, no dudes en visitarnos y vivir una grandiosa experiencia.
                </p>

              </div>
            </aside>
          </div>

          <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">

          <article>
              <div class="row">
                <div class="align-self-center col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="post-slider">
                    <div class="post-heading">
                      <h3><a href="#">Renta de Vehículo</a></h3>
                    </div>
                    <div class="clear"></div>
                    <!-- start flexslider -->
                    <div class="flexslider">
                      <ul class="slides">
                        <li>
                          <img src="img/servicios/renta-normal.jpg." alt="" />
                        </li>
                        <li>
                          <img src="img/servicios/renta-motoneta.jpg" alt="" />
                        </li>
                      </ul>
                    </div>
                    <!-- end flexslider -->
                  </div>
                  </div>
                  <div class="align-self-center col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <ul>
                        <h5>Autos:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>Licencia de conducir vigente</li>
                        <li>Aceptamos todas las tarjeta de crédito</li>
                        </ul>
                        <p>Se requiere de un depósito de garantia por la cantidad de MXN 20,000.00</p>
                    </div>
                    <div class="align-self-center col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <ul>
                        <h5>Motonetas:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>Licencia de conducir vigente</li>
                        <li>Aceptamos todas las tarjeta de crédito</li>
                        </ul>
                        <p>Se requiere de un depósito de garantia por la cantidad de MXN 20,000.00</p>
                    </div>

                </div>
            </article>

            <article>
              <div class="row">
                <div class="align-self-center col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="post-slider">
                    <div class="post-heading">
                      <h3><a href="#">Renta de Automovil + Chofer</a></h3>
                    </div>
                    <div class="clear"></div>
                    <!-- start flexslider -->
                    <div class="flexslider">
                      <ul class="slides">
                        <li>
                          <img src="img/servicios/renta-mas-chofer-2.jpg" alt="" />
                        </li>
                        <li>
                          <img src="img/servicios/renta-mas-chofer-3.jpg" alt="" />
                        </li>
                      </ul>
                    </div>
                    <!-- end flexslider -->
                  </div>
                  </div>
                  <div class="align-self-center col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <ul>
                        <h5>Automovil + Chofer:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>Aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Se requiere de un depósito de garantia por la cantidad de MXN 20,000.00</p>
                        <p>El servicio de chofer es de 8 hrs. por dia.</p>
                    </div>
                </div>
            </article>

            <article>
              <div class="row">
                <div class="align-self-center col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="post-slider">
                    <div class="post-heading">
                      <h3><a href="#">Traslado a Todas Partes de la República Mexicana</a></h3>
                    </div>
                    <div class="clear"></div>
                    <!-- start flexslider -->
                    <div class="flexslider">
                      <ul class="slides">
                        <li>
                          <img src="img/servicios/traslado.jpg" alt="" />
                        </li>
                        <li>
                          <img src="img/servicios/traslado2.jpg" alt="" />
                        </li>
                      </ul>
                    </div>
                    <!-- end flexslider -->
                  </div>
                  </div>
                  <div class="align-self-center col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <ul>
                        <h5>Traslados:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>Aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Comunícate con tu sucursal de preferencia y obten la cotización de tu viaje</p>
                    </div>

                </div>
            </article>
            <article>
              <div class="row">
                <div class="align-self-center col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="post-slider">
                    <div class="post-heading">
                      <h3><a href="#">Flotillas Para Empresas</a></h3>
                    </div>
                    <div class="clear"></div>
                    <!-- start flexslider -->
                    <div class="flexslider">
                      <ul class="slides">
                        <li>
                          <img src="img/servicios/renta-mas-chofer-2.jpg" alt="" />
                        </li>
                        <li>
                          <img src="img/servicios/renta-mas-chofer-3.jpg" alt="" />
                        </li>
                      </ul>
                    </div>
                    <!-- end flexslider -->
                  </div>
                  </div>
                  <div class="align-self-center col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <ul>
                        <h5>Flotilla:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>Licencia de conducir vigente</li>
                        <li>Aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Comunícate con tu sucursal de preferencia y obten la cotización de tu flotilla</p>
                    </div>
                </div>
            </article>
          </div>
        </div>
      </div>
    </section>


@endsection