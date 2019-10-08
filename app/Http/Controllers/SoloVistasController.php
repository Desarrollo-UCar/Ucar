<?php

namespace App\Http\Controllers;
use App;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoloVistasController extends Controller{
public function vista_generar_cotizacion_traslado(){
    $solicitud_traslado = App\traslado_temp::findOrFail(31);
    return view('generar_cotizacion_traslado',compact('solicitud_traslado'));
}
public function sucursal_P_Escondido(){return view('sucursal_Puerto_Escondido');} 
public function sucursal_Ixtepec(){ return view('sucursal_Ixtepec');}
public function reservacion(){      return view('reservacion');}
public function servicios(){        return view('servicios');}
public function sucursales(){       return view('sucursales');}
public function sucursal_Istmo(){   return view('sucursal_Istmo');}

public function renta_traslado(){
    $estado = "inicio";
       return view('renta_traslado', compact('estado'));
    }
public function renta_flotilla(){   return view('renta_flotilla');}
public function en_construccion(){  return view('en_construccion');}
public function bienvenida(){       return view('bienvenida');}
}
