function Tipo(){
    var opcion= document.getElementById("tipo");
    var texto = opcion.options[opcion.selectedIndex].text;
    document.getElementById("tipo").value=texto;
    
    var row = document.getElementById("uno");
    var lice = document.getElementById("licencia");
    var expe = document.getElementById("expedicion");
    var venc = document.getElementById("vencimiento");
    
    if (texto=='CHOFER') {
      row.style.display='block';
      lice.style.display='block';      
      expe.style.display='block';
      venc.style.display='block';
    }else{
      row.style.display='none';
      lice.style.display='none';     
      expe.style.display='none';
      venc.style.display='none';
      }
  }