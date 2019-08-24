@extends('plantilla')
@section('seccion')
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <aside class="left-sidebar">
              <div class="widget">
                <div class="tabs">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#one" data-toggle="tab"><i class="icon-star"></i> Popular</a></li>
                    <li><a href="#two" data-toggle="tab">Recent</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="one">
                      <ul class="popular">
                        <li>
                          <img src="img/flota/Chevrolet-Aveo-2018.jpg" alt="" class="thumbnail pull-left" />
                          <p><a href="#">Chevrolet Aveo</a></p>
                          <span>Junio, 2019</span>
                        </li>
                        <li>
                          <img src="img/flota/Honda-Dio-2019.jpg" alt="" class="thumbnail pull-left" />
                          <p><a href="#">Motoneta Honda</a></p>
                          <span>Julio, 2019</span>
                        </li>
                      </ul>
                    </div>
                    <div class="tab-pane" id="two">
                      <ul class="recent">
                        <li>
                          <p><a href="#">Toyota rentada recientemente</a></p>
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

          <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">

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
                        <li>licencia vigente</li>
                        <li>aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Detalles del servicio</p>
                    </div>
                    <div class="align-self-center col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <ul>
                        <h5>Motonetas:</h5>
                        <li>identificacion/pasaporte</li>
                        <li>licencia vigente</li>
                        <li>Tarjeta</li>
                        </ul>
                        <p>Detalles del servicio</p>
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
                        <li>licencia vigente</li>
                        <li>aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Detalles del servicio</p>
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
                        <h5>Autos:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>licencia vigente</li>
                        <li>aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Detalles del servicio</p>
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
                        <h5>Autos:</h5>
                        <li>Identificacion/pasaporte</li>
                        <li>licencia vigente</li>
                        <li>aceptamos todas las tarjeta de credito</li>
                        </ul>
                        <p>Detalles del servicio</p>
                    </div>
                    <div class="align-self-center col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <ul>
                        <h5>Motonetas:</h5>
                        <li>identificacion/pasaporte</li>
                        <li>licencia vigente</li>
                        <li>Tarjeta</li>
                        </ul>
                        <p>Detalles del servicio</p>
                    </div>

                </div>
            </article>
          </div>
        </div>
      </div>
    </section>


@endsection