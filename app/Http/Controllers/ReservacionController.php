<?php

namespace App\Http\Controllers;

use App\Alquiler;
use App\Empleado;
use App\EmpleadoSucursal;
use App\Reservacion;
use Illuminate\Http\Request;
use App\Cliente;
use App\Vehiculo;
use PDF;
use mpdf;
use App;
use DB;
use App\VehiculoSucursales;
use App\traslado_temp;

use App\Sucursal;


class ReservacionController extends Controller
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

            $reservaciones = Alquiler::
            join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
            join('clientes','idCliente','=','reservacions.id_cliente')->
            join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
            join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->
            where('vehiculosucursales.sucursal','=',$sucursale->sucursal)->
            where('vehiculosucursales.status','=','disponible')->get();

            return view('gerente.reservaciones.inicio', compact ('reservaciones'));

        }

        $reservaciones = Alquiler::  
        join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
        join('clientes','idCliente','=','reservacions.id_cliente')->
        join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
        join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->get();

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
        //return response()->json($reservacion);
        //    
        $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
        //return response()->json($cliente);
        $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
        //return response()->json($alquiler);
        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();
        $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
        $edad = $carbon->parse( $newDate)->age; // 1990-10-25
        //dump($edad);
        //$reservacion = Reservacion::where('id','=',$id)->first();
    ///return (response()->json([$cliente, $reservacion, $alquiler, $vehiculo]));

        
        $sucur = VehiculoSucursales::where('vehiculo','=',$alquiler->id_vehiculo)->first();
        $sucursal = $sucur->sucursal;
        $fecha_i = $alquiler->fecha_recogida;
        $fecha_f = $alquiler->fecha_devolucion;
        $disponibles = DB::select('SELECT * FROM vehiculos 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculos.idvehiculo NOT IN (
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        UNION
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculos.tipo = ?
        AND vehiculosucursales.status ="ACTIVO"
        AND  alquilers.fecha_recogida <= ?
        AND alquilers.fecha_devolucion >= ?);',[$sucursal,$sucursal,$fecha_i,$fecha_f,$sucursal,$vehiculo->tipo, $fecha_i,$fecha_f]);


        $pagos = App\Pago_reservacion::where('id_reserva','=',$reservacion->id)->get();

        $servicios = App\alquilerserviciosextra::where('alquiler','=',$alquiler->id)->
        join('serviciosextras','idserviciosextra','=','alquilerserviciosextras.servicioExtra')->get();

        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles','pagos','servicios'));
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

        $alquiler->estatus = 'cancelado';
        $alquiler->save();

        return back()->with('message','Operation Successful !');

        $sucur = VehiculoSucursales::where('vehiculo','=',$alquiler->id_vehiculo)->first();
        $sucursal = $sucur->sucursal;
        $fecha_i = $alquiler->fecha_recogida;
        $fecha_f = $alquiler->fecha_devolucion;
        $disponibles = DB::select('SELECT * FROM vehiculos 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.idvehiculo NOT IN (
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        UNION
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
         AND  alquilers.fecha_recogida <= ?
        AND alquilers.fecha_devolucion >= ?);',[$sucursal,$sucursal,$fecha_i,$fecha_f,$sucursal,$fecha_i,$fecha_f]);


        $pagos = App\Pago_reservacion::where('reservacion','=',$reservacion->id)->get() ;
        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles','pagos'));


    
        //return response()->json($alquileres);

    }

        /**
     * Display the specified resource.
     *
     * @param  \App\reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function printPDF(reservacion $reservacion)
    {
;
        //return response()->json(date('Y\-m\-d H\:i\:s'));
        //$pdf = PDF::loadView('index', $reservacion);  
        //return $pdf->stream(' contrato.pdf');

       //return response()->json($reservacion);

       $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
       $alquiler->estatus = 'en curso';
       $alquiler->save();

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
    public function pago_Reservacion(request $request)
    {   //return response()->json(date('Y\-m\-d H\:i\:s'));
         $reservacion = Reservacion::where('id','=',$request['reservacion'])->first();
        
        if($request['motivo']=='saldo'){
        $saldoNuevo = $reservacion->saldo - $request['monto'];
        $reservacion->saldo = $saldoNuevo;
        $reservacion->save();

        }  
        
        $carbon = new \Carbon\Carbon();
        
        $pago = new App\Pago_reservacion;
        $pago->total = $request['monto'];
        $pago->fecha =date('Y\-m\-d H\:i\:s');
        //return response()->json($pago);
        $pago->mostrador_Datos = $request['datos'];
        $pago->id_reserva = $reservacion->id;
        $pago->estatus= 'pagado';
        $pago->motivo = $request['motivo'];
        $pago->comentario = $request['comentario'];
        $pago->save();


        return back()->with('message','Operation Successful !');
        
        $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
        $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();

        $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
        $edad = $carbon->parse( $newDate)->age; // 1990-10-25

        $sucur = VehiculoSucursales::where('vehiculo','=',$alquiler->id_vehiculo)->first();
        $sucursal = $sucur->sucursal;
        $fecha_i = $alquiler->fecha_recogida;
         $fecha_f = $alquiler->fecha_devolucion;
        $disponibles = DB::select('SELECT * FROM vehiculos 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND vehiculos.idvehiculo NOT IN (
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        UNION
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND  alquilers.fecha_recogida <= ?
        AND alquilers.fecha_devolucion >= ?);',[$sucursal,$sucursal,$fecha_i,$fecha_f,$sucursal,$fecha_i,$fecha_f]);
    
    //return response()->json($disponibles);

    
    $pagos = App\Pago_reservacion::where('reservacion','=',$reservacion->id)->get() ;

        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles','pagos'));
    }

    public function garantia(Reservacion $reservacion)
    {        
         $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
 
        $servicios = App\alquilerserviciosextra::where('alquiler','=',$alquiler->id)->
        join('serviciosextras','idserviciosextra','=','alquilerserviciosextras.servicioExtra')->get();
        
        $pagos = App\Pago_reservacion::where('reservacion','=',$reservacion->id)->get() ;;

        $carbon = new \Carbon\Carbon();


    
        $pago = new App\Pago_reservacion;
        $pago->total = $reservacion->saldo;
        $pago->fecha =date('Y\-m\-d H\:i\:s');
        //return response()->json($pago);
        $pago->paypal_Datos = '---';
        $pago->mostrador_Datos = '---';
        $pago->garantia_Datos = 'si';
        $pago->id_reserva = $reservacion->id;
        $pago->reservacion = $reservacion->id;
        $pago->estatus= 'pagado';
        $pago->save();
        return back()->with('message','Operation Successful !');

        $reservacion->saldo = '0';
        $reservacion->save();


        
        $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
        $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();

        $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
        $edad = $carbon->parse( $newDate)->age; // 1990-10-25

        $sucur = VehiculoSucursales::where('vehiculo','=',$alquiler->id_vehiculo)->first();
        $sucursal = $sucur->sucursal;
        $fecha_i = $alquiler->fecha_recogida;
        $fecha_f = $alquiler->fecha_devolucion;
        $disponibles = DB::select('SELECT * FROM vehiculos 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND vehiculos.idvehiculo NOT IN (
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        UNION
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND  alquilers.fecha_recogida <= ?
        AND alquilers.fecha_devolucion >= ?);',[$sucursal,$sucursal,$fecha_i,$fecha_f,$sucursal,$fecha_i,$fecha_f]);
    
    //return response()->json($disponibles);

        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles'));
    }

                /**
     * Display the specified resource.
     *
     * @param  \App\reservacion  $reservacion
     * @return \Illuminate\Http\Response
     */
    public function cambia_Vehiculo(Request $Request)
    {  
        
        $carbon = new \Carbon\Carbon();
        $reservacion = Reservacion::where('id','=',$Request['reservacion'])->first();

        
        $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
        $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();


        $vehiculo_cambio = Vehiculo::where('idvehiculo','=',$Request['vehiculo'])->first();
        //return (response()->json([$cliente, $reservacion, $alquiler, $vehiculo, $vehiculo_cambio]));
        $vehiculo->estatus = 'verificar';
        $vehiculo->save();

        $alquiler->id_vehiculo = $vehiculo_cambio->idvehiculo;
         $alquiler->save();

         return back()->with('message','Operation Successful !');

         $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();

        $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
        $edad = $carbon->parse( $newDate)->age; // 1990-10-25
        //dump($edad);
        //$reservacion = Reservacion::where('id','=',$id)->first();
        //return (response()->json([$cliente, $reservacion, $alquiler, $vehiculo]));
  

        $sucur = VehiculoSucursales::where('vehiculo','=',$alquiler->id_vehiculo)->first();
        $sucursal = $sucur->sucursal;
        $fecha_i = $alquiler->fecha_recogida;
        $fecha_f = $alquiler->fecha_devolucion;
        $disponibles = DB::select('SELECT * FROM vehiculos 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND vehiculos.idvehiculo NOT IN (
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
        UNION
        SELECT vehiculos.idvehiculo FROM vehiculos  
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
        INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
        WHERE vehiculosucursales.sucursal=?
        AND vehiculos.estatus ="disponible"
        AND vehiculosucursales.status ="ACTIVO"
        AND  alquilers.fecha_recogida <= ?
        AND alquilers.fecha_devolucion >= ?);',[$sucursal,$sucursal,$fecha_i,$fecha_f,$sucursal,$fecha_i,$fecha_f]);
    
    //return response()->json($disponibles);

        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles'));


        $valor = $Request->get("select2");
        //return response()->json($Request['user_id']);
        return response()->json($Request);


    }

    public function registra_conductor(Request $request){
   
           
        
            $alquiler = Alquiler::where('id','=',$request['alquiler'])->first();

            $alquiler->num_licencia = $request['numero'];
            $alquiler->nombreConductor = $request['nombre'];
            $alquiler->expedicion_licencia = $request['fecha_e'];
            $alquiler->expiracion_licencia = $request['fecha_c'];
            $alquiler->save();
            return back()->with('message','Operation Successful !');
            $carbon = new \Carbon\Carbon();
            //return response()->json($reservacion);
            $reservacion = Reservacion::where('id','=',$request['reservacion']);
            //    
            $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
            //return response()->json($cliente);
            $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
            //return response()->json($alquiler);
            $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();
            $newDate = date("Y\-m\-d", strtotime($cliente->fecha_nacimiento));
            $edad = $carbon->parse( $newDate)->age; // 1990-10-25
            //dump($edad);
            //$reservacion = Reservacion::where('id','=',$id)->first();
        ///return (response()->json([$cliente, $reservacion, $alquiler, $vehiculo]));    
            
            $sucur = VehiculoSucursales::where('vehiculo','=',$alquiler->id_vehiculo)->first();
            $sucursal = $sucur->sucursal;
            $fecha_i = $alquiler->fecha_recogida;
            $fecha_f = $alquiler->fecha_devolucion;
            $disponibles = DB::select('SELECT * FROM vehiculos 
            INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
            WHERE vehiculosucursales.sucursal=?
            AND vehiculos.idvehiculo NOT IN (
            SELECT vehiculos.idvehiculo FROM vehiculos  
            INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
            INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
            WHERE vehiculosucursales.sucursal=?
            AND vehiculos.estatus ="disponible"
            AND vehiculosucursales.status ="ACTIVO"
            AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
            OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
            UNION
            SELECT vehiculos.idvehiculo FROM vehiculos  
            INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
            INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
            WHERE vehiculosucursales.sucursal=?
            AND vehiculos.estatus ="disponible"
            AND vehiculosucursales.status ="ACTIVO"
            AND  alquilers.fecha_recogida <= ?
            AND alquilers.fecha_devolucion >= ?);',[$sucursal,$sucursal,$fecha_i,$fecha_f,$sucursal,$fecha_i,$fecha_f]);
    
    
            $pagos = App\Pago_reservacion::where('reservacion','=',$reservacion->id)->get();
    
            $servicios = App\alquilerserviciosextra::where('alquiler','=',$alquiler->id)->
            join('serviciosextras','idserviciosextra','=','alquilerserviciosextras.servicioExtra')->get();
    
            return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles','pagos','servicios'));

          return response()->json($alquiler);
    }
 
    public function recibe_vehiculo(Request $request){
        $alquiler = Alquiler::where('id','=',$request['alquiler'])->first();
        $alquiler->estatus = 'terminado';
        $alquiler->save();

   
        $reservacion = Reservacion::where('id','=',$alquiler->id_reservacion)->first();
        $reservacion->comentarios = $request['comentario'];
        $reservacion->save();

        $vehiculo = Vehiculo::where('idvehiculo','=',$alquiler->id_vehiculo)->first();
        $vehiculo->kilometraje = $request['km'];
        $vehiculo->save();

        return back()->with('message','Operation Successful !');


    }

    public function fechaRecogida(Request $request)
    {  
        if(!$request->user()->hasRole('gerente')){
            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

            $reservaciones = Alquiler::
            join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
            join('clientes','idCliente','=','reservacions.id_cliente')->
            join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
            join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->
            where('vehiculosucursales.sucursal','=',$sucursale->sucursal)->
            where('vehiculosucursales.status','=','ACTIVO')->
            where('alquilers.fecha_recogida','=',$request['fecha_e'])->
            orderby('alquilers.fecha_recogida')->get();
           // return response()->json($reservaciones);
            return view('gerente.reservaciones.inicio', compact ('reservaciones'));

            //return response()->json($reservaciones);
        }
        
        $reservaciones = Alquiler::join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
        join('clientes','idCliente','=','id_cliente')->
        join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->
        where('alquilers.fecha_recogida','=',$request['fecha_e'])->get();

        return view('gerente.reservaciones.inicio', compact ('reservaciones'));

        
    }

    
    public function cliente(Request $request)
    {  
        if(!$request->user()->hasRole('gerente')){
            $email = $request->user()->email;
            $empleado = Empleado::where('correo','=',$email)->first();
            $sucursale = EmpleadoSucursal::where('empleado','=',$empleado->idempleado)
            ->where('status','=','activo')->first();
            $sucursals=Sucursal::where('idsucursal','=',$sucursale->sucursal)->get();

            $reservaciones = Alquiler::
            join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
            join('clientes','idCliente','=','reservacions.id_cliente')->
            join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
            join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->
            where('vehiculosucursales.sucursal','=',$sucursale->sucursal)->
            where('vehiculosucursales.status','=','ACTIVO')->
            where('clientes.nombre','=',$request['nombre'])->
            where('clientes.primer_apellido','=',$request['apellido'])->
            where('clientes.fecha_nacimiento','=',$request['nac'])->
            orderby('alquilers.fecha_recogida')->get();
           // return response()->json($reservaciones);
            return view('gerente.reservaciones.inicio', compact ('reservaciones'));

            //return response()->json($reservaciones);
        }
        
        
        $reservaciones = Alquiler::join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
        join('clientes','idCliente','=','id_cliente')->
        join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->
        where('clientes.nombre','=',$request['nombre'])->
        orWhere('clientes.primer_apellido','=',$request['apellido'])->
        orWhere('clientes.fecha_nacimiento','=',$request['nac'])->get();

        //return response()->json($reservaciones);

        return view('gerente.reservaciones.inicio', compact ('reservaciones'));

        
    }

    public function vehiculo(Request $request)
    { 

     
          $reservaciones = Alquiler::
        join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
        join('vehiculos','idvehiculo','=','alquilers.id_vehiculo')->
        join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
        join('clientes','idCliente','=','reservacions.id_cliente')->
        // where('vehiculosucursales.status','=','disponible')->
        where('vehiculos.idvehiculo','=',$request['vehiculo'])->get();
       


        //return response()->json($reservaciones); 

        return view('gerente.reservaciones.inicio', compact ('reservaciones'));

        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTraslado(request $request)
    {
        //return response()->json($request);
        $traslados = traslado_temp::get();

        return view('gerente.reservaciones.inicioTraslado', compact ('traslados'));
    }


    }
