<?php

namespace App\Http\Controllers;
use App;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoloVistasController extends Controller{
    public function sucursal_info(Request $request){
        $idsucursal = $request->idsucursal; 
        $sucursal = App\Sucursal::where('idsucursal','=',$idsucursal)->first();
        //$sucursal = App\Sucursal::findOrFail($id); 
        $sucursales = App\Sucursal::all();
        //return $sucursales;
        return view('sucursal_informacion',compact('sucursales','sucursal'));
    }
public function vista_generar_cotizacion_traslado(){
    $solicitud_traslado = App\traslado_temp::findOrFail(31);
    return view('generar_cotizacion_traslado',compact('solicitud_traslado'));
}
public function reservacion(){   
    $sucursales = App\Sucursal::all();
    return view('reservacion',compact('sucursales'));}
public function servicios(){ 
    $sucursales = App\Sucursal::all();
    return view('servicios',compact('sucursales'));
}

public function renta_traslado(){
    $estado = "inicio";
    $sucursales = App\Sucursal::all();
       return view('renta_traslado', compact('estado','sucursales'));
    }
public function renta_flotilla(){  
    $sucursales = App\Sucursal::all();
     return view('renta_flotilla',compact('sucursales'));}
public function en_construccion(){ 
    $sucursales = App\Sucursal::all(); 
    return view('en_construccion',compact('sucursales'));}
public function bienvenida(){
    $sucursales = App\Sucursal::all();
    return view('bienvenida',compact('sucursales'));}
}
