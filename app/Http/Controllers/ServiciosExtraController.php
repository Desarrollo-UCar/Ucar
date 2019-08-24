<?php

namespace App\Http\Controllers;

use App\Serviciosextras;
use App\Sucursal;
use App\servicioextrasucursales;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class ServiciosExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviciosextra = Serviciosextras::join('servicioextrasucursales','idserviciosextra','=','servicioextrasucursales.serviciosextra')
        ->join('sucursals','idsucursal','=','servicioextrasucursales.sucursal')
        ->select('serviciosextras.*','servicioextrasucursales.*','sucursals.nombre as sucursal','sucursals.idsucursal')
        ->get();

        //return $serviciosextra;
        return view('gerente.servicio_extra.ver_serviciosextras',compact('serviciosextra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sucursal= Sucursal::all();
         
           return view('gerente.servicio_extra.alta_servicio',compact('sucursal'));
        
        
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
        $guardar=0;
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $datos = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datos['foto']=$request->file('foto')->store('upload','public');
            //return $datos;
          if(  serviciosextras::insert([
                'nombre'=> $datos['nombre'],                
                'descripcion'=> $datos['descripcion'],                
                'disponibilidad'=> $datos['disponibilidad'],                
                'precio'=> $datos['precio'],                
                'foto'=> $datos['foto'],
                'created_at'=>$date,
                'updated_at'=>$date
            ])){
                $guardar = 1;
                //return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
            }else{
            //return back()->with('errormsj','ERROR AL GUARDAR LOS DATOS :(');
                $guardar = 0;
            }
        }else{
            if(serviciosextras::insert([
                'nombre'=> $datos['nombre'],                
                'descripcion'=> $datos['descripcion'],                
                'disponibilidad'=> $datos['disponibilidad'],                
                'precio'=> $datos['precio'],                
                'foto'=> null,
                'created_at'=>$date,
                'updated_at'=>$date
                ])){
                 //   return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
                    $guardar =1;
                }else{
               // return back()->with('errormsj','ERROR AL GUARDAR LOS DATOS :(');
                $guardar=0;
                }  
          }

        $sucu = $request->input('sucursal');
        $foranea = Sucursal::where('nombre',$sucu)->first(); 
        $serext = Serviciosextras::where('nombre',$datos['nombre'])->first();

        if(servicioextrasucursales::insert([
            'sucursal'=>$foranea->idsucursal,
            'serviciosextra' => $serext->idserviciosextra,
            'descripcion'=>$datos['descripcion'],
            'cantidad' => $datos['cantidad'],
            'created_at'=>$date,
            'updated_at'=>$date
        ])){
            $guardar=1;
        }else{
            $guardar= 0;
        }

            if($guardar==1){
                return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
            }else{
                return back()->with('errormsj','ERROR AL GUARDAR LOS DATOS :(');
            }
        return $datos;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServicioExtra  $servicioExtra
     * @return \Illuminate\Http\Response
     */
    /*public function show(ServicioExtra $servicioExtra)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServicioExtra  $servicioExtra
     * @return \Illuminate\Http\Response
     */
   /* public function edit(ServiciosExtra $servicioExtra)
    {
        //
    }*/

    public function modificar(Request $servicioextra){

        //return $servicioextra;
        $servicio=Serviciosextras::where('idserviciosextra',$servicioextra['servicioextra'])
                                ->first();
        $sucursal=Sucursal::all();
        $foranea =sucursal::where('idsucursal',$servicioextra['sucursal'])->first(); 
        $serviciosucursal=servicioextrasucursales::where('sucursal',$servicioextra['sucursal'])
        ->where('serviciosextra',$servicioextra['servicioextra'])
        ->first();
        return view('gerente.servicio_extra.editar_servicios',compact('servicio','sucursal','foranea','serviciosucursal'));
      //return $servicioextra;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServicioExtra  $servicioExtra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $guardar=0;
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $datos = $request->except('_token'); 
        $servicio=Serviciosextras::where('nombre',$request['nombre'])->first();    
        if ($request->hasFile('foto')) {
            Storage::delete('public/'.$servicio->foto); 
            $datos['foto']=$request->file('foto')->store('upload','public');
            if(  $servicio->update([
                'nombre'=> $datos['nombre'],                
                'descripcion'=> $datos['descripcion'],                
                'disponibilidad'=> $datos['disponibilidad'],                
                'precio'=> $datos['precio'],                
                'foto'=> $datos['foto'],
                'updated_at'=>$date
            ])){
                $guardar = 1;
                //return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
            }else{
            //return back()->with('errormsj','ERROR AL GUARDAR LOS DATOS :(');
                $guardar = 0;
            }
        }else{
            if(  $servicio->update([
                'nombre'=> $datos['nombre'],                
                'descripcion'=> $datos['descripcion'],                
                'disponibilidad'=> $datos['disponibilidad'],                
                'precio'=> $datos['precio'],                
                'updated_at'=>$date
            ])){
                $guardar = 1;
                //return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
            }else{
            //return back()->with('errormsj','ERROR AL GUARDAR LOS DATOS :(');
                $guardar = 0;
            }            
        }
            $sucursal=Sucursal::where('nombre',$datos['sucursal'])->first();
            $serviciosucursal=servicioextrasucursales::where('serviciosextra',$servicio['idserviciosextra'])->first();
            //return $sucursal['nombre'];
            if( $serviciosucursal->update([
                'sucursal'=>$sucursal['idsucursal'],
                'serviciosextra' => $servicio['idserviciosextra'],
                'descripcion'=>$datos['descripcion'],
                'cantidad' => $datos['cantidad'],
                'updated_at'=>$date
            ])               
            ){
                $guardar = 1;
            }else{
                $guardar = 0;
            }

            if($guardar==1){
                return back()->with('msj','DATOS MODIFICADOS EXITOSAMENTE :)');
            }else{
                return back()->with('errormsj','ERROR AL MODIFICAR LOS DATOS :(');
            }
     return $datos;   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServicioExtra  $servicioExtra
     * @return \Illuminate\Http\Response
     */
   /* public function destroy(ServiciosExtra $servicioExtra)
    {
        //
    }*/
}
