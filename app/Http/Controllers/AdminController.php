<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
class AdminController extends Controller
{
    //
    public function inicio(){
    	return view ('theme.lte.layout');
    }

    public function inicioGerente(){
    	return view ('gerente.inicio');
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
