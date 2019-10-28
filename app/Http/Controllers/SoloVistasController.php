<?php
namespace App\Http\Controllers;
use App;
use DB;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SoloVistasController extends Controller{
    public function sucursal_info(Request $request){
        $idsucursal = $request->idsucursal; 
        $sucursal = App\Sucursal::where('idsucursal','=',$idsucursal)->first();
        //$sucursal = App\Sucursal::findOrFail($id); 
        $sucursales = App\Sucursal::all();
        //return $sucursales;
        //return $sucursal;
        return view('sucursal_informacion',compact('sucursales','sucursal'));
    }
public function vista_generar_cotizacion_traslado(){
    $solicitud_traslado = App\traslado_temp::findOrFail(31);
    return view('generar_cotizacion_traslado',compact('solicitud_traslado'));
}
public function reservacion(){   
    $sucursales = App\Sucursal::all();
    return view('reservacion',compact('sucursales'));}

public function servicios(){ 
    //---------VEHICULO MAS RENTADO EN EL MES ANTERIOR
        $anio = date("Y",strtotime(date("Y-m-d")."- 1 month"));
        $mes = date("m",strtotime(date("Y-m-d")."- 1 month"));

        $consulta_popular= DB::select('SELECT vehiculos.idvehiculo,
        COUNT(*) as cantidad FROM alquilers 
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo
        WHERE YEAR(alquilers.fecha_recogida) = ?
        AND MONTH(alquilers.fecha_recogida) = ?
        GROUP BY id_vehiculo ORDER BY cantidad DESC LIMIT ?',[$anio,$mes,1]);

        try{
            $idpopular = $consulta_popular['0']->idvehiculo;
        }catch (\Exception $ex) {
            $idpopular = 1;
        }
        
        $popular = app\Vehiculo::where('idvehiculo','=',$idpopular)->get();
        $sucursales = App\Sucursal::all();
    //return $popular;
    setlocale(LC_TIME, 'es_ES');
    $fecha = DateTime::createFromFormat('!m', $mes);
    $mes = strftime("%B", $fecha->getTimestamp());
    return view('servicios',compact('sucursales','popular','anio','mes'));
}

public function renta_traslado(){
    $estado = "inicio";
    $sucursales = App\Sucursal::all();
       return view('renta_traslado', compact('estado','sucursales'));
    }
public function renta_flotilla(){  
    $sucursales = App\Sucursal::all();
     return view('renta_flotilla',compact('sucursales'));}
public function en_construccion(){ 
    $sucursales = App\Sucursal::all(); 
    return view('en_construccion',compact('sucursales'));}
public function bienvenida(){
    $sucursales = App\Sucursal::all();
    return view('bienvenida',compact('sucursales'));}




    //impresion de correos electronicos
    public function correo_salida_vehiculo(){
        $reservacion = DB::select('SELECT reservacions.id, alquilers.id AS id_alquiler, reservacions.fecha_reservacion, reservacions.total,
                reservacions.saldo, sucursals.nombre, alquilers.fecha_recogida,alquilers.fecha_devolucion, alquilers.hora_recogida, alquilers.hora_devolucion,
                IF (DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida) = 0,1,DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida)) AS dias,
                vehiculos.marca, vehiculos.modelo,vehiculos.transmicion,vehiculos.puertas,vehiculos.rendimiento,vehiculos.anio,vehiculos.kilometraje,
                vehiculos.precio,vehiculos.pasajeros,vehiculos.maletero,vehiculos.color,vehiculos.cilindros,vehiculos.tipo, vehiculos.descripcion,vehiculos.foto
                FROM reservacions
                INNER join alquilers ON alquilers.id_reservacion = reservacions.id 
                inner join vehiculos ON vehiculos.idvehiculo		 = alquilers.id_vehiculo 
                inner join sucursals ON sucursals.idsucursal		 = alquilers.lugar_recogida
                INNER JOIN pago_reservacions ON pago_reservacions.id_reserva	= reservacions.id
                where reservacions.id = ?',[1]);
     //return $reservacion;
        $sucursal = App\Sucursal::findOrFail(1);
        //return $reservacion;   
        return view('mails.salida_de_vehiculo',compact('reservacion','sucursal'));
        }
    public function correo_llegada_vehiculo(){
            $reservacion = DB::select('SELECT reservacions.id, alquilers.id AS id_alquiler, reservacions.fecha_reservacion, reservacions.total,
                    reservacions.saldo, sucursals.nombre, alquilers.fecha_recogida,alquilers.fecha_devolucion, alquilers.hora_recogida, alquilers.hora_devolucion,
                    IF (DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida) = 0,1,DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida)) AS dias,
                    vehiculos.marca, vehiculos.modelo,vehiculos.transmicion,vehiculos.puertas,vehiculos.rendimiento,vehiculos.anio,vehiculos.kilometraje,
                    vehiculos.precio,vehiculos.pasajeros,vehiculos.maletero,vehiculos.color,vehiculos.cilindros,vehiculos.tipo, vehiculos.descripcion,vehiculos.foto
                    FROM reservacions
                    INNER join alquilers ON alquilers.id_reservacion = reservacions.id 
                    inner join vehiculos ON vehiculos.idvehiculo		 = alquilers.id_vehiculo 
                    inner join sucursals ON sucursals.idsucursal		 = alquilers.lugar_recogida
                    INNER JOIN pago_reservacions ON pago_reservacions.id_reserva	= reservacions.id
                    where reservacions.id = ?',[1]);
         //return $reservacion;
         setlocale(LC_ALL,"es_ES");
         $fecha = date("d-m-y",strtotime(date("Y-m-d")));
         $hora = date("h:m:s",strtotime(date("h-m-s")));
            $sucursal = App\Sucursal::findOrFail(1);
            //return $reservacion;   
            return view('mails.llegada_de_vehiculo',compact('reservacion','sucursal','fecha','hora'));
            }
    public function correo_confirmacion_pago(){
    $reservacion = DB::select('SELECT reservacions.id, alquilers.id AS id_alquiler, reservacions.fecha_reservacion, reservacions.total,
            reservacions.saldo, sucursals.nombre, alquilers.fecha_recogida,alquilers.fecha_devolucion, alquilers.hora_recogida, alquilers.hora_devolucion,
            IF (DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida) = 0,1,DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida)) AS dias,
            vehiculos.marca, vehiculos.modelo,vehiculos.transmicion,vehiculos.puertas,vehiculos.rendimiento,vehiculos.anio,
            vehiculos.precio,vehiculos.pasajeros,vehiculos.maletero,vehiculos.color,vehiculos.cilindros,vehiculos.tipo, vehiculos.descripcion,vehiculos.foto
            FROM reservacions
            INNER join alquilers ON alquilers.id_reservacion = reservacions.id 
            inner join vehiculos ON vehiculos.idvehiculo		 = alquilers.id_vehiculo 
            inner join sucursals ON sucursals.idsucursal		 = alquilers.lugar_recogida
            INNER JOIN pago_reservacions ON pago_reservacions.id_reserva	= reservacions.id
            where reservacions.id = ?',[1]);
 //return $reservacion;
    $pago_reserva = App\Pago_reservacion::findOrFail(1);
    $sucursal = App\Sucursal::findOrFail(1);
    //return $reservacion;   
    return view('mails.confirmacion_pago',compact('reservacion','pago_reserva','sucursal'));
    }
    public function disenio_reserva_finalizada(){
        $sucursales = App\Sucursal::all();
        $correo   = auth()->user()->email;
        $cliente= App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
        $vehiculo       = App\Vehiculo::findOrFail(2);
        //return $reservacion;   
        return view('reservacion_exitosa',compact('sucursales','cliente','vehiculo'));
        }
}

