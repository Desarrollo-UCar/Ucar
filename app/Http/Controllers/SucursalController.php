<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\EmpleadoSucursal;
use App\Sucursal;
use Illuminate\Http\Request;
//use App\Providers\ValidacionesLaravel;
class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {   
        //return response()->json($request);
           if(!$request->user()->hasRole('gerente')){
            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();
            return view('gerente.sucursal.versucursales',compact('sucursals'));
        }
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
    public function create(request $request)
    {
        if($request->user()->hasRole('gerente'))
        return view('gerente.sucursal.alta_sucursal');
        return abort(403, 'No tienes autorización para ingresar.');
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
     
       
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
       $request->validate([
            'nombre'=>'required|regex:/^[\pL\s]+$/u',
            'codigopostal'=>'required|regex:/[0-9]{5}/m',
            'estado'=>'required',
            'municipio'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
            'numero'=>'required',
            'telefono'=>'required|regex:/[1-9][0-9]{9}/m',
        ]);

        Sucursal::create([
            'nombre'=> $request['nombre'],
            'codigopostal'=>$request['codigopostal'],
            'estado'=>$request['estado'],
            'municipio' =>$request['municipio'],
            'colonia'=>$request['colonia'],
            'calle' =>$request['calle'],
            'numero'=>$request['numero'],
            'telefono'=>$request['telefono'],
            'status'=> 'ACTIVO',
            'created_at' => $date,
            'updated_at'=> $date
        ]);
   
        return response()->json(['success'=>'DATOS AGREGADOS CORRECTAMENTE']);
    
   
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
    
   
    
    public function destroy(Sucursal $sucursal)
    {
        //
    }

   public function ModificarDatos(Request $request){
    $carbon = new \Carbon\Carbon();
    $date = $carbon->now();
    $request->validate([
        'nombre'=>'required|regex:/^[\pL\s]+$/u',
        'codigopostal'=>'required|regex:/[0-9]{5}/m',
        'estado'=>'required',
        'municipio'=>'required',
        'colonia'=>'required',
        'calle'=>'required',
        'numero'=>'required',
        'telefono'=>'required|regex:/[1-9][0-9]{9}/m',
        ]);
        $sucursal=Sucursal::where('idsucursal',$request['idsucursal'])->first();
          
        $sucursal->update([
            'nombre'=> $request['nombre'],
            'codigopostal'=>$request['codigopostal'],
            'estado'=>$request['estado'],
            'municipio' =>$request['municipio'],
            'colonia'=>$request['colonia'],
            'calle' =>$request['calle'],
            'numero'=>$request['numero'],
            'telefono'=>$request['telefono'],
            'status'=> 'ACTIVO',
            'updated_at'=> $date
        ]);
        return response()->json(['success'=>'DATOS AGREGADOS CORRECTAMENTE']);

    }

}
