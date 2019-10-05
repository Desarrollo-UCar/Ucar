<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App;
use DB;
use DateTime;
use DateInterval;
use Mail;
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
         //datos necesarios en el siguiente paso cotizacion por parte del administrador
         
         // Guardamos en la base de datos (equivalente al flush de Doctrine)
         $traslado_temp->save();
        //Consultas a las bases de datos flota disponible en las fechas dadas y devolucion de los datos de la reserva de un traslado
         $datos_reserva_traslado = App\traslado_temp::findOrFail($traslado_temp->id);
        return view('renta_traslado_datos',compact('datos_reserva_traslado'));
    }
    
public function calculo_costos_traslado(Request $reserva){
        $solicitud_traslado = App\traslado_temp::findOrFail($reserva['id_sol_traslado']);
        $solicitud_traslado->id_vehiculo = null;
        $solicitud_traslado->save();
        $sucursales = App\Sucursal::all();
        $vehiculos_disponibles = null;
        $dias = null;
        $horas = null;
        $subtotal = null;
        $vehiculo_elegido = null;
        return view('traslado_calculo_cotizacion',compact('vehiculo_elegido','vehiculos_disponibles','solicitud_traslado','sucursales','dias','horas','subtotal'));
    }
    
public function vehiculos_por_sucursal(Request $reserva){
    //return $reserva['viaje_redondo'];
    $solicitud_traslado = App\traslado_temp::findOrFail($reserva['id_sol_traslado']);
    $solicitud_traslado->id_vehiculo = null;
    $solicitud_traslado->save();
    $sucursales = App\Sucursal::all();
    $sucursal = 1;
    foreach ($sucursales as $su) {
        if($su->nombre == $reserva['sucursal'])
            $sucursal = $su->idsucursal; 
    }
    $solicitud_traslado->sucursal = $sucursal;
    $solicitud_traslado->fecha_salida_de_sucursal=  date("Y\-m\-d", strtotime($reserva['fecha_salida_sucursal']));
    $solicitud_traslado->hora_salida_de_sucursal = $reserva['hora_salida_sucursal'];
    $solicitud_traslado->km_sucursal_origen      = $reserva['km'];
    $solicitud_traslado->gasolina                = $reserva['gasolina'];
    $solicitud_traslado->otros_gastos            = $reserva['otros_gastos'];
    
                $solicitud_traslado->lugar_salida  = $reserva['lugar_salida'];
                $solicitud_traslado->fecha_salida  = date("Y\-m\-d", strtotime($reserva['fecha_salida']));
                $solicitud_traslado->hora_salida   = $reserva['hora_salida'];
                $solicitud_traslado->lugar_llegada = $reserva['lugar_llegada'];
                $solicitud_traslado->fecha_llegada_solicitada =$reserva['fecha_llegada_solicitada'];
                $solicitud_traslado->hora_llegada  = $reserva['hora_llegada'];
                $solicitud_traslado->n_pasajeros   = $reserva['n_pasajeros'];
                if($reserva['viaje_redondo'] == "1" | $reserva['viaje_redondo'] == "on"){
                    $solicitud_traslado->viaje_redondo = 1;
                    $solicitud_traslado->dias_espera   = $reserva['dias_espera'];
                }else{
                    $solicitud_traslado->viaje_redondo = 0;
                    $solicitud_traslado->dias_espera   = 0;
                }
                $solicitud_traslado->fecha_llegada_solicitada = date("Y\-m\-d", strtotime($reserva['fecha_llegada_solicitada']));
    //fechas en formato 
    
    //calculamos la fecha de llegada a la sucursal en base a la fecha de llegada a destino 
    //consultamos los vehiculos disponibles en las fechas acordadas con el cliente por parte del administrador
    $vehiculos_disp = DB::select(' SELECT vehiculos.idvehiculo, vehiculos.marca, vehiculos.modelo, vehiculos.transmicion,
    vehiculos.puertas, vehiculos.rendimiento, vehiculos.precio, vehiculos.pasajeros,
    vehiculos.maletero, vehiculos.color, vehiculos.cilindros, vehiculos.tipo, vehiculos.descripcion,
    vehiculos.foto FROM vehiculos 
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
       AND alquilers.fecha_devolucion >= ?)ORDER BY vehiculos.precio,vehiculos.marca, vehiculos.modelo',
                                        [$sucursal,$sucursal,$sucursal,
                                        $solicitud_traslado->fecha_salida_de_sucursal,$reserva['fecha_solicitada'],$solicitud_traslado->fecha_salida_de_sucursal,$reserva['fecha_solicitada']]);

        if(!empty($vehiculos_disp)){
        $v_anterior = "h";
        $vehiculos_disponibles = [];
        foreach($vehiculos_disp as $v){
            if($v_anterior != "h"){
                if($v_anterior->marca . $v_anterior->modelo == $v->marca . $v->modelo){
                    $v_anterior = $v;
                }
                else{
                    $v_anterior = $v;
                    if($v->tipo != "motoneta")
                        array_push($vehiculos_disponibles, $v);  
                }
            }
            else{
                $v_anterior = $v;
                if($v->tipo != "motoneta")
                    array_push($vehiculos_disponibles, $v);
            }
        }
    }
    //si ya fue seleccionado un vehiculo y entonces la variable $reserva->id_vehiculo no es null
    //dias de renta
    $dias = null;
    $horas = null;
    $subtotal = null;
    $vehiculo_elegido = null;
    $solicitud_traslado->save();
   // $solicitud_traslado = App\traslado_temp::findOrFail($solicitud_traslado->id);

    if($reserva['id_vehiculo'] != null){
        $solicitud_traslado->id_vehiculo = $reserva['id_vehiculo'];
        $vehiculo_elegido       = App\Vehiculo::findOrFail($reserva['id_vehiculo']);

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
            $subtotal = ($dias+ 1) * $vehiculo_elegido->precio;
        }else{
            $subtotal = $dias * $vehiculo_elegido->precio + (($vehiculo_elegido->precio/24) * $horas);

        }   
    }
    $solicitud_traslado->save();
    $solicitud_traslado = App\traslado_temp::findOrFail($solicitud_traslado->id);
    //return $solicitud_traslado;
    return view('traslado_calculo_cotizacion',compact('solicitud_traslado','sucursales','vehiculos_disponibles','vehiculo_elegido','dias','horas','subtotal'));
}


public function guardar_confirmacion_traslado(Request $reserva){
    $solicitud_traslado = App\traslado_temp::findOrFail($reserva['id_sol_traslado']);
    $vehiculo           = App\Vehiculo::findOrFail($solicitud_traslado->id_vehiculo);
    //return $solicitud_traslado;
    //calculamos los datos necesarios
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
        ///-----
        $total_previos = $solicitud_traslado->km / $vehiculo->rendimiento * $solicitud_traslado->gasolina + $solicitud_traslado->otros_gastos * 2;
        $total_sueldo_chofer = $solicitud_traslado->n_choferes * $solicitud_traslado->sueldo_chofer * $dias;
        $subtotal =   $total_previos + $total_sueldo_chofer + $subtotal;
        $total = $subtotal - ($subtotal / 100 * $solicitud_traslado->descuento) ;

    //guardamos los datos en las tablas correspondientes
    //tabla reserva
        $reservacion = new App\Reservacion;
        $reservacion->id_cliente = 1;
        $reservacion->fecha_reservacion = date('Y\-m\-d H\:i\:s');
        $reservacion->motivo_visita = 'por rellenar';
        $reservacion->comentarios = 'por rellenar';
        $reservacion->total = $total;
        $reservacion->saldo = 0.0;
        $reservacion->save();
    //tabla alquiler
        $alquiler = new App\Alquiler;
        $alquiler->id_reservacion = $reservacion->id;
        $alquiler->lugar_recogida = $solicitud_traslado->lugar_salida;
        $alquiler->fecha_recogida = $solicitud_traslado->fecha_salida;
        $alquiler->hora_recogida = $solicitud_traslado->hora_salida;
        $alquiler->lugar_devolucion =  $solicitud_traslado->lugar_llegada;
        $alquiler->fecha_devolucion =  $solicitud_traslado->fecha_llegada_solicitada;
        $alquiler->hora_devolucion = $solicitud_traslado->hora_llegada;
        $alquiler->id_vehiculo = $solicitud_traslado->id_vehiculo;
        $alquiler->km_salida = $vehiculo->kilometraje;
        $alquiler->km_regresa = $vehiculo->kilometraje;
        $alquiler->nombreConductor = 'por rellenar';
        $alquiler->num_licencia = 'por rellenar';
        $alquiler->expedicion_licencia = 'por rellenar';
        $alquiler->expiracion_licencia = 'por rellenar';
        $alquiler->estatus = 'pendiente_recogida';
        $alquiler->save();
    //---------------------------
   return "ya esta";
    //////-------------------------
    Mail::send('mails.confirmacion_traslado',compact('solicitud_traslado','reserva','vehiculo','subtotal','total_sueldo_chofer','total', 'dias', 'horas'), function ($message) use ($solicitud_traslado,$vehiculo){
        $message->from('ucardesarollo@gmail.com', 'Ucar');
        $message->to($solicitud_traslado->email)->subject('Confirmacion de Reserva de Traslado');
        $message->attach($vehiculo->foto);
    });
    /////////-------------------------
    return "mensaje enviado";
}




}
