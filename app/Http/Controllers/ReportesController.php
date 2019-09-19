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
    //
public function fechaReservacion(){

    return view('gerente.reportes.fechaReservacion');
}
    
}
