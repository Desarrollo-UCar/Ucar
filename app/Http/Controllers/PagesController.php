<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DateTime;
class PagesController extends Controller
{
    public function inicio(){
        return view('index');
    }

    public function postFormularioindex(Request $request){   
        // Creamos el objeto
        $reserva_temp = new App\reserva_temp;
        // Seteamos las propiedades
        $reserva_temp->fecha_hora_reserva = date('Y\-m\-d H\:i\:s');
        $reserva_temp->lugar_recogida = $request->lugarrecogida;
        $reserva_temp->fecha_recogida = $request->fechaRecogida;
        $reserva_temp->hora_recogida = $request->horaRecogida;

        $reserva_temp->lugar_devolucion = $request->lugarrecogida;
        $reserva_temp->fecha_devolucion = $request->fechaDevolucion;
        $reserva_temp->hora_devolucion = $request->horaDevolucion;

        $reserva_temp->codigo_descuento =  $request->codigoPromocion;
        $reserva_temp->tipo_vehiculo= $request->tipoVehiculo;
        $reserva_temp->id_vehiculo = 0;
        $reserva_temp->total = 0;
        $reserva_temp->servicios_extra = 'ee';
        // Guardamos en la base de datos (equivalente al flush de Doctrine)
        $reserva_temp->save();

        
        $vehiculos_disponibles = App\Vehiculo::all();
        $datos_reserva         = App\reserva_temp::findOrFail($reserva_temp->id);
        //return $datos_reserva;
        return view('reservar_auto',compact('vehiculos_disponibles', 'datos_reserva'));
    }

    public function pflota(){
        $flota = App\Vehiculo::all();
        return view('flota',compact('flota'));
    }


    public function reservacion(){
        return view('reservacion');
    }

    public function inicio_sesion_cliente(){
        return view('inicio_sesion_cliente');
    }

    public function servicios(){
        return view('servicios');
    }

    public function sucursales(){
        return view('sucursales');
    }

    public function sucursal_Puerto_Escondido(){
        return view('sucursal_Puerto_Escondido');
    }

    public function sucursal_Ixtepec(){
        return view('sucursal_Ixtepec');
    }

    public function sucursal_Istmo(){
        return view('sucursal_Istmo');
    }

    public function renta_auto(){
        return view('renta_auto');
    }

    public function renta_traslado(){
        return view('renta_traslado');
    }

    public function renta_flotilla(){
        return view('renta_flotilla');
    }

    public function modificar_renta(){
        return view('modificar_renta');
    }

    public function en_construccion(){
        return view('en_construccion');
    }

    public function en_construccion2(Request $email){
        $correo   = $email['email'];
       //return response()->json($email);
        $cliente= App\Cliente::where('correo','=',$correo)->first();
        return response()->json($cliente);
        return view('en_construccion');
    }

    public function reservar_servicios_extra(Request $reserva){
        //return $reserva;
        $id_vehiculo    = $reserva['id_vehiculo'];
        $id_reserva     = $reserva['id_reserva'];

        $vehiculo       = App\Vehiculo::findOrFail($id_vehiculo);
        $datos_reserva  = App\reserva_temp::findOrFail($id_reserva);
        $servicios_extra= App\serviciosextras::all();
        return view('reservar_servicios_extra',
            compact('vehiculo','datos_reserva','servicios_extra'
                ));
    }

