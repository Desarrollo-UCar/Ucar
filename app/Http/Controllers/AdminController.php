<?php

namespace App\Http\Controllers;

use App\Alquiler;
use Illuminate\Http\Request;
use App\EmpleadoSucursal;
use  App\Empleado;
use App\Sucursal;


use App\Cliente;
class AdminController extends Controller
{
    //
    public function inicio(){
    	return view ('theme.lte.layout');
    }

    public function inicioGerente(Request $request){  
        
        if(!$request->user()->hasRole('gerente')){
 
        $email = $request->user()->email;
        $empleado = Empleado::where('correo','=',$email)->first();
        //return $empleado;
        $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
        ->where('status','=','activo')->first();
        $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

        $reservaciones = Alquiler::
        select('*','alquilers.estatus AS estatus_alquiler')-> 
        join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
        join('clientes','idCliente','=','reservacions.id_cliente')->
        join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
        join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->
        where('vehiculosucursales.sucursal','=',$sucursale->sucursal)->
        // where('vehiculosucursales.status','=','ACTIVO')->
        where('alquilers.fecha_recogida','>=',date('Y').'-01-01')->get();
          //  return $reservaciones;
        return view('gerente.inicio', compact ('reservaciones'));

    }

    $reservaciones = Alquiler::  
    select('*','alquilers.estatus AS estatus_alquiler')-> 
    join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
    join('clientes','idCliente','=','reservacions.id_cliente')->
    join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
    join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->  
    where('alquilers.fecha_recogida','>=',date('Y').'-01-01')->
    get();

    // return ($reservaciones);
    	return view ('gerente.inicio',compact ('reservaciones'));
    }


    public function nuevoChofer(){
    	return view ('gerente.usuarios.empleados.chofer.alta_chofer');
    }
  
    public function Vehiculo(){
        return view('gerente.vehiculo.alta_vehiculo');
    }

    public function Sucursal(){
        return view('gerente.sucursal.alta_sucursal');
    }

}
