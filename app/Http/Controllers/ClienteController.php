<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cliente;
use App\User;
use App\Role;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB; 
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 $clientes  = Cliente::orderBy('idcliente','DESC')->get();
    	return view ('gerente.clientes.ver_clientes',compact('clientes'));
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
      return response()->json(['success'=>$request['nombres']]);
        /*
        costo del chofer ponerlo por 8 hrs
        quitar el prepago 
        requsitos para recoger el auto antes del pago
        telefono lleva acento
        buscar la api para rellenar estados
        appellido no lleva numero
        poner terminos y oondiciones 
        Agregar genero al cliente y empleado 
        modificación en la vista cliente 
        fecha matenimiento mal validado

        */
    }


    public function mostrar(Request $request)
    {

        return $request;
        if($request['fecha_inicio']==null && $request['fecha_final']== null){
        $clientes = DB::table('reservacions')                                    
        ->join('clientes','idCliente','=','reservacions.id_cliente')
        ->select(DB::raw('count(*) as cantidad, reservacions.id_cliente,clientes.*'))
          ->groupBy('reservacions.id_cliente')
          ->orderBy('cantidad','desc')
          //->limit(10)
          ->get()
          ;          
        }
          
          if($request['fecha_inicio']!= null && $request['fecha_final']== null){
            $clientes = DB::table('reservacions')                                    
            ->join('clientes','idCliente','=','reservacions.id_cliente')
            ->where('reservacions.fecha_reservacion','>=',$request['fecha_inicio'])
            ->select(DB::raw('count(*) as cantidad, reservacions.id_cliente,clientes.*'))
              ->groupBy('reservacions.id_cliente')
              ->orderBy('cantidad','desc')
              //->limit(10)
              ->get()
              ;
          }

          if($request['fecha_final']!= null && $request['fecha_inicial']== null){
            $clientes = DB::table('reservacions')                                    
            ->join('clientes','idCliente','=','reservacions.id_cliente')
            ->where('reservacions.fecha_reservacion','>=',$request['fecha_final'])
            ->select(DB::raw('count(*) as cantidad, reservacions.id_cliente,clientes.*'))
              ->groupBy('reservacions.id_cliente')
              ->orderBy('cantidad','desc')
              //->limit(10)
              ->get()
              ;
          }
          if($request['fecha_final']!= null && $request['fecha_inicial'] != null){
            $clientes = DB::table('reservacions')                                    
            ->join('clientes','idCliente','=','reservacions.id_cliente')
            ->where(['reservacions.fecha_reservacion','>=',$request['fecha_inicio']],'reservacions.fecha_reservacion','<=',$request['fecha_final'])
            ->select(DB::raw('count(*) as cantidad, reservacions.id_cliente,clientes.*'))
              ->groupBy('reservacions.id_cliente')
              ->orderBy('cantidad','desc')
              //->limit(10)
              ->get()
              ;
          }

        //  return $request;
        return view ('gerente.clientes.clientes_frecuentes',compact('clientes'));
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        //    public function index()
    
          $clientes  = Cliente::where('idCliente','=',$id)->get();
           return view ('gerente.clientes.ver_clientes',compact('clientes'));
         
     
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function Agregar(Request $request)
    {
        //        
        // return response()->json(['success'=>'hola mundo']);

       
      if($request['nacionalidad']!='MEXICANA'){
        $request->validate([
          // 'ine' => 'required|regex:/[0-9]{13}/m',
           'nombres' =>'required|regex:/^[\pL\s]+$/u',
           'primerApellido' =>'required',
           'segundoApellido' =>'required',
           'fechaNacimiento' =>'required|date',
           'nacionalidad' =>'required',
           'pasaporte' =>'required',
           'pais' => 'required',
           'estado' =>'required',
           'ciudad' =>'required',
           'colonia' =>'required',
           'calle' =>'required',
           'email' =>'required|email',
           'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
           //  'genero' => 'required',
          //  'sucursal' => 'required',
           'numero' => 'required',
          'password'=> 'required',
          'passwordconfirm'=>'required',
       ]);
        }else{
          $request->validate([
             'ine' => 'required|regex:/[0-9]{13}/m',
             'nombres' =>'required|regex:/^[\pL\s]+$/u',
             'primerApellido' =>'required',
             'segundoApellido' =>'required',
             'fechaNacimiento' =>'required|date',
             'nacionalidad' =>'required',
             'pais' => 'required',
             'estado' =>'required',
             'ciudad' =>'required',
             'colonia' =>'required',
             'calle' =>'required',
             'email' =>'required|email',
             'telefono' =>'required|regex:/[1-9][0-9]{9}/m',
             'numero' => 'required',
            'password'=> 'required',
            'passwordconfirm'=>'required',
         ]);

        }

        $consulta = Cliente::where('correo',$request['email'])->first();

        if(!empty($consulta)){
          return response()->json(['success'=>'ERROR1']);
        }

        if($request['password']!= $request['passwordconfirm']){
          return response()->json(['success'=>'ERRORCONTRA']);
        }
        
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $diff = $date->diffInYears($request['fechaNacimiento']); 
        if($diff<18 ||$diff > 70){
             return response()->json(['success'=>'ERROR2']);
         }
          // return response()->json(['success'=>'EXITO']);
        Cliente::insert([
          'credencial'=>$request['ine'],
          'pasaporte'=>$request['pasaporte'],
          'nombre'=> $request['nombres'],
          'primer_apellido'=>$request['primerApellido'],
          'segundo_apellido'=>$request['segundoApellido'],
          'fecha_nacimiento'=>$request['fechaNacimiento'],
          'nacionalidad'=>$request['nacionalidad'],
          'correo'=>$request['email'],
          'telefono'=>$request['telefono'],
          'calle'=>$request['calle'],
          'numero'=>$request['numero'],
          'colonia'=>$request['colonia'],
          'ciudad'=>$request['ciudad'],
          'estado'=>$request['estado'],
          'pais'=>$request['pais'],
          'created_at'=>$date,
          'updated_at'=>$date
        ]);
        
        
        // return response()->json(['success'=>'EXITO']);

        
        $user = User::create([
          'name' => $request['nombres'],
          'email' => $request['email'],
          'password' => Hash::make($request['password']),
      ]);

      // return response()->json(['success'=>'EXITO']);

      $user->roles()->attach(Role::where('name', 'user')->first());

          // $credenciales= validate($request(),[
          //   'email' =>'required|email',
          //   'password'=> 'required',
          // ]);
          
          if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return response()->json(['success'=>'EXITO']);
          }    else{
            return response()->json(['success'=>'NO SE PUDO CONECTAR']);
          }      
        
      
        
    }

    
}
