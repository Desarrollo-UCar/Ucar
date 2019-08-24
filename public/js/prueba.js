window.onload=function() {


    function on(sa){alert("Hemos pulsado en on" + sa.value);}
      
    function off(){alert("Hemos pulsado en off");}
      

    var silla = document.getElementById('1');
    var gps =document.getElementById("2");
    var chofer =document.getElementById("3");
    
      silla.addEventListener("change", comprueba, false);
      gps.addEventListener("change", compruebagps, false);
      chofer.addEventListener("change", compruebachofer, false);
      function comprueba(){
        if(silla.checked){
            on(silla);
        }else{
           off();
        }
      }
      function compruebagps(){
        if(gps.checked){
            on(gps);
        }else{
           off();
        }
      }
      function compruebachofer(){
        if(chofer.checked){
            on(chofer);
        }else{
           off();
        }
      }

    
};