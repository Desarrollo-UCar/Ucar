<?php

use Illuminate\Support\Facades\Route;

Auth::routes(); 
  
Auth::routes(['verify' => true]);
Route::get('register', function () {return view('/auth/register');})->name('register')->middleware('guest');
Route::get('login', function () {return view('/auth/login');})->name('login')->middleware('guest');
//routes para PagesController
Route::get('/',                       'PagesController@inicio')->                  name('index') ;
Route::get('flota',                   'PagesController@pflota')->                  name('flota');
Route::post('postFormularioindex',    'PagesController@postFormularioindex')->     name('postFormularioindex') ;
Route::get('reservar_servicios_extra','PagesController@reservar_servicios_extra')->name('reservar_servicios_extra') ;
Route::post('reservar_realizar_pago', 'PagesController@reservar_realizar_pago')->  name('reservar_realizar_pago') ;
Route::get('validar_logeo',           'PagesController@validar_logeo')->           name('validar_logeo')->middleware(['auth', 'verified']);
Route::post('pago_paypal',            'PagesController@pago_paypal')->             name('pago_paypal')->middleware(['auth', 'verified']);
Route::post('correo_reserva',         'PagesController@correo_reserva')->          name('correo_reserva')->middleware(['auth', 'verified']);
Route::get('dashboard_cliente',       'PagesController@dashboard_cliente')->       name('dashboard_cliente')->middleware(['auth', 'verified']);
Route::get('despues_de_pago',         'PagesController@despues_de_pago')->         name('despues_de_pago')->middleware(['auth', 'verified']);
Route::get('terminos_y_condiciones',  'PagesController@terminos_y_condiciones')->  name('terminos_y_condiciones') ;
///routes para traslado controller
Route::post('renta_traslado_vehiculo', 'TrasladoController@renta_traslado_vehiculo')-> name('renta_traslado_vehiculo');//solicitud del cliente
Route::get('validar_logeo_traslado',            'TrasladoController@validar_logeo_traslado')->           name('validar_logeo_traslado')->middleware(['auth', 'verified']);
Route::get('validar_sin_logeo_traslado',        'TrasladoController@validar_sin_logeo_traslado')->       name('validar_sin_logeo_traslado');
//generar la cotizacion del lado del adminitrador
Route::get('vista_generar_cotizacion_traslado','SoloVistasController@vista_generar_cotizacion_traslado')->name('vista_generar_cotizacion_traslado');//cargar la vista inicial de administrador para cotizar el traslado
Route::get('calculo_costos_traslado',  'TrasladoController@calculo_costos_traslado')->name('calculo_costos_traslado') ;
Route::post('vehiculos_por_sucursal', 'TrasladoController@vehiculos_por_sucursal')-> name('vehiculos_por_sucursal');
Route::get('vehiculos_por_sucursal', 'TrasladoController@vehiculos_por_sucursal')-> name('vehiculos_por_sucursal');
Route::get('guardar_confirmacion_traslado', 'TrasladoController@guardar_confirmacion_traslado')-> name('guardar_confirmacion_traslado');
//Route::post('CreateImage','TrasladoController@store');
//routes para el pago de stripe 
Route::post('crear_pago_stripe', 'PagosStripeController@crear_pago_stripe')-> name('crear_pago_stripe');
//routes para envio de correos 
Route::post('correo_confirmacion_reserva', 'EmailController@correo_confirmacion_reserva')-> name('correo_confirmacion_reserva');
//routes para SoloVistasController
Route::get('Reservacion',             'SoloVistasController@reservacion')->         name('reservacion') ;
Route::get('servicios',               'SoloVistasController@servicios')->            name('servicios') ;
Route::get('sucursales',              'SoloVistasController@sucursales')->           name('sucursales') ;
Route::get('sucursal_P_Escondido',    'SoloVistasController@sucursal_P_Escondido')->name('sucursal_P_Escondido') ;
Route::get('sucursal_Ixtepec',        'SoloVistasController@sucursal_Ixtepec')->     name('sucursal_Ixtepec') ;
Route::get('sucursal_Istmo',          'SoloVistasController@sucursal_Istmo')->       name('sucursal_Istmo') ;
Route::get('renta_flotilla',          'SoloVistasController@renta_flotilla')->       name('renta_flotilla') ;
Route::get('en_construccion',         'SoloVistasController@en_construccion')->      name('en_construccion');//ruta para todas las que aun no estan
Route::get('renta_traslado',          'SoloVistasController@renta_traslado')->       name('renta_traslado') ;
Route::get('bienvenida',              'SoloVistasController@bienvenida')->           name('bienvenida');//bienvenida al cliente al verificar su cuenta de correo
//vamos a ver que onda con los pagos

////----------------------
Route::get('prueba', function () {return view('prueba');})->name('prueba');


//Route::get('gerente', 'AdminController@inicio')->name('home');

//Route::get('gerente/inicio', 'AdminController@inicioGerente')->name('homeG');

//Route::get('gerente/usuarios/empleados/administradores/inicio', 'AdminController@altaAdmin')->name('alta_Admin');

