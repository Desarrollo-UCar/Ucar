<?php

namespace App\Http\Controllers;
use App\Empleado;
use App\EmpleadoSucursal;
use App\Vehiculo;
use App\Sucursal;
use App\Modelo;
use App\vehiculoSucursales;
use App\MarcaVehiculo;
use App\MarcaModelo;
use App\Categoria;
use App\Alquiler;
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
            ->where('status','=','ACTIVO')->first();
            $sucursal=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();
            $marca= MarcaVehiculo::all();
            $categoria= Categoria::all();
            return view('gerente.vehiculo.alta_vehiculo',compact('sucursal','marca','categoria'));
        }

        $sucursal=Sucursal::all();
        $marca= MarcaVehiculo::all();
        $categoria= Categoria::all();
        return view('gerente.vehiculo.alta_vehiculo',compact('sucursal','marca','categoria'));
    }

    
    
    public function store(Request $request)
    {


        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();              
        

        $request->validate([
            'foto'       => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
            'foto_atras' => 'required|image|mimes:jpeg,png,jpg,gif',
            // 'nombre'=>'required|regex:/^[\pL\s]+$/u',
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
            // 'status'     => 'required',
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

        //SE AGREGA LA PRIMERA FOTO
        $image_derecha = $request->file('foto_derecha');
        $new_name_derecha = rand() . '.' . $image_derecha->getClientOriginalExtension();
        $image_derecha->move(public_path('images'), $new_name_derecha);

        //SE AGREGA LA PRIMERA FOTO
        $image_izquierda = $request->file('foto_izquierda');
        $new_name_izquierda = rand() . '.' . $image_izquierda->getClientOriginalExtension();
        $image_izquierda->move(public_path('images'), $new_name_izquierda);

        $image_atras = $request->file('foto_atras');
        $new_name_atras = rand() . '.' . $image_atras->getClientOriginalExtension();
        $image_atras->move(public_path('images'), $new_name_atras);
        
        // return response()->json(['success'=>$request['vin']]);
            Vehiculo::insert([                
                'vin' =>$request['vin'],
                'matricula'  =>$request['matricula'],
                'marca'      =>$request['marca'],
                'modelo'     =>$request['modelo'],
                'transmicion' =>$request['transmision'],
                'puertas' =>$request['puertas'],
                'rendimiento' =>$request['rendimiento'],
                'estatus'     =>'ACTIVO',
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
                'foto'       =>$new_name,
                'foto_derecha'=>$new_name_derecha,
                'foto_izquierda'=>$new_name_izquierda,
                'foto_trasera' =>$new_name_atras,
                'created_at'=>$date,
                'updated_at'=>$date
            ]);

           
        // return response()->json(['success'=>'ERROR1']);
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
        $categoria= Categoria::all();
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
        return view('gerente.vehiculo.editar_vehiculo',compact('foranea','vehi','sucursal','vehiculosucursal','categoria'));
    }

    


    public function update(Request $request)
    { 
          return redirect()->route('vehiculo.index'); 
    }

  
    public function ModificarDatos(Request $request){
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();    
        
        // return response()->json(['success'=>$request['foto']]);


        // NO SE MODIFICA NINGUNA FOTO

if($request['foto'] ==null && $request['foto_derecha'] ==null && $request['foto_izquierda'] ==null && $request['foto_atras'] ==null){
    $request->validate([
        // 'foto'       => 'required|image|mimes:jpeg,png,jpg,gif',
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
        // 'status'     => 'required',
        'sucursal'   => 'required',
       // 'descripcion'=> 'required',
    ]);
   
        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
      
try{
        $vehiculo ->update([
            // 'foto'       =>$new_name,
            'vin'        =>$request['vin'],
            'matricula'  =>$request['matricula'],
            'marca'      =>$request['marca'],
            'modelo'     =>$request['modelo'],
            'transmicion'=>$request['transmision'],
            'puertas'    =>$request['puertas'],
            'rendimiento'=>$request['rendimiento'],
            // 'estatus'    =>$request['status'],
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
            // 'estatus'    =>$request['status'],               
            'updated_at' =>$date
        ]);
}catch(\Illuminate\Database\QueryException $ex){
    return response()->json(['success'=>'REPITE']);
}
        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehiculo['idvehiculo'],
                // 'status'=>$request['status'],
                'updated_at'=>$date
                ]);

                return response()->json(['success'=>'EXITO']);

}


            // SE MODIFICA LA ULTIMA FOTO

if($request['foto'] ==null && $request['foto_derecha'] ==null && $request['foto_izquierda'] ==null && $request['foto_atras'] !=null){
    // return response()->json(['success'=>'HOLA']);
    $request->validate([
        'foto_atras'       => 'required|image|mimes:jpeg,png,jpg,gif',
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
        // 'status'     => 'required',
        'sucursal'   => 'required',
       // 'descripcion'=> 'required',
    ]);
   
        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        // $new_name1 = $request->hidden_image;
        $image1 = $request->file('foto_atras'); 
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);
        // return response()->json(['success'=>$new_name1]);
        try{$vehiculo ->update([
            'foto_trasera' =>$new_name1,
            'vin'        =>$request['vin'],
            'matricula'  =>$request['matricula'],
            'marca'      =>$request['marca'],
            'modelo'     =>$request['modelo'],
            'transmicion'=>$request['transmision'],
            'puertas'    =>$request['puertas'],
            'rendimiento'=>$request['rendimiento'],
            // 'estatus'    =>$request['status'],
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
            // 'estatus'    =>$request['status'],               
            'updated_at' =>$date
        ]);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['success'=>'REPITE']);
        }
        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehiculo['idvehiculo'],
                // 'status'=>$request['status'],
                'updated_at'=>$date
                ]);

                return response()->json(['success'=>'EXITO']);
}


            // SE MODIFICA SOLO LA FOTO IZQUIERDA
            if($request['foto'] ==null && $request['foto_derecha'] ==null && $request['foto_izquierda'] !=null && $request['foto_atras'] ==null){
                //  return response()->json(['success'=>'HOLA']);
                $request->validate([
                    'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                    // 'status'     => 'required',
                    'sucursal'   => 'required',
                   // 'descripcion'=> 'required',
                ]);
               
                    $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                    // $new_name1 = $request->hidden_image;
                    $image = $request->file('foto_izquierda'); 
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name);
                    // return response()->json(['success'=>$new_name1]);
                    try{$vehiculo ->update([
                        'foto_izquierda' =>$new_name,
                        'vin'        =>$request['vin'],
                        'matricula'  =>$request['matricula'],
                        'marca'      =>$request['marca'],
                        'modelo'     =>$request['modelo'],
                        'transmicion'=>$request['transmision'],
                        'puertas'    =>$request['puertas'],
                        'rendimiento'=>$request['rendimiento'],
                        // 'estatus'    =>$request['status'],
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
                        // 'estatus'    =>$request['status'],               
                        'updated_at' =>$date
                    ]);
                    }catch(\Illuminate\Database\QueryException $ex){
                        return response()->json(['success'=>'REPITE']);
                    }
                    $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
                    // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                    $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
                    ->first();
                        $vehiculosucursal->update([
                            'sucursal'=>$foranea['idsucursal'],
                            'vehiculo'=>$vehiculo['idvehiculo'],
                            // 'status'=>$request['status'],
                            'updated_at'=>$date
                            ]);
            
                            return response()->json(['success'=>'EXITO']);
            }


                        // SE MODIFICA SOLO LA FOTO DERECHA
                        if($request['foto'] ==null && $request['foto_derecha'] !=null && $request['foto_izquierda'] ==null && $request['foto_atras'] ==null){
                            //  return response()->json(['success'=>'HOLA']);
                            $request->validate([
                                'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                                // 'status'     => 'required',
                                'sucursal'   => 'required',
                               // 'descripcion'=> 'required',
                            ]);
                           
                                $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                                // $new_name1 = $request->hidden_image;
                                $image = $request->file('foto_derecha'); 
                                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                                $image->move(public_path('images'), $new_name);
                                // return response()->json(['success'=>$new_name1]);
                                try{$vehiculo ->update([
                                    'foto_derecha' =>$new_name,
                                    'vin'        =>$request['vin'],
                                    'matricula'  =>$request['matricula'],
                                    'marca'      =>$request['marca'],
                                    'modelo'     =>$request['modelo'],
                                    'transmicion'=>$request['transmision'],
                                    'puertas'    =>$request['puertas'],
                                    'rendimiento'=>$request['rendimiento'],
                                    // 'estatus'    =>$request['status'],
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
                                    // 'estatus'    =>$request['status'],               
                                    'updated_at' =>$date
                                ]);
                                }catch(\Illuminate\Database\QueryException $ex){
                                    return response()->json(['success'=>'REPITE']);
                                }
                                $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
                                // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                                $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
                                ->first();
                                    $vehiculosucursal->update([
                                        'sucursal'=>$foranea['idsucursal'],
                                        'vehiculo'=>$vehiculo['idvehiculo'],
                                        // 'status'=>$request['status'],
                                        'updated_at'=>$date
                                        ]);
                        
                                        return response()->json(['success'=>'EXITO']);
                        }


                                // SE MODIFICA SOLO LA FOTO UNO
            if($request['foto'] !=null && $request['foto_derecha'] ==null && $request['foto_izquierda'] ==null && $request['foto_atras'] ==null){
                //  return response()->json(['success'=>'HOLA']);
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                    // 'status'     => 'required',
                    'sucursal'   => 'required',
                   // 'descripcion'=> 'required',
                ]);
               
                    $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                    // $new_name1 = $request->hidden_image;
                    $image = $request->file('foto'); 
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name);
                    // return response()->json(['success'=>$new_name1]);
                    try{$vehiculo ->update([
                        'foto' =>$new_name,
                        'vin'        =>$request['vin'],
                        'matricula'  =>$request['matricula'],
                        'marca'      =>$request['marca'],
                        'modelo'     =>$request['modelo'],
                        'transmicion'=>$request['transmision'],
                        'puertas'    =>$request['puertas'],
                        'rendimiento'=>$request['rendimiento'],
                        // 'estatus'    =>$request['status'],
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
                        // 'estatus'    =>$request['status'],               
                        'updated_at' =>$date
                    ]);
                    }catch(\Illuminate\Database\QueryException $ex){
                        return response()->json(['success'=>'REPITE']);
                    }
                    $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
                    // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                    $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
                    ->first();
                        $vehiculosucursal->update([
                            'sucursal'=>$foranea['idsucursal'],
                            'vehiculo'=>$vehiculo['idvehiculo'],
                            // 'status'=>$request['status'],
                            'updated_at'=>$date
                            ]);
            
                            return response()->json(['success'=>'EXITO']);
            }



            
                                // SE MODIFICA SOLO LAS DOS PRIMERAS FOTOS
                                if($request['foto'] !=null && $request['foto_derecha'] !=null && $request['foto_izquierda'] ==null && $request['foto_atras'] ==null){
                                    //  return response()->json(['success'=>'HOLA']);
                                    $request->validate([
                                        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                                        'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                                        // 'status'     => 'required',
                                        'sucursal'   => 'required',
                                       // 'descripcion'=> 'required',
                                    ]);
                                   
                                        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                                        // $new_name1 = $request->hidden_image;
                                        $image = $request->file('foto'); 
                                        $new_name = rand() . '.' . $image->getClientOriginalExtension();
                                        $image->move(public_path('images'), $new_name);


                                        $image1 = $request->file('foto_derecha'); 
                                        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                                        $image1->move(public_path('images'), $new_name1);
                                        // return response()->json(['success'=>$new_name1]);
                                        try{$vehiculo ->update([
                                            'foto' =>$new_name,
                                            'foto_derecha' =>$new_name1,
                                            'vin'        =>$request['vin'],
                                            'matricula'  =>$request['matricula'],
                                            'marca'      =>$request['marca'],
                                            'modelo'     =>$request['modelo'],
                                            'transmicion'=>$request['transmision'],
                                            'puertas'    =>$request['puertas'],
                                            'rendimiento'=>$request['rendimiento'],
                                            // 'estatus'    =>$request['status'],
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
                                            // 'estatus'    =>$request['status'],               
                                            'updated_at' =>$date
                                        ]);
                                        }catch(\Illuminate\Database\QueryException $ex){
                                            return response()->json(['success'=>'REPITE']);
                                        }
                                        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
                                        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                                        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
                                        ->first();
                                            $vehiculosucursal->update([
                                                'sucursal'=>$foranea['idsucursal'],
                                                'vehiculo'=>$vehiculo['idvehiculo'],
                                                // 'status'=>$request['status'],
                                                'updated_at'=>$date
                                                ]);
                                
                                                return response()->json(['success'=>'EXITO']);
                                }

                                  // SE MODIFICA SOLO LAS DOS FOTOS DE EN MEDIO
                                  if($request['foto'] ==null && $request['foto_derecha'] !=null && $request['foto_izquierda'] !=null && $request['foto_atras'] ==null){
                                    //  return response()->json(['success'=>'HOLA']);
                                    $request->validate([
                                        'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
                                        'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                                        // 'status'     => 'required',
                                        'sucursal'   => 'required',
                                       // 'descripcion'=> 'required',
                                    ]);
                                   
                                        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                                        // $new_name1 = $request->hidden_image;
                                        $image = $request->file('foto_derecha'); 
                                        $new_name = rand() . '.' . $image->getClientOriginalExtension();
                                        $image->move(public_path('images'), $new_name);


                                        $image1 = $request->file('foto_izquierda'); 
                                        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                                        $image1->move(public_path('images'), $new_name1);
                                        // return response()->json(['success'=>$new_name1]);
                                        try{$vehiculo ->update([
                                            'foto_derecha' =>$new_name,
                                            'foto_izquierda' =>$new_name1,
                                            'vin'        =>$request['vin'],
                                            'matricula'  =>$request['matricula'],
                                            'marca'      =>$request['marca'],
                                            'modelo'     =>$request['modelo'],
                                            'transmicion'=>$request['transmision'],
                                            'puertas'    =>$request['puertas'],
                                            'rendimiento'=>$request['rendimiento'],
                                            // 'estatus'    =>$request['status'],
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
                                            // 'estatus'    =>$request['status'],               
                                            'updated_at' =>$date
                                        ]);
                                        }catch(\Illuminate\Database\QueryException $ex){
                                            return response()->json(['success'=>'REPITE']);
                                        }
                                        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
                                        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
                                        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
                                        ->first();
                                            $vehiculosucursal->update([
                                                'sucursal'=>$foranea['idsucursal'],
                                                'vehiculo'=>$vehiculo['idvehiculo'],
                                                // 'status'=>$request['status'],
                                                'updated_at'=>$date
                                                ]);
                                
                                                return response()->json(['success'=>'EXITO']);
                                }


  // SE MODIFICA SOLO LAS DOS ULTIMAS FOTOS
  if($request['foto'] ==null && $request['foto_derecha'] ==null && $request['foto_izquierda'] !=null && $request['foto_atras'] !=null){
    //  return response()->json(['success'=>'HOLA']);
    $request->validate([
        'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_atras' => 'required|image|mimes:jpeg,png,jpg,gif',
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
        // 'status'     => 'required',
        'sucursal'   => 'required',
       // 'descripcion'=> 'required',
    ]);
   
        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        // $new_name1 = $request->hidden_image;
        $image = $request->file('foto_izquierda'); 
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);


        $image1 = $request->file('foto_atras'); 
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);
        // return response()->json(['success'=>$new_name1]);
        try{$vehiculo ->update([
            'foto_izquierda' =>$new_name,
            'foto_trasera' =>$new_name1,
            'vin'        =>$request['vin'],
            'matricula'  =>$request['matricula'],
            'marca'      =>$request['marca'],
            'modelo'     =>$request['modelo'],
            'transmicion'=>$request['transmision'],
            'puertas'    =>$request['puertas'],
            'rendimiento'=>$request['rendimiento'],
            // 'estatus'    =>$request['status'],
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
            // 'estatus'    =>$request['status'],               
            'updated_at' =>$date
        ]);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['success'=>'REPITE']);
        }
        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehiculo['idvehiculo'],
                // 'status'=>$request['status'],
                'updated_at'=>$date
                ]);

                return response()->json(['success'=>'EXITO']);
}


  // SE MODIFICA SOLO LAS TRES PRIMERAS FOTOS
  if($request['foto'] !=null && $request['foto_derecha'] !=null && $request['foto_izquierda'] !=null && $request['foto_atras'] ==null){
    //  return response()->json(['success'=>'HOLA']);
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
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
        // 'status'     => 'required',
        'sucursal'   => 'required',
       // 'descripcion'=> 'required',
    ]);
   
        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        // $new_name1 = $request->hidden_image;
        $image = $request->file('foto'); 
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);


        $image1 = $request->file('foto_derecha'); 
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);


        $image2 = $request->file('foto_izquierda'); 
        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
        $image2->move(public_path('images'), $new_name2);
        // return response()->json(['success'=>$new_name1]);
        try{$vehiculo ->update([
            'foto' =>$new_name,
            'foto_derecha' =>$new_name1,
            'foto_izquierda' =>$new_name2,
            'vin'        =>$request['vin'],
            'matricula'  =>$request['matricula'],
            'marca'      =>$request['marca'],
            'modelo'     =>$request['modelo'],
            'transmicion'=>$request['transmision'],
            'puertas'    =>$request['puertas'],
            'rendimiento'=>$request['rendimiento'],
            // 'estatus'    =>$request['status'],
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
            // 'estatus'    =>$request['status'],               
            'updated_at' =>$date
        ]);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['success'=>'REPITE']);
        }
        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehiculo['idvehiculo'],
                // 'status'=>$request['status'],
                'updated_at'=>$date
                ]);

                return response()->json(['success'=>'EXITO']);
}

  // SE MODIFICA SOLO LAS TRES ULTIMAS FOTOS
  if($request['foto'] ==null && $request['foto_derecha'] !=null && $request['foto_izquierda'] !=null && $request['foto_atras'] !=null){
    $request->validate([
        'foto_atras' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
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
        // 'status'     => 'required',
        'sucursal'   => 'required',
       // 'descripcion'=> 'required',
    ]);
    // return response()->json(['success'=>'HOLA']);
   
        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        // $new_name1 = $request->hidden_image;
        $image = $request->file('foto_atras'); 
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);


        $image1 = $request->file('foto_derecha'); 
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);


        $image2 = $request->file('foto_izquierda'); 
        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
        $image2->move(public_path('images'), $new_name2);
        // return response()->json(['success'=>$new_name1]);
        try{$vehiculo ->update([
            'foto_trasera' =>$new_name,
            'foto_derecha' =>$new_name1,
            'foto_izquierda' =>$new_name2,
            'vin'        =>$request['vin'],
            'matricula'  =>$request['matricula'],
            'marca'      =>$request['marca'],
            'modelo'     =>$request['modelo'],
            'transmicion'=>$request['transmision'],
            'puertas'    =>$request['puertas'],
            'rendimiento'=>$request['rendimiento'],
            // 'estatus'    =>$request['status'],
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
            // 'estatus'    =>$request['status'],               
            'updated_at' =>$date
        ]);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['success'=>'REPITE']);
        }
        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehiculo['idvehiculo'],
                // 'status'=>$request['status'],
                'updated_at'=>$date
                ]);

                return response()->json(['success'=>'EXITO']);
}

        // SE MODIFICA TODAS LAS FOTOS 
