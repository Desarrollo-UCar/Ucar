<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use DB;
use DateTime;
use Mail;
class PagesController extends Controller{
    public function inicio(){//SE RELLENA EL SELECT DE SUCURSALES
        $sucursales = App\Sucursal::all();
        return view('index',compact('sucursales'));
    }
    public function postFormularioindex(Request $request){ 
        $hora_actual = strtotime(date('H\:i'));
        $hora_de_recogida = strtotime(date(" H\:i", strtotime($request->horaRecogida)));
        $hora_de_devolucion = strtotime(date(" H\:i", strtotime($request->horaDevolucion)));
        $R = $request->fechaRecogida;
        $D = $request->fechaDevolucion;
        if($R=='0' || $D =='0')
            return back()->with('mensaje', 'Seleccione fechas!');
        if(($R == $D) & $hora_de_recogida > $hora_de_devolucion)
            return back()->with('mensaje', 'No puede tener una hora de devolución menor la de recogida!');
        if($R == date('Y\-m\-d') & $hora_de_recogida <= $hora_actual)
            return redirect()->back()->with('mensaje', 'Hora de recogida expiradal!');
        if($R == $D & $hora_de_recogida == $hora_de_devolucion)
            return redirect()->back()->with('mensaje', 'Dias y Horas Iguales!');
// buscamos el id de sucursal que hace referencia el lugar de recogida
        $sucursales = App\Sucursal::all();
        $sucursal = 1;
        foreach ($sucursales as $su) {
            if($su->nombre == $request->lugarrecogida)
                $sucursal = $su->idsucursal; 
        }
// Creamos el objeto
        $reserva_temp = new App\reserva_temp;
        $reserva_temp->fecha_hora_reserva = date('Y\-m\-d H\:i\:s');
        $reserva_temp->lugar_recogida = $sucursal;
        $reserva_temp->fecha_recogida = $request->fechaRecogida;
        $reserva_temp->hora_recogida = $request->horaRecogida;
        $reserva_temp->lugar_devolucion = $sucursal;
        $reserva_temp->fecha_devolucion = $request->fechaDevolucion;
        $reserva_temp->hora_devolucion = $request->horaDevolucion;
        $reserva_temp->codigo_descuento =  'en_construccion';
        $reserva_temp->tipo_vehiculo= 'en construccion';
        $reserva_temp->id_vehiculo = 0;
        $reserva_temp->total = 0;
        $reserva_temp->servicios_extra = 'ee';
        $reserva_temp->id_cliente = 0;
// Guardamos en la base de datos (equivalente al flush de Doctrine)
        $reserva_temp->save();
// consulta a los vehiculos disponibles
    $fecha_i = $request->fechaRecogida;
    $fecha_f = $request->fechaDevolucion;
    $vehiculos_disp = DB::select('SELECT * FROM vehiculos 
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
    WHERE vehiculosucursales.sucursal=2
    AND vehiculos.estatus ="disponible"
    AND vehiculosucursales.status ="ACTIVO"
    AND  alquilers.fecha_recogida <= ?
    AND alquilers.fecha_devolucion >= ?)ORDER BY vehiculos.precio,vehiculos.marca, vehiculos.modelo',
                                        [$sucursal,$sucursal,$fecha_i,$fecha_f,$fecha_i,$fecha_f]);
        $datos_reserva         = App\reserva_temp::findOrFail($reserva_temp->id);
        //obtener solo un vehiculo por marca y modelo
        $sucursal         = App\Sucursal::findOrFail($datos_reserva->lugar_recogida);

