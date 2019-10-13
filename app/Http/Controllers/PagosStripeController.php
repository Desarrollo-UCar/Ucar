<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App;
use DB;
use DateTime;
use Mail;
use App\Http\Controllers\Controller;

class PagosStripeController extends Controller{
    public function crear_pago_stripe(Request $request){
        //return $request;
       $datos_reserva  = App\reserva_temp::findOrFail($request->id_reserva_temp);
       //return $datos_reserva;
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
        $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
        $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' =>  intval($datos_reserva->total),
                'currency' => 'mxn'
            ));
            //---------------
            $correo   = auth()->user()->email;
            //el cliente no se esta creando al momento del registro
                $cliente= App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
                $datos_reserva  = App\reserva_temp::findOrFail($request->id_reserva_temp);
                $datos_reserva->id_cliente = $cliente->idCliente;//guardo el cliente en la temporal por si acaso
                $datos_reserva->save();
                // Creamos el objeto para Reservacion
                $reservacion = new App\Reservacion;
                $reservacion->id_cliente = $cliente->idCliente;
                $reservacion->fecha_reservacion = date('Y\-m\-d H\:i\:s');
                $reservacion->motivo_visita = 'por rellenar';
                $reservacion->comentarios = 'por rellenar';
                $reservacion->total = $datos_reserva->total;
                $reservacion->saldo = 0.0;
                $reservacion->save();
                // listo tenemos la reserva
                // Creamos el objeto para Pago_reservacion
                $pago_reserva = new App\Pago_reservacion;
                $pago_reserva->id_reserva = $reservacion->id;
                $pago_reserva->paypal_datos = 'por rellenar';
                $pago_reserva->mostrador_datos = 'por rellenar en mostrador';
                //$pago_reserva->garantia_datos = 'por rellenar en mostrador';
                $pago_reserva->fecha = date('Y\-m\-d H\:i\:s');
                $pago_reserva->total = $reservacion->total;
                $pago_reserva->estatus = 'pendiente';
                //$pago_reserva->reservacion = 0;
                $pago_reserva->save();
             // listo tenemos el pago de la rserva creado falata que el cliente pague
            // buscamos el vehiculo para proceder a crear el alquiler con todos los datos
                $vehiculo       = App\Vehiculo::findOrFail($datos_reserva->id_vehiculo);
                // Creamos el objeto para Pago_reservacion
                $alquiler = new App\Alquiler;
                $alquiler->id_reservacion = $reservacion->id;
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
                //rellenamos la tabla de alquileresservicioextra para llevar un control de l    os servicios eextra que tiene cada alquiler y cada reserva
                //tenemos uq hacer un foreach para rellenar en caso de que haya mas de un servicio extra
                $porciones = str_split($datos_reserva->servicios_extra,1);
                //echo $datos_reserva->servicios_extra;
                //return $porciones;
                foreach($porciones as $p){
                    $alquiler_serv_extra = new App\alquilerserviciosextra;
                    $alquiler_serv_extra->alquiler = $alquiler->id;
                    $alquiler_serv_extra->servicioExtra = intval($p);
                    $alquiler_serv_extra->save();
                }
            //listo tenemos el alquler
                if($request->btnAccion == 'pago_total'){
                    $monto = $pago_reserva->total;
                    $reservacion->saldo = 0.0;
                    $reservacion->save();
                }else{//volvemos a calcular los dias para SACAR EL ANTICIPO
                    $devolucion = new DateTime($alquiler->fecha_devolucion);
                    $salida     = new DateTime($alquiler->fecha_recogida);
                    $diferencia = $salida->diff($devolucion);
                    $dias = $diferencia->format('%a');
                    $total = $pago_reserva->total;
                    if($dias == 0)
                        $dias = 1;
                    $monto = $total / $dias;
                    $reservacion->saldo = $pago_reserva->total - $monto;
                }
                $reservacion->save();
                return view('reservacion_exitosa',compact('cliente','vehiculo','reservacion'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
     }


    

       
}
