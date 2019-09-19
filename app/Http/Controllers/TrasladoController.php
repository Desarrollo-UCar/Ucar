<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use DB;
use App\Http\Controllers\Controller;

class TrasladoController extends Controller{
    //parte de la reserva de un traslado
    public function renta_traslado_vehiculo(Request $request){  
        if($request->fecha_salida=='0' || $request->fecha_solicitada =='0')
            return back()->with('mensaje', 'Seleccione fechas!');
         // Creamos el objeto traslado_temp
         $traslado_temp = new App\traslado_temp;
         // Seteamos las propiedades de la tabla traslado_temp
         $traslado_temp->fecha_hora_reserva = date('Y\-m\-d H\:i\:s');
        
         $traslado_temp->lugar_salida = $request->lugar_salida;
         $traslado_temp->fecha_salida = $request->fecha_salida;
         $traslado_temp->hora_salida = $request->hora_salida;
         $traslado_temp->lugar_llegada = $request->lugar_llegada;
         $traslado_temp->fecha_llegada_solicitada = $request->fecha_solicitada;
         $traslado_temp->n_pasajeros = intval($request->n_pasajeros);

         $traslado_temp->nombres = $request->nombres;
         $traslado_temp->primer_apellido = $request->primerApellido;
         $traslado_temp->segundo_apellido = $request->segundoApellido;
         $traslado_temp->telefono = $request->telefono;
         $traslado_temp->email = $request->email;
         // Guardamos en la base de datos (equivalente al flush de Doctrine)
         $traslado_temp->save();
        //Consultas a las bases de datos flota disponible en las fechas dadas y devolucion de los datos de la reserva de un traslado
         $datos_reserva_traslado = App\traslado_temp::findOrFail($traslado_temp->id);
        return view('renta_traslado_datos',compact('datos_reserva_traslado'));
    }

    public function enviar_datos_traslado(Request $reserva){
        $id_vehiculo    = $reserva['id_vehiculo'];
        //return $id_vehiculo;
        $id_reserva     = $reserva['id_reserva_traslado'];
        $vehiculo       = App\Vehiculo::findOrFail($id_vehiculo);
        $datos_reserva_traslado  = App\traslado_temp::findOrFail($id_reserva);
        $chofer = App\serviciosextras::findOrFail(3);
        $datos_reserva_traslado->id_vehiculo = $id_vehiculo;
        //hacer el save
        ///------
        //calcular los costos del traslado
        $km = ($datos_reserva_traslado->km_recorridos)/1000;
        $hrs = ($datos_reserva_traslado->tiempo_estimado)/3600;
        $dias = $hrs/24;
        $precio_gasolina = 20.6; // checar si se solicita al cliente
        $litros_gasolina = $km/$vehiculo->rendimiento;
        $monto_gasolina = $litros_gasolina * $precio_gasolina;
        $num_choferes = ($km>400) ? 2 : 1;
        $alquiler_vehiculo = $dias * $vehiculo->precio;
        $sueldo_choferes = ($num_choferes * $chofer->precio) * $dias;
        $total = ($monto_gasolina + $alquiler_vehiculo + $sueldo_choferes) * 2;

        $datos_reserva_traslado->precio_litro_gasolina = $precio_gasolina;
        $datos_reserva_traslado->litros_gasolina = $litros_gasolina;
        $datos_reserva_traslado->monto_gasolina = $monto_gasolina;
        $datos_reserva_traslado->num_choferes = $num_choferes;
        $datos_reserva_traslado->sueldo_chofer = $sueldo_choferes;
        $datos_reserva_traslado->total = $total;
        $datos_reserva_traslado->save();
        return view('renta_traslado_datos',compact('vehiculo','datos_reserva_traslado'));
    }

    public function solicita_info_traslado(Request $reserva){
        }
    
}
