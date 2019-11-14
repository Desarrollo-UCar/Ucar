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

use App\Http\Controllers\Controller;
use App\tallerservicios;

class ReportesController extends Controller{

    public function index(){
        $serviciost = tallerservicios::orderby ('nombreservicio', 'asc')->get();
        return view('gerente.reportes.inicio', compact('serviciost'));
    }
    //
public function fechaReservacion(){
        //reservaciones por anio
    $reservaciones_anio = DB::select(
        'SELECT (YEAR(fecha_reservacion)) AS anio, COUNT(*) AS total
         FROM reservacions
        GROUP BY (YEAR(fecha_reservacion)) ORDER BY (YEAR(fecha_reservacion)) ASC
        LIMIT ?',[4]);
       //return response()->json($reservaciones_anio);
        //configuracion de idioma
   DB::select('SET lc_time_names = "es_MX";');
   //reservaciones por mes
    $reservaciones_mes = DB::select( 
        'SELECT   MONTHNAME(CONCAT("0000-",meses.mes,"-00")) mes,meses.CANTIDAD as cantidad
            FROM( SELECT MONTH(fecha_reservacion) AS mes, COUNT(*) AS CANTIDAD
                FROM reservacions 
                    WHERE YEAR(fecha_reservacion) = ?
            GROUP BY MONTH(fecha_reservacion)
        )meses;',[date('Y')]);
   //return response()->json($reservaciones_mes);
        $dias = DB::SELECT('SELECT DAY(DIA) AS DIA, CANTIDAD FROM (SELECT (date(fecha_reservacion)) AS DIA, COUNT(*) AS CANTIDAD
        FROM reservacions
        WHERE fecha_reservacion  <= CURDATE() 
        AND fecha_reservacion >= DATE_SUB(CURDATE(), INTERVAL ? WEEK) GROUP BY date(fecha_reservacion))tabla',[1]);
        //return response()->json($dias);

        return view('gerente.reportes.fechaReservacion', compact('reservaciones_anio','reservaciones_mes','dias'));
}

public function fechaAlquiler(){
      //reservaciones por anio
      $reservaciones_anio = DB::select(
        'SELECT (YEAR(fecha_recogida)) AS anio, COUNT(*) AS total
         FROM alquilers
        GROUP BY (YEAR(fecha_recogida)) ORDER BY (YEAR(fecha_recogida)) ASC
        LIMIT ?',[4]);
       //return response()->json($reservaciones_anio);

        //configuracion de idioma
   DB::select('SET lc_time_names = "es_MX";');

   //reservaciones por mes
    $reservaciones_mes = DB::select( 
        'SELECT   MONTHNAME(CONCAT("0000-",meses.mes,"-00")) mes,meses.CANTIDAD as cantidad
            FROM( SELECT MONTH(fecha_recogida) AS mes, COUNT(*) AS CANTIDAD
                FROM alquilers 
                    WHERE YEAR(fecha_recogida) = ?
            GROUP BY MONTH(fecha_recogida)
        )meses;',[date('Y')]);
   //return response()->json($reservaciones_mes);
        $dias = DB::SELECT('SELECT (DAY(fecha_recogida)) AS DIA, COUNT(*) AS CANTIDAD
        FROM alquilers
        WHERE fecha_recogida  <= CURDATE() 
        AND fecha_recogida >= DATE_SUB(CURDATE(), INTERVAL ? WEEK) GROUP BY (fecha_recogida)',[1]);
        //return response()->json($dias);
        return view('gerente.reportes.fechaAlquiler', compact('reservaciones_anio','reservaciones_mes','dias'));
}


public function fechaCobro(){
    //reservaciones por anio
    $reservaciones_anio = DB::select(
      'SELECT (YEAR(fecha)) AS anio, sum(total) AS total
       FROM pago_reservacions
      GROUP BY (YEAR(fecha)) ORDER BY (YEAR(fecha)) ASC
      LIMIT ?',[4]);
     //return response()->json($reservaciones_anio);

      //configuracion de idioma
 DB::select('SET lc_time_names = "es_MX";');

 //reservaciones por mes
  $reservaciones_mes = DB::select( 
      'SELECT   MONTHNAME(CONCAT("0000-",meses.mes,"-00")) mes,meses.CANTIDAD as cantidad
          FROM( SELECT MONTH(fecha) AS mes, sum(total) AS CANTIDAD
              FROM pago_reservacions
                  WHERE YEAR(fecha) = ?
          GROUP BY MONTH(fecha)
      )meses;',[date('Y')]);
 //return response()->json($reservaciones_mes);
         $dias = DB::SELECT('      SELECT DAY(DIA) AS DIA, CANTIDAD FROM (SELECT (date(fecha)) AS DIA, sum(total)     AS CANTIDAD
                FROM pago_reservacions
                 WHERE fecha  <= CURDATE() 
            AND fecha >= DATE_SUB(CURDATE(), INTERVAL ? WEEK) GROUP BY date(fecha))tabla',[1]);
      return view('gerente.reportes.fechaPago', compact('reservaciones_anio','reservaciones_mes','dias'));
}
    

public function mantenimientos(Request $request){
    return $request;
    //consultas para mantenimientos
    if($request['fecha_inicio']==null&&$request['fecha_fin']==null&&$request['servicio']=='ninguno'){
        $titulo   = 'MANTENIMIENTOS POR VEHICULO (GENERAL)';
        $x        = 'matricula';
        $y        = 'cantidad';
        $etiqueta = 'Mantenimientos';
        $datos = DB::SELECT('SELECT  vehiculos.modelo ,vehiculos.matricula,
        COUNT(*) AS cantidad FROM mantenimientos
        INNER JOIN vehiculos ON mantenimientos.vehiculo = vehiculos.idvehiculo
        GROUP BY mantenimientos.vehiculo');
        return view('gerente.reportes.mantenimientos',compact('datos','titulo','x','y','etiqueta'));
    }

    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['servicio']=='ninguno'){
        $titulo = 'MANTENIMIENTOS POR VEHICULO '. '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Mantenimientos';
        $datos = DB::SELECT('SELECT  vehiculos.modelo ,vehiculos.matricula,
        COUNT(*) AS cantidad FROM mantenimientos
        INNER JOIN vehiculos ON mantenimientos.vehiculo = vehiculos.idvehiculo
        WHERE mantenimientos.fecha_salida BETWEEN ? AND ?
        GROUP BY mantenimientos.vehiculo',[$request['fecha_inicio'],$request['fecha_fin']]);
        return view('gerente.reportes.mantenimientos',compact('datos','titulo','x','y','etiqueta'));
    }

    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['servicio']!='ninguno'){
        $titulo = 'MANTENIMIENTOS POR VEHICULO '. '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Mantenimientos';
        $datos = DB::SELECT('SELECT matricula, marca, modelo, anio, nombreservicio, cantidad FROM (SELECT mantenimientos.vehiculo, detalletallerservicios.tallerservicio,
        COUNT(*) as cantidad FROM detalletallerservicios 
        INNER JOIN tallerservicios ON detalletallerservicios.idetalletallerservicio = tallerservicios.idserviciotaller
        INNER JOIN mantenimientos ON mantenimientos.idmantenimiento = detalletallerservicios.mantenimiento
        WHERE detalletallerservicios.tallerservicio = ?
        AND mantenimientos.fecha_salida BETWEEN ? AND ?
        GROUP BY mantenimientos.vehiculo, detalletallerservicios.tallerservicio) A
        INNER JOIN vehiculos ON vehiculos.idvehiculo = A.vehiculo
        INNER JOIN tallerservicios ON A.tallerservicio = tallerservicios.idserviciotaller
        ORDER BY cantidad desc',[$request['servicio'],$request['fecha_inicio'],$request['fecha_fin']]);
        return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }

    if($request['fecha_inicio']==null&&$request['fecha_fin']==null&&$request['servicio']!='ninguno'){
        $servicio = tallerservicios::findOrFail($request['servicio']);
        $titulo   = 'MANTENIMIENTOS POR VEHICULO (GENERAL PARA: '. $servicio->nombreservicio. ')';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Mantenimientos';
        $datos = DB::SELECT('SELECT matricula, marca, modelo, anio, nombreservicio, cantidad FROM (SELECT mantenimientos.vehiculo, detalletallerservicios.tallerservicio,
        COUNT(*) as cantidad FROM detalletallerservicios 
        INNER JOIN tallerservicios ON detalletallerservicios.idetalletallerservicio = tallerservicios.idserviciotaller
        INNER JOIN mantenimientos ON mantenimientos.idmantenimiento = detalletallerservicios.mantenimiento
        WHERE detalletallerservicios.tallerservicio = ?
        GROUP BY mantenimientos.vehiculo, detalletallerservicios.tallerservicio) A
        INNER JOIN vehiculos ON vehiculos.idvehiculo = A.vehiculo
        INNER JOIN tallerservicios ON A.tallerservicio = tallerservicios.idserviciotaller
        ORDER BY cantidad desc',[$request['servicio']]);
        return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
//consulta para vehiculos -----------VEEHICULO CON MAS RENTAS Y VEHICULO CON MAS INGRESOS
    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['consulta']==null){
        $titulo   = 'VEHICULOS CON MAS RENTAS (GENERAL)';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Mantenimientos';
        $datos = DB::SELECT('SELECT matricula, marca, modelo, anio, nombreservicio, cantidad FROM (SELECT mantenimientos.vehiculo, detalletallerservicios.tallerservicio,
        COUNT(*) as cantidad FROM detalletallerservicios 
        INNER JOIN tallerservicios ON detalletallerservicios.idetalletallerservicio = tallerservicios.idserviciotaller
        INNER JOIN mantenimientos ON mantenimientos.idmantenimiento = detalletallerservicios.mantenimiento
        WHERE detalletallerservicios.tallerservicio = ?
        GROUP BY mantenimientos.vehiculo, detalletallerservicios.tallerservicio) A
        INNER JOIN vehiculos ON vehiculos.idvehiculo = A.vehiculo
        INNER JOIN tallerservicios ON A.tallerservicio = tallerservicios.idserviciotaller
        ORDER BY cantidad desc',[$request['servicio']]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
        }
        if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['consulta']==null){
            $titulo   = 'VEHICULOS CON MAS RENTAS (GENERAL)';
            $x = 'matricula';
            $y = 'cantidad';
            $etiqueta = 'Mantenimientos';
            $datos = DB::SELECT('SELECT matricula, marca, modelo, anio, nombreservicio, cantidad FROM (SELECT mantenimientos.vehiculo, detalletallerservicios.tallerservicio,
            COUNT(*) as cantidad FROM detalletallerservicios 
            INNER JOIN tallerservicios ON detalletallerservicios.idetalletallerservicio = tallerservicios.idserviciotaller
            INNER JOIN mantenimientos ON mantenimientos.idmantenimiento = detalletallerservicios.mantenimiento
            WHERE detalletallerservicios.tallerservicio = ?
            GROUP BY mantenimientos.vehiculo, detalletallerservicios.tallerservicio) A
            INNER JOIN vehiculos ON vehiculos.idvehiculo = A.vehiculo
            INNER JOIN tallerservicios ON A.tallerservicio = tallerservicios.idserviciotaller
            ORDER BY cantidad desc',[$request['servicio']]);
                return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
            }

}

}
