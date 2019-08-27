<?php

namespace App\Http\Controllers;
use App\Tallerservicios;
use Illuminate\Http\Request;

class TallerServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taller=Tallerservicios::all();
        return view('gerente.serviciotaller.ver_servicio_taller',compact('taller'));
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
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        if($request->validate([
            'nombreservicio' => 'required',
            'descripcion' =>'required',
        ])){
            //return $request;
            Tallerservicios::insert([
                'nombreservicio'=>$request['nombreservicio'],
                'descripcion'=>$request['descripcion'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
            return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
        }
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $datos = Tallerservicios::where('idservicioTaller',$id)->first();
        $taller=Tallerservicios::all();
        return view('gerente.serviciotaller.edit_taller_servicio',compact('datos','taller'));
        return $datos;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        //return $id;
        $taller= Tallerservicios::where('idserviciotaller',$id)->first();
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        if($request->validate([
            'nombreservicio' => 'required',
            //'descripcion' =>'required',
        ])){
            //return $request;
            $taller->update([
                'nombreservicio'=>$request['nombreservicio'],
                'descripcion'=>$request['descripcion'],
                //'created_at'=>$date,
                'updated_at'=>$date
            ]);
            return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
        }
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