        if(!empty($vehiculos_disp)){
        $v_anterior = "h";
        $vehiculos_disponibles = [];
        foreach($vehiculos_disp as $v){
            if($v_anterior != "h"){
                //echo $v_anterior->marca . $v_anterior->modelo;
                //echo $v->marca . $v->modelo;
                if($v_anterior->marca . $v_anterior->modelo == $v->marca . $v->modelo){
                    $v_anterior = $v;
                }
                else{
                    $v_anterior = $v;
                    array_push($vehiculos_disponibles, $v);  
                    //echo "agregando";
                }
                //echo "---------------------";
            }
            else{
            $v_anterior = $v;
            //echo $v_anterior->marca . $v_anterior->modelo;
              //  echo $v->marca . $v->modelo;
            array_push($vehiculos_disponibles, $v);
            //echo "agregando"; 
            //echo "---------------------";
            }
        }
    }
       //return $datos_reserva; colocar un if en la vista para cuando el arreglo este vacio y mandar un mensaje de que no hay disponibilidad
       return view('reservar_auto',compact('vehiculos_disponibles', 'datos_reserva','sucursal'));         
    }
    
    public function pflota(){
        $vehiculos_disp = DB::select('SELECT *  FROM vehiculos ORDER BY precio,marca,modelo');

        if(!empty($vehiculos_disp)){
            $v_anterior = "h";
            $flota = [];
            foreach($vehiculos_disp as $v){
                if($v_anterior != "h"){
                    //echo $v_anterior->marca . $v_anterior->modelo;
                    //echo $v->marca . $v->modelo;
                    if($v_anterior->marca . $v_anterior->modelo == $v->marca . $v->modelo){
                        $v_anterior = $v;
                    }
                    else{
                        $v_anterior = $v;
                        array_push($flota, $v);  
                        //echo "agregando";
                    }
                    //echo "---------------------";
                }
                else{
                $v_anterior = $v;
                //echo $v_anterior->marca . $v_anterior->modelo;
                  //  echo $v->marca . $v->modelo;
                array_push($flota, $v);
                //echo "agregando"; 
                //echo "---------------------";
                }
            }
        }

        return view('flota',compact('flota'));
    }

    public function dashboard_cliente(){
    $correo   = auth()->user()->email;
    //el cliente no se esta creando al momento del registro
    $cliente= App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
        //pasarle los datos del cliente para proyectarlos arriba
        //obtener los datos de todas las reservaciones del cliente
        $reservas_cliente = DB::select('SELECT reservacions.id, reservacions.fecha_reservacion, reservacions.total, reservacions.saldo, sucursals.nombre,alquilers.id as id_alquiler,
        alquilers.fecha_recogida,alquilers.fecha_devolucion, alquilers.hora_recogida, alquilers.hora_devolucion,
        IF (DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida) = 0,1,DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida)) AS dias,
        vehiculos.marca, vehiculos.modelo,vehiculos.transmicion,vehiculos.puertas,vehiculos.rendimiento,vehiculos.anio,
        vehiculos.precio,vehiculos.pasajeros,vehiculos.maletero,vehiculos.color,vehiculos.cilindros,vehiculos.tipo, vehiculos.descripcion,
        vehiculos.foto
        FROM reservacions 
        INNER join alquilers ON alquilers.id_reservacion = reservacions.id 
        inner join vehiculos ON vehiculos.idvehiculo		 = alquilers.id_vehiculo 
        inner join sucursals ON sucursals.idsucursal		 = alquilers.lugar_recogida
        INNER JOIN pago_reservacions ON pago_reservacions.id_reserva	= reservacions.id
        where id_cliente = ?',[$cliente->idCliente]);
        //obtenemos los datos de los servicios extra
        $cliente_serv_extra = DB::select('SELECT alquiler,serviciosextras.idserviciosextra,serviciosextras.nombre,serviciosextras.precio
        FROM alquilerserviciosextras
        INNER JOIN serviciosextras ON serviciosextras.idserviciosextra = alquilerserviciosextras.servicioExtra
        INNER JOIN alquilers ON alquilerserviciosextras.alquiler = alquilers.id
        INNER JOIN reservacions ON reservacions.id = alquilers.id_reservacion
        INNER JOIN clientes ON clientes.idCliente = reservacions.id_cliente WHERE id_cliente = ?',[$cliente->idCliente]);
 
        return view('dashboard_cliente',compact('cliente','reservas_cliente','cliente_serv_extra'));
    }

    public function reservar_servicios_extra(Request $reserva){
        $id_vehiculo    = $reserva['id_vehiculo'];
        $id_reserva     = $reserva['id_reserva'];

        $vehiculo       = App\Vehiculo::findOrFail($id_vehiculo);
        $datos_reserva  = App\reserva_temp::findOrFail($id_reserva);

        //consulta para saber los servicios extra ocupados en la fecha indicada y en dicha sucursal
        $cantidad_servicios_extra_ocupados = DB::select('SELECT idserviciosextra AS servicioExtra, COUNT(*) AS cantidad FROM(
            SELECT serviciosextras.idserviciosextra, alquilers.id  FROM serviciosextras
              INNER JOIN servicioextrasucursales on servicioextrasucursales.serviciosextra = serviciosextras.idserviciosextra
              INNER JOIN alquilerserviciosextras ON serviciosextras.idserviciosExtra = alquilerserviciosextras.servicioExtra
              INNER JOIN alquilers ON alquilers.id = alquilerserviciosextras.alquiler
                WHERE servicioextrasucursales.sucursal = ?
              AND ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
              OR  ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
              UNION
              SELECT serviciosextras.idserviciosextra, alquilers.id FROM serviciosextras
          INNER JOIN servicioextrasucursales on servicioextrasucursales.serviciosextra = serviciosextras.idserviciosextra
          INNER JOIN alquilerserviciosextras ON serviciosextras.idserviciosextra = alquilerserviciosextras.servicioExtra
          INNER JOIN alquilers ON alquilers.id = alquilerserviciosextras.alquiler
            WHERE servicioextrasucursales.sucursal = ?
          AND  alquilers.fecha_recogida >= ?
          AND alquilers.fecha_devolucion <= ?) tablita GROUP BY idserviciosextra
          ',[$datos_reserva->lugar_recogida,$datos_reserva->fecha_recogida,$datos_reserva->fecha_devolucion,$datos_reserva->lugar_recogida,$datos_reserva->fecha_recogida,$datos_reserva->fecha_devolucion]);
        //return $cantidad_servicios_extra_ocupados;
        //obtenemos los totales de servicios de sucursal
        $cantidad_servicios_extra_totales = DB::select('SELECT * FROM servicioextrasucursales where sucursal = ?',[$datos_reserva->lugar_recogida]);
        //return $cantidad_servicios_extra_totales ;
        //como ya tenemos la cantidad y el id del servicio extra que esta ocupados en la sucursal,
            //obtener los qye estan ocupadoos id y cantidad por sucursal
            // filtrar los que estan disponibles segun la tabla servicios extra sucursal
           // $total_s_e_por_sucursal  = App\servicioextrasucursales::all();
            $servicios_extra_antes = [];
            if(empty($cantidad_servicios_extra_ocupados)){
                $servicios_extra_antes = $cantidad_servicios_extra_totales;
            }else{
                foreach ($cantidad_servicios_extra_totales as $servicio_total) {
                    $encontrado = 0;
                    foreach($cantidad_servicios_extra_ocupados as $servicio_ocupado){

                       // echo('Total '.$servicio_total->serviciosextra.' Ocupado: '. $servicio_ocupado->servicioExtra);
                        if($servicio_total->serviciosextra == $servicio_ocupado->servicioExtra){ // ya filtramos solo los servicios perteneciientes a a la s=ucursal
                            if($servicio_total->cantidad > $servicio_ocupado->cantidad){
                                array_push($servicios_extra_antes, $servicio_total);  //falta obtener los datos a proyectar de la tabla serviciosextra

                            }
                            $encontrado = 1;
                            //echo('encontrado'); 
                        }

                    }
                    //dd('----'.$encontrado); 
                        if($encontrado == 0)
                        array_push($servicios_extra_antes, $servicio_total);
                }
            }
            //--------------------------------------------

   


            //return $servicios_extra_antes;
            $servicios_e  = App\serviciosextras::all();
            $servicios_extra = [];
            //obtener los datos necesarios a proyectar        
            foreach ($servicios_e as $extra_datos) {
                foreach($servicios_extra_antes as $extra){   
                    if($extra_datos->idserviciosextra == $extra->serviciosextra){
                        array_push($servicios_extra, $extra_datos); 
                    }
                }
            }
            $sucursal         = App\Sucursal::findOrFail($datos_reserva->lugar_recogida);
        // cierre de consulta de servicios extra en las fechas indicadas
        return view('reservar_servicios_extra',compact('vehiculo','datos_reserva','servicios_extra','sucursal'));
    }

    public function reservar_realizar_pago(Request $reserva){
        $id_vehiculo     = $reserva['id_vehiculo'];
        $id_reserva      = $reserva['id_reserva'];
        $servicios     = $reserva['id'];

        $vehiculo       = App\Vehiculo::findOrFail($id_vehiculo);
        $datos_reserva  = App\reserva_temp::findOrFail($id_reserva);
        $devolucion = new DateTime($datos_reserva->fecha_devolucion);
        $salida     = new DateTime($datos_reserva->fecha_recogida);
        $diferencia = $salida->diff($devolucion);
        $dias = $diferencia->format('%a');
        if($dias == 0)
            $dias = 1;
        $servicios_extra = [];
        $total_serv_extra = 0; 
        if(is_array($servicios)){
            if(count($servicios) > 0 ){
                foreach ($servicios as $valor) {
                    $datos = App\serviciosextras::findOrFail($valor);
                    $datos->precioRenta = $datos->precio * intval($dias);
                    $total_serv_extra += $datos->precio * intval($dias);
                    array_push($servicios_extra, $datos); 
                }
            }
        }
        $alquiler = intval($vehiculo->precio) * intval($dias);
        $totalf = $alquiler + $total_serv_extra;
        $total = number_format($totalf,2);
        //actualizar tabla temporal de la reserva
    $datos_reserva->id_vehiculo = $vehiculo->idvehiculo;
    $datos_reserva->total = $totalf;
    //convertir a cadena para poder alamcenar los datos FORMATO id_servicio-cantidad, id_servicio-cantidad,... 
    $cadena_serv_extra = "";
    if(is_array($servicios)){
        if(count($servicios) > 0 ){
            foreach ($servicios as $valor)
                $cadena_serv_extra = $cadena_serv_extra . $valor;
        }
    }
    $datos_reserva->servicios_extra = $cadena_serv_extra;
    $datos_reserva->save();
    $sucursal         = App\Sucursal::findOrFail($datos_reserva->lugar_recogida);
        return view('reservar_realizar_pago',
            compact('vehiculo','datos_reserva','servicios_extra','dias','alquiler','subtotal','total','sucursal'));
    }

