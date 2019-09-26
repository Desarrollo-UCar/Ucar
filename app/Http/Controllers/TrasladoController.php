<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App;
use DB;
use App\Http\Controllers\Controller;

class TrasladoController extends Controller{
    //parte de la reserva de un traslado
    public function renta_traslado_vehiculo(Request $request){ 
        //return $request; 
        if($request->fecha_salida=='0' || $request->fecha_solicitada =='0')
            return back()->with('mensaje', 'Seleccione fechas!');
         // Creamos el objeto traslado_temp
         $traslado_temp = new App\traslado_temp;
         // Seteamos las propiedades de la tabla traslado_temp
         $traslado_temp->fecha_hora_reserva = date('Y\-m\-d H\:i\:s');
        
         $traslado_temp->lugar_salida = $request->lugar_salida;
         $traslado_temp->fecha_salida = $request->fecha_salida;
         $traslado_temp->lugar_llegada = $request->lugar_llegada;
         $traslado_temp->fecha_llegada_solicitada = date("Y\-m\-d", strtotime($request->fecha_solicitada));
         $traslado_temp->hora_llegada = $request->hora_llegada;
         $traslado_temp->n_pasajeros = intval($request->n_pasajeros);

         $traslado_temp->nombres = $request->nombres;
         $traslado_temp->primer_apellido = $request->primerApellido;
         $traslado_temp->segundo_apellido = $request->segundoApellido;
         $traslado_temp->telefono = $request->telefono;
         $traslado_temp->email = $request->email;
         $traslado_temp->viaje_redondo = intval($request->viaje_redondo);
         if(!intval($request->viaje_redondo) == 0)
         $traslado_temp->dias_espera = $request->dias_espera;
         else
         $traslado_temp->dias_espera = 0;
         // Guardamos en la base de datos (equivalente al flush de Doctrine)
         $traslado_temp->save();
        //Consultas a las bases de datos flota disponible en las fechas dadas y devolucion de los datos de la reserva de un traslado
         $datos_reserva_traslado = App\traslado_temp::findOrFail($traslado_temp->id);
        return view('renta_traslado_datos',compact('datos_reserva_traslado'));
    }

    ///------------------------------------------------------------------------------------------------
public function vehiculos_disponibles(Request $reserva){
// Creamos el objeto traslado_temp
$traslado_temp = App\traslado_temp::findOrFail($reserva['id']);
// Seteamos las propiedades de la tabla traslado_temp
$traslado_temp->lugar_salida  = $reserva['lugar_salida'];
$traslado_temp->fecha_salida  = date("Y\-m\-d", strtotime($reserva['fecha_salida']));
$traslado_temp->hora_salida   = $reserva['hora_salida'];
$traslado_temp->lugar_llegada = $reserva['lugar_llegada'];
$traslado_temp->hora_llegada  = $reserva['hora_llegada'];
$traslado_temp->n_pasajeros   = $reserva['n_pasajeros'];
$traslado_temp->viaje_redondo = intval($reserva['viaje_redondo']);
//return intval($reserva['viaje_redondo']);
//return $reserva['dias_espera'];
if(!$reserva['viaje_redondo'] == 0)
    $traslado_temp->dias_espera   = $reserva['dias_espera'];
else
     $traslado_temp->dias_espera = 0;
$traslado_temp->fecha_llegada_solicitada = date("Y\-m\-d", strtotime($reserva['fecha_llegada_solicitada']));
// Guardamos en la base de datos (equivalente al flush de Doctrine)
//return $traslado_temp->dias_espera;
$traslado_temp->save();
$solicitud_traslado= $traslado_temp;
    $vehiculos_disp = DB::select(' SELECT vehiculos.idvehiculo, vehiculos.marca, vehiculos.modelo, vehiculos.transmicion,
    vehiculos.puertas, vehiculos.rendimiento, vehiculos.precio, vehiculos.pasajeros,
    vehiculos.maletero, vehiculos.color, vehiculos.cilindros, vehiculos.tipo, vehiculos.descripcion,
    vehiculos.foto, sucursals.idsucursal,sucursals.nombre FROM vehiculos 
       INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
          INNER JOIN sucursals ON sucursals.idsucursal = vehiculosucursales.sucursal
       AND vehiculos.idvehiculo NOT IN (
       SELECT vehiculos.idvehiculo FROM vehiculos  
       INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
       INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
      
       AND vehiculos.estatus ="disponible"
       AND vehiculosucursales.status ="ACTIVO"
       AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
       OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
       UNION
       SELECT vehiculos.idvehiculo FROM vehiculos  
       INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
       INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
      
       AND vehiculos.estatus ="disponible"
       AND vehiculosucursales.status ="ACTIVO"
       AND  alquilers.fecha_recogida <= ?
       AND alquilers.fecha_devolucion >= ?)ORDER BY vehiculos.precio,vehiculos.marca, vehiculos.modelo, sucursals.idsucursal',
                                            [$reserva['fecha_salida'],$reserva['fecha_solicitada'],$reserva['fecha_salida'],$reserva['fecha_solicitada']]);

        if(!empty($vehiculos_disp)){
            $v_anterior = "h";
            $vehiculos_disponibles = [];
            foreach($vehiculos_disp as $v){
                if($v_anterior != "h"){
                    //echo $v_anterior->marca . $v_anterior->modelo;
                    //echo $v->marca . $v->modelo;
                    if($v_anterior->marca . $v_anterior->modelo .$v_anterior->nombre == $v->marca . $v->modelo . $v->nombre){
                        $v_anterior = $v;
                    }
                    else{
                        $v_anterior = $v;
                            if($v->tipo != "motoneta")
                            array_push($vehiculos_disponibles, $v);  
                        //echo "agregando";
                    }
                    //echo "---------------------";
                }
                else{
                $v_anterior = $v;
                //echo $v_anterior->marca . $v_anterior->modelo;
                  //  echo $v->marca . $v->modelo;
                  if($v->tipo != "motoneta")
                    array_push($vehiculos_disponibles, $v);
                //echo "agregando"; 
                //echo "---------------------";
                }
            }
        }
        $solicitud_traslado = App\traslado_temp::findOrFail($traslado_temp->id);

        return view('traslado_elegir_vehiculo',compact('solicitud_traslado','vehiculos_disponibles'));
    }//fin de la funcion de vehiculos disponibles


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
}
