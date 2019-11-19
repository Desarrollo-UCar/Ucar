<?php
namespace App\Http\Controllers;
use App\Alquiler;
use App\Empleado;
use App\EmpleadoSucursal;
use App\Reservacion;
use Illuminate\Http\Request;
use App\Cliente;
use App\Vehiculo;
use App\Sucursal;
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
        $sucursales = App\Sucursal::all();
        return view('gerente.reportes.inicio', compact('serviciost','sucursales'));
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
}

public function vehiculos(Request $request){
//consulta para vehiculos -----------VEEHICULO CON MAS RENTAS Y VEHICULO CON MAS INGRESOS
    if($request['fecha_inicio']==null&&$request['fecha_fin']==null&&$request['consulta']=='rentas'){
        $titulo   = 'VEHICULOS CON MAS RENTAS (GENERAL)';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Rentas';
        $datos = DB::SELECT('SELECT alquilers.id_vehiculo, vehiculos.matricula, COUNT(*) cantidad FROM alquilers 
        inner join vehiculos ON  alquilers.id_vehiculo = vehiculos.idvehiculo group BY id_vehiculo ORDER BY cantidad DESC');
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['consulta']=='rentas'){
        $titulo = 'VEHICULOS CON MAS RENTAS '. '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Rentas';
        $datos = DB::SELECT('SELECT alquilers.id_vehiculo, vehiculos.matricula, COUNT(*) cantidad FROM alquilers 
        inner join vehiculos ON  alquilers.id_vehiculo = vehiculos.idvehiculo WHERE alquilers.fecha_devolucion 
        BETWEEN ? AND ? group BY id_vehiculo ORDER BY cantidad DESC',[$request['fecha_inicio'],$request['fecha_fin']]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['consulta']=='ingresos'){
        $titulo = 'VEHICULOS CON MAS INGRESOS '. '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'matricula';
        $y = 'cantidad';
        $etiqueta = 'Rentas';
        $datos = DB::SELECT('SELECT matricula, SUM(total) AS total FROM(SELECT id_reserva, SUM(total) as total FROM pago_reservacions GROUP BY id_reserva) a
        INNER JOIN alquilers ON alquilers.id_reservacion = a.id_reserva
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        WHERE alquilers.fecha_devolucion BETWEEN ? AND ?
        GROUP BY idvehiculo ORDER BY total DESC',[$request['fecha_inicio'],$request['fecha_fin']]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['fecha_inicio']==null&&$request['fecha_fin']==null&&$request['consulta']=='ingresos'){
        $titulo   = 'VEHICULOS CON MAS INGRESOS (GENERAL)';
        $x = 'matricula';
        $y = 'total';
        $etiqueta = 'Rentas';
        $datos = DB::SELECT('SELECT matricula, SUM(total) AS total FROM
        (SELECT id_reserva, SUM(total) as total FROM pago_reservacions GROUP BY id_reserva) a
        INNER JOIN alquilers ON alquilers.id_reservacion = a.id_reserva
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        GROUP BY idvehiculo ORDER BY total DESC');
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
}
public function clientes(Request $request){
    //consulta para clientes ------------------CLIENTES QUE SON MAS FRECUENTES EN EL NEGOCIO
    if($request['fecha_inicio']==null&&$request['fecha_fin']==null){
        $titulo   = 'INGRESOS POR CLIENTE (GENERAL)';
        $x = 'correo';
        $y = 'totall';
        $etiqueta = 'Total gastado';
        $datos = DB::SELECT('SELECT correo, SUM(totall) AS totall  FROM
        (SELECT id_reserva, SUM(total) as totall FROM pago_reservacions GROUP BY id_reserva) a
        INNER JOIN alquilers ON alquilers.id_reservacion = a.id_reserva
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        INNER JOIN reservacions ON reservacions.id =  alquilers.id_reservacion
        INNER JOIN clientes ON reservacions.id_cliente = clientes.idCliente
        GROUP BY id_cliente ORDER BY totall DESC');
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null){
        $titulo = 'INGRESOS POR CLIENTE '. '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'correo';
        $y = 'totall';
        $etiqueta = 'Total gastado';
        $datos = DB::SELECT('SELECT correo, SUM(totall) AS totall  FROM
        (SELECT id_reserva, SUM(total) as totall FROM pago_reservacions GROUP BY id_reserva) a
        INNER JOIN alquilers ON alquilers.id_reservacion = a.id_reserva
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        INNER JOIN reservacions ON reservacions.id =  alquilers.id_reservacion
        INNER JOIN clientes ON reservacions.id_cliente = clientes.idCliente
        WHERE alquilers.fecha_devolucion BETWEEN ? AND ?
        GROUP BY id_cliente ORDER BY totall DESC',[$request['fecha_inicio'],$request['fecha_fin']]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
}
public function sucursales(Request $request){
   // return $request;
    //consulta para sucursales ------------------CONSULTAS RELEVANTES SOBRE CADA SUCURSAL
    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['sucursal']!=null&&$request['aniomes']=='año'){
        $titulo   = 'CANTIDAD DE ALQUILERES POR AÑO' . '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'anio';
        $y = 'total';
        $etiqueta = 'Sucursal';
        $sucursal = Sucursal::where('nombre','=',$request['sucursal'])->first();
        $datos = DB::SELECT('SELECT (YEAR(fecha_recogida)) AS anio, COUNT(*) AS total FROM alquilers         
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = alquilers.id_vehiculo
        WHERE alquilers.fecha_devolucion BETWEEN ? AND ? AND vehiculosucursales.sucursal = ?
        GROUP BY (YEAR(fecha_recogida)) ORDER BY (YEAR(fecha_recogida)) ASC LIMIT ?',[$request['fecha_inicio'],$request['fecha_fin'],$sucursal->idsucursal,$request['limite']]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['fecha_inicio']!=null&&$request['fecha_fin']!=null&&$request['sucursal']!=null&&$request['aniomes']=='mes'){
        $titulo   = 'CANTIDAD DE ALQUILERES POR FECHA / POR AÑO' . '(' . date("d-m-Y",strtotime($request['fecha_inicio'])) . ' al ' . date("d-m-Y",strtotime($request['fecha_fin'])) . ')';
        $x = 'mes';
        $y = 'cantidad';
        $etiqueta = 'Sucursal';
        $sucursal = Sucursal::where('nombre','=',$request['sucursal'])->first();
        $datos = DB::SELECT('SELECT   MONTHNAME(CONCAT("0000-",meses.mes,"-00")) mes,meses.CANTIDAD as cantidad
        FROM( SELECT MONTH(fecha_recogida) AS mes, COUNT(*) AS CANTIDAD FROM alquilers 
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = alquilers.id_vehiculo
        WHERE alquilers.fecha_devolucion BETWEEN ? AND ? AND vehiculosucursales.sucursal = ?
        GROUP BY MONTH(fecha_recogida))meses',[$request['fecha_inicio'],$request['fecha_fin'],$sucursal->idsucursal]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['sucursal']!=null&&$request['aniomes']=='semana'){
        $titulo   = 'cantidad de alquileres por dia GENERAL ULTIMA SEMANA';
        $x = 'dia';
        $y = 'cantidad';
        $etiqueta = 'Sucursal';
        $sucursal = Sucursal::where('nombre','=',$request['sucursal'])->first();
        $datos = DB::SELECT('SELECT fecha_recogida AS dia, COUNT(*) AS cantidad FROM alquilers
      	INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = alquilers.id_vehiculo
        WHERE fecha_recogida  <= CURDATE() AND vehiculosucursales.sucursal = ?
        AND fecha_recogida >= DATE_SUB(CURDATE(), INTERVAL ? WEEK) GROUP BY (fecha_recogida)',[$sucursal->idsucursal,1]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
    if($request['fecha_inicio']==null&&$request['fecha_fin']==null&&$request['sucursal']!=null){
        $titulo   = 'CANTIDAD DE ALQUILERES POR AÑO (GENERAL)';
        $x = 'anio';
        $y = 'total';
        $etiqueta = 'Sucursal';
        $sucursal = Sucursal::where('nombre','=',$request['sucursal'])->first();
        $datos = DB::SELECT('SELECT (YEAR(fecha_recogida)) AS anio, COUNT(*) AS total FROM alquilers
        INNER JOIN vehiculos ON vehiculos.idvehiculo = alquilers.id_vehiculo 
        INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = alquilers.id_vehiculo
        WHERE vehiculosucursales.sucursal = ? GROUP BY (YEAR(fecha_recogida)) ORDER BY (YEAR(fecha_recogida)) ASC LIMIT ?',[$sucursal->idsucursal,$request['limite']]);
            return view('gerente.reportes.mantenimientos', compact('datos','titulo','x','y','etiqueta'));
    }
}

}