public function pago_paypal(Request $reserva){//suponemos que el cliente ya esta logeado
    $correo   = auth()->user()->email;
//el cliente no se esta creando al momento del registro
    $cliente= App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
    $datos_reserva  = App\reserva_temp::findOrFail($reserva->id_reserva);
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
    $pago_reserva->garantia_datos = 'por rellenar en mostrador';
    $pago_reserva->fecha = date('Y\-m\-d H\:i\:s');
    $pago_reserva->total = $reservacion->total;
    $pago_reserva->estatus = 'pendiente';
    $pago_reserva->reservacion = 0;
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
    if($reserva->btnAccion == 'pago_total'){
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
    //obtener los datos de todas las reservaciones del cliente
    $reserva_correo = DB::select('SELECT reservacions.id, alquilers.id AS id_alquiler, reservacions.fecha_reservacion, reservacions.total,
    reservacions.saldo, sucursals.nombre, alquilers.fecha_recogida,alquilers.fecha_devolucion, alquilers.hora_recogida, alquilers.hora_devolucion,
    IF (DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida) = 0,1,DATEDIFF(alquilers.fecha_devolucion , alquilers.fecha_recogida)) AS dias,
    vehiculos.marca, vehiculos.modelo,vehiculos.transmicion,vehiculos.puertas,vehiculos.rendimiento,vehiculos.anio,
    vehiculos.precio,vehiculos.pasajeros,vehiculos.maletero,vehiculos.color,vehiculos.cilindros,vehiculos.tipo, vehiculos.descripcion,vehiculos.foto
    FROM reservacions
    INNER join alquilers ON alquilers.id_reservacion = reservacions.id 
    inner join vehiculos ON vehiculos.idvehiculo		 = alquilers.id_vehiculo 
    inner join sucursals ON sucursals.idsucursal		 = alquilers.lugar_recogida
    INNER JOIN pago_reservacions ON pago_reservacions.id_reserva	= reservacions.id
    where reservacions.id = ?',[$reservacion->id]);
    //obtenemos los datos de los servicios extra
    $serv_extra_correo = DB::select('SELECT alquiler,serviciosextras.idserviciosextra,serviciosextras.nombre,serviciosextras.precio
    FROM alquilerserviciosextras
    INNER JOIN serviciosextras ON serviciosextras.idserviciosextra = alquilerserviciosextras.servicioExtra
    INNER JOIN alquilers ON alquilerserviciosextras.alquiler = alquilers.id
    INNER JOIN reservacions ON reservacions.id = alquilers.id_reservacion
    INNER JOIN clientes ON clientes.idCliente = reservacions.id_cliente WHERE reservacions.id = ?',[$reservacion->id]);
    //Mail::to($correo)->send(new App\Mail\Enviar($reserva_correo,$serv_extra_correo));
    $reservacion = $reserva_correo;
    $serv_extra = $serv_extra_correo;
    $asunto = 'Confirmacion de Reserva';
//////-------------------------
    Mail::send('mails.correo_reserva',compact('reservacion','serv_extra'), function ($message) use ($asunto,$correo,$reservacion) {
        $message->from('ucardesarollo@gmail.com', 'Ucar');
        $message->to($correo)->subject($asunto);
        foreach($reservacion as $reserva){
            $message->attach($reserva->foto);
        }
    });
/////////-------------------------
    return view('pago',compact('monto','alquiler'));
    }

    public function validar_logeo(Request $reserva){
        $r     = $reserva['id_reserva'];
        $datos_reserva  = App\reserva_temp::findOrFail($r);
        $devolucion = new DateTime($datos_reserva->fecha_devolucion);
        $salida     = new DateTime($datos_reserva->fecha_recogida);
        $diferencia = $salida->diff($devolucion);
        $dias = $diferencia->format('%a');
        if($dias == 0)
            $dias = 1;
        $anticipo = $datos_reserva->total / $dias;
        return view('seleccionar_forma_de_pago',compact('datos_reserva','anticipo'));
    }

    public function despues_de_pago(Request $pago){
        $respuesta = $pago['nacionalidad'];
        return $respuesta;
                return response()->json(['success'=>'EXITO']);
        return 'hola r';
        return view('bienvenida');
    }
}