if($request['foto'] !=null && $request['foto_derecha'] !=null && $request['foto_izquierda'] !=null && $request['foto_atras'] !=null){
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_atras' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_derecha' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto_izquierda' => 'required|image|mimes:jpeg,png,jpg,gif',
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
        // 'status'     => 'required',
        'sucursal'   => 'required',
       // 'descripcion'=> 'required',
    ]);
    // return response()->json(['success'=>'HOLA']);
   
        $vehiculo = vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        // $new_name1 = $request->hidden_image;
        $image = $request->file('foto_atras'); 
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);


        $image1 = $request->file('foto_derecha'); 
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);


        $image2 = $request->file('foto_izquierda'); 
        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
        $image2->move(public_path('images'), $new_name2);

        $image3 = $request->file('foto'); 
        $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
        $image3->move(public_path('images'), $new_name3);
        // return response()->json(['success'=>$new_name1]);
        try{$vehiculo ->update([
            'foto_trasera' =>$new_name,
            'foto_derecha' =>$new_name1,
            'foto_izquierda' =>$new_name2,
            'foto' =>$new_name3,
            'vin'        =>$request['vin'],
            'matricula'  =>$request['matricula'],
            'marca'      =>$request['marca'],
            'modelo'     =>$request['modelo'],
            'transmicion'=>$request['transmision'],
            'puertas'    =>$request['puertas'],
            'rendimiento'=>$request['rendimiento'],
            // 'estatus'    =>$request['status'],
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
            // 'estatus'    =>$request['status'],               
            'updated_at' =>$date
        ]);
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json(['success'=>'REPITE']);
        }
        $foranea = Sucursal::where('nombre',$request['sucursal'])->first();      
        // $vehi =Vehiculo::where('idvehiculo',$request['idvehiculo'])->first();
        $vehiculosucursal=VehiculoSucursales::where('vehiculo',$vehiculo['idvehiculo'])
        ->first();
            $vehiculosucursal->update([
                'sucursal'=>$foranea['idsucursal'],
                'vehiculo'=>$vehiculo['idvehiculo'],
                // 'status'=>$request['status'],
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

    public function Modelo(Request $request){
        return view('gerente.vehiculo.modelovehiculo'); 
    }

    public function insertModelo(Request $request){

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();   

        $request->validate([
            'modelo' => 'required',
            'descripcion'=> 'required',
        ]);
        // return response()->json(['success'=>'EXITO']);
        Modelo::insert([
            'nombremodelo'=>$request['modelo'],
            'descripcion'=>$request['descripcion'],
            'created_at'=>$date,
            'updated_at'=>$date
            ]);
            return response()->json(['success'=>'EXITO']);
    }

    public function Consultar(Request $request){

            $marca = MarcaVehiculo::
            //  join('marca_modelos','id','=','marca_modelos.idMarca')
            // ->join('modelo_vehiculos','marca_modelos.idModelo','=','modelo_vehiculos.id')
            // ->select('modelo_vehiculos.*')
            where('nombre',$request['text'])
            ->first();

             $marcamodelo = MarcaModelo::join('modelo_vehiculos','idModelo','=','modelo_vehiculos.id')
             ->select('modelo_vehiculos.*')
             ->where('idMarca',$marca['id'])->get();

            return response()->json(['success'=>$marcamodelo]);
    }


    public function BajaVehiculo(Request $request){
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
                        $reservas = Alquiler::where('id_vehiculo',$request['vehiculo'])
                        ->where('fecha_recogida','>=',$date)
                        ->orderBy('id','asc')
                        ->get();

                        if(count($reservas)>0){
                        return back()->with('curso',$reservas);
                        }else{
                            $vehiculo = vehiculo::where('idvehiculo',$request['vehiculo'])->first(); 
                            $vehiculo ->update([                              
                             'estatus'    =>'INACTIVO',
                             'updated_at' =>$date                             
                            ]);  
                            return back()->with('baja',$vehiculo);                          
                        }
        return $reservas;
    }

    public function BorrarVehiculo(Request $request){
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
                      
        $vehiculo = vehiculo::where('idvehiculo',$request['vehiculo'])->first(); 
        $vehiculo1 = vehiculo::where('idvehiculo',$request['vehiculo'])->first(); 
                        $vehiculo ->update([                              
                             'estatus'    =>'INACTIVO', 
                             'updated_at' =>$date                            
                            ]);
        return back()->with('baja',$vehiculo1);        
    }
    

    public function AltaVehiculo(Request $request){
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        // return $request;          
        $vehiculo = vehiculo::where('idvehiculo',$request['vehiculo'])->first(); 
                        $vehiculo ->update([                              
                             'estatus'    =>'ACTIVO', 
                             'updated_at' =>$date                            
                            ]);
        return back()->with('alta',$vehiculo);        
    }
}

