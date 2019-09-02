$(document).ready(function () {
  var value = $("#codigo_postal").val();
  obtenerDatos(value);
  $("#codigo_postal").keyup(function () {
       var value = $(this).val();
       document.getElementById("municipio").readOnly = true;
       document.getElementById("estado").readOnly = true;
      obtenerDatos(value);
      
    });
    
  function obtenerDatos(datos){
    var cadena = datos;

    var url= 'https://api-codigos-postales.herokuapp.com/v2/codigo_postal/' + cadena;
    var api = new XMLHttpRequest();
    api.open('GET',url,true);
    api.send();

    api.onreadystatechange= function(){

      if(this.status == 200 && this.readyState==4){
        var arreglo=JSON.parse(this.responseText);
       // console.log(arreglo.municipio);
       
       var municipio = arreglo.municipio;
        municipio= municipio.toUpperCase();
        $("#municipio").val(municipio);

        var estado = arreglo.estado;
        estado = estado.toUpperCase();
        $("#estado").val(estado);

        var select = document.getElementById("colonia");
        var colonia = arreglo.colonias;
        select.options.length = 0; 
        for(var item of colonia){
            var select = document.getElementById("colonia");
            item = item.toUpperCase();
              select.options[select.options.length] = new Option(item, item);
        }
      }
    }
  }  
    
});