//Route::get('gerente/usuarios/empleados/chofer/alta_chofer', 'AdminController@nuevoChofer')->name('chofer');

//Route::get('gerente/usuarios/vehiculo/alta_vehiculo','AdminController@Vehiculo')->name('vehiculo');

//Route::get('gerente/usuarios/sucursal/alta_sucursal','AdminController@Sucursal')->name('sucursal');


/*Route::get('/', function () {
    return view('index');
})->name('index');*/


Route::resource('user','UsuariosController');
//Route::post('login','UsuariosController@login');
//Route::group(['role' => 'admin'], function () {

//Route::get('/usuario','UsuariosController@Login');

//Route::get('gerente', 'AdminController@inicio')->name('home');

Route::get('gerente/inicio', 'AdminController@inicioGerente')->name('homeG')->middleware('auth','roleAdmin:admin');

Route::group(['middleware' => 'auth','roleAdmin:admin'], function () {
//Route::get('gerente/usuarios/vehiculo/alta_vehiculo','AdminController@Vehiculo')->name('vehiculo');
Route::resource('vehiculo','VehiculoController');//admin
Route::resource('products','ProductController');//admin
Route::resource('sucursal','SucursalController');//admin
Route::resource('empleado','EmpleadoController');
Route::resource('servicioe', 'ServiciosExtraController');
Route::resource('mantenimiento', 'MantenimientoController');
Route::resource('tallerservicio', 'TallerServicioController');
Route::resource('cliente', 'ClienteController');
Route::get('mostrarmantenimiento', 'MantenimientoController@mostrar')->name('mostrarmantenimiento');
Route::get('editarmantenimieto', 'MantenimientoController@modificar')->name('modificarmantenimiento');
Route::get('modificar','EmpleadoController@modificar')->name('modificarempleado');
Route::get('modivehiculo','VehiculoController@modificar')->name('modificarvehiculo');
Route::get('modificarservicio','ServiciosExtraController@modificar')->name('modificarservicio');
Route::get('modificarsucursal','SucursalController@modificar')->name('modificarsucursal');
Route::get('vehiculomodelo','VehiculoController@Modelo')->name('modelovehiculo');//admin
Route::post('vehiculoinsert','VehiculoController@insertModelo')->name('insertmodelo');//admin
Route::post('clientemostrar', 'ClienteController@mostrar')->name('showcliente');
Route::post('sucursalModificarDatos','SucursalController@ModificarDatos')->name('modificardatos');
Route::post('sucursalModificarEmpleado','EmpleadoController@ModificarDatos')->name('datosempleado');
Route::post('vehiculoModificar','VehiculoController@ModificarDatos')->name('datosvehiculo');
Route::post('servicioModificar','ServiciosExtraController@ModificarDatos')->name('datoservicio');

//});


//Route::post('login','UsuariosController@login');


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//---------------------------------------------------------------------------mis rutas K
//rutas reservacion
Route::post('pago/', 'ReservacionController@pago_Reservacion')->name('pagoReservacion');
Route::get('cancel/{id}', 'ReservacionController@cancela')->name('cancelaReservacion');
Route::resource('reservacion', 'ReservacionController');
Route::get('/customer/print-pdf/{reservacion}', 'ReservacionController@printPDF')->name('contrato');
Route::get('/customeer', 'ReservacionController@cambia_Vehiculo')->name('cambia_Vehiculo');
Route::get('/reservacion/{reservacion}', 'ReservacionController@garantia')->name('garantia');

Route::get('/detalle/{reservacion}', 'ReservacionController@show')->name('reservacion');
Route::get('/traslados', 'ReservacionController@indexTraslado')->name('taslados');
Route::get('/conductor','ReservacionController@registra_conductor')->name('conductor');
Route::get('/recibir','ReservacionController@recibe_vehiculo')->name('recibir');
Route::get('/reservacionesFecha','ReservacionController@fechaRecogida')->name('porFecha');
Route::get('/reservacionesCliente','ReservacionController@cliente')->name('porCliente');
Route::get('/reservacionesVehiculo','ReservacionController@vehiculo')->name('porVehiculo');
});
Route::get('clienteagregar', 'ClienteController@Agregar')->name('agregarcliente');

Route::get('reportesFechaReservacion', 'ReportesController@fechaReservacion')->name ('reportesFechaReservacion');
Route::get('fechaAlquiler', 'ReportesController@fechaAlquiler')->name ('fechaAlquiler');
Route::get('fechaCobro', 'ReportesController@fechaCobro')->name ('fechaCobro');

Route::get('InicioReportes', 'ReportesController@index')->name ('InicioReportes');

Route::get('catalogos', 'MarcaVehiculoController@index')->name('catalogos');
Route::get('registrarMarca','MarcaVehiculoController@store')->name('registrarMarca');
Route::get('registrarModelo','ModeloVehiculoController@store')->name('registrarModelo');
Route::resource('marca', 'MarcaVehiculoController');
 //Route::resource('marcamodelo', 'MarcaModeloController');
Route::post('marcasmodelos','VehiculoController@Consultar')->name('marcasmodelos');