<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Sucursal;
use App\EmpleadoSucursal;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class EmpleadoController extends Controller
{
        public function index()
    {
        $empleado = Empleado::join('empleadosucursals','idempleado','=','empleadosucursals.empleado')
        ->join('sucursals','empleadosucursals.sucursal','=','sucursals.idsucursal')
        ->select('empleados.*','empleadosucursals.status','sucursals.nombre as sucursal','sucursals.idsucursal')
        ->get();
        return view('gerente.usuarios.empleados.administradores.ver_admin',compact('empleado'));
    }

    
    public function create()
    {
        $sucursal=Sucursal::all();
        return view('gerente.usuarios.empleados.administradores.alta_admin',compact('sucursal'));
    }

    
    public function store(Request $request)
    {   
       // return $request;
        //$empleado = Empleado::where('ine',$request['ine'])->first();
        //return $empleado;
       // $datos = request()->except('_token');
         //return response()->json(['errors'=>$request['foto']]);
         //$request['foto']=$request->file('foto')->store('upload','public');
         //if ($request->hasFile('foto')) {

           // $imagen = $request['foto'];

          

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
            if($request['tipo']=='CHOFER'){
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                   'ine' => 'required|regex:/[0-9]{13}/m',
                   'nombres' =>'required|regex:/^[\pL\s]+$/u',
                    'primerApellido' =>'required',
                    'segundoApellido' =>'required',
                    'fechaNacimiento' =>'required|date',
                    'nacionalidad' =>'required',
                    'codigopostal' => 'required|regex:/[0-9]{5}/m',
                    'estado' =>'required',
                    'municipio' =>'required',
                    'colonia' =>'required',
                    'calle' =>'required',
                    'correo' =>'required|email',
                    'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
                    'tipo' => 'required',
                    'genero' => 'required',
                    'sucursal' => 'required',
                    'numero' => 'required',
                    'numLicencia' => 'required',
                    'licenciaFechaExpiracion' => 'required|date',
                    'licenciaFechaExpedicion' => 'required|date',
                ]);
            }else{
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                    'ine' => 'required|regex:/[0-9]{13}/m',
                    'nombres' =>'required|regex:/^[\pL\s]+$/u',
                    'primerApellido' =>'required',
                    'segundoApellido' =>'required',
                    'fechaNacimiento' =>'required|date',
                    'nacionalidad' =>'required',
                    'genero' => 'required',
                    'codigopostal' => 'required|regex:/[0-9]{5}/m',
                    'estado' =>'required',
                    'municipio' =>'required',
                    'colonia' =>'required',
                    'calle' =>'required',
                    'correo' =>'required|email',
                    'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
                    'tipo' => 'required',                   
                    'sucursal' => 'required',
                    'numero' => 'required',
                    'status'=> 'required',
                ]);
            }      
                
      /*return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
       'class_name'  => 'alert-success'
      ]);*/
      
      $todo=Empleado::all();
      if(count($todo)>0){        
        $empleado = Empleado::where('ine',$request['ine'])->first();
        if(!empty($empleado)){
            return response()->json(['success'=>'ERROR1']);
         }
        }
         $diff = $date->diffInYears($request['fechaNacimiento']); 
       if($diff<15 ||$diff > 60){
            return response()->json(['success'=>'ERROR2']);
        }

        $image = $request->file('foto');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

                    Empleado::insert([
                        'ine'=>$request['ine'],
                        'nombres'=>$request['nombres'],
                        'primerApellido'=>$request['primerApellido'],
                        'segundoApellido'=>$request['segundoApellido'],
                        'fechaNacimiento'=>$request['fechaNacimiento'],
                        'nacionalidad'=>$request['nacionalidad'],
                        'codigopostal'=>$request['codigopostal'],
                        'estado'=>$request['estado'],
                        'municipio'=>$request['municipio'],
                        'colonia'=>$request['colonia'],
                        'calle'=>$request['calle'],
                        'numero'=>$request['numero'],
                        'foto'=>$new_name,
                        'correo'=>$request['correo'],
                        'telefono'=>$request['telefono'],
                        'tipo'=>$request['tipo'],
                        'genero'=>$request['genero'],
                        'status'=>$request['status'],
                        'licenciaFechaExpiracion'=>$request['licenciaFechaExpiracion'],
                        'licenciaFechaExpedicion'=>$request['licenciaFechaExpedicion'],
                        'numLicencia'=>$request['numLicencia'],
                        'created_at'=>$date,
                        'updated_at'=>$date
                    ]);
               

                 $sucu = $request['sucursal'];
                $foranea = Sucursal::where('nombre',$sucu)->first();      
                    $emp = Empleado::where('ine',$request['ine'])->first();
                    EmpleadoSucursal::insert([
                        'sucursal'=>$foranea->idsucursal,
                        'empleado'=>$emp->idempleado,
                        'status'=>$request['status'],
                        'created_at'=>$date,
                        'updated_at'=>$date
                        ]);
           
                        return response()->json(['success'=>'EXITO']);
    
    }

    
    public function show(Empleado $empleado)
    {
       
    }


   
    public function update(Request $request)
    {
       
    
}


    public function modificar(Request $empleado){
        $foranea = Sucursal::where('idsucursal',$empleado['idsucursal'])->first();      
        $emp = Empleado::where('idempleado',$empleado['idempleado'])->first();
        $sucursal=Sucursal::all();
        $empleadosucursal = EmpleadoSucursal::where('sucursal',$foranea['idsucursal'])->first();
        return view('gerente.usuarios.empleados.administradores.editar_empleado',compact('foranea','emp','sucursal','empleadosucursal'));

    }

    public function ModificarDatos(Request $request){

        
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $new_name = $request->hidden_image;
        $image = $request->file('foto');       
      

            if($image != '')
        { 
            if($request['tipo']=='CHOFER'){
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                   'ine' => 'required|regex:/[0-9]{13}/m',
                   'nombres' =>'required|regex:/^[\pL\s]+$/u',
                    'primerApellido' =>'required',
                    'segundoApellido' =>'required',
                    'fechaNacimiento' =>'required|date',
                    'nacionalidad' =>'required',
                    'codigopostal' => 'required|regex:/[0-9]{5}/m',
                    'estado' =>'required',
                    'municipio' =>'required',
                    'colonia' =>'required',
                    'calle' =>'required',
                    'correo' =>'required|email',
                    'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
                    'tipo' => 'required',
                    'genero' => 'required',
                    'sucursal' => 'required',
                    'numero' => 'required',
                    'numLicencia' => 'required',
                    'licenciaFechaExpiracion' => 'required|date',
                    'licenciaFechaExpedicion' => 'required|date',
                ]);
            }else{
                $request->validate([
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                    'ine' => 'required|regex:/[0-9]{13}/m',
                    'nombres' =>'required|regex:/^[\pL\s]+$/u',
                    'primerApellido' =>'required',
                    'segundoApellido' =>'required',
                    'fechaNacimiento' =>'required|date',
                    'nacionalidad' =>'required',
                    'genero' => 'required',
                    'codigopostal' => 'required|regex:/[0-9]{5}/m',
                    'estado' =>'required',
                    'municipio' =>'required',
                    'colonia' =>'required',
                    'calle' =>'required',
                    'correo' =>'required|email',
                    'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
                    'tipo' => 'required',                   
                    'sucursal' => 'required',
                    'numero' => 'required',
                    'status'=> 'required',
                ]);
            }      
                
      /*return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
       'class_name'  => 'alert-success'
      ]);*/
      
      
        
        $empleado = Empleado::where('ine',$request['ine'])->first();
         $diff = $date->diffInYears($request['fechaNacimiento']); 
       if($diff<15 ||$diff > 60){
            return response()->json(['success'=>'ERROR2']);
        }

        $image = $request->file('foto');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

                   
        $empleado->update([
                        'ine'=>$request['ine'],
                        'nombres'=>$request['nombres'],
                        'primerApellido'=>$request['primerApellido'],
                        'segundoApellido'=>$request['segundoApellido'],
                        'fechaNacimiento'=>$request['fechaNacimiento'],
                        'nacionalidad'=>$request['nacionalidad'],
                        'codigopostal'=>$request['codigopostal'],
                        'estado'=>$request['estado'],
                        'municipio'=>$request['municipio'],
                        'colonia'=>$request['colonia'],
                        'calle'=>$request['calle'],
                        'numero'=>$request['numero'],
                        'foto'=>$new_name,
                        'correo'=>$request['correo'],
                        'telefono'=>$request['telefono'],
                        'tipo'=>$request['tipo'],
                        'genero'=>$request['genero'],
                        'status'=>$request['status'],
                        'licenciaFechaExpiracion'=>$request['licenciaFechaExpiracion'],
                        'licenciaFechaExpedicion'=>$request['licenciaFechaExpedicion'],
                        'numLicencia'=>$request['numLicencia'],
                        'created_at'=>$date,
                        'updated_at'=>$date
                    ]);
               

                 $sucu = $request['sucursal'];
                $foranea = Sucursal::where('nombre',$sucu)->first();      
                    $emp = Empleado::where('ine',$request['ine'])->first();
                    EmpleadoSucursal::insert([
                        'sucursal'=>$foranea->idsucursal,
                        'empleado'=>$emp->idempleado,
                        'status'=>$request['status'],
                        'created_at'=>$date,
                        'updated_at'=>$date
                        ]);
           
                        return response()->json(['success'=>'EXITO']);
        }else{
            if($request['tipo']=='CHOFER'){
                $request->validate([
                   'ine' => 'required|regex:/[0-9]{13}/m',
                   'nombres' =>'required|regex:/^[\pL\s]+$/u',
                    'primerApellido' =>'required',
                    'segundoApellido' =>'required',
                    'fechaNacimiento' =>'required|date',
                    'nacionalidad' =>'required',
                    'codigopostal' => 'required|regex:/[0-9]{5}/m',
                    'estado' =>'required',
                    'municipio' =>'required',
                    'colonia' =>'required',
                    'calle' =>'required',
                    'correo' =>'required|email',
                    'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
                    'tipo' => 'required',
                    'genero' => 'required',
                    'sucursal' => 'required',
                    'numero' => 'required',
                    'numLicencia' => 'required',
                    'licenciaFechaExpiracion' => 'required|date',
                    'licenciaFechaExpedicion' => 'required|date',
                ]);
            }else{
                $request->validate([
                    'ine' => 'required|regex:/[0-9]{13}/m',
                    'nombres' =>'required|regex:/^[\pL\s]+$/u',
                    'primerApellido' =>'required',
                    'segundoApellido' =>'required',
                    'fechaNacimiento' =>'required|date',
                    'nacionalidad' =>'required',
                    'genero' => 'required',
                    'codigopostal' => 'required|regex:/[0-9]{5}/m',
                    'estado' =>'required',
                    'municipio' =>'required',
                    'colonia' =>'required',
                    'calle' =>'required',
                    'correo' =>'required|email',
                    'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
                    'tipo' => 'required',                   
                    'sucursal' => 'required',
                    'numero' => 'required',
                    'status'=> 'required',
                ]);
            }      
               
      
      
        
        $empleado = Empleado::where('ine',$request['ine'])->first();
         $diff = $date->diffInYears($request['fechaNacimiento']); 
       if($diff<15 ||$diff > 60){
            return response()->json(['success'=>'ERROR2']);
        }

                        
        $empleado->update([
                        'ine'=>$request['ine'],
                        'nombres'=>$request['nombres'],
                        'primerApellido'=>$request['primerApellido'],
                        'segundoApellido'=>$request['segundoApellido'],
                        'fechaNacimiento'=>$request['fechaNacimiento'],
                        'nacionalidad'=>$request['nacionalidad'],
                        'codigopostal'=>$request['codigopostal'],
                        'estado'=>$request['estado'],
                        'municipio'=>$request['municipio'],
                        'colonia'=>$request['colonia'],
                        'calle'=>$request['calle'],
                        'numero'=>$request['numero'],
                        'correo'=>$request['correo'],
                        'telefono'=>$request['telefono'],
                        'tipo'=>$request['tipo'],
                        'genero'=>$request['genero'],
                        'status'=>$request['status'],
                        'licenciaFechaExpiracion'=>$request['licenciaFechaExpiracion'],
                        'licenciaFechaExpedicion'=>$request['licenciaFechaExpedicion'],
                        'numLicencia'=>$request['numLicencia'],
                        'created_at'=>$date,
                        'updated_at'=>$date
                    ]);
               

                 $sucu = $request['sucursal'];
                $foranea = Sucursal::where('nombre',$sucu)->first();      
                    $emp = Empleado::where('ine',$request['ine'])->first();
                    EmpleadoSucursal::insert([
                        'sucursal'=>$foranea->idsucursal,
                        'empleado'=>$emp->idempleado,
                        'status'=>$request['status'],
                        'created_at'=>$date,
                        'updated_at'=>$date
                        ]);
           
                        return response()->json(['success'=>'EXITO']);

        }

    }
    public function destroy(Empleado $empleado)
    {
        $empleado-> delete();
        return redirect()->route('empleado.index');
    }
}
