<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" margin= "0">

<head>

    <style>
      @page { margin: 180px 25px; }

        p.small {
          line-height: 0.1% ;
        }

        p.big {
          line-height: 1.8;
        }

      #header { 
        position: fixed;
        left: 0px; 
        top: -160px;
        right: 0px; 
        height: 115px;
        background-color: rgb(215, 215, 215);
        text-align: center; 
          }

      #footer {
        position: fixed;
        left: 0px; 
        bottom: -180px;
        right: 0px; 
        height: 150px; 
        background-color: lightblue;
        }

      #p {
        position: fixed; 
        left: 0px; 
        top: 60px; 
        right: 0px; 
        height: 180px;  
        border-style: solid;
        border-width: 1px; 
        text-align: center;
          }

          h5
          {
        line-height: 0.2;
        }
        h2
          {
  
        }
        h3
          {
        line-height: 0.2;
        }
        table{
          border-collapse: collapse;
          /* margin: 15px; */
          /* border-style: solid; */
          /* border-width: 2px;  */
          border: 1px solid black;
        }
        th {
          border: 1px solid black;
  background-color:cadetblue;
  color: black;
}
td{
  border: 1px solid black;
}


        label {
  font-size: 9px;
  }
        input {
  border: none;
  border-bottom: 1px solid;
}
      #footer .page:after { content: counter(page, upper-roman) }
    </style>
<head>
    <div id="header">
      <!--  <div class="pull-left image">
            <img src="{{asset("assets/$theme/dist/img/descarga.jpg")}}" class="img-circle" alt="User Image">
          </div> -->

          <div id="logo" style="position:absolute; width:100px; height:0px; top: 0px; left: 0px"> 
          <img src="{{asset("assets/$theme/dist/img/descarga.jpg")}}"width="115" height="115"> </div> 

        <p class="small">
            <h2>RENTA DE AUTOS Y SCOOTERS</h2>
            <h3>ADRIANA RODRIGUEZ BENITEZ</h3>
            <h5>Calle del Morro s/n, Col Marinero</h5>
            <h5>Santa Maria, Colotepec, Poch, Oax. C.P.70934</h5>
      </p>
    </div>
  </head>
      <body> 
          <h2>BITACORA DE MANTENIMIENTOS</h2>
          <h5>___________________________________________________________________________________________________________________</h5>
          
          <?php
          $anterior='0';
          $total = 0;
          $gran_total = 0;
          ?>

            @foreach ($mantenimientos as $mantenimiento)
            
            @if($anterior!=$mantenimiento->vehiculo)
            @if($anterior!='0')
            <tr>
              <td colspan='4'>TOTAL</td>
              {{-- <td></td>
              <td></td>      
              <td></td>
              <td></td> --}}
              <td> ${{number_format($total,2)}} </td>
               </tr>
            </table>
            <?php
            $gran_total+=$total;
            $total=0;
            ?>
            
            @endif
              <h4> Vehiculo: {{$mantenimiento->marca}} {{$mantenimiento->modelo}} {{$mantenimiento->anio}}Matricula: {{$mantenimiento->matricula}} </h4>
               
               <table class="table" WIDTH="100%">
                  <tr>
                    <th>Numero</th>
                    <th>Entra</th>
                    <th>Sale</th>
                    {{-- <th>Costo</th> --}}
                    <th>Tipo</th>
                    <th>Costo</th>
                  </tr>
                  {{-- <br> --}}

              @endif

              <tr>
              <td>{{$mantenimiento->idmantenimiento}}</td>
              <td>{{date("d\-m\-Y", strtotime($mantenimiento->fecha_ingresa))}}</td>
              <td>{{date("d\-m\-Y", strtotime($mantenimiento->fecha_salida))}}</td>
              <td>{{$mantenimiento->tipom}}</td>
              <td> ${{number_format($mantenimiento->costo_total,2)}}</td>
             </tr>

             <?php
             $total+=$mantenimiento->costo_total;
             $anterior=$mantenimiento->vehiculo;
             ?>
     @endforeach

     <tr>
        <td colspan='4'>TOTAL</td>
        <td>${{number_format($total,2)}} </td>
         </tr>
      </table>
      <?php
      $gran_total+=$total;

      ?>
              <p class="small">
    <h2>Costo total de mantenimientos =<strong> ${{number_format($gran_total,2)}}</strong> </h2>
          </p>
  </body>
</html>