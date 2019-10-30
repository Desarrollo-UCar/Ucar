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
use DateTime;
use App\Sucursal;
use Illuminate\Foundation\Console\Presets\Bootstrap;
use PhpOffice\PhpWord\TemplateProcessor;
use App\reintegros;
use Mail;


use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

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
    //----------------------------------------------!MODIFICACION¡
    $devolucion = new DateTime($fecha_f);
    $salida     = new DateTime($fecha_i);
    $diferencia = $salida->diff($devolucion);
    $dias = $diferencia->format('%a');

    $fecha_ii = $fecha_i;
    $fecha_ff = $fecha_f;

    if($dias > 1){
       $fecha_ii = date("Y-m-d",strtotime($fecha_i."+ 1 day"));//fecha de inicio dentro del rango
       $fecha_ff = date("Y-m-d",strtotime($fecha_f."- 1 day"));//fecha de fin dentro del rango
       //return $fecha_ii;
    }

    $hora_r =new DateTime($alquiler->hora_recogida);
    $hora_r->modify('-1 hours');
    $hora_r->format('H:i:s');

    $hora_d =new DateTime($alquiler->hora_devolucion);
    $hora_d->modify('+1 hours');
    $hora_d->format('H:i:s');

    $hora_dd = (string)$hora_d->format('H:i:s');//conversion de horas
    $hora_rr = (string)$hora_r->format('H:i:s');
    //return $hora_dd;

    $disponibles = DB::select('SELECT * FROM vehiculos 
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculos.idvehiculo NOT IN (
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND (? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
    OR ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion)
    UNION
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND  alquilers.fecha_recogida >= ?
    AND alquilers.fecha_devolucion <= ?
    UNION
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND  alquilers.fecha_devolucion = ?
    AND alquilers.hora_devolucion >= ?
	UNION
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND  alquilers.fecha_recogida = ?
    AND alquilers.hora_recogida <= ?
    UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
    AND  reserva_temps.estatus != "cancelada"
    AND ( ? BETWEEN reserva_temps.fecha_recogida AND reserva_temps.fecha_devolucion
    OR ? BETWEEN reserva_temps.fecha_recogida AND reserva_temps.fecha_devolucion)
    UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
   AND reserva_temps.estatus != "cancelada"
    AND  reserva_temps.fecha_recogida >= ?
    AND reserva_temps.fecha_devolucion <= ?
    UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
   AND reserva_temps.estatus != "cancelada"
    AND  reserva_temps.fecha_devolucion = ?
    AND reserva_temps.hora_devolucion >= ?
	UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
   AND reserva_temps.estatus != "cancelada"
    AND  reserva_temps.fecha_recogida = ?
    AND reserva_temps.hora_recogida <= ?)ORDER BY vehiculos.precio,vehiculos.marca, vehiculos.modelo',
                                        [$sucursal,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_i,$hora_rr,$sucursal,$fecha_f,$hora_dd,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff]);


                                        // return $vehiculos_disp;
    //-------------------------------------------------!FIN MODIFICACION¡


        $pagos = App\Pago_reservacion::where('id_reserva','=',$reservacion->id)->get();

        $reembolsos = App\reintegros::where('id_reserva','=',$reservacion->id)->get();

        $servicios = App\alquilerserviciosextra::where('alquiler','=',$alquiler->id)->
        join('serviciosextras','idserviciosextra','=','alquilerserviciosextras.servicioExtra')->get();

        return view ('gerente.reservaciones.detalle', compact('cliente', 'reservacion', 'alquiler', 'vehiculo','edad','disponibles','pagos','servicios','reembolsos'));
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

        //return response()->json(date('Y\-m\-d H\:i\:s'));
        //$pdf = PDF::loadView('index', $reservacion);  
        //return $pdf->stream(' contrato.pdf');

       //return response()->json($reservacion);

       $alquiler = Alquiler::where('id_reservacion','=',$reservacion->id)->first();
       $alquiler->estatus = 'en curso';
       $alquiler->save();

       $cliente = Cliente::where('idCliente','=',$reservacion->id_cliente)->first();
       $vehiculo = Vehiculo::where('idVehiculo','=',$alquiler->id_vehiculo)->first();

//GENERAR WORD
$templateWord = new TemplateProcessor(storage_path('plantillab.docx'));
 
$nombre = $cliente->nombre.' '.$cliente->primer_apellido.' '.$cliente->segundo_apellido;
$direccion = $cliente->ciudad.' '.$cliente->colonia.' '.$cliente->calle.' '.$cliente->numero.'  Estado: '.$cliente->estado.'   Pais: '.$cliente->pais;
$fecha_nacimiento = $cliente->fecha_nacimiento;
$telefono = $cliente->telefono;
$correo = $cliente->correo;
$licencia = $alquiler->num_licencia;
$reservacion = $alquiler->id_reservacion;


