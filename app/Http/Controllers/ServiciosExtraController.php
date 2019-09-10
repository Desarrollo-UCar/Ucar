<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\EmpleadoSucursal;
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
    public function index(request $request)
    {

        if(!$request->user()->hasRole('gerente')){
            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

            $serviciosextra = Serviciosextras::join('servicioextrasucursales','idserviciosextra','=','servicioextrasucursales.serviciosextra')
            ->join('sucursals','idsucursal','=','servicioextrasucursales.sucursal')
            ->select('serviciosextras.*','servicioextrasucursales.*','sucursals.nombre as sucursal','sucursals.idsucursal')->
            where('servicioextrasucursales.sucursal','=',$sucursale->sucursal)
            ->get();
    
            //return $serviciosextra;
        } 
        else{
        $serviciosextra = Serviciosextras::join('servicioextrasucursales','idserviciosextra','=','servicioextrasucursales.serviciosextra')
        ->join('sucursals','idsucursal','=','servicioextrasucursales.sucursal')
        ->select('serviciosextras.*','servicioextrasucursales.*','sucursals.nombre as sucursal','sucursals.idsucursal')
        ->get();
        }
        //return $serviciosextra;
        return view('gerente.servicio_extra.ver_serviciosextras',compact('serviciosextra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
        if(!$request->user()->hasRole('gerente')){
            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursal=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();
        }
            else{
        $sucursal= Sucursal::all();
            }
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
        
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        //$new_name = $request->hidden_image;
      

             $request->validate([
                   'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                   'nombre'=> 'required',               
                   'descripcion'=> 'required',                
                   'disponibilidad'=> 'required',                
                   'precio'=> 'required',
                   'cantidad'=> 'required',  
                   'sucursal'=> 'required', 
                ]);

    $todo =   Serviciosextras::all();
    if(count($todo)>0){
        $servicio =  Serviciosextras::where('nombre',$request['nombre']);
    if(!empty($servicio)){
        return response()->json(['success'=>'ERROR1']);
    }
    }

         $image = $request->file('foto');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        
                
          serviciosextras::insert([
            'nombre'=> $request['nombre'],                
            'descripcion'=> $request['descripcion'],                
            'disponibilidad'=> $request['disponibilidad'],                
            'precio'=> $request['precio'],                
            'foto'=> $new_name,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);

      
        $sucu = $request['sucursal'];
        $foranea = Sucursal::where('nombre',$sucu)->first(); 
        $serext = Serviciosextras::where('nombre',$request['nombre'])->first();

        servicioextrasucursales::insert([
            'sucursal'=>$foranea->idsucursal,
            'serviciosextra' => $serext->idserviciosextra,
            'descripcion'=>$request['descripcion'],
            'cantidad' => $request['cantidad'],
            'created_at'=>$date,
            'updated_at'=>$date
        ]);
        return response()->json(['success'=>'EXITO']);
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

        if(!$servicioextra->user()->hasRole('gerente')){   

            $email = $servicioextra->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)     ->where('status','=','activo')->first();

            $sucursal=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();


       }    
       else{
        $sucursal=Sucursal::all();
       }
        $foranea =sucursal::where('idsucursal',$servicioextra['sucursal'])->first(); 
        $serviciosucursal=servicioextrasucursales::where('sucursal',$servicioextra['sucursal'])
        ->where('serviciosextra',$servicioextra['servicioextra'])
        ->first();
        //return  $serviciosucursal;
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
        
    }

    public function ModificarDatos(Request $request){

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $new_name = $request->hidden_image;
        $image = $request->file('foto');

       // return response()->json(['success'=>'EXITO']);
    
        if($image != '')
        {
             $request->validate([
                   'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                   'nombre'=> 'required',               
                   'descripcion'=> 'required',                
                   'disponibilidad'=> 'required',                
                   'precio'=> 'required',
                   'cantidad'=> 'required',  
                   'sucursal'=> 'required', 
                ]);   
    

         $image = $request->file('foto');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        
        $servicio=Serviciosextras::where('idserviciosextra',$request['idservicio'])->first(); 
        $servicio->update([
            'nombre'=> $request['nombre'],                
            'descripcion'=> $request['descripcion'],                
            'disponibilidad'=> $request['disponibilidad'],                
            'precio'=> $request['precio'],                
            'foto'=> $new_name,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);

        $sucursal = Sucursal::where('nombre',$request['sucursal'])->first();
    
        $serviciosucursal=servicioextrasucursales::where('serviciosextra',$servicio['idserviciosextra'])
        ->first();
                $serviciosucursal->update([
                    'sucursal'=>$sucursal['idsucursal'],
                    'serviciosextra' => $servicio['idserviciosextra'],
                    'descripcion'=>$request['descripcion'],
                    'cantidad' => $request['cantidad'],
                    'updated_at'=>$date
        ]);
        return response()->json(['success'=>'EXITO']);

        }else{
            //return response()->json(['success'=>'EXITO']);
            $request->validate([
                'nombre'=> 'required',               
                'descripcion'=> 'required',                
                'disponibilidad'=> 'required',                
                'precio'=> 'required',
                'cantidad'=> 'required',  
                'sucursal'=> 'required', 
             ]);
     
       
             $servicio=Serviciosextras::where('idserviciosextra',$request['idservicio'])->first(); 
     $servicio->update([
         'nombre'=> $request['nombre'],                
         'descripcion'=> $request['descripcion'],                
         'disponibilidad'=> $request['disponibilidad'],                
         'precio'=> $request['precio'],   
         'created_at'=>$date,
         'updated_at'=>$date
     ]);

     
    
     $serviciosucursal=servicioextrasucursales::where('serviciosextra',$servicio['idserviciosextra'])->first();


     $sucu = $request['sucursal'];
     $foranea = Sucursal::where('nombre',$sucu)->first(); 
     $serext = Serviciosextras::where('idserviciosextra',$request['idservicio'])->first(); 

     $serviciosucursal->update([
         'sucursal'=>$foranea->idsucursal,
         'serviciosextra' => $serext->idserviciosextra,
         'descripcion'=>$request['descripcion'],
         'cantidad' => $request['cantidad'],
         'created_at'=>$date,
         'updated_at'=>$date
     ]);
     return response()->json(['success'=>'EXITO']);
        }

      
    }
   
}
