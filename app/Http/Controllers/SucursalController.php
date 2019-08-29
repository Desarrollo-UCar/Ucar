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
     
        //return $dato;
      
       if($request->validate([
            'nombre'=>'required|con_espacios',
            'pais'=>'required',
            'estado'=>'required',
            'ciudad'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
            'numero'=>'required',
            'telefono'=>'required|tele_fono',
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

   /* public function validarLetra($cadena){

        $min=['a','b','c','d','e','f','g','h','i','j','k','l','k','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'];
        $may = ['A','B','C','D','E','F','G','H','I','J','K','L','K','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $aux=0;
        //for($i=0;$i<count($cadena);$i++){
            for($j=0;$j<sizeof($min);$j++){
                if($cadena[$j]==$min[$j] ||$cadena[$j]==$may[$j]){
                    $aux=$aux+1;
                    break;
                }                
          //  }
        }
        return "hola";
    }*/

}
