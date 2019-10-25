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
  
    //  return response()->json(['success'=>'fsdfdghj']);
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
       $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto1' => 'required|image|mimes:jpeg,png,jpg,gif',
        'foto2' => 'required|image|mimes:jpeg,png,jpg,gif',
            'nombre'=>'required|regex:/^[\pL\s]+$/u',
            'codigopostal'=>'required|regex:/[0-9]{5}/m',
            'estado'=>'required',
            'municipio'=>'required',
            'colonia'=>'required',
            'calle'=>'required',
            'numero'=>'required',
            'telefono'=>'required|regex:/[1-9][0-9]{9}/m',
        ]);

        $contar = Sucursal::all();
        if(!empty($contar)){
            $nombre = str_replace(' ', '', $request['nombre']);
            $comparar = Sucursal::all();
            foreach($comparar as $comp){
            $nom=str_replace(' ', '', $comp['nombre']);
          
            if($nom == $nombre){
                return response()->json(['success'=>'EXISTE']);
            }
        }
        }

        //SE AGREGA LA PRIMERA FOTO
        $image = $request->file('foto');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        //SE AGREGA LA PRIMERA FOTO
        $image1 = $request->file('foto1');
        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
        $image1->move(public_path('images'), $new_name1);

        //SE AGREGA LA PRIMERA FOTO
        $image2 = $request->file('foto2');
        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
        $image2->move(public_path('images'), $new_name2);
        // return response()->json(['success'=>'DATOS AGREGADOS CORRECTAMENTE']);
        Sucursal::create([
            'foto'=>$new_name,
            'foto1'=>$new_name1,
            'foto2'=>$new_name2,
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
   
    // NO SE MODIFICA NINGUNA IMAGEN
    if($request['foto']==null && $request['foto1']==null && $request['foto2']==null){
        
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

    // SE MODIFICA LA PRIMERA IMAGEN
    if($request['foto']!=null && $request['foto1']==null && $request['foto2']==null){
        
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
            $image = $request->file('foto');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);   
            
    
            $sucursal->update([
                'foto'=>$new_name,
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
    
        // SE MODIFICA LA SEGUNDA IMAGEN 

        if($request['foto']==null && $request['foto1']!=null && $request['foto2']==null){
        
            $request->validate([
                'foto1' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                $image1 = $request->file('foto1');
                $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                $image1->move(public_path('images'), $new_name1);
        
                
        
                $sucursal->update([
                    'foto1'=>$new_name1,
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
        
        
            //SE MODIFICA LA TERCERA IMAGEN

            if($request['foto']==null && $request['foto1']==null && $request['foto2']!=null){
        
                $request->validate([
                    'foto2' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                
                    $image2 = $request->file('foto2');
                    $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
                    $image2->move(public_path('images'), $new_name2);
            
                    
            
                    $sucursal->update([
                        'foto2'=>$new_name2,
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
            
                //SE MODIFICA LAS TRES IMAGENES
                if($request['foto']!=null && $request['foto1']!=null && $request['foto2']!=null){
        
                    $request->validate([
                        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                        'foto1' => 'required|image|mimes:jpeg,png,jpg,gif',
                        'foto2' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                        $image = $request->file('foto');
                        $new_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $new_name);
                
                        $image1 = $request->file('foto1');
                        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                        $image1->move(public_path('images'), $new_name1);                
                        
                        $image2 = $request->file('foto2');
                        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
                        $image2->move(public_path('images'), $new_name2);
                        $sucursal->update([
                            'foto'=>$new_name,
                            'foto1'=>$new_name1,
                            'foto2'=>$new_name2,
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
                
                     //SE MODIFICA LAS DOS PRIMERAS IMAGENES
                if($request['foto']!=null && $request['foto1']!=null && $request['foto2']==null){
        
                    $request->validate([
                        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                        'foto1' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                        $image = $request->file('foto');
                        $new_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $new_name);
                
                        $image1 = $request->file('foto1');
                        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                        $image1->move(public_path('images'), $new_name1);                
                        
                        $sucursal->update([
                            'foto'=>$new_name,
                            'foto1'=>$new_name1,
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
                
                             //SE MODIFICA LAS DOS ULTIMAS IMAGENES
                if($request['foto']==null && $request['foto1']!=null && $request['foto2']!=null){
        
                    $request->validate([
                        'foto1' => 'required|image|mimes:jpeg,png,jpg,gif',
                        'foto2' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                        $image1 = $request->file('foto1');
                        $new_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                        $image1->move(public_path('images'), $new_name1);                
                        
                        $image2 = $request->file('foto2');
                        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
                        $image2->move(public_path('images'), $new_name2);                
                        
                        $sucursal->update([
                            'foto1'=>$new_name1,
                            'foto2'=>$new_name2,
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

                                     //SE MODIFICA LAS DOS LATERALES DE IMAGENES
                if($request['foto']!=null && $request['foto1']==null && $request['foto2']!=null){
        
                    $request->validate([
                        'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
                        'foto2' => 'required|image|mimes:jpeg,png,jpg,gif',
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
                        $image = $request->file('foto');
                        $new_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images'), $new_name);                
                        
                        $image2 = $request->file('foto2');
                        $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
                        $image2->move(public_path('images'), $new_name2);                
                        
                        $sucursal->update([
                            'foto'=>$new_name,
                            'foto2'=>$new_name2,
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

}
