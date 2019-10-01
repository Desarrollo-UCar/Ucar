<?php

namespace App\Http\Controllers;

use App\MarcaModelo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarcaModeloController extends Controller
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
        return response()->json(['success'=>'HAY UNA PETICIÓN']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarcaModelo  $marcaModelo
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaModelo $marcaModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarcaModelo  $marcaModelo
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaModelo $marcaModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarcaModelo  $marcaModelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarcaModelo $marcaModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarcaModelo  $marcaModelo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarcaModelo $marcaModelo)
    {
        //
    }

    public function Consultar(Request $request)
    {
        //
        return response()->json(['success'=>$request['text']]);
    }
}
