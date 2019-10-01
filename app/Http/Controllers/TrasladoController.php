<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App;
use DB;
use DateTime;
use DateInterval;
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
         if(intval($request->viaje_redondo) != 0)
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
    $traslado_temp = App\traslado_temp::findOrFail($reserva['id']);
    // Seteamos las propiedades de la tabla traslado_temp
    echo($reserva['viaje_redondo'] . "-");
    //echo(intval($reserva['viaje_redondo']));
    $traslado_temp->lugar_salida  = $reserva['lugar_salida'];
    $traslado_temp->fecha_salida  = date("Y\-m\-d", strtotime($reserva['fecha_salida']));
    $traslado_temp->hora_salida   = $reserva['hora_salida'];
    $traslado_temp->lugar_llegada = $reserva['lugar_llegada'];
    $traslado_temp->hora_llegada  = $reserva['hora_llegada'];
    $traslado_temp->n_pasajeros   = $reserva['n_pasajeros'];
    if($reserva['viaje_redondo'] == "0" | $reserva['viaje_redondo'] == "on"){
        $traslado_temp->viaje_redondo = 1;
        $traslado_temp->dias_espera   = $reserva['dias_espera'];
        echo("SI viaje redondo");
    }else{
        $traslado_temp->viaje_redondo = 0;
        $traslado_temp->dias_espera   = 0;
        echo("NO viaje redondo");
    }
    $traslado_temp->fecha_llegada_solicitada = date("Y\-m\-d", strtotime($reserva['fecha_llegada_solicitada']));
    // Guardamos en la base de datos (equivalente al flush de Doctrine)
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
                    if($v_anterior->marca . $v_anterior->modelo .$v_anterior->nombre == $v->marca . $v->modelo . $v->nombre){
                        $v_anterior = $v;
                    }else{
                        $v_anterior = $v;
                            if($v->tipo != "motoneta")
                            array_push($vehiculos_disponibles, $v);  
                    }
                }else{
                $v_anterior = $v;
                  if($v->tipo != "motoneta")
                    array_push($vehiculos_disponibles, $v);
                }
            }
        }
    $solicitud_traslado = App\traslado_temp::findOrFail($traslado_temp->id);
    echo($solicitud_traslado->viaje_redondo . "-");
    return view('traslado_elegir_vehiculo',compact('solicitud_traslado','vehiculos_disponibles'));
    }//fin de la funcion de vehiculos disponibles


public function calculo_costos_traslado(Request $reserva){
        $solicitud_traslado = App\traslado_temp::findOrFail($reserva['id_sol_traslado']);
        $vehiculo       = App\Vehiculo::findOrFail($reserva['id_vehiculo']);
        //calcular
        //dias de renta
        $llegada = new DateTime($solicitud_traslado->fecha_llegada_solicitada);
        $llegada->add(new DateInterval('PT'. substr($solicitud_traslado->hora_llegada,0,2) .'H'));
        $salida = new DateTime($solicitud_traslado->fecha_salida);
        $salida->add(new DateInterval('PT'. substr($solicitud_traslado->hora_salida,0,2) .'H'));
 //return $llegada->format('Y-m-d H:i') . "\n"; 
// el costo del puerto punto de origen seria por kiometraje
//kilometraje por la gasolina
        $diferencia = $salida->diff($llegada);
        //$dias = $diferencia->format('%Y años %m meses %d days %H horas %i minutos %s segundos');
        $dias = $diferencia->format('%d');
        $horas = $diferencia->format('%H');
        if($solicitud_traslado->viaje_redondo == 1){
            $dias = $dias * 2;
            $horas = $horas * 2;
        }
        if($horas > 8 ){
            $subtotal = ($dias+ 1) * $vehiculo->precio;
        }else{
            $subtotal = $dias * $vehiculo->precio + (($vehiculo->precio/24) * $horas);
        }        
        //numero de choferes para el viaje
        //sueldo del chofer sera ingresado por el admind no estará fijo por cualquier cambio
        //costo del servicio
        // ****indicar que los siguientes gastos corren por cuenta del cliente y estan fuera de esta cotizacion:
        //gasolina
        //casetas
        //viaticos del chofer en caso de que sean varios dias
        // indicar forma de pago (preguntar por esta, se solicita un anticipo antes del dia de salida o es hasta la salida y llegada quue se cubren los pagos) 
        //* podemos poner una pequeña calculadora para estimar gastos de gasolina ((km de viaje / rendimiento vehiculo)*precio de gasolina)
       
        return view('traslado_calculo_cotizacion',compact('vehiculo','solicitud_traslado','dias', 'horas', 'subtotal'));
    }
    
public function crear_reservacion_traslado(Request $traslado){
        # code..
        return $traslado;

}




}
