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
      
                    <h3 class="box-title">Alquileres de la ultima semana</h3>
    
                  </div>
                  <div class="box-body">
                      <div class="col-md-2"></div>
                      <div class="col-md-7">
                    <div id="bar-chart2-dias" style="height: 350px;"></div>
                    </div>
                  </div>
                  <!-- /.box-body-->
                </div>
              </div>


      </div>

      <div class="row">
          <div class="col-md-12 ">
            <!-- Line chart -->
            <div class="box">
              <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
  
              <h3 class="box-title">Alquileres realizados en el año {{date('Y')}}</h3>

              </div>
              <div class="box-body">
                <div id="bar-chart2-meses" style="height: 300px;"></div>
              </div>
              <!-- /.box-body-->
            </div>
          </div>


  </div>

  <div class="box">
      <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Alquileres realizados en los ultimos años</h3>

      </div>
      <div class="box-body chart-responsive">
          <div class="col-md-3"></div>
        <div class="col-md-6 ">
        <div class="chart" id="bar-chart2" style="height: 300px;"></div>
      </div>
    </div>
      <!-- /.box-body -->
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
                //BAR CHART dias
    var bar = new Morris.Bar({
      element: 'bar-chart2-dias',
      resize: true,
      data: @json($dias),
      barColors: ['#4AB0FC'],
      xkey: 'DIA',
      ykeys: ['CANTIDAD'],
      labels: ['Alquileres'],
      hideHover: 'auto',
      fillOpacity: 100
    });
    //FIN BARCHART AÑO

          //BAR CHART  año
    var bar = new Morris.Bar({
      element: 'bar-chart2',
      resize: true,
      data: @json($reservaciones_anio),
      barColors: ['#A3D169'],
      xkey: 'anio',
      ykeys: ['total'],
      labels: ['Alquileres'],
      hideHover: 'auto',
      fillOpacity: 100
    });
    //FIN BARCHART AÑO

//bar char meses
    var bar = new Morris.Bar({
      element: 'bar-chart2-meses',
      resize: true,
      data: @json($reservaciones_mes),
      barColors: ['#E7B343'],
      xkey: 'mes',
      ykeys: ['cantidad'],
      labels: ['Alquileres'],
      hideHover: 'auto',
      fillOpacity: 100
    });
    //FIN BARCHART AÑO
      /*
       * Flot Interactive Chart
       * -----------------------
       */
      // We use an inline data source in the example, usually data would
      // be fetched from a server
      var data = [], totalPoints = 100
  
      function getRandomData() {
  
        if (data.length > 0)
          data = data.slice(1)
  
        // Do a random walk
        while (data.length < totalPoints) {
  
          var prev = data.length > 0 ? data[data.length - 1] : 50,
              y    = prev + Math.random() * 10 - 5
  
          if (y < 0) {
            y = 0
          } else if (y > 100) {
            y = 100
          }
  
          data.push(y)
        }
  
        // Zip the generated y values with the x values
        var res = []
        for (var i = 0; i < data.length; ++i) {
          res.push([i, data[i]])
        }
  
        return res
      }
  
      var interactive_plot = $.plot('#interactive', [getRandomData()], {
        grid  : {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor  : '#f3f3f3'
        },
        series: {
          shadowSize: 0, // Drawing is faster without shadows
          color     : '#3c8dbc'
        },
        lines : {
          fill : true, //Converts the line chart to area chart
          color: '#3c8dbc'
        },
        yaxis : {
          min : 0,
          max : 100,
          show: true
        },
        xaxis : {
          show: true
        }
      })
  
      var updateInterval = 500 //Fetch data ever x milliseconds
      var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
      function update() {
  
        interactive_plot.setData([getRandomData()])
  
        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw()
        if (realtime === 'on')
          setTimeout(update, updateInterval)
      }
  
      //INITIALIZE REALTIME DATA FETCHING
      if (realtime === 'on') {
        update()
      }
      //REALTIME TOGGLE
      $('#realtime .btn').click(function () {
        if ($(this).data('toggle') === 'on') {
          realtime = 'on'
        }
        else {
          realtime = 'off'
        }
        update()
      })
      /*
       * END INTERACTIVE CHART
       */
  
      /*
       * LINE CHART
       * ----------
       */
      //LINE randomly generated data
  
      var sin = [], cos = []
      for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)])
        cos.push([i, Math.cos(i)])
      }
      var line_data1 = {
        data : sin,
        color: '#3c8dbc'
      }
      var line_data2 = {
        data : cos,
        color: '#00c0ef'
      }
      $.plot('#line-chart', [line_data1, line_data2], {
        grid  : {
          hoverable  : true,
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor  : '#f3f3f3'
        },
        series: {
          shadowSize: 0,
          lines     : {
            show: true
          },
          points    : {
            show: true
          }
        },
        lines : {
          fill : false,
          color: ['#3c8dbc', '#f56954']
        },
        yaxis : {
          show: true
        },
        xaxis : {
          show: true
        }
      })
      //Initialize tooltip on hover
      $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: 'absolute',
        display : 'none',
        opacity : 0.8
      }).appendTo('body')
      $('#line-chart').bind('plothover', function (event, pos, item) {

        if (item) {
          var x = item.datapoint[0].toFixed(2),
              y = item.datapoint[1].toFixed(2)
  
          $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
            .css({ top: item.pageY + 5, left: item.pageX + 5 })
            .fadeIn(200)
        } else {
          $('#line-chart-tooltip').hide()
        }
  
      })
      /* END LINE CHART */
  
      /*
       * FULL WIDTH STATIC AREA CHART
       * -----------------
       */
      var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
        [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
        [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
      $.plot('#area-chart', [areaData], {
        grid  : {
          borderWidth: 0
        },
        series: {
          shadowSize: 0, // Drawing is faster without shadows
          color     : '#00c0ef'
        },
        lines : {
          fill: true //Converts the line chart to area chart
        },
        yaxis : {
          show: false
        },
        xaxis : {
          show: false
        }
      })
  
      /* END AREA CHART */
  
    /*
     * BAR CHART RESERVACION POR AÑO 
     * ---------
     */

     var bar_data = {
      data :  [[1,1]],

      color: '#3c8dbc'
    }


    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1, 
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })

    /* END BAR CHART RESERVACION POR AÑO */

 /*
     * BAR CHART RESERVACION POR AÑO 
     * ---------
     */

     var bar_data_meses = {
      data : [[1,1]],

      color: '#3c8dbc'
    }


    $.plot('#bar-chart-meses', [bar_data_meses], {
      grid  : {
        borderWidth: 1, 
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })

    /* END BAR CHART RESERVACION POR AÑO */

   
  
      /*
       * DONUT CHART
       * -----------
       */
  
      var donutData = [
        { label: 'Series2', data: 30, color: '#3c8dbc' },
        { label: 'Series3', data: 20, color: '#0073b7' },
        { label: 'Series4', data: 50, color: '#00c0ef' }
      ]
      $.plot('#donut-chart', donutData, {
        series: {
          pie: {
            show       : true,
            radius     : 1,
            innerRadius: 0.5,
            label      : {
              show     : true,
              radius   : 2 / 3,
              formatter: labelFormatter,
              threshold: 0.1
            }
  
          }
        },
        legend: {
          show: false
        }
      })
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