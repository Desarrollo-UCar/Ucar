<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
//use DB;
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
            return redirect()->back()->with('mensaje', 'En dias iguales, la fecha de devolucion no puede ser menor a la de recogida.');
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
    if($request->reserva_anterior != null)
        $reserva_temp->id_reserva_anterior = $request->reserva_anterior;
    else
        $reserva_temp->id_reserva_anterior = 0;

    if($reserva_temp->estatus != 'reserva_finalizada'){
        $reserva_temp->estatus = 'consulta_disponibles';
     }
// Guardamos en la base de datos (equivalente al flush de Doctrine)
        $reserva_temp->save();
// consulta a los vehiculos disponibles
    $fecha_i = $request->fechaRecogida;
    $fecha_f = $request->fechaDevolucion;

    //----------------------------------------------!MODIFICACION¡
    $devolucion = new DateTime($fecha_f);
    $salida     = new DateTime($fecha_i);
    $diferencia = $salida->diff($devolucion);
    $dias = $diferencia->format('%a');

    $fecha_ii = $fecha_i;
    $fecha_ff = $fecha_f;

    if($dias > 1){
       $fecha_ii = date("Y-m-d",strtotime($fecha_i."+ 1 day"));//fecha de inicio dentro del rango
       $fecha_ff = date("Y-m-d",strtotime($fecha_f."- 1 day"));//fecha de fin dentro del rango
       //return $fecha_ii;
    }

    $hora_r =new DateTime($request->horaRecogida);
    $hora_r->modify('-1 hours');
    $hora_r->format('H:i:s');

    $hora_d =new DateTime($request->horaDevolucion);
    $hora_d->modify('+1 hours');
    $hora_d->format('H:i:s');

    $hora_dd = (string)$hora_d->format('H:i:s');//conversion de horas
    $hora_rr = (string)$hora_r->format('H:i:s');
    //return $hora_dd;

    $vehiculos_disp = DB::select('SELECT * FROM vehiculos 
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculos.idvehiculo NOT IN (
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND (? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion
    OR ? BETWEEN alquilers.fecha_recogida AND alquilers.fecha_devolucion)
    UNION
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND  alquilers.fecha_recogida >= ?
    AND alquilers.fecha_devolucion <= ?
    UNION
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND  alquilers.fecha_devolucion = ?
    AND alquilers.hora_devolucion >= ?
	UNION
    SELECT vehiculos.idvehiculo FROM vehiculos  
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    INNER JOIN alquilers ON alquilers.id_vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND alquilers.estatus != "cancelado"
    AND  alquilers.fecha_recogida = ?
    AND alquilers.hora_recogida <= ?
    UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
    AND  reserva_temps.estatus != "cancelada"
    AND ( ? BETWEEN reserva_temps.fecha_recogida AND reserva_temps.fecha_devolucion
    OR ? BETWEEN reserva_temps.fecha_recogida AND reserva_temps.fecha_devolucion)
    UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
   AND reserva_temps.estatus != "cancelada"
    AND  reserva_temps.fecha_recogida >= ?
    AND reserva_temps.fecha_devolucion <= ?
    UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
   AND reserva_temps.estatus != "cancelada"
    AND  reserva_temps.fecha_devolucion = ?
    AND reserva_temps.hora_devolucion >= ?
	UNION
    SELECT reserva_temps.id_vehiculo FROM reserva_temps
   INNER JOIN vehiculos ON vehiculos.idvehiculo = reserva_temps.id_vehiculo
    INNER JOIN vehiculosucursales ON vehiculosucursales.vehiculo = vehiculos.idvehiculo
    WHERE vehiculosucursales.sucursal=?
    AND vehiculos.estatus ="ACTIVO"
    AND vehiculosucursales.status ="ACTIVO"
    AND reserva_temps.estatus != "reserva_finalizada"
   AND reserva_temps.estatus != "cancelada"
    AND  reserva_temps.fecha_recogida = ?
    AND reserva_temps.hora_recogida <= ?)ORDER BY vehiculos.precio,vehiculos.marca, vehiculos.modelo',
                                        [$sucursal,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_i,$hora_rr,$sucursal,$fecha_f,$hora_dd,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff,$sucursal,$fecha_ii,$fecha_ff]);

        $datos_reserva         = App\reserva_temp::findOrFail($reserva_temp->id);
        //obtener solo un vehiculo por marca y modelo

        $sucursal         = App\Sucursal::findOrFail($datos_reserva->lugar_recogida);
        $vehiculos_disponibles = [];
        if(!empty($vehiculos_disp)){
        $v_anterior = "h";


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
    //return $vehiculos_disp;
       //return $datos_reserva; colocar un if en la vista para cuando el arreglo este vacio y mandar un mensaje de que no hay disponibilidad
       return view('reservar_auto',compact('vehiculos_disponibles', 'datos_reserva','sucursal','sucursales'));         
    }
    
    public function pflota(){
        $flota = DB::table('vehiculos')->select('marca', 'modelo','transmicion','puertas','rendimiento',
        'estatus','anio','precio','pasajeros','maletero','color','cilindros','kilometraje','tipo','descripcion',
        'foto','foto_derecha','foto_izquierda','foto_frente','foto_trasera')
        ->orderBy('precio','desc','marca','desc','modelo','desc')->distinct()->paginate(6); 
        $sucursales = App\Sucursal::all();
        return view('flota',compact('flota','sucursales'));
    }

    public function dashboard_cliente(){
    $correo   = auth()->user()->email;
    //el cliente no se esta creando al momento del registro
    $cliente= App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
        //pasarle los datos del cliente para proyectarlos arriba
        //obtener los datos de todas las reservaciones del cliente
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
        inner join sucursals ON sucursals.idsucursal		 = alquilers.lugar_recogida
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
        return view('dashboard_cliente',compact('cliente','reservas_cliente','cliente_serv_extra','sucursales'));
    }

    public function mi_perfil(){
        $correo  = auth()->user()->email;
        $cliente = App\Cliente::where('correo','=',$correo)->first();//buscamos datos del cliente que ya esta logeado
        $oko = 0;
        $sucursales = App\Sucursal::all();
        return view('mi_perfil',compact('cliente','oko','sucursales'));
    }

    public function reservar_servicios_extra(Request $reserva){
        $id_vehiculo    = $reserva['id_vehiculo'];
        $id_reserva     = $reserva['id_reserva'];

        $vehiculo       = App\Vehiculo::findOrFail($id_vehiculo);
        $datos_reserva  = App\reserva_temp::findOrFail($id_reserva);
    if($datos_reserva->estatus != 'reserva_finalizada'){
        $datos_reserva->estatus = 'reserva_servcios_extra';
        $datos_reserva->id_vehiculo = $vehiculo->idvehiculo;
        $datos_reserva->save();
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
        $sucursales = App\Sucursal::all();
        return view('reservar_servicios_extra',compact('vehiculo','datos_reserva','servicios_extra','sucursal','sucursales'));
    }
}
    public function reservar_realizar_pago(Request $reserva){
        $servicios     = $reserva['id'];

        $vehiculo       = App\Vehiculo::findOrFail($reserva['id_vehiculo']);
        $datos_reserva  = App\reserva_temp::findOrFail($reserva['id_reserva']);
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
    // $datos_reserva->id_vehiculo = $vehiculo->idvehiculo;
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
    if($datos_reserva->estatus != 'reserva_finalizada'){
        $datos_reserva->estatus = 'antes_de_pago';
    }
    $datos_reserva->save();
    $sucursal         = App\Sucursal::findOrFail($datos_reserva->lugar_recogida);
    $sucursales = App\Sucursal::all();
        return view('reservar_realizar_pago',compact('vehiculo','datos_reserva','servicios_extra','dias','alquiler','subtotal','total','sucursal','sucursales'));
    }
    
    public function validar_logeo(Request $reserva){
        $r     = $reserva['id_reserva'];
        $sucursales = App\Sucursal::all();
        $datos_reserva  = App\reserva_temp::findOrFail($r);
        $devolucion = new DateTime($datos_reserva->fecha_devolucion);
        $salida     = new DateTime($datos_reserva->fecha_recogida);
        $diferencia = $salida->diff($devolucion);
        $dias = $diferencia->format('%a');
        if($dias == 0)
            $dias = 1;
        $anticipo = $datos_reserva->total / $dias;
        //ajustar los montos a cobrar en el caso que sea una modificacion de reserva
        //return $datos_reserva;
        //if($datos_reserva->id_reserva_anterior != 0){     
          //  $this->actualizar_reserva( $anticipo,$r);
           
        //}else{
        return view('seleccionar_forma_de_pago',compact('datos_reserva','anticipo','sucursales'));
        //}
    }

    public function actualizar_reserva($anticipo, $id_temporal){
        //consultar las dos reservas
        $temporal_actual  = App\reserva_temp::findOrFail($id_temporal);//reservacion actual
        $reservacion = App\Reservacion::findOrFail($temporal_actual->id_reserva_anterior);//reservacion pasada
        $vehiculo       = App\Vehiculo::findOrFail($temporal_actual->id_vehiculo);
        //obtenemos el anticipo pasado
        $alquiler_pasado = App\Alquiler::where('id_reservacion', '=', $reservacion->id,'estatus', '!=', 'cancelado') ;//buscamos datos del cliente que ya esta logeado
        //obtenemos el anticipo de la reserva pasada
        
        $devolucion = new DateTime($alquiler_pasado->fecha_devolucion);
        $salida     = new DateTime($alquiler_pasado->fecha_recogida);
        $diferencia = $salida->diff($devolucion);
        $dias = $diferencia->format('%a');
        if($dias == 0)
            $dias = 1;
        $anticipo_pasado = $resevacion->total / $dias;
        //actualizar e3l registro de la reserva
            if($anticipo_pasado > $anticipo){//comparamos si el anticipo que ya pago el cliente es mayor al modificado y en ese caso ya no se le cobra el anticipo
                $reservacion->motivo_visita = 'por rellenar';
                $reservacion->comentarios = 'reservacion actualizada por el cliente';
                $reservacion->total = $temporal_actual->total;
                $reservacion->saldo = $temporal_actual->total-$anticipo_pasado;
                $reservacion->save();
                // listo tenemos la reserva
            // buscamos el vehiculo para proceder a crear el alquiler con todos los datos
                // Creamos el objeto para Pago_reservacion
                $alquiler = new App\Alquiler;
                $alquiler->id_reservacion = $reservacion->id;
                $alquiler->lugar_recogida = $temporal_actual->lugar_recogida;
                $alquiler->fecha_recogida = $temporal_actual->fecha_recogida;
                $alquiler->hora_recogida = $temporal_actual->hora_recogida;
                $alquiler->lugar_devolucion = $temporal_actual->lugar_devolucion;
                $alquiler->fecha_devolucion = $temporal_actual->fecha_devolucion;
                $alquiler->hora_devolucion = $temporal_actual->hora_devolucion;
                $alquiler->id_vehiculo = $temporal_actual->id_vehiculo;
                $alquiler->km_salida = $vehiculo->kilometraje;
                $alquiler->km_regresa = $vehiculo->kilometraje;
                $alquiler->nombreConductor = 'por rellenar';
                $alquiler->num_licencia = 'por rellenar';
                $alquiler->expedicion_licencia = 'por rellenar';
                $alquiler->expiracion_licencia = 'por rellenar';
                $alquiler->estatus = 'pendiente_recogida';
                $alquiler->save();
                //cancelar el pasado alquiler
                $alquiler_pasado = App\Alquiler::findOrFail($reservacion->id);
                $alquiler_pasado->estatus = 'cancelado';
                $alquiler_pasado->save();
                //rellenamos la tabla de alquileresservicioextra para llevar un control de l    os servicios eextra que tiene cada alquiler y cada reserva
                //tenemos uq hacer un foreach para rellenar en caso de que haya mas de un servicio extra
                $porciones = str_split($temporal_actual->servicios_extra,1);
                //echo $datos_reserva->servicios_extra;
                //return $porciones;
                foreach($porciones as $p){
                    $alquiler_serv_extra = new App\alquilerserviciosextra;
                    $alquiler_serv_extra->alquiler = $alquiler->id;
                    $alquiler_serv_extra->servicioExtra = intval($p);
                    $alquiler_serv_extra->save();
                }
                //----------------------
            }else{
                
            }
    }



}
