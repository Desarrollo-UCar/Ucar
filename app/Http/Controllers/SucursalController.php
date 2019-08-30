<?php

namespace App\Http\Controllers;

use App\Sucursal;
use Illuminate\Http\Request;
use Sabberworm\CSS\Value\Size;

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
     //$dato=$this->validarLetra($request['nombre']);
     
        //return $request;
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
       $request->validate([
            'nombre'=>'required|con_espacios',
            'codigopostal'=>'required|postal',
            'estado'=>'required',
            'municipio'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
            'numero'=>'required',
            'telefono'=>'required|tele_fono',
        ]);
        Sucursal::create([
            'nombre'=> $request['nombre'],
            'codigopostal'=>$request['codigopostal'],
            'estado'=>$request['estado'],
            'municipio' =>$request['municipio'],
            'colonia'=>$request['colonia'],
            'calle' =>$request['calle'],
            'numero'=>$request['numero'],
            'telefono'=>$request['telefono'],
            'status'=> 'ACTIVO',
            'created_at' => $date,
            'updated_at'=> $date
        ]);
   
        return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
    
   
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
       // return $request;
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
       $request->validate([
        'nombre'=>'required|con_espacios',
        'codigopostal'=>'required|postal',
        'estado'=>'required',
        'municipio'=>'required',
        'colonia'=>'required',
        'calle'=>'required',
        'numero'=>'required',
        'telefono'=>'required|tele_fono',
        ]);
            $sucursal=Sucursal::where('nombre',$request['nombre'])->first();
          
        $sucursal->update([
            'nombre'=> $request['nombre'],
            'codigopostal'=>$request['codigopostal'],
            'estado'=>$request['estado'],
            'municipio' =>$request['municipio'],
            'colonia'=>$request['colonia'],
            'calle' =>$request['calle'],
            'numero'=>$request['numero'],
            'telefono'=>$request['telefono'],
            'status'=> 'ACTIVO',
            'updated_at'=> $date
        ]);
        return back()->with('msj','DATOS MODIFICADOS EXITOSAMENTE :)');

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

   public function Autocomplete($cadena){
    
    echo $cadena;
    return response()->json($cadena);

    }

}
