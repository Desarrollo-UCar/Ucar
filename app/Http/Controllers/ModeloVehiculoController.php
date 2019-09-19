<?php

namespace App\Http\Controllers;

use App\ModeloVehiculo;
use App\MarcaModelo;
use App\MarcaVehiculo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeloVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        ModeloVehiculo::insert([
            'nombre'=>$request['modelo'],
        ]);
        
        $modelo = ModeloVehiculo::where('nombre','=',$request['modelo'])->first();
        $marca = MarcaVehiculo::where('id','=',$request['marca'])->first();

        MarcaModelo::insert([
            'idMarca'=>$marca->id,
            'idModelo'=>$modelo->id
        ]);

        return back()->with('msj','Modelo agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModeloVehiculo  $modeloVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(ModeloVehiculo $modeloVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModeloVehiculo  $modeloVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(ModeloVehiculo $modeloVehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModeloVehiculo  $modeloVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModeloVehiculo $modeloVehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModeloVehiculo  $modeloVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModeloVehiculo $modeloVehiculo)
    {
        //
    }
}
