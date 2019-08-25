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

    public function verclientes(){
        $clientes  = Cliente::orderBy('idcliente','DESC')->get();
    	return view ('gerente.clientes.ver_clientes',compact('clientes'));
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
