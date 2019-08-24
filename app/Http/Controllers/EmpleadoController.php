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

        $empleado = Empleado::where('curp',$request['curp'])->first();
        //return $empleado;
        if(!empty($empleado)){
            return back()->with('msj','EL EMPLEADO '.$request['nombres'].' '.$request['primerApellido'].' YA SE ENCUENTRA REGISTRADO');
        }
        //return "no";
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $diff = $date->diffInYears($request['fechaNacimiento']); 
        if($diff<15){
            return back()->with('mensaje','INTRODUZCA UNA FECHA DE NACIMIENTO INCORRECTO:)');
        }else{         
        
       //return $diff;
        if($request['tipo']=='CHOFER'){
            if($request->validate([
                'curp' => 'required|max:18',
                'nombres' =>'required',
                'primerApellido' =>'required',
                'segundoApellido' =>'required',
                'fechaNacimiento' =>'required|date',
                'nacionalidad' =>'required',
                'pais' =>'required',
                'estado' =>'required',
                'ciudad' =>'required',
                'colonia' =>'required',
                'calle' =>'required',
                'correo' =>'required|email',
                'telefono' =>'required',
                'tipo' => 'required',
                'numlicencia' => 'required',
                'licenciaFechaExpiracion' => 'required|date',
                'licenciaFechaExpedicion' => 'required|date',
            ])){

        $datos = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datos['foto']=$request->file('foto')->store('upload','public');

            Empleado::insert([
                'curp'=>$datos['curp'],
                'nombres'=>$datos['nombres'],
                'primerApellido'=>$datos['primerApellido'],
                'segundoApellido'=>$datos['segundoApellido'],
                'fechaNacimiento'=>$datos['fechaNacimiento'],
                'nacionalidad'=>$datos['nacionalidad'],
                'pais'=>$datos['pais'],
                'estado'=>$datos['estado'],
                'ciudad'=>$datos['ciudad'],
                'colonia'=>$datos['colonia'],
                'calle'=>$datos['calle'],
                'numero'=>$datos['numero'],
                'foto'=>$datos['foto'],
                'correo'=>$datos['correo'],
                'telefono'=>$datos['telefono'],
                'tipo'=>$datos['tipo'],
                'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                'numLicencia'=>$datos['numLicencia'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
            
        }else {
            Empleado::insert([
                'curp'=>$datos['curp'],
                'nombres'=>$datos['nombres'],
                'primerApellido'=>$datos['primerApellido'],
                'segundoApellido'=>$datos['segundoApellido'],
                'fechaNacimiento'=>$datos['fechaNacimiento'],
                'nacionalidad'=>$datos['nacionalidad'],
                'pais'=>$datos['pais'],
                'estado'=>$datos['estado'],
                'ciudad'=>$datos['ciudad'],
                'colonia'=>$datos['colonia'],
                'calle'=>$datos['calle'],
                'numero'=>$datos['numero'],               
                'correo'=>$datos['correo'],
                'telefono'=>$datos['telefono'],
                'tipo'=>$datos['tipo'],
                'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                'numLicencia'=>$datos['numLicencia'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        }

        $sucu = $request->input('sucursal');
        $foranea = Sucursal::where('nombre',$sucu)->first();      
            $emp = Empleado::where('curp',$datos['curp'])->first();
            EmpleadoSucursal::insert([
                'sucursal'=>$foranea->idsucursal,
                'empleado'=>$emp->idempleado,
                'status'=>$datos['status'],
                'created_at'=>$date,
                'updated_at'=>$date
                ]);
   
                return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
            }
        }else{
            if($request->validate([
                'curp' => 'required|max:18',
                'nombres' =>'required',
                'primerApellido' =>'required',
                'segundoApellido' =>'required',
                'fechaNacimiento' =>'required|date',
                'nacionalidad' =>'required',
                'pais' =>'required',
                'estado' =>'required',
                'ciudad' =>'required',
                'colonia' =>'required',
                'calle' =>'required',
                'correo' =>'required|email',
                'telefono' =>'required',
            ])){

        $datos = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datos['foto']=$request->file('foto')->store('upload','public');

            Empleado::insert([
                'curp'=>$datos['curp'],
                'nombres'=>$datos['nombres'],
                'primerApellido'=>$datos['primerApellido'],
                'segundoApellido'=>$datos['segundoApellido'],
                'fechaNacimiento'=>$datos['fechaNacimiento'],
                'nacionalidad'=>$datos['nacionalidad'],
                'pais'=>$datos['pais'],
                'estado'=>$datos['estado'],
                'ciudad'=>$datos['ciudad'],
                'colonia'=>$datos['colonia'],
                'calle'=>$datos['calle'],
                'numero'=>$datos['numero'],
                'foto'=>$datos['foto'],
                'correo'=>$datos['correo'],
                'telefono'=>$datos['telefono'],
                'tipo'=>$datos['tipo'],
                'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                'numLicencia'=>$datos['numLicencia'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
            
        }else {
            Empleado::insert([
                'curp'=>$datos['curp'],
                'nombres'=>$datos['nombres'],
                'primerApellido'=>$datos['primerApellido'],
                'segundoApellido'=>$datos['segundoApellido'],
                'fechaNacimiento'=>$datos['fechaNacimiento'],
                'nacionalidad'=>$datos['nacionalidad'],
                'pais'=>$datos['pais'],
                'estado'=>$datos['estado'],
                'ciudad'=>$datos['ciudad'],
                'colonia'=>$datos['colonia'],
                'calle'=>$datos['calle'],
                'numero'=>$datos['numero'],               
                'correo'=>$datos['correo'],
                'telefono'=>$datos['telefono'],
                'tipo'=>$datos['tipo'],
                'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                'numLicencia'=>$datos['numLicencia'],
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        }

        $sucu = $request->input('sucursal');
        $foranea = Sucursal::where('nombre',$sucu)->first();      
            $emp = Empleado::where('curp',$datos['curp'])->first();
            EmpleadoSucursal::insert([
                'sucursal'=>$foranea->idsucursal,
                'empleado'=>$emp->idempleado,
                'status'=>$datos['status'],
                'created_at'=>$date,
                'updated_at'=>$date
                ]);
   
                return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
        }
    }
}
    }

    
    public function show(Empleado $empleado)
    {
       
    }


   
    public function update(Request $request)
    {
        
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        //return "no";
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $diff = $date->diffInYears($request['fechaNacimiento']); 
        if($diff<15){
            return back()->with('mensaje','INTRODUZCA UNA FECHA DE NACIMIENTO INCORRECTO:)');
        }else{ 

        if($request['tipo']=='CHOFER'){
            if($request->validate([
                'curp' => 'required|max:18',
                'nombres' =>'required',
                'primerApellido' =>'required',
                'segundoApellido' =>'required',
                'fechaNacimiento' =>'required|date',
                'nacionalidad' =>'required',
                'pais' =>'required',
                'estado' =>'required',
                'ciudad' =>'required',
                'colonia' =>'required',
                'calle' =>'required',
                'correo' =>'required|email',
                'telefono' =>'required',
                'tipo' => 'required',
                'tipo' => 'required',
                'numlicencia' => 'required',
                'licenciaFechaExpiracion' => 'required|date',
                'licenciaFechaExpedicion' => 'required|date',
            ])){
                $datos = $request->except('_token');
                $empleado = Empleado::where('curp',$datos['curp'])->first();
                $file=$empleado['foto'];
                  if ($request->hasFile('foto')) {
                      Storage::delete('public/'.$empleado->foto); 
                      $datos['foto']=$request->file('foto')->store('upload','public');
                      $empleado->update([
                          'curp'=>$datos['curp'],
                         'nombres'=>$datos['nombres'],
                         'primerApellido'=>$datos['primerApellido'],
                         'segundoApellido'=>$datos['segundoApellido'],
                         'fechaNacimiento'=>$datos['fechaNacimiento'],
                         'nacionalidad'=>$datos['nacionalidad'],
                         'pais'=>$datos['pais'],
                         'estado'=>$datos['estado'],
                         'ciudad'=>$datos['ciudad'],
                         'colonia'=>$datos['colonia'],
                         'calle'=>$datos['calle'],
                         'numero'=>$datos['numero'],
                         'foto'=>$datos['foto'],
                         'correo'=>$datos['correo'],
                         'telefono'=>$datos['telefono'],
                         'tipo'=>$datos['tipo'],
                         'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                         'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                         'numLicencia'=>$datos['numLicencia'],
                         'updated_at'=>$date
                 ]);
                  }else { 
                      $empleado->update([
                          'curp'=>$datos['curp'],
                         'nombres'=>$datos['nombres'],
                         'primerApellido'=>$datos['primerApellido'],
                         'segundoApellido'=>$datos['segundoApellido'],
                         'fechaNacimiento'=>$datos['fechaNacimiento'],
                         'nacionalidad'=>$datos['nacionalidad'],
                         'pais'=>$datos['pais'],
                         'estado'=>$datos['estado'],
                         'ciudad'=>$datos['ciudad'],
                         'colonia'=>$datos['colonia'],
                         'calle'=>$datos['calle'],
                         'numero'=>$datos['numero'],
                         'foto'=>$file,
                         'correo'=>$datos['correo'],
                         'telefono'=>$datos['telefono'],
                         'tipo'=>$datos['tipo'],
                         'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                         'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                         'numLicencia'=>$datos['numLicencia'],               
                         'updated_at'=>$date
                 ]);
                  }  
          
                  
                  $foranea = Sucursal::where('nombre',$datos['sucursal'])->first();      
                  $emp = Empleado::where('curp',$datos['curp'])->first();
                  $empleadosucursal=EmpleadoSucursal::where('empleado',$emp['idempleado'])
                  ->first();
                      $empleadosucursal->update([
                          'sucursal'=>$foranea['idsucursal'],
                          'empleado'=>$emp['idempleado'],
                          'status'=>$datos['status'],
                          'updated_at'=>$date
                          ]);
                  
                   return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
            }
            
        }else{

        if($request->validate([
            'curp' => 'required|max:18',
            'nombres' =>'required',
            'primerApellido' =>'required',
            'segundoApellido' =>'required',
            'fechaNacimiento' =>'required|date',
            'nacionalidad' =>'required',
            'pais' =>'required',
            'estado' =>'required',
            'ciudad' =>'required',
            'colonia' =>'required',
            'calle' =>'required',
            'correo' =>'required|email',
            'telefono' =>'required',
        ])){
            $datos = $request->except('_token');
            $empleado = Empleado::where('curp',$datos['curp'])->first();
            $file=$empleado['foto'];
              if ($request->hasFile('foto')) {
                  Storage::delete('public/'.$empleado->foto); 
                  $datos['foto']=$request->file('foto')->store('upload','public');
                  $empleado->update([
                      'curp'=>$datos['curp'],
                     'nombres'=>$datos['nombres'],
                     'primerApellido'=>$datos['primerApellido'],
                     'segundoApellido'=>$datos['segundoApellido'],
                     'fechaNacimiento'=>$datos['fechaNacimiento'],
                     'nacionalidad'=>$datos['nacionalidad'],
                     'pais'=>$datos['pais'],
                     'estado'=>$datos['estado'],
                     'ciudad'=>$datos['ciudad'],
                     'colonia'=>$datos['colonia'],
                     'calle'=>$datos['calle'],
                     'numero'=>$datos['numero'],
                     'foto'=>$datos['foto'],
                     'correo'=>$datos['correo'],
                     'telefono'=>$datos['telefono'],
                     'tipo'=>$datos['tipo'],
                     'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                     'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                     'numLicencia'=>$datos['numLicencia'],
                     'updated_at'=>$date
             ]);
              }else { 
                  $empleado->update([
                      'curp'=>$datos['curp'],
                     'nombres'=>$datos['nombres'],
                     'primerApellido'=>$datos['primerApellido'],
                     'segundoApellido'=>$datos['segundoApellido'],
                     'fechaNacimiento'=>$datos['fechaNacimiento'],
                     'nacionalidad'=>$datos['nacionalidad'],
                     'pais'=>$datos['pais'],
                     'estado'=>$datos['estado'],
                     'ciudad'=>$datos['ciudad'],
                     'colonia'=>$datos['colonia'],
                     'calle'=>$datos['calle'],
                     'numero'=>$datos['numero'],
                     'foto'=>$file,
                     'correo'=>$datos['correo'],
                     'telefono'=>$datos['telefono'],
                     'tipo'=>$datos['tipo'],
                     'licenciaFechaExpiracion'=>$datos['licenciaFechaExpiracion'],
                     'licenciaFechaExpedicion'=>$datos['licenciaFechaExpedicion'],
                     'numLicencia'=>$datos['numLicencia'],               
                     'updated_at'=>$date
             ]);
              }  
      
              
              $foranea = Sucursal::where('nombre',$datos['sucursal'])->first();      
              $emp = Empleado::where('curp',$datos['curp'])->first();
              $empleadosucursal=EmpleadoSucursal::where('empleado',$emp['idempleado'])
              ->first();
                  $empleadosucursal->update([
                      'sucursal'=>$foranea['idsucursal'],
                      'empleado'=>$emp['idempleado'],
                      'status'=>$datos['status'],
                      'updated_at'=>$date
                      ]);
              
                      return back()->with('msj','DATOS GUARDADOS EXITOSAMENTE :)');
        }
    }
       
    }
}


    public function modificar(Request $empleado){
        $foranea = Sucursal::where('idsucursal',$empleado['idsucursal'])->first();      
        $emp = Empleado::where('idempleado',$empleado['idempleado'])->first();
        $sucursal=Sucursal::all();
        $empleadosucursal = EmpleadoSucursal::where('sucursal',$foranea['idsucursal'])->first();
        return view('gerente.usuarios.empleados.administradores.editar_empleado',compact('foranea','emp','sucursal','empleadosucursal'));

    }
    public function destroy(Empleado $empleado)
    {
        $empleado-> delete();
        return redirect()->route('empleado.index');
    }
}
