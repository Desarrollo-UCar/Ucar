@extends('plantilla')
@section('seccion')
    <section id="inner-headline">
      <div class="container">
        <div class="row nomargin">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="inner-heading">
              <h2>Autos disponibles a precios accesibles</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
  <section id="content">
      <div class="container">
        <div class="row nomargin">
          <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7">
              <ul class="portfolio-categ filter">
                <li class="all active"><a href="#">Todos</a></li>
                <li class="compacto"><a href="#" title="">Compactos</a></li>
                <li class="camioneta"><a href="#" title="">Camionetas</a></li>
                <li class="suburban"><a href="#" title="">Suburbans</a></li>
                <li class="motoneta"><a href="#" title="">Motonetas</a></li>
              </ul>
          </div>
          <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
              <ul class="portfolio-categ filter">
                <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optradio">Precio de renta
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optradio">Rendimiento
                    </label>
                  </div>
                  <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio">Cilindros
                      </label>
                    </div>
                </ul>
          </div>
        </div>
      </div>
  </section>          
<!-- inicio descripcion de servicios-->
<section id="projects">
      <div class="container">
        <div class="row nomargin cs-style-2 portfolio">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="row nomargin">
@foreach($flota as $vehiculo)
    <div class="grid item-thumbs graphic col-sm-4 col-md-4 col-lg-4 col-xl-4" data-id={{$vehiculo->idvehiculo}} data-type= {{$vehiculo->tipo}}>
    <div class="pricing-box-wrap special animated-fast flyIn">
            <div class="pricing-heading">
                <h3><strong>{{$vehiculo->marca}}</strong> {{$vehiculo->modelo}}</h3>
                <h5><strong>MXN {{number_format($vehiculo->precio,2)}}</strong></h5>
                <h6><strong><i class="fa fa-car"  style="color: #fffffe;" aria-hidden="true"></i> {{$vehiculo->cilindros}} Cilindros
                            <i class="fa fa-bolt" style="color: #fffffe;" aria-hidden="true"></i> {{$vehiculo->rendimiento}} Km/L
                            <i class="fa fa-male" style="color: #fffffe;" aria-hidden="true"></i> {{$vehiculo->pasajeros}} Pasajeros</strong>
                            </h6>

            </div>
                    <figure>
                            <div><img src={{$vehiculo->foto}} /></div>
                    </figure>
            <div class="pricing-action">
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-medium btn-theme" data-toggle="modal" data-target="#vehiculo{{$vehiculo->idvehiculo}}"><i class="icon-chevron-down"></i>
                    Detalles
                    </button>
                <!-- Button trigger modal -->
            </div>
    </div>
    </div>
@endforeach
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- inicio descripcion de servicios-->
<section id="modales">
<!-- Modal -->
@foreach($flota as $vehiculo)
<div class="modal"  id="vehiculo{{$vehiculo->idvehiculo}}" tabindex="-1" role="dialog" aria-labelledby="detalle_vehiculoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="row nomargin modal-body">
                <div class="text-center col-sm-8 col-md-8 col-lg-8 col-xl-8">
                        <h4><strong> {{$vehiculo->marca}}</strong></h4>
                        <h5><strong> {{$vehiculo->modelo}}</strong></h5>
                        <!-- <img src=//$vehiculo->foto}} style="width:100%"/>    recuerda poner las llaves -->
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
                </div>
                <div class="align-self-center col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <ul>
                        <li></i>{{$vehiculo->tipo}}</li>
                        <li><i class="fa fa-male"       aria-hidden="true"></i>{{$vehiculo->pasajeros}} Pasajeros</li>
                        <li><i class="fa fa-suitcase"   aria-hidden="true"></i>{{$vehiculo->maletero}}</li>
                        <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->puertas}} Puertas</li>
                        <li><i class="fa fa-exchange"   aria-hidden="true"></i>Transmisión:  {{$vehiculo->transmicion}} </li>
                        <li><i class="fa fa-car"        aria-hidden="true"></i>{{$vehiculo->cilindros}} Cilindros</li>
                        <li><i class="fa fa-bolt"       aria-hidden="true"></i>{{$vehiculo->rendimiento}} Kilómetros por litro</li>
                        <li><i class="fa fa-pencil-square"aria-hidden="true"></i>Color: {{ $vehiculo->color}}</li>
                        </ul>
                        <p>{{$vehiculo->descripcion}}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Fin Modal -->
</section>

@endsection