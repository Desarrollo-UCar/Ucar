<?php

namespace App\Http\Controllers;

use App\mantenimientos;
use App\Vehiculo;
use App\Tallerservicios;
use App\Detalletallerservicios;
use App\vehiculosucursales;
use Illuminate\Http\Request;

class mantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mantenimiento = mantenimientos::join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')
        ->select('mantenimientos.*','vehiculos.*','mantenimientos.tipo as servicio')
        ->get();
        //return $mantenimiento;
        return view('gerente.mantenimiento.ver_mantenimiento',compact('mantenimiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
       $taller=Tallerservicios::all();
        $vehiculo = Vehiculo::join('vehiculosucursales','vehiculo','=','idvehiculo')
        ->join('sucursals','idsucursal','=','vehiculosucursales.sucursal')
        ->where('vehiculos.vin',$request['vehiculo'])->first();
        //return $vehiculo;
        return view('gerente.mantenimiento.alta_mantenimiento', compact('vehiculo','taller')) ;
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
        $servicios =$request['servicios'];
       
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $hoy =$date->format('Y-m-d');
        if($request['fecha_ingresa']>$hoy){
            return back()->with('mensaje','INTRODUZCA LA FECHA DE SALIDA CORRECTAMENTE :)');
        }
        if($request['fecha_salida']>$hoy){
            return back()->with('mensaje','INTRODUZCA LA FECHA DE INGRESO CORRECTAMENTE :)');
        }

        if($request['fecha_salida']<$request['fecha_ingresa'] && $request['fecha_salida']!=null){
            return back()->with('mensaje','LAS FECHAS SON INCORRECTAS :)');
        }
       

       if(($request->validate([
            'tipo' => 'required',
            'fecha_ingresa' => 'required',
            //'fecha_salida' =>'required',
            'kilometraje' => 'required',
            //'costo' =>'required',
        ]))){
            
            $vehiculo = Vehiculo::where('vin',$request['vin'])->first();

            $vehiculosucursal = vehiculosucursales::where('vehiculo',$vehiculo['idvehiculo'])
                ->first();
           if($request['fecha_salida']==null){
            $vehiculosucursal->update(
                   [
                    'status'=> 'MANTENIMIENTO',
                    'updated_at'=>$date
                   ]
               );
           }else{
            $vehiculosucursal->update(
                [
                 'status'=> 'ACTIVO',
                 'updated_at'=>$date
                ]
            );
           }

           if($request['fecha_salida']!=null){
                $status = 'INACTIVO';
            }else{
                $status = 'ACTIVO';
            }
           //return $vehiculo;
            mantenimientos::insert([
                'fecha_ingresa' => $request['fecha_ingresa'],
                'fecha_salida' => $request['fecha_salida'],
                'costo_total' => $request['costo'],
                'tipo' =>  $request['tipo'],
                'status' => $status,
                'vehiculo' => $vehiculo['idvehiculo'],
                'created_at'=>$date,
                'updated_at'=>$date

            ]); 
            
            $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])
            ->where('fecha_ingresa',$request['fecha_ingresa'])
            ->first();  
                      
            if(is_array($servicios)){
            if(count($servicios)>0){
                foreach($servicios as $serv){
                    $taller=Tallerservicios::where('nombreservicio',$serv)->first();
                   Detalletallerservicios::insert([
                    'mantenimiento' => $mantenimiento['idmantenimiento'],
                    'tallerservicio'=> $taller['idserviciotaller'],
                    'created_at'=>$date,
                    'updated_at'=>$date
                    ]);
                }
            }
        }
            return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
        }

        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mantenimientos  $mantenimientos
     * @return \Illuminate\Http\Response
     */
    public function mostrar(Request $mantenimientos)
    {
        //
        $mantenimiento = mantenimientos::join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')
        ->join('vehiculosucursales','idvehiculo','=','mantenimientos.vehiculo')
        ->join('sucursals','idsucursal','=','vehiculosucursales.sucursal')
        ->select('mantenimientos.*','vehiculos.*','sucursals.*')
        ->first();

        $taller = Tallerservicios::all();

        //return $mantenimiento;
        return view('gerente.mantenimiento.editar_mantenimiento',compact('mantenimiento','taller'));
    }

    public function show(Request $mantenimientos)
    {
        //
        $mantenimiento = mantenimientos::join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')
        ->select('mantenimientos.*','vehiculos.*')->get();
        $datos = mantenimientos::all();
        return $mantenimiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mantenimientos  $mantenimientos
     * @return \Illuminate\Http\Response
     */
    public function modificar(Request $mantenimientos)
    {
        $mantenimiento = mantenimientos::join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')
        ->join('vehiculosucursales','idvehiculo','=','mantenimientos.vehiculo')
        ->join('sucursals','idsucursal','=','vehiculosucursales.sucursal')
        ->select('mantenimientos.*','vehiculos.*','sucursals.*','mantenimientos.tipo as serv')
        ->first();

        $servicios = mantenimientos::join('detalletallerservicios','idmantenimiento','detalletallerservicios.mantenimiento')
        ->join('tallerservicios','idserviciotaller','=','detalletallerservicios.tallerservicio')
        ->select('mantenimientos.*','detalletallerservicios.*','tallerservicios.*','detalletallerservicios.created_at as fecha')
        ->get();

       // return $servicios;
        return view('gerente.mantenimiento.detalle_mantenimiento',compact('mantenimiento','servicios'));
    }

    public function edit(Request $mantenimientos)
    {
        return $mantenimientos; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mantenimientos  $mantenimientos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $servicios =$request['servicios'];
        
        $vehiculo = Vehiculo::where('vin',$request['vin'])->first();
        $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])->first();

        $taller=Detalletallerservicios::where('mantenimiento',$mantenimiento['idmantenimiento'])
        ->get();

        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $hoy =$date->format('Y-m-d');
        if($request['fecha_ingresa']>$hoy){
            return back()->with('mensaje','INTRODUZCA LA FECHA DE SALIDA CORRECTAMENTE :)');
        }
        if($request['fecha_salida']>$hoy){
            return back()->with('mensaje','INTRODUZCA LA FECHA DE INGRESO CORRECTAMENTE :)');
        }

        if($request['fecha_salida']<$request['fecha_ingresa'] && $request['fecha_salida']!=null){
            return back()->with('mensaje','LAS FECHAS SON INCORRECTAS :)');
        }
        
        if(!(is_array($servicios)) && empty($taller)){
            //return "hola";
            return back()->with('mensaje','SELECCIONA UNO O MÁS SERVICIOS REALIZADOS EN LA SECCION AGREGAR DESCRIPCIÓN:)');
        }

        //return "Lleno";
    //return "tiene que ser un arreglo";
       if(($request->validate([
            'tipo' => 'required',
            'fecha_ingresa' => 'required',
            //'fecha_salida' =>'required',
            'kilometraje' => 'required',
            'costo' =>'required',
        ]))){
            
            $vehiculo = Vehiculo::where('vin',$request['vin'])->first();

            $vehiculosucursal = vehiculosucursales::where('vehiculo',$vehiculo['idvehiculo'])
                ->first();
           if($request['fecha_salida']==null){
            $vehiculosucursal->update(
                   [
                    'status'=> 'MANTENIMIENTO',
                    'updated_at'=>$date
                   ]
               );
           }else{
            $vehiculosucursal->update(
                [
                 'status'=> 'ACTIVO',
                 'updated_at'=>$date
                ]
            );
           }

           if($request['fecha_salida']!=null){
                $status = 'INACTIVO';
            }else{
                $status = 'ACTIVO';
            }
           //return $vehiculo;
           $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])
           ->where('fecha_ingresa',$request['fecha_ingresa'])
           ->first(); 

           $mantenimiento ->update([
                'fecha_ingresa' => $request['fecha_ingresa'],
                'fecha_salida' => $request['fecha_salida'],
                'costo_total' => $request['costo'],
                'tipo' =>  $request['tipo'],
                'status' => $status,
                //'vehiculo' => $vehiculo['idvehiculo'],
                //'created_at'=>$date,
                'updated_at'=>$date

            ]); 
            
            $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])
            ->where('fecha_ingresa',$request['fecha_ingresa'])
            ->first();  
                      
            if(is_array($servicios)){
            if(count($servicios)>0){
                foreach($servicios as $serv){
                    $taller=Tallerservicios::where('nombreservicio',$serv)->first();
                   Detalletallerservicios::insert([
                    'mantenimiento' => $mantenimiento['idmantenimiento'],
                    'tallerservicio'=> $taller['idserviciotaller'],
                    'created_at'=>$date,
                    'updated_at'=>$date
                    ]);
                }
            }
        }
            return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
        }

        
       
        return $servicios;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mantenimientos  $mantenimientos
     * @return \Illuminate\Http\Response
     */
    public function destroy(mantenimientos $mantenimientos)
    {
        //
    }
}
