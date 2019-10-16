
@extends('plantilla')
@section('seccion')
<section id="content">
<div class="container">
    <form  action="{{ route('cliente_modificar')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="form-group col-md-12 col-sm-12">
        <label>Datos personales que puede modificar de su cuenta, cuando cambie de domicilio</label>
    </div>  
    <div class="form-group col-md-2 col-sm-2">
        <label>Teléfono</label>
        <input type="text" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" pattern="[0-9]*" minlength = "10" maxlength="10" title="Número a 10 digitos" value ="{{$cliente->telefono}}"  required>
    </div>  
    <div class="form-group col-md-2 col-sm-2">
        <label>País</label>
        <input type="text" class="form-control" placeholder="País" name="pais" onkeyup="javascript:this.value=this.value.toUpperCase();" id="pais" value ="{{$cliente->pais}}" required>
    </div>
    <div class="form-group col-md-2 col-sm-2">
        <label>Estado</label>
        <input type="text" class="form-control" placeholder="Estado" name="estado" onkeyup="javascript:this.value=this.value.toUpperCase();" id="estado" value ="{{$cliente->estado}}" required>
    </div>      
    <div class="form-group col-md-3 col-sm-3">
        <label>Ciudad</label>
        <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();" id="ciudad" value ="{{$cliente->ciudad}}" required>
    </div>
    <div class="form-group col-md-3 col-sm-3">
        <label>Colonia</label>
        <input type="text" class="form-control" placeholder="Colonia" name="colonia" onkeyup="javascript:this.value=this.value.toUpperCase();" id="colonia" value ="{{$cliente->colonia}}" required>
    </div>
    <div class="form-group col-md-4 col-sm-4">
        <label>Calle</label>
        <input type="text" class="form-control" placeholder="Calle" name="calle" onkeyup="javascript:this.value=this.value.toUpperCase();" id="calle"value ="{{$cliente->calle}}" required>
    </div>
    <div class="form-group col-md-2 col-sm-2">
        <label>Número</label>
        <input type="text" class="form-control" placeholder="Número de calle" name="numero" onkeyup="javascript:this.value=this.value.toUpperCase();" id="numero" value ="{{$cliente->numero}}" required>
    </div>
    <div class="col-md-2 col-sm-2">
        <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Modificar" style="margin-top: 18%;">
    </div>
    @if($oko == 1)
    <div class="content2 col-md-3 col-sm-3">
            <p style="margin-top: 5%;">Cambios realizados con exito <i class="ico icon-circled active icon-2x fa-2x fa fa-check text-success" ></i></p>
    </div>
    @endif
</div> {{-- aqui termina el div row --}}
</form> {{-- AQUI TERMINA EL FORM --}}      
</div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content2").fadeOut(1500);
    },450);
});
</script>