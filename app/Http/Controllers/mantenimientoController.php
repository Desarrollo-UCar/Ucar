<?php

namespace App\Http\Controllers;

use App\mantenimientos;
use App\Vehiculo;
use App\Tallerservicios;
use App\Detalletallerservicios;
use App\vehiculosucursales;
use App\Empleado;
use App\Sucursal;
use App\EmpleadoSucursal;
use App\Alquiler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class mantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //

        if(!$request->user()->hasRole('gerente')){

            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

            $mantenimiento = mantenimientos::join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')->
            join('vehiculosucursales','vehiculosucursales.vehiculo','=','mantenimientos.vehiculo')
            ->where('vehiculosucursales.sucursal','=',$sucursale->sucursal)
            ->select('mantenimientos.*','vehiculos.*','mantenimientos.tipo as servicio')
            ->get();

        }
        else{
        $mantenimiento = mantenimientos::join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')
        ->select('mantenimientos.*','vehiculos.*','mantenimientos.tipo as servicio')
        ->get();
        //return $mantenimiento;
        }
        return view('gerente.mantenimiento.ver_mantenimiento',compact('mantenimiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $vehiculo = Vehiculo::join('vehiculosucursales','vehiculo','=','idvehiculo')
        ->join('sucursals','idsucursal','=','vehiculosucursales.sucursal')
        ->select('vehiculos.*','sucursals.nombre')
        ->where('vehiculos.vin',$request['vehiculo'])->first();
        $alquileres = Alquiler::where('id_vehiculo','=',$vehiculo['idvehiculo'])
                            ->where('estatus','like','%curso')
                            //   ->where('id_vehiculo','=',$vehiculo['idvehiculo'])
                            ->get();
                            $carbon = new \Carbon\Carbon();
                            $date = $carbon->now();
        $reservas = Alquiler::where('id_vehiculo',$vehiculo->idvehiculo)
        ->where('fecha_recogida','>=',$date)->get();
        //  return $reservas;
        // if(count($alquileres)>0){
        //     return back()->with('mensaje','EN CURSO');
        // } 
        // if(count($reservas)>0){
        //     return back()->with('curso',$reservas);
        // }                         
        // return $alquileres;
       $taller=Tallerservicios::all();
        //return $vehiculo;
        $mantenimientos= mantenimientos::where('mantenimientos.vehiculo',$vehiculo->idvehiculo)->get();
        //return $mantenimientos;
        return view('gerente.mantenimiento.alta_mantenimiento', compact('vehiculo','taller','mantenimientos')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //  return $request;
        $servicios =$request['servicios'];
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $hoy =$date->format('Y-m-d');
        //return $request['fecha_ingresa'];
        //return $hoy;
        if($request['fecha_ingresa']<$hoy){
            return back()->with('mensaje','INTRODUZCA LA FECHA DE SALIDA CORRECTAMENTE :)');
        }
        if($request['fecha_salida']!=null){
            if($request['fecha_salida']<$hoy ||$request['fecha_salida']<$request['fecha_ingresa']){
                return back()->with('mensaje','INTRODUZCA LA FECHA DE REGRESO CORRECTAMENTE :)');
            }
        }
        if($request['fecha_ingresa']==null){
            return back()->with('mensaje','LAS FECHAS SON INCORRECTAS :)');
        }

        $reservas = Alquiler::where('id_vehiculo',$request['idvehiculo'])
         ->where('fecha_recogida','>=',$request['fecha_ingresa'])
        ->where('fecha_recogida','<=',$request['fecha_salida'])
        ->orderBy('id','asc')
        ->get();

        // return $reservas;
        if(count($reservas)>0){
            return back()->with('curso',$reservas)
                         ->withInput();
        }
        
       if(($request->validate([
            'tipo' => 'required',
            'fecha_ingresa' => 'required',
            //'fecha_salida' =>'required',
            'kilometraje' => 'required',
            //'costo' =>'required',
        ]))){
            $vehiculo = Vehiculo::where('matricula',$request['matricula'])->first();
            $vehiculosucursal = vehiculosucursales::where('vehiculo',$vehiculo['idvehiculo'])
                ->first();
                //return $vehiculosucursal;
           if($request['fecha_salida'] == $hoy){
                $vehiculosucursal->update(
                   [
                    'status'=> 'MANTENIMIENTO',
                    'updated_at'=>$date
                   ]
               );
           }else{
                //progrmar mantenimientos ... inserrtar en mantenimiento
           }
//return  $hoy;
//return  $request['fecha_salida'];
           if($request['fecha_ingresa'] == $hoy){
                $status = 'CURSO';
            }else{
                $status = 'ESPERA';
            }
           //return $vehiculo;
           $mantenimiento = DB::select('SELECT vehiculo FROM mantenimientos
           WHERE (? BETWEEN mantenimientos.fecha_ingresa AND mantenimientos.fecha_salida
           OR ? BETWEEN mantenimientos.fecha_ingresa AND mantenimientos.fecha_salida)
           AND mantenimientos.STATUS = "ESPERA"
           AND mantenimientos.vehiculo = ?
           UNION
           SELECT vehiculo FROM mantenimientos
           WHERE  mantenimientos.fecha_ingresa >= ?
           AND mantenimientos.vehiculo = ?
           AND mantenimientos.fecha_salida <= ?
           AND mantenimientos.STATUS = "ESPERA"',
           [$request['fecha_ingresa'],$request['fecha_salida'],$vehiculo->idvehiculo,$request['fecha_ingresa'],$vehiculo->idvehiculo,$request['fecha_salida']]);

            if(count($mantenimiento)>0){
                return back()->with('mensaje','NO PUEDES PROGRAMAR DOS MANTENIMIENTOS EN LAS MISMAS FECHAS');
            }

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

    public function enviar(Request $request){
        //return $request;
        $servicios =$request['servicios'];
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $hoy =$date->format('Y-m-d');
            $vehiculo = Vehiculo::where('idvehiculo',$request['vehiculo'])->first();
            $vehiculosucursal = vehiculosucursales::where('vehiculo',$vehiculo['idvehiculo'])->first();
            $mantenimiento = mantenimientos::where('idmantenimiento',$request['mantenimiento']);
                $vehiculosucursal->update(
                   [
                    'status'=> 'MANTENIMIENTO',
                    'updated_at'=>$date
                   ]
               );
                $mantenimiento->update(
                [
                    'status'=> 'CURSO',
                    'updated_at'=>$date,
                    'fecha_ingresa' => $hoy
                ]
                );
            return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\mantenimientos  $mantenimientos
     * @return \Illuminate\Http\Response
     */
    public function mostrar(Request $mantenimientos){
        //  return $mantenimientos['mantenimiento'];
        $mantenimiento = mantenimientos::
         join('vehiculos','idvehiculo','=','mantenimientos.vehiculo')
        ->join('vehiculosucursales','idvehiculo','=','mantenimientos.vehiculo')
        ->join('sucursals','idsucursal','=','vehiculosucursales.sucursal')
        ->select('mantenimientos.*','vehiculos.*','sucursals.nombre')
        // ->select('mantenimientos.*','vehiculos.*')
        ->where('idmantenimiento',$mantenimientos['mantenimiento'])
        ->first();

        $taller = Tallerservicios::all();
        $tipo   = mantenimientos::findOrFail($mantenimientos['mantenimiento']);


        $servicios = mantenimientos::join('detalletallerservicios','idmantenimiento','detalletallerservicios.mantenimiento')
        ->join('tallerservicios','idserviciotaller','=','detalletallerservicios.tallerservicio')
        ->select('mantenimientos.*','detalletallerservicios.*','tallerservicios.*','detalletallerservicios.created_at as fecha')
        ->where('idmantenimiento',$mantenimientos['mantenimiento'])
        ->get();
        //  return $mantenimiento;
        return view('gerente.mantenimiento.editar_mantenimiento',compact('mantenimiento','taller','servicios','tipo'));
    }


    public function show(Request $mantenimientos){
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
        ->select('mantenimientos.*','vehiculos.*','sucursals.nombre','mantenimientos.tipo as serv')
        ->where('idmantenimiento',$mantenimientos['mantenimiento'])
        ->first();

        $servicios = mantenimientos::join('detalletallerservicios','idmantenimiento','detalletallerservicios.mantenimiento')
        ->join('tallerservicios','idserviciotaller','=','detalletallerservicios.tallerservicio')
        ->select('mantenimientos.*','detalletallerservicios.*','tallerservicios.*','detalletallerservicios.created_at as fecha')
        ->where('idmantenimiento',$mantenimientos['mantenimiento'])
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
    public function update(Request $request){
        //return $request;
        $servicios =$request['servicios'];
        $vehiculo = Vehiculo::where('matricula',$request['matricula'])->first();
        //return $vehiculo;
        $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])->first();
        $taller=Detalletallerservicios::where('mantenimiento',$mantenimiento['idmantenimiento'])->get();
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $hoy =$date->format('Y-m-d');
        if($request['fecha_salida']<$hoy ||$request['fecha_salida']<$request['fecha_ingresa'])
            return back()->with('mensaje','INTRODUZCA LA FECHA DE INGRESO CORRECTAMENTE :)');
        if($request['fecha_ingresa']==null)
            return back()->with('mensaje','LAS FECHAS SON INCORRECTAS :)');
        if(!(is_array($servicios)) && (empty($taller)))
            return back()->with('mensaje','SELECCIONA UNO O MÁS SERVICIOS REALIZADOS EN LA SECCION AGREGAR DESCRIPCIÓN:)');
    //return "tiene que ser un arreglo";
       if(($request->validate([
            'tipo' => 'required',
            'fecha_ingresa' => 'required',
            //'fecha_salida' =>'required',
            'kilometraje' => 'required',
            'costo' =>'required',
        ]))){
            $vehiculosucursal = vehiculosucursales::where('vehiculo',$vehiculo['idvehiculo'])->first();
            $vehiculosucursal->update(
                   [
                    'status'=> 'ACTIVO',
                    'updated_at'=>$date
                   ]
               );
               $vehiculo->update(
                [
                 'estatus'=> 'ACTIVO',
                 'updated_at'=>$date
                ]
            );

           //return $vehiculo;
           $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])
           ->where('fecha_ingresa',$request['fecha_ingresa'])->first(); 

           $mantenimiento ->update([
                'fecha_ingresa' => $request['fecha_ingresa'],
                'fecha_salida' => $request['fecha_salida'],
                'costo_total' => $request['costo'],
                'tipo' =>  $request['tipo'],
                'status' => 'TERMINADO',
                //'vehiculo' => $vehiculo['idvehiculo'],
                //'created_at'=>$date,
                'updated_at'=>$date

            ]); 
            
            $mantenimiento = mantenimientos::where('vehiculo',$vehiculo['idvehiculo'])
            ->where('fecha_ingresa',$request['fecha_ingresa'])->first();  
                      
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

    public function cancelar(Request $request){
        //return $request;
        $vehiculo = Vehiculo::where('idvehiculo',$request['vehiculo'])->first();
        $mantenimiento = mantenimientos::where('idmantenimiento',$request['mantenimiento'])->first();
        //return $mantenimiento;
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $hoy =$date->format('Y-m-d');
        $mantenimiento ->update([
            'status' => 'CANCELADO',
            'updated_at'=>$date
        ]); 
        return back()->with('msj','CANCELADO EXITOSAMENTE :)');
    }

    public function Historial(Request $request)
    {
        $vehiculo=Vehiculo::join('vehiculosucursales','idvehiculo','=','vehiculosucursales.vehiculo')
                            ->join('sucursals','vehiculosucursales.sucursal','=','sucursals.idsucursal')
                            ->select('vehiculos.*','sucursals.nombre as sucursal')
                            ->where('idvehiculo',$request['vehiculo'])->first();
        $mantenimientos= mantenimientos::where('mantenimientos.vehiculo',$request['vehiculo'])
        ->get();

        return view('gerente.mantenimiento.historial_mantenimiento',compact('vehiculo','mantenimientos'));
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

    public function Confmante(Request $request)
    {
        // return $request;
        $vehiculo = Vehiculo::join('vehiculosucursales','vehiculo','=','idvehiculo')
        ->join('sucursals','idsucursal','=','vehiculosucursales.sucursal')
        ->where('vehiculos.idvehiculo',$request['vehiculo'])->first();
        $taller=Tallerservicios::all();
    
        //return $vehiculo;
        return view('gerente.mantenimiento.alta_mantenimiento', compact('vehiculo','taller')) ;
        return $vehiculo;
    }
}
