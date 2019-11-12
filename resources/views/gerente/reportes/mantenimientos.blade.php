@extends("theme.$theme.layout")

@section('styles')
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/morris.js/morris.css")}}">
@endsection

@section('contenido')
<section class="content-header">
    <h1>
      Panel de administracion
      <small>Gerente</small>
    </h1>
</section>
<section class="content">


          <div class="row"> 
              <div class="col-md-12 ">
                <!-- Line chart -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
      
                  <h3 class="box-title">{{$titulo}}</h3>
    
                  </div>
                  <div class="box-body">
                      <div class="col-md-2"></div>
                      <div class="col-md-7">
                    <div id="bar-chart2-mantenimientos" style="height: 350px;"></div>
                    </div>
                  </div>
                  <!-- /.box-body-->
                </div>
              </div>


      </div>


  
    </section>

@endsection

@section('scripts')

<!-- Morris.js charts -->
<script src="{{asset("assets/$theme/bower_components/raphael/raphael.min.js")}}"></script>
<script src="{{asset("assets/$theme/bower_components/morris.js/morris.min.js")}}"></script>

<!-- jvectormap -->
<script src="{{asset("assets/$theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{asset("assets/$theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}"></script>

<!-- jQuery Knob Chart-->
<script src="{{asset("assets/$theme/bower_components/jquery-knob/dist/jquery.knob.min.js")}}"></script>

<!-- FLOT CHARTS -->
<script src="{{asset("assets/$theme/bower_components/Flot/jquery.flot.js")}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset("assets/$theme/bower_components/Flot/jquery.flot.resize.js")}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset("assets/$theme/bower_components/Flot/jquery.flot.pie.js")}}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{asset("assets/$theme/bower_components/Flot/jquery.flot.categories.js")}}"></script>
<script>
    $(function () {
                //BAR CHART mantenimientos general
    var bar = new Morris.Bar({
      element: 'bar-chart2-mantenimientos',
      resize: true,
      data: @json($mantenimientos),
      barColors: ['#4AB0FC'],
      xkey: 'matricula',
      ykeys: ['cantidad'],
      labels: ['Mantenimientos'],
      hideHover: 'auto',
      fillOpacity: 100
    });
    //FIN BARCHART AÑO

      /*
       * END DONUT CHART
       */
  
    })
  
    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
      return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + '<br>'
        + Math.round(series.percent) + '%</div>'
    }
  </script>

@endsection