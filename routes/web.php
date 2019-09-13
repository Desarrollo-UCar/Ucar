<?php
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
Route::get('terminos_y_condiciones',  'PagesController@terminos_y_condiciones')->  name('terminos_y_condiciones') ;
Route::post('continuar_despues_de_verificacion',  'PagesController@continuar_despues_de_verificacion')->  name('continuar_despues_de_verificacion') ;

///routes para traslado controller
Route::post('renta_traslado_vehiculo','TrasladoController@renta_traslado_vehiculo')->name('renta_traslado_vehiculo') ;
Route::get('renta_traslado_datos',    'TrasladoController@renta_traslado_datos')-> name('renta_traslado_datos') ;
Route::get('solicita_info_traslado',  'TrasladoController@solicita_info_traslado')->name('solicita_info_traslado') ;
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
Route::get('pago/{reservacion}', 'ReservacionController@pago_Reservacion')->name('pagoReservacion');
Route::get('cancel/{id}', 'ReservacionController@cancela')->name('cancelaReservacion');
Route::resource('reservacion', 'ReservacionController');
Route::get('/customer/print-pdf/{reservacion}', 'ReservacionController@printPDF')->name('contrato');
Route::get('/customeer', 'ReservacionController@cambia_Vehiculo')->name('cambia_Vehiculo');
Route::get('/reservacion/{reservacion}', 'ReservacionController@garantia')->name('garantia');

Route::get('/detalle/{reservacion}', 'ReservacionController@show')->name('reservacion');
Route::get('/conductor','ReservacionController@registra_conductor')->name('conductor');
Route::get('/recibir','ReservacionController@recibe_vehiculo')->name('recibir');
Route::get('/reservacionesFecha','ReservacionController@fechaRecogida')->name('porFecha');
Route::get('/reservacionesCliente','ReservacionController@cliente')->name('porCliente');
Route::get('/reservacionesVehiculo','ReservacionController@vehiculo')->name('porVehiculo');
});
Route::get('clienteagregar', 'ClienteController@Agregar')->name('agregarcliente');