    public function reservar_realizar_pago(Request $reserva){
        //return $reserva;
        $id_vehiculo     = $reserva['id_vehiculo'];
        $id_reserva      = $reserva['id_reserva'];
        $servicios     = $reserva['id'];

        $vehiculo       = App\Vehiculo::findOrFail($id_vehiculo);
        $datos_reserva  = App\reserva_temp::findOrFail($id_reserva);

        $devolucion = new DateTime($datos_reserva->fecha_devolucion);
        $salida     = new DateTime($datos_reserva->fecha_recogida);
        $diferencia = $salida->diff($devolucion);
        $dias = $diferencia->format('%a');

        $servicios_extra = [];
        $total_serv_extra = 0; 
        if(is_array($servicios)){
            if(count($servicios) > 0 ){
                foreach ($servicios as $valor) {
                    $datos = App\serviciosextras::findOrFail($valor);
                    $datos->precioRenta = $datos->precio * intval($dias);
                    $total_serv_extra += $datos->precio;
                    array_push($servicios_extra, $datos); 
                }
            }
        }
        $alquiler = intval($vehiculo->precio) * intval($dias);
        $cuota_aeropuerto=130;
        $cargo_servicio = 10;
        $subtotal = $alquiler + $cuota_aeropuerto + $cargo_servicio + $total_serv_extra;
        $iva = $subtotal*16/100;
        $total_decimal = $subtotal + $iva;
        $iva = number_format($iva,2);
        $prepago = number_format($total_decimal*95/100,2);
        $total = number_format($total_decimal,2);
        $subtotal = number_format($subtotal,2);
//actualizar tabla temporal de la reserva
    $datos_reserva->id_vehiculo = $id_vehiculo;
    $datos_reserva->total = $total_decimal;
    $datos_reserva->save();

        return view('reservar_realizar_pago',
            compact('vehiculo','datos_reserva','servicios_extra','dias','alquiler','subtotal','cuota_aeropuerto','cargo_servicio','total','iva','prepago'));
    }

public function pago_paypal(Request $reserva){
    //return $reserva;
        $datos_reserva  = App\reserva_temp::findOrFail($reserva->id);
        
    // Creamos el objeto para Cliente
    $cliente = new App\Cliente;
    $cliente->nombre = $reserva->nombre;
    $cliente->primer_apellido = $reserva->primer_apellido;
    $cliente->segundo_apellido = $reserva->segundo_apellido;
    $cliente->fecha_nacimiento = new DateTime('2000-01-01');
    $cliente->nacionalidad = $reserva->nacionalidad;
    $cliente->correo = $reserva->email;
    $cliente->telefono = $reserva->celular;
    $cliente->calle = 'por rellenar';
    $cliente->numero = 0;
    $cliente->colonia = 'por rellenar';
    $cliente->ciudad = 'por rellenar';
    $cliente->estado = 'por rellenar';
    $cliente->pais = 'por rellenar';
    $cliente->foto = 'por rellenar';

    $cliente->save();
        // Creamos el objeto para Reservacion
    $reserva_temp = new App\Reservacion;
    // Seteamos las propiedades
    //return $cliente;
    $reserva_temp->id_cliente = $cliente->id;
    $reserva_temp->fecha_reservacion = date('Y\-m\-d H\:i\:s');
    $reserva_temp->motivo_visita = 'por rellenar';
    $reserva_temp->comentarios = 'por rellenar';
    $reserva_temp->total = $datos_reserva->total;
    $reserva_temp->save();

    // Creamos el objeto para Pago_reservacion
    $pago_reserva = new App\Pago_reservacion;
    // Seteamos las propiedades
    $pago_reserva->id_reserva = $reserva_temp->id;
    $pago_reserva->paypal_datos = 'por rellenar';
    $pago_reserva->fecha = date('Y\-m\-d H\:i\:s');
    $pago_reserva->total = $reserva_temp->total;
    $pago_reserva->status = 'pendiente';
    $pago_reserva->save();


    $vehiculo       = App\Vehiculo::findOrFail($datos_reserva->id_vehiculo);
    // Creamos el objeto para Pago_reservacion
    $alquiler = new App\Alquiler;
    $alquiler->id_reservacion = $reserva_temp->id;
    $alquiler->lugar_recogida = $datos_reserva->lugar_recogida;
    $alquiler->fecha_recogida = $datos_reserva->fecha_recogida;
    $alquiler->hora_recogida = $datos_reserva->hora_recogida;
    $alquiler->lugar_devolucion = $datos_reserva->lugar_devolucion;
    $alquiler->fecha_devolucion = $datos_reserva->fecha_devolucion;
    $alquiler->hora_devolucion = $datos_reserva->hora_devolucion;
    $alquiler->id_vehiculo = $datos_reserva->id_vehiculo;
    $alquiler->km_salida = $vehiculo->kilometraje;
    $alquiler->km_regresa = $vehiculo->kilometraje;
    $alquiler->nombreConductor = 'por rellenar';
    $alquiler->num_licencia = 'por rellenar';
    $alquiler->expedicion_licencia = 'por rellenar';
    $alquiler->expiracion_licencia = 'por rellenar';
    $alquiler->estatus = 'pendiente_recogida';
    $alquiler->save();
    //volvemos a calcular los dias
    $devolucion = new DateTime($datos_reserva->fecha_devolucion);
        $salida     = new DateTime($datos_reserva->fecha_recogida);
        $diferencia = $salida->diff($devolucion);
        $dias = $diferencia->format('%a');
        $total_vehiculo = intval($vehiculo->precio) * intval($dias);
        $servicios_extra = 'EN CONSTRUCCION :)';

        $cuota_aeropuerto=130;
        $cargo_servicio = 10;
        $subtotal = $total_vehiculo + $cuota_aeropuerto + $cargo_servicio;

        $iva = $subtotal*16/100;
        $iva = number_format($iva,2);
        $subtotal = number_format($subtotal,2);
    // Seteamos las propiedades  "btnAccion":"pago_mostrador"
    if($reserva->btnAccion == 'pago_mostrador'){
        return view('reservar_finalizada',compact('pago_reserva','cliente','reserva_temp','vehiculo','alquiler','total_vehiculo','dias','servicios_extra','iva','subtotal'));
    }else{
        
        return view('pago',compact('pago_reserva'));
    }
    }
    

//parte de la reserva de un traslado


