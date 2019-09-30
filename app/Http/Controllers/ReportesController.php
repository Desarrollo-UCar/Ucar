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

class ReportesController extends Controller
{

    public function index(){

        return view('gerente.reportes.inicio');

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

   
   
        $dias = DB::SELECT('SELECT (DAY(fecha_reservacion)) AS DIA, COUNT(*) AS CANTIDAD
        FROM reservacions
        WHERE fecha_reservacion  <= CURDATE() 
        AND fecha_reservacion >= DATE_SUB(CURDATE(), INTERVAL ? WEEK) GROUP BY DAY(fecha_reservacion)',[1]);
        //return response()->json($dias);

        return view('gerente.reportes.fechaReservacion', compact('reservaciones_anio','reservaciones_mes','dias'));

}

public function concurrencia(){
      //reservaciones por anio
      $alquilers_anio = DB::select(
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
        AND fecha_recogida >= DATE_SUB(CURDATE(), INTERVAL ? WEEK) GROUP BY DAY(fecha_recogida)',[1]);
        //return response()->json($dias);

        return view('gerente.reportes.fechaReservacion', compact('reservaciones_anio','reservaciones_mes','dias'));


}
    
}
