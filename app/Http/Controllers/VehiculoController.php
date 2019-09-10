<?php

namespace App\Http\Controllers;
use App\Empleado;
use App\EmpleadoSucursal;
use App\Vehiculo;
use App\Sucursal;
use App\VehiculoSucursales;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class VehiculoController extends Controller
{
  
    public function index(request $request)
    {
        if(!$request->user()->hasRole('gerente')){
            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

            $vehiculo = Vehiculo::join('vehiculosucursales','idvehiculo','=','vehiculosucursales.vehiculo')
            ->join('sucursals','vehiculosucursales.sucursal','=','sucursals.idsucursal')
            ->select('vehiculos.*','vehiculosucursales.*','sucursals.*')
            ->where('vehiculosucursales.sucursal','=',$sucursale->sucursal)
            ->get();
            return view('gerente.vehiculo.ver_vehiculo',compact('vehiculo'));

        }


        $vehiculo = Vehiculo::join('vehiculosucursales','idvehiculo','=','vehiculosucursales.vehiculo')
        ->join('sucursals','vehiculosucursales.sucursal','=','sucursals.idsucursal')
        ->select('vehiculos.*','vehiculosucursales.*','sucursals.*') ->get();
        return view('gerente.vehiculo.ver_vehiculo',compact('vehiculo'));

    }

  
    public function create(request $request)
    {
        //
        if(!$request->user()->hasRole('gerente')){

            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursal=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

            return view('gerente.vehiculo.alta_vehiculo',compact('sucursal'));
        }

        $sucursal=Sucursal::all();
        return view('gerente.vehiculo.alta_vehiculo',compact('sucursal'));
    }

    
    
    public function store(Request $request)
    {


        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();              
        

        $request->validate([
            'foto'       => 'required|image|mimes:jpeg,png,jpg,gif',
            'vin'        => 'required| regex:/[0-9A-Za-z]{17}/m',
            'matricula'  => 'required| regex:/[0-9A-Za-z]/m|min:6|max:8',
            'marca'      => 'required',
            'modelo'     => 'required',
            'transmision'=> 'required',
            'puertas'    => 'required',
            'rendimiento' => 'required',
            'anio'       => 'required',
            'precio'     => 'required',
            'costo'      => 'required',
            'pasajeros'  => 'required',
            'maletero'   => 'required',
            'color'      => 'required',
            'cilindros'  => 'required',
            'kilometraje'=> 'required',
            'tipo'       => 'required',
            'status'     => 'required',
            'sucursal'   => 'required',
           // 'descripcion'=> 'required',
        ]);
        
        $todo=Vehiculo::all();
        if(count($todo)>0){
        $vehiculo = Vehiculo::where('vin',$request['vin'])->first();
        if(!empty($vehiculo)){
            return response()->json(['success'=>'ERROR1']);
         }
        }
         $image = $request->file('foto');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

            Vehiculo::insert([
                'foto'       =>$new_name,
                'vin'        =>$request['vin'],
                'matricula'  =>$request['matricula'],
                'marca'      =>$request['marca'],
                'modelo'     =>$request['modelo'],
                'transmicion' =>$request['transmision'],
                'puertas' =>$request['puertas'],
                'rendimiento' =>$request['rendimiento'],
                'estatus'     =>$request['status'],
                'anio'       =>$request['anio'],
                'precio'     =>$request['precio'],
                'costo'      =>$request['costo'],
                'pasajeros'  =>$request['pasajeros'],
                'maletero'   =>$request['maletero'],
                'color'      =>$request['color'],
                'cilindros'  =>$request['cilindros'],
                'kilometraje'=>$request['kilometraje'],
                'tipo'       =>$request['tipo'],
                'descripcion'=>$request['descripcion'],
                'estatus'       =>$request['status'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);

           
          
        $sucu = $request->input('sucursal');
        $foranea = Sucursal::where('nombre',$sucu)->first();      
            $emp = Vehiculo::where('vin',$request['vin'])->first();
            VehiculoSucursales::insert([
                'sucursal'=>$foranea->idsucursal,
                'vehiculo'=>$emp->idvehiculo,
                'status'=>'ACTIVO',
                'created_at'=>$date,
                'updated_at'=>$date
                ]);
   
                return response()->json(['success'=>'EXITO']);
    }

   
    public function show(Empleado $empleado)
    {
        //
    }

 
    public function modificar(Request $vehiculo)
    {
       
        $foranea = Sucursal::where('idsucursal',$vehiculo['sucursal'])->first();      
        $vehi = Vehiculo::where('idvehiculo',$vehiculo['vehiculo'])->first();

        if(!$vehiculo->user()->hasRole('gerente')){
            $email = $vehiculo->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();  
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();

            $sucursal=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();
        }
        else{
        $sucursal=Sucursal::all();
    }
        $vehiculosucursal = VehiculoSucursales::where('sucursal',$foranea['idsucursal'])->first();
        
        //return $vehi;
        return view('gerente.vehiculo.editar_vehiculo',compact('foranea','vehi','sucursal','vehiculosucursal'));
    }

    


    public function update(Request $request)
    { 
          return redirect()->route('vehiculo.index'); 
    }

  
    public function ModificarDatos(Request $request){
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();    
        $new_name = $request->hidden_image;
        $image = $request->file('foto');       
      

            if($image != '')
        { 
            
        $request->validate([
            'foto'       => 'required|image|mimes:jpeg,png,jpg,gif',
            'vin'        => 'required| regex:/[0-9A-Za-z]{17}/m',
            'matricula'  => 'required| regex:/[0-9A-Za-z]/m|min:6|max:8',
            'marca'      => 'required',
            'modelo'     => 'required',
            'transmision'=> 'required',
            'puertas'    => 'required',
            'rendimiento'=> 'required',
            'anio'       => 'required',
            'precio'     => 'required',
            'costo'      => 'required',
            'pasajeros'  => 'required',
            'maletero'   => 'required',
            'color'      => 'required',
            'cilindros'  => 'required',
            'kilometraje'=> 'required',
            'tipo'       => 'required',
            'status'     => 'required',
            'sucursal'   => 'required',
           // 'descripcion'=> 'required',
        ]);
       
            $vehiculo = vehiculo::where('vin',$request['vin'])->first();
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $vehiculo ->update([
                'foto'       =>$new_name,
                'vin'        =>$request['vin'],
                'matricula'  =>$request['matricula'],
                'marca'      =>$request['marca'],
                'modelo'     =>$request['modelo'],
                'transmicion' =>$request['transmision'],
                'puertas' =>$request['puertas'],
                'rendimiento' =>$request['rendimiento'],
                'estatus'     =>$request['status'],
                'anio'       =>$request['anio'],
                'precio'     =>$request['precio'],
                'costo'      =>$request['costo'],
                'pasajeros'  =>$request['pasajeros'],
                'maletero'   =>$request['maletero'],
                'color'      =>$request['color'],
                'cilindros'  =>$request['cilindros'],
                'kilometraje'=>$request['kilometraje'],
                'tipo'       =>$request['tipo'],
                'descripcion'=>$request['descripcion'],
                'estatus'       =>$request['status'],               
                'updated_at'=>$date
            ]);

            $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
            $vehi =Vehiculo::where('vin',$request['vin'])->first();
            $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehi['idvehiculo'])
            ->first();
                $vehiculosucursal->update([
                    'sucursal'=>$foranea['idsucursal'],
                    'vehiculo'=>$vehi['idvehiculo'],
                    'status'=>$request['status'],
                    'updated_at'=>$date
                    ]);
    
                    return response()->json(['success'=>'EXITO']);
            }else{

                $vehiculo = vehiculo::where('vin',$request['vin'])->first();
                $request->validate([
                    //'foto'       => 'required|image|mimes:jpeg,png,jpg,gif',
                    'vin'        => 'required| regex:/[0-9A-Za-z]{17}/m',
                    'matricula'  => 'required| regex:/[0-9A-Za-z]/m|min:6|max:8',
                    'marca'      => 'required',
                    'modelo'     => 'required',
                    'transmision'=> 'required',
                    'puertas'    => 'required',
                    'rendimiento'=> 'required',
                    'anio'       => 'required',
                    'precio'     => 'required',
                    'costo'      => 'required',
                    'pasajeros'  => 'required',
                    'maletero'   => 'required',
                    'color'      => 'required',
                    'cilindros'  => 'required',
                    'kilometraje'=> 'required',
                    'tipo'       => 'required',
                    'status'     => 'required',
                    'sucursal'   => 'required',
                   // 'descripcion'=> 'required',
                ]);
                $vehiculo ->update([
                //'foto'       =>$new_name,
                'vin'        =>$request['vin'],
                'matricula'  =>$request['matricula'],
                'marca'      =>$request['marca'],
                'modelo'     =>$request['modelo'],
                'transmicion' =>$request['transmision'],
                'puertas' =>$request['puertas'],
                'rendimiento' =>$request['rendimiento'],
                'estatus'     =>$request['status'],
                'anio'       =>$request['anio'],
                'precio'     =>$request['precio'],
                'costo'      =>$request['costo'],
                'pasajeros'  =>$request['pasajeros'],
                'maletero'   =>$request['maletero'],
                'color'      =>$request['color'],
                'cilindros'  =>$request['cilindros'],
                'kilometraje'=>$request['kilometraje'],
                'tipo'       =>$request['tipo'],
                'descripcion'=>$request['descripcion'],
                'estatus'       =>$request['status'],               
                'updated_at'=>$date
            ]);

            $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
            $vehi =Vehiculo::where('vin',$request['vin'])->first();
            $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehi['idvehiculo'])
            ->first();
                $vehiculosucursal->update([
                    'sucursal'=>$foranea['idsucursal'],
                    'vehiculo'=>$vehi['idvehiculo'],
                    'status'=>$request['status'],
                    'updated_at'=>$date
                    ]);
    
                    return response()->json(['success'=>'EXITO']);
            }

    }


    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo-> delete();
        return redirect()->route('vehiculo.index');
        //
    }
}
