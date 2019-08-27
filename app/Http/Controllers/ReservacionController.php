<?php

namespace App\Http\Controllers;

use App\Alquiler;
use App\Reservacion;
use Illuminate\Http\Request;
use App\Cliente;
use App\Vehiculo;
use PDF;
use mpdf;
use App;


class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reservaciones = Reservacion::join('clientes','idCliente','=','id_cliente')->get();
        //->select('reservaciones.*','reservaciones.*','reservacion.id')

        //return $reser
       // $reservaciones=Reservacion::orderBy('id','DESC')->paginate(300);
        return view('gerente.reservaciones.inicio', compact ('reservaciones'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function show(Reservacion $reservacion)
    {

        $carbon = new \Carbon\Carbon();

        //    
        $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
        $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();
        $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
        $edad = $carbon->parse( $newDate)->age; // 1990-10-25
        //dump($edad);
        //$reservacion = Reservacion::where('id','=',$id)->first();
        //return (response()->json([$cliente, $reservacion, $alquiler, $vehiculo]));
        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\crear_reservacion  $crear_reservacion
     * @return \Illuminate\Http\Response
     */
    public function edit(crear_reservacion $crear_reservacion)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\crear_reservacion  $crear_reservacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, crear_reservacion $crear_reservacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\crear_reservacion  $crear_reservacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(crear_reservacion $crear_reservacion)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function cancela($idReservacion){

        $carbon = new \Carbon\Carbon();
        
        $reservacion = Reservacion::where('id','=',$idReservacion)->first();

        //$reservacion->estatus = 'cancelada';
        //$reservacion->save();

        //$alquileres = alquiler::where('idReservacion','=',$idReservacion)->paginate(300);

        $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
        $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();

        $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
        $edad = $carbon->parse( $newDate)->age; // 1990-10-25
        dump($newDate);
        $alquiler->estatus = 'cancelado';
        $alquiler->save();


        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo', 'cliente','edad'));
    
        //return response()->json($alquileres);

    }

        /**
     * Display the specified resource.
     *
     * @param  \App\reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function printPDF(Reservacion $reservacion)
    {
        //return response()->json(date('Y\-m\-d H\:i\:s'));
        //$pdf = PDF::loadView('index', $reservacion);  
        //return $pdf->stream(' contrato.pdf');

       //return response()->json($reservacion);

       $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();

       $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();


        //return response()->json($r);
       // This  $data array will be passed to our PDF blade
       $data = [
          'title' => 'Contrato',
          'heading' => 'RENTA DE AUTOS Y SCOOTERS',
          'content' => '',
        'nombre' => $cliente->nombre,
        'ap' => $cliente->primer_apellido,
        'am' => $cliente->segundo_apellido
    ];
    
          
        $pdf = PDF::loadView('pdf_view', $data);  
        return $pdf->stream(' contrato.pdf');
    }

            /**
     * Display the specified resource.
     *
     * @param  \App\reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function pago_Reservacion(Reservacion $reservacion)
    {   //return response()->json(date('Y\-m\-d H\:i\:s'));
        $carbon = new \Carbon\Carbon();
        
        $pago = new App\Pago_reservacion;
        $pago->total = $reservacion->saldo;
        $pago->fecha =date('Y\-m\-d H\:i\:s');
        return response()->json($pago);
        $pago->save();
        $reservacion->estatus = 'pagado';
        $reservacion->saldo = '0';
        $reservacion->save();
    }

    public function garantia(Reservacion $reservacion)
    {  
        $carbon = new \Carbon\Carbon();
    
        $pago = new app\Pago_reservacion;
        $pago->total = '10000';
        $pago->fecha =  $carbon->now();
        $pago->save();
        $reservacion->estatus = 'pagado';
        $reservacion->save();
    }
}
