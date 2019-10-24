<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use DB;
use DateTime;
use Mail;
class ModificarReservaController extends Controller{
    public function modificar_reserva(Request $request){ 
        $reserva = App\Reservacion::where('id','=',$request->id)->first();
        $alquiler = App\Alquiler::findOrFail($reserva->id);
        $sucursales = App\Sucursal::all();
        //return $alquiler;
        
        return view('modificar_reserva',compact('alquiler','sucursales'));
    }
}
