<?php

Auth::routes(); 

Route::get('register', function () {
    return view('/auth/register');
})->name('register')->middleware('guest');

Route::get('login', function () {
    return view('/auth/login');
})->name('login')->middleware('guest');

Route::get('/','PagesController@inicio')->name('index') ;
Route::get('flota','PagesController@pflota')->name('flota');
Route::get('Reservacion','PagesController@reservacion')->name('reservacion') ;
Route::get('inicio_sesion_cliente','PagesController@inicio_sesion_cliente')->name('inicio_sesion_cliente') ;
Route::get('servicios', 'PagesController@servicios')->name('servicios') ;
Route::get('sucursales', 'PagesController@sucursales')->name('sucursales') ;
Route::get('sucursal_Puerto_Escondido', 'PagesController@sucursal_Puerto_Escondido')->name('sucursal_Puerto_Escondido') ;
Route::get('sucursal_Ixtepec', 'PagesController@sucursal_Ixtepec')->name('sucursal_Ixtepec') ;
Route::get('sucursal_Istmo', 'PagesController@sucursal_Istmo')->name('sucursal_Istmo') ;
Route::get('renta_auto', 'PagesController@renta_auto')->name('renta_auto') ;
Route::get('renta_motoneta', 'PagesController@renta_motoneta')->name('renta_motoneta') ;
Route::get('renta_flotilla', 'PagesController@renta_flotilla')->name('renta_flotilla') ;
Route::get('modificar_renta', 'PagesController@modificar_renta')->name('modificar_renta') ;
Route::post('postFormularioindex', 'PagesController@postFormularioindex')->name('postFormularioindex') ;
Route::get('reservar_servicios_extra', 'PagesController@reservar_servicios_extra')->name('reservar_servicios_extra') ;
Route::post('reservar_realizar_pago', 'PagesController@reservar_realizar_pago')->name('reservar_realizar_pago') ;
Route::get('renta_traslado', 'PagesController@renta_traslado')->name('renta_traslado') ;
Route::post('renta_traslado_vehiculo', 'PagesController@renta_traslado_vehiculo')->name('renta_traslado_vehiculo') ;
Route::get('renta_traslado_datos', 'PagesController@renta_traslado_datos')->name('renta_traslado_datos') ;
Route::get('solicita_informacion_traslado', 'PagesController@solicita_informacion_traslado')->name('solicita_informacion_traslado') ;
Route::get('validar_logeo', 'PagesController@validar_logeo')->name('validar_logeo')->middleware('auth');//estamos en esta probando el envio por get desde el formulario
Route::post('pago_paypal', 'PagesController@pago_paypal')->name('pago_paypal')->middleware('auth');

Route::get('en_construccion', 'PagesController@en_construccion')->name('en_construccion');//ruta para todas las que aun no estan
Route::get('dashboard_cliente', 'PagesController@dashboard_cliente')->name('dashboard_cliente')->middleware('auth') ;
Route::get('terminos_y_condiciones', 'PagesController@terminos_y_condiciones')->name('terminos_y_condiciones') ;
//______________________________________

Route::get('prueba', function () {
    return view('prueba');
})->name('prueba');

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
//Route::group(['middleware' => 'auth'], function () {

//Route::get('/usuario','UsuariosController@Login');

//Route::get('gerente', 'AdminController@inicio')->name('home');
Route::get('gerente/inicio', 'AdminController@inicioGerente')->name('homeG');//->middleware('auth');


//Route::get('gerente/usuarios/vehiculo/alta_vehiculo','AdminController@Vehiculo')->name('vehiculo');
Route::resource('vehiculo','VehiculoController');
Route::resource('products','ProductController');
Route::resource('sucursal','SucursalController');
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
Route::post('sucursalautocomplete','SucursalController@Autocomplete')->name('auto');
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