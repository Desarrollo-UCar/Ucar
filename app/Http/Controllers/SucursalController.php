<?php

namespace App\Http\Controllers;

use App\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sucursals = Sucursal::all();
       // return $sucursals;
        return view('gerente.sucursal.versucursales',compact('sucursals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gerente.sucursal.alta_sucursal');
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
        $bandera = 0;
       if($request->validate([
            'pais'=>'required',
            'estado'=>'required',
            'ciudad'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
            'numero'=>'required',
            'telefono'=>'required',
        ])){
        Sucursal::create($request->all());
   
        return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
    }
    return "error";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function modificar(Request $sucursal)
    {
        //      
        $sucursal = Sucursal::where('idsucursal',$sucursal['idsucursal'])->first();

        return view('gerente.sucursal.editar_sucursal',compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        
        $request->validate([
            'nombre'=>'required',
            'pais'=>'required',
            'estado'=>'required',
            'ciudad'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
            'numero'=>'required',
            'telefono'=>'required',
        ]);
            $sucursal=Sucursal::where('nombre',$request['nombre'])->first();
          
        $sucursal->update($request->all());
        return redirect()->route('sucursal.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        //
    }
}
