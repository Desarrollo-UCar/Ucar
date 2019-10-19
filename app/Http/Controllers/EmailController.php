<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use DB;
use DateTime;
use Mail;

class EmailController extends Controller{
    public static function correo_confirmacion_reserva(Request $request){//suponemos que el cliente ya esta logeado
        //obtener los datos de todas las reservaciones del cliente
        //return $request;
        $correo   = auth()->user()->email;
        $cliente= App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
       $reservas_cliente = DB::select('SELECT reservacions.id, reservacions.fecha_reservacion, reservacions.total, reservacions.saldo,
                sucursals.nombre,sucursals.telefono,alquilers.id as id_alquiler,
                alquilers.fecha_recogida,alquilers.fecha_devolucion, alquilers.hora_recogida, alquilers.hora_devolucion,
                IF (DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida) = 0,1,DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida)) AS dias,
                vehiculos.marca, vehiculos.modelo,vehiculos.transmicion,vehiculos.puertas,vehiculos.rendimiento,vehiculos.anio,
                vehiculos.precio,vehiculos.pasajeros,vehiculos.maletero,vehiculos.color,vehiculos.cilindros,vehiculos.tipo, vehiculos.descripcion,
                vehiculos.foto
                FROM reservacions 
                INNER join alquilers ON alquilers.id_reservacion = reservacions.id 
                inner join vehiculos ON vehiculos.idvehiculo		 = alquilers.id_vehiculo 
                inner join sucursals ON sucursals.idsucursal		        = alquilers.lugar_recogida
                INNER JOIN pago_reservacions ON pago_reservacions.id_reserva	= reservacions.id
                where id_cliente = ? ORDER BY reservacions.id desc',[$cliente->idCliente]);
                //obtenemos los datos de los servicios extra
                $cliente_serv_extra = DB::select('SELECT alquiler,serviciosextras.idserviciosextra,serviciosextras.nombre,serviciosextras.precio
                FROM alquilerserviciosextras
                INNER JOIN serviciosextras ON serviciosextras.idserviciosextra = alquilerserviciosextras.servicioExtra
                INNER JOIN alquilers ON alquilerserviciosextras.alquiler = alquilers.id
                INNER JOIN reservacions ON reservacions.id = alquilers.id_reservacion
                INNER JOIN clientes ON clientes.idCliente = reservacions.id_cliente WHERE id_cliente = ? ORDER BY reservacions.id desc',[$cliente->idCliente]);
          $sucursales = App\Sucursal::all();
         //enviar correo
         //PagosStripeController::correo_confirmacion_reserva($reservacion,$correo);
                return view('dashboard_cliente',compact('cliente','reservas_cliente','cliente_serv_extra','sucursales'));
   }



   
}
