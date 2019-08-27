<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cliente;
Use App\Reservacion;

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
        return $request;
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
       
        //
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
}
