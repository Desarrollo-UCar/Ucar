<?php

namespace App\Http\Controllers;

use App\MarcaVehiculo;
use App\ModeloVehiculo;
use App\MarcaModelo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarcaVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $marcas = MarcaVehiculo::all();
        $modelos = ModeloVehiculo::all();
        $marcasm = MarcaVehiculo::join('marca_modelos','marca_modelos.idMarca','=','marca_vehiculos.id')
        ->join('modelo_vehiculos','modelo_vehiculos.id','=','marca_modelos.idModelo')->
        select('modelo_vehiculos.nombre as nombre2','marca_vehiculos.nombre')->get();
        return view('gerente.vehiculo.catalogos',compact('marcas','modelos','marcasm'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      // return reSPONSE()->json($request);
        MarcaVehiculo::insert([
            'nombre'=>$request['nombre'],
        ]);
        return back()->with('msj','Marca agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaVehiculo $marcaVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaVehiculo $marcaVehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarcaVehiculo $marcaVehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarcaVehiculo $marcaVehiculo)
    {
        //
    }
}
