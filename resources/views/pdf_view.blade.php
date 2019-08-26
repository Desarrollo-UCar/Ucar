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
        
          margin: 15px;
          border-style: solid;
          border-width: 2px; 

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
  <body>
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
        <h5>___________________________________________________________________________________________________________________</h5>
          <h5>Datos arrendatario (Renter)</h5>
      
              <table class="table" WIDTH="100%">

                  <tr>
                
                    <td>  
                      <label for="fname"  >Nombre (Name)</label></td>
                    <td>
                    <label for="fname"  >Fecha Nac. (Bhirthday)</label></td>
                
                    <td><label for="fname"> Tel Cel. (CelPhone)</label></td>
                
                  </tr>
                
                  <tr>
                
                      <td> {{$nombre}}  {{$ap}} {{$am}}  </td>
                  
                      <td>2000/01/01</td>
                  
                      <td>{{$nombre}}</td>
                  
                    </tr>

                  <tr>
                
                    <td> <input type="text" id="fname" name="fname"au></td>
                
                    <td><input type="text" id="fname" name="fname"></td>
                
                    <td><input type="text" id="fname" name="fname"></td>

                  </tr>

                  <!-- SEGUNDA FILA-->

                  <tr>
                
                      <td>  
                        <label for="fname"  >Direccion Local (Local Addess)</label></td>
                      <td>
                      <label for="fname" > Calle (Street)</label></td>
                  
                      <td><label for="fname"  > Correo Electronico/e-mail</label></td>
                  
                    </tr>
                  
                    <tr>
                  
                        <td> {{$nombre}}  {{$ap}} {{$am}} </td>
                    
                        <td><input type="text" id="fname" name="fname"></td>
                    
                        <td>{{$nombre}}</td>
                    
                      </tr>
  
                    <tr>
                  
                      <td> <input type="text" id="fname" name="fname"></td>
                  
                      <td><input type="text" id="fname" name="fname"></td>
                  
                      <td><input type="text" id="fname" name="fname"></td>
                      
                    </tr>
                    
                    <!-- Tercer nivel-->

                    <tr>
                
                        <td>  
                          <label for="fname"  >Licencia Conductor (Driver License)</label></td>
                        <td>
                        <label for="fname" >Ciudaad (City)</label></td>
                    
                        <td><label for="fname"  > Lugar de hospedaje / Place of</label></td>
                    
                      </tr>
                    
                      <tr>
                    
                          <td> {{$nombre}}  {{$ap}} {{$am}} </td>
                      
                          <td><input type="text" id="fname" name="fname"></td>
                      
                          <td>{{$nombre}}</td>
                      
                        </tr>
    
                      <tr>
                    
                        <td> <input type="text" id="fname" name="fname"></td>
                    
                        <td><input type="text" id="fname" name="fname"></td>
                    
                        <td><input type="text" id="fname" name="fname"></td>
                        
                      </tr>

                      <tr>
                
                          <td>  
                            <label for="fname"  >Vence (Expire)</label></td>
                          <td>
                          <label for="fname" > Pais (Country)</label></td>
                      
                          <td><label for="fname"  > </label></td>
                      
                        </tr>
                      
                        <tr>
                      
                            <td> {{$nombre}}  {{$ap}} {{$am}} </td>
                        
                            <td><input type="text" id="fname" name="fname"></td>
                        
                            <td>{{$nombre}}</td>
                        
                          </tr>
      
                        <tr>
                      
                          <td> <input type="text" id="fname" name="fname"></td>
                      
                          <td><input type="text" id="fnamDe" name="fname"></td>
                      
                          <td><input type="text" id="fname" name="fname"></td>
                          
                        </tr>

                        <!-- -->

                        <tr>

                          <td>             
                            <label for="fname" ><b>Conductor adicional (Additiona driver)</b></label></td>
                          <td>
                          <label for="fname" ></label></td>
                      
                          <td><label for="fname"  > </label></td>
                      
                        </tr>
                      

                        <tr>

                            <td>             
                              <label for="fname">Nombre (Name)</label></td>
                            <td>
                            <label for="fname" >Fecha Nac. (Bithday) &nbsp;&nbsp;&nbsp;&nbsp;Licencia Conductor(Driver Licence)}</label></td>
                        
                            <td><label for="fname"  >Vence (Expire)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspFirma (Signature)</label></td>
                        
                          </tr>
                        
                          <tr>
                        
                              <td> {{$nombre}}  {{$ap}} {{$am}} </td>
                          
                              <td><input type="text" id="fname" name="fname"></td>
                          
                              <td>{{$nombre}}</td>
                          
                            </tr>
        
                          <tr>
                        
                            <td> <input type="text" id="fname" name="fname"></td>
                        
                            <td><input type="text" id="fname" name="fname"></td>
                        
                            <td><input type="text" id="fname" name="fname"></td>
                            
                          </tr>            
                </table>
<table>
  <tr>
              <td>
                <table>
                  <tr>
                    <td>  
                      <table>
                        <tr>
                        <td>
                            <table>
                              <tr>
                              <td>&nbsp;&nbsp;</td>
                              <td>S</td>
                              <td>E</td>
                              </tr>

                              <tr>
                                <td>Espejo <br> Mirror</td>
                                <td>|_|</td>
                                <td>|_|</td>
                                </tr>

                                <tr>
                                    <td>Llanta <br> Spare</td>
                                    <td>|_|</td>
                                    <td>|_|</td>
                                    </tr>

                                    <tr>
                                        <td>Radio</td>
                                        <td>|_|</td>
                                        <td>|_|</td>
                                    </tr>

                                    <tr>
                                        <td>Toldo <br> awning<br></td>
                                        <td>|_|</td>
                                        <td>|_|</td>
                                        </tr>

                                        <tr>
                                            <td>Gas</td>
                                            <td>|_|</td>
                                            <td>|_|</td>
                                        </tr>

                            </table>  

                       
                        </td>  

                        <td>
                            <table>
                                <tr>
                                <td>&nbsp;&nbsp;</td>
                                <td>S</td>
                                <td>E</td>
                                </tr>
  
                                <tr>
                                  <td>Placas <br> Plates</td>
                                  <td>|_|</td>
                                  <td>|_|</td>
                                  </tr>
  
                                  <tr>
                                      <td>Antena <br> antenna</td>
                                      <td>|_|</td>
                                      <td>|_|</td>
                                      </tr>
  
                                      <tr>
                                          <td>______ <br>______<br></td>
                                          <td>|_|</td>
                                          <td>|_|</td>
                                          </tr>
  
                                          <tr>
                                              <td>______ <br>______<br></td>
                                              <td>|_|</td>
                                              <td>|_|</td>
                                          </tr>
  
                              </table>  
                        </td>

                        <td>
                            <table>
                                <tr>
                                <td>&nbsp;&nbsp;</td>
                                <td>S</td>
                                <td>E</td>
                                </tr>
  
                                <tr>
                                  <td>______<br>______</td>
                                  <td>|_|</td>
                                  <td>|_|</td>
                                  </tr>
  
                                  <tr>
                                      <td>______ <br>______</td>
                                      <td>|_|</td>
                                      <td>|_|</td>
                                      </tr>
  
                                      <tr>
                                          <td>______ <br>______<br></td>
                                          <td>|_|</td>
                                          <td>|_|</td>
                                          </tr>
  
                                          <tr>
                                              <td>______ <br>______<br></td>
                                              <td>|_|</td>
                                              <td>|_|</td>
                                          </tr>
  
                              </table>  
                        </td>
                      </tr>
                      
                    </table>
                  </td>
                </tr>
                <tr>
                    <td>
                        He verificado que el vehiculo lleva el equipo especial especificado, que los daños esten marcados en el croquis y soy responsable por daños o robo parcial o total.
                        <br>
                        He verified that the vehicle carries the specified special equipment, that the damages are marked in the sketch and I am responsible for damages or partial or total theft.
                    </td>
                  </tr>
                </table>
       </td>
      <td>
          <td>
              He verificado que el vehiculo lleva el equipo especial especificado, que los daños esten marcados en el croquis y soy responsable por daños o robo parcial o total.
              <br>
              He verified that the vehicle carries the specified special equipment, that the damages are marked in the sketch and I am responsible for damages or partial or total theft.
          </td>  
      </td> 
      </table>
      </body>
    
    <div id="footer">
      <p class="page">Page </p>
    </div>
    <div id="content">

      <p style="page-break-before: always;">the second page</p>
    </div>
  </body>
</html>