    public function renta_traslado_vehiculo(Request $request){  
        //estimar fecha y hora de llegada
        $fecha_estimada = $request->fecha_salida; 
        $hora_estimada =  $request->hora_salida;
         // Creamos el objeto traslado_temp
         $traslado_temp = new App\traslado_temp;
         // Seteamos las propiedades de la tabla traslado_temp
         $traslado_temp->fecha_hora_reserva = date('Y\-m\-d H\:i\:s');
        
         $traslado_temp->lugar_salida = $request->lugar_salida;
         $traslado_temp->fecha_salida = $request->fecha_salida;
         $traslado_temp->hora_salida = $request->hora_salida;

         $traslado_temp->lugar_llegada = $request->lugar_llegada;
         $traslado_temp->fecha_llegada_estimada = $fecha_estimada;
         $traslado_temp->hora_llegada_estimada = $hora_estimada;
         $traslado_temp->id_vehiculo = 0;
         $traslado_temp->km_recorridos = $request->km_recorridos;
         $traslado_temp->tiempo_estimado = $request->tiempo_estimado;

        $traslado_temp->precio_litro_gasolina = 0;
        $traslado_temp->litros_gasolina = 0;
        $traslado_temp->monto_gasolina = 0;
        $traslado_temp->num_choferes = 1;
        $traslado_temp->sueldo_chofer = 0;
        $traslado_temp->total = 0;
         // Guardamos en la base de datos (equivalente al flush de Doctrine)
         $traslado_temp->save();
        //Consultas a las bases de datos flota disponible en las fechas dadas y devolucion de los datos de la reserva de un traslado
         $vehiculos_disponibles  = App\Vehiculo::all();
         $datos_reserva_traslado = App\traslado_temp::findOrFail($traslado_temp->id);
        return view('renta_traslado_vehiculo',compact('vehiculos_disponibles', 'datos_reserva_traslado'));
    }

    public function renta_traslado_datos(Request $reserva){
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

    public function solicita_informacion_traslado(Request $reserva){
        //return $reserva;
            // Creamos el objeto para Cliente
        

        }





}
