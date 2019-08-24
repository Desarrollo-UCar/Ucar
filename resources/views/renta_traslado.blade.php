@extends('plantilla')

@section('seccion')
<section id="formulario">
    <div class="bg-white" id='formulario_reserva_vehiculo'>
        <h5 class="text-center"><strong>Reserva </strong>tu viaje de la manera mas rápida</h5>
    </div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <!-- inicio card reserva -->
            <div class="card bg-light text-white">
            <!--Card content-->
            <div class="card-body">
                <!-- inicio Formulario reserva-->
                <form action="{{ route('renta_traslado_vehiculo')}}" method="POST" name = "formulario" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <label for="lugar_salida">LUGAR DE SALIDA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                </div>
                                <input name = 'lugar_salida' id="origin-input" class="form-control form-control-lg" type="text" placeholder="Ingresa el lugar de salida">
                            </div>
                        </div>
                        <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <label for="lugar_llegada">LUGAR DE LLEGADA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-pencil-square"aria-hidden="true"></i></span>
                                </div>
                                <input name = 'lugar_llegada' id="destination-input" class="form-control form-control-lg" type="text" placeholder="Ingresa el lugar de llegada">
                            </div>
                        </div>
                    
                        <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                            <label for="fechaRecogida">FECHA DE SALIDA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"aria-hidden="true"></i></span>
                                </div>
                                <input name = 'fecha_salida' type="text" class="form-control form-control-lg" placeholder="{{date('Y\-m\-d ') }}" id='fecha_traslado_salida' required>
                            </div>
                        </div>
                        <div class="form-group col-sm-2 col-md-2 col-lg-2 col-xl-2">
                            <label for="horaRecogida">HORA DE SALIDA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-clock-o"aria-hidden="true"></i></span>
                                </div>
                                <select name = 'hora_salida' class="form-control">
                                    <option>08:00</option><option>09:00</option>
                                    <option selected>10:00</option><option>11:00</option>
                                    <option>12:00</option><option>13:00</option>
                                    <option>14:00</option><option>15:00</option>
                                    <option>16:00</option><option>17:00</option>
                                    <option>18:00</option><option>19:00</option>
                                    <option>20:00</option><option>21:00</option>
                                </select>
                            </div>
                        </div>   
                            <input type="button" value = "Consultar" class="btn btn-medium btn-theme" onclick ="Tipo();">
                    </div>
                    <!-- proyeccion de variables tiempo estimado y kilometros estimados -->
                    <div class="form-row" style="display: none;" id="estimaciones">
                        <div class=" col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <h6>KM ESTIMADOS DE VIAJE:</h6>
                            <input name ="km" class="form-control form-control-lg" type="text" id = "km" value = "" readonly = "readonly">
                        </div>
                        <div class=" col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <h6>HRS ESTIMADAS DE VIAJE:</h6>
                            <input name = "hrs" class="form-control form-control-lg" type="text" id = "hrs" value = "" readonly = "readonly">
                        </div>
                        <div class="form-group col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <button class="btn btn-primary" type="submit">Continuar con la Reserva</button>
                        </div>
                    </div>
                       <!-- cajas con valores de lo que se va enviar -->
                    <div class="form-row" style="display: none;" id="datos_enviados">
                          <input name ="km_recorridos"  type="text" id = "km_recorridos" value = "" readonly = "readonly">
                          <input name = "tiempo_estimado"  type="text" id = "tiempo_estimado" value = "" readonly = "readonly">
                  </div>
                    
                </form>
                <!-- fin formulario reserva -->
            </div>
        </div>       
    </div>
</div>
</div>


</section>
@endsection

@section('mapa')
<!-- inicio del mapa de localizacion -->    
<div class="container">    


 <div id="map"></div>
</div>
<!-- fin del mapa de localizacion --> 
@endsection
<script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script
        // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
            mapTypeControl: false,
            center: {lat: 15.8705117, lng: -97.0831325},
            zoom: 13
          });
          new AutocompleteDirectionsHandler(map);
        }
        /**
         * @constructor
         */
        function AutocompleteDirectionsHandler(map) {
          this.map = map;
          this.originPlaceId = null;
          this.destinationPlaceId = null;
          this.travelMode = 'DRIVING';
          this.directionsService = new google.maps.DirectionsService;
          this.directionsDisplay = new google.maps.DirectionsRenderer;
          this.directionsDisplay.setMap(map);
        
          var originInput = document.getElementById('origin-input');
          var destinationInput = document.getElementById('destination-input');

          var originAutocomplete = new google.maps.places.Autocomplete(originInput);
          // Specify just the place data fields that you need.
          originAutocomplete.setFields(['place_id']);
          var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
          // Specify just the place data fields that you need.
          destinationAutocomplete.setFields(['place_id']);
        
          this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
          this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

          
        }
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
            autocomplete, mode) {
          var me = this;
          autocomplete.bindTo('bounds', this.map);
        
          autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            //console.log(place);
            if (!place.place_id) {
              window.alert('Favor de seleccionar un elemento de la lista.');
              return;
            }
            if (mode === 'ORIG') {
              me.originPlaceId = place.place_id;
             // console.log(me.originPlaceId);
            } else {
              me.destinationPlaceId = place.place_id;
            }
            me.route();
            me.destinationPlaceId = me.originPlaceId;
            me.originPlaceId = 'ChIJLdFhSob3uIURuxK1uEllGww';
            me.route();
          });
        };
        
        AutocompleteDirectionsHandler.prototype.route = function() {
          if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
          }
          var me = this;
          this.directionsService.route(
              {
                origin: {'placeId': this.originPlaceId},
                destination: {'placeId': this.destinationPlaceId},
                travelMode: this.travelMode
              },
              function(response, status) {
                if (status === 'OK') {
                  me.directionsDisplay.setDirections(response);
                  // Aqui con el response podemos acceder a la distancia como texto 
                //console.log(response.routes[0].legs[0].distance.text);
                console.log(response);
                document.getElementById('km').value = response.routes[0].legs[0].distance.text;
                document.getElementById('km_recorridos').value = response.routes[0].legs[0].distance.value;
                // Obtenemos la distancia como valor numerico en metros 
                 // console.log(response.routes[0].legs[0].distance.value);
                  document.getElementById('hrs').value = response.routes[0].legs[0].duration.text;
                  document.getElementById('tiempo_estimado').value = response.routes[0].legs[0].duration.value;
                  //console.log(response.routes[0].legs[0].duration);
                } else {
                  window.alert('Directions request failed due to ' + status);
                }
              });
        };        

    function Tipo(){
      var variables_estimadas= document.getElementById("estimaciones");
    variables_estimadas.style.display = (variables_estimadas.style.display == 'none')?'block' : 'none';
  }
</script>