// --- Asignamos valores a la plantilla
$templateWord->setValue('Reservacion',$reservacion);
$templateWord->setValue('nombre',$nombre);
$templateWord->setValue('direccion',$direccion);
$templateWord->setValue('correo',$correo);
$templateWord->setValue('licencia',$licencia);
// $templateWord->setValue('cp_empresa',$cp);
$templateWord->setValue('tel',$telefono);
$templateWord->setValue('fecha_nacimiento',$fecha_nacimiento);
//DATOS DEL ALQUILER
$templateWord->setValue('entrega',$alquiler->fecha_recogida);
$templateWord->setValue('hora_entrega',$alquiler->hora_recogida);
$templateWord->setValue('devolucion',$alquiler->fecha_devolucion);
$templateWord->setValue('hora_devolucion',$alquiler->hora_devolucion);
//DATOS DEL VEHICULO
$templateWord->setValue('vin',$vehiculo->vin);
$templateWord->setValue('tipo',$vehiculo->tipo);
$templateWord->setValue('matricula',$vehiculo->matricula);
$templateWord->setValue('modelo',$vehiculo->modelo.' ',$vehiculo->anio);
$templateWord->setValue('marca',$vehiculo->marca);
$templateWord->setValue('color',$vehiculo->color);
$templateWord->setValue('casado','X');
$templateWord->setValue('divorciado',' ');


$templateWord->saveAs(storage_path('Documento01.docx'));

Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
// Any writable directory here. It will be ignored.
Settings::setPdfRendererPath('.');

$phpWord = IOFactory::load(storage_path('Documento01.docx'), 'Word2007');
$phpWord->save(storage_path('result.pdf'), 'PDF');

return response()->download(storage_path('Documento01.docx'));

//FIN GENERAR WORD

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
    public function reembolso_Reservacion(request $request){
        $reservacion = Reservacion::where('id','=',$request['reservacion'])->first();
        $carbon = new \Carbon\Carbon();
        
        $reintegro = new reintegros;
        $reintegro->total = $request['monto'];
        $reintegro->fecha =date('Y\-m\-d H\:i\:s');
        //return response()->json($pago);
        $reintegro->mostrador_Datos = $request['datos'];
        $reintegro->id_reserva = $reservacion->id;
        $reintegro->estatus= 'pagado';
        $reintegro->motivo = $request['motivo'];
        $reintegro->comentario = $request['comentario'];
        $reintegro->save();

        return back()->with('message','Operation Successful !');

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
       // return $request;
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
        $pago->metodo = $request['metodo'];
        $pago->save();

               //enviar mensaje de un nuevo pago realizado
               $pago_reserva = $pago;
               $alquiler = App\Alquiler::findOrFail($reservacion->id);
               $sucursal = App\Sucursal::findOrFail($alquiler->lugar_recogida);
               $asunto   = 'pago por {{pago_reserva->motivo}} Ü-CAR';
               $cliente  = App\cliente::findOrFail($reservacion->id_cliente);
               $correo = $cliente->correo; 
               Mail::send('mails.confirmacion_pago',compact('reservacion','pago_reserva','sucursal'), function ($message) use ($asunto,$correo,$reservacion) {
                   $message->from('ucardesarollo@gmail.com', 'Ü-car');
                   $message->to($correo)->subject($asunto);
                   }); 


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

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
       $request->validate([
            'reservacion'=>'required',
            'alquiler'=>'required',
            'numero'=>'required',
            'nombre'=>'required',
            'fecha_e'=>'required|date',
            'fecha_c'=>'required|date',
        ]);
        
        if($request['fecha_e']>=$request['fecha_c']){
            return response()->json(['success'=>'FECHAS']); 
        }   

            $alquiler = Alquiler::where('id','=',$request['alquiler'])->first();

            $alquiler->num_licencia = $request['numero'];
            $alquiler->nombreConductor = $request['nombre'];
            $alquiler->expedicion_licencia = $request['fecha_e'];
            $alquiler->expiracion_licencia = $request['fecha_c'];
            $alquiler->save();
            return response()->json(['success'=>'EXITO']);          
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
        //enviar correo al cliente cuando entrega el cehiculo
        $asunto = 'Confirmacion de pago reserva Ü-CAR';
        $sucursal = App\Sucursal::findOrFail($alquiler->lugar_recogida);
        $cliente  = App\cliente::findOrFail($reservacion->id_cliente);
        $correo = $cliente->correo; 
        setlocale(LC_ALL,"es_ES");
        $fecha = date("d-m-y",strtotime(date("Y-m-d")));
        $hora = date("h:m:s",strtotime(date("h-m-s")));
                Mail::send('mails.llegada_de_vehiculo',compact('reservacion','sucursal','fecha','hora'), function ($message) use ($asunto,$correo,$reservacion) {
                    $message->from('ucardesarollo@gmail.com', 'Ü-car');
                    $message->to($correo)->subject($asunto);
                    }); 

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


    public function indexAndroid(request $request)
     {
        //return response()->json($request);

        $reservaciones = Alquiler::  
        join('reservacions','reservacions.id','=','alquilers.id_reservacion')->
        join('clientes','idCliente','=','reservacions.id_cliente')->
        join('vehiculosucursales','vehiculosucursales.vehiculo','=','alquilers.id_vehiculo')->
        join('vehiculos','vehiculos.idvehiculo','=','alquilers.id_vehiculo')->get();

        return $reservaciones;//view('gerente.reservaciones.inicio', compact ('reservaciones'));
        }
    }
