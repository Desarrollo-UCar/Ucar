<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use App\Sucursal;
use App\VehiculoSucursales;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
  
    public function index()
    {
        $vehiculo = Vehiculo::join('vehiculosucursales','idvehiculo','=','vehiculosucursales.vehiculo')
        ->join('sucursals','vehiculosucursales.sucursal','=','sucursals.idsucursal')
        ->select('vehiculos.*','vehiculosucursales.*','sucursals.*')
        ->get();
        return view('gerente.vehiculo.ver_vehiculo',compact('vehiculo'));

    }

  
    public function create()
    {
        //
        $sucursal=Sucursal::all();
        return view('gerente.vehiculo.alta_vehiculo',compact('sucursal'));
    }

    
    
    public function store(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();              
        $datos = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datos['foto']=$request->file('foto')->store('upload','public');
            Vehiculo::insert([
                'vin'        =>$datos['vin'],
                'matricula'  =>$datos['matricula'],
                'marca'      =>$datos['marca'],
                'modelo'     =>$datos['modelo'],
                'transmicion' =>$datos['transmicion'],
                'puertas' =>$datos['puertas'],
                'redimiento' =>$datos['rendimiento'],
                'estatus'     =>$datos['status'],
                'anio'       =>$datos['anio'],
                'precio'     =>$datos['precio'],
                'costo'      =>$datos['costo'],
                'pasajeros'  =>$datos['pasajeros'],
                'maletero'   =>$datos['maletero'],
                'color'      =>$datos['color'],
                'cilindros'  =>$datos['cilindros'],
                'kilometraje'=>$datos['kilometraje'],
                'tipo'       =>$datos['tipo'],
                'descripcion'=>$datos['descripcion'],
                'foto'       =>$datos['foto'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        }
        else{
            Vehiculo::insert([
                'vin'        =>$datos['vin'],
                'matricula'  =>$datos['matricula'],
                'marca'      =>$datos['marca'],
                'modelo'     =>$datos['modelo'],
                'transmicion' =>$datos['transmicion'],
                'puertas' =>$datos['puertas'],
                'redimiento' =>$datos['rendimiento'],
                'estatus'     =>$datos['status'],
                'anio'       =>$datos['anio'],
                'precio'     =>$datos['precio'],
                'costo'      =>$datos['costo'],
                'pasajeros'  =>$datos['pasajeros'],
                'maletero'   =>$datos['maletero'],
                'color'      =>$datos['color'],
                'cilindros'  =>$datos['cilindros'],
                'kilometraje'=>$datos['kilometraje'],
                'tipo'       =>$datos['tipo'],
                'descripcion'=>$datos['descripcion'],
                'foto'       =>null,
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        }   
        $sucu = $request->input('sucursal');
        $foranea = Sucursal::where('nombre',$sucu)->first();      
            $emp = Vehiculo::where('vin',$datos['vin'])->first();
            VehiculoSucursales::insert([
                'sucursal'=>$foranea->idsucursal,
                'vehiculo'=>$emp->idvehiculo,
                'status'=>'ACTIVO',
                'created_at'=>$date,
                'updated_at'=>$date
                ]);
   
        return redirect()->route('vehiculo.create');
    }

   
    public function show(Empleado $empleado)
    {
        //
    }

 
    public function modificar(Request $vehiculo)
    {

        $foranea = Sucursal::where('idsucursal',$vehiculo['sucursal'])->first();      
        $vehi = Vehiculo::where('idvehiculo',$vehiculo['vehiculo'])->first();
        $sucursal=Sucursal::all();
        $vehiculosucursal = VehiculoSucursales::where('sucursal',$foranea['idsucursal'])->first();
        
        return view('gerente.vehiculo.editar_vehiculo',compact('foranea','vehi','sucursal','vehiculosucursal'));
    }

    


    public function update(Request $request)
    {

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();              
        $datos = request()->except('_token');
       
        $vehiculo = vehiculo::where('vin',$datos['vin'])->first();
        if ($request->hasFile('foto')) {
            $datos['foto']=$request->file('foto')->store('upload','public');
            $vehiculo ->update([
                'vin'        =>$datos['vin'],
                'matricula'  =>$datos['matricula'],
                'marca'      =>$datos['marca'],
                'modelo'     =>$datos['modelo'],
                'anio'       =>$datos['anio'],
                'precio'     =>$datos['precio'],
                'costo'      =>$datos['costo'],
                'pasajeros'  =>$datos['pasajeros'],
                'maletero'   =>$datos['maletero'],
                'color'      =>$datos['color'],
                'cilindros'  =>$datos['cilindros'],
                'kilometraje'=>$datos['kilometraje'],
                'tipo'       =>$datos['tipo'],
                'descripcion'=>$datos['descripcion'],
                'foto'       =>$datos['foto'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        }
        else{
            $vehiculo ->update([
                'vin'        =>$datos['vin'],
                'matricula'  =>$datos['matricula'],
                'marca'      =>$datos['marca'],
                'modelo'     =>$datos['modelo'],
                'anio'       =>$datos['anio'],
                'precio'     =>$datos['precio'],
                'costo'      =>$datos['costo'],
                'pasajeros'  =>$datos['pasajeros'],
                'maletero'   =>$datos['maletero'],
                'color'      =>$datos['color'],
                'cilindros'  =>$datos['cilindros'],
                'kilometraje'=>$datos['kilometraje'],
                'tipo'       =>$datos['tipo'],
                'descripcion'=>$datos['descripcion'],
                'foto'       =>null,
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        } 

        $foranea = Sucursal::where('nombre',$datos['sucursal'])->first();      
        $vehi =Vehiculo::where('vin',$datos['vin'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehi['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehi['idvehiculo'],
                'status'=>$datos['status'],
                'updated_at'=>$date
                ]);

        
       
          return redirect()->route('vehiculo.index'); 
    }

  
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo-> delete();
        return redirect()->route('vehiculo.index');
        //
    }
}
