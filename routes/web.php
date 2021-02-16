<?php

use App\Empleado;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Hash;
/* RUTAS PARA INGRESO Y REGISTRO DE USUARIO Y CLIENTE */

Route::post('/ingresar', 'UserController@logearse')->name('user.logearse');  //esta es para cuando le damos al boton Ingresar
Route::get('/login', 'UserController@verLogin')->name('user.verLogin'); //para desplegar la vista del Login
Route::get('/cerrarSesion','UserController@cerrarSesion')->name('user.cerrarSesion');

Route::get('/', 'UserController@verLogin');

/* Route::get('/login', function () {
    return view('login');
}); */

Route::get('/', function () {
    return view('bienvenido');
})->name('indexPrincipal');


// usar dd("aaaaaaaaaa"); para debugear GA

/**CATEGORIA */
Route::resource('categoria', 'CategoriaController');  // es resource pq trabajamos con varias rutas 
Route::get('/categoria/delete/{id}','CategoriaController@delete');

/**PRODUCTO */
Route::resource('producto', 'ProductoController');  // es resource pq trabajamos con varias rutas 
Route::get('/producto/delete/{id}','ProductoController@delete');

Route::get('/gagaa/',function(){
return Hash::make('hola');
});

/**ORDEN */
Route::resource('orden', 'OrdenController');  // es resource pq trabajamos con varias rutas 
Route::get('/caja/cierre','CajaController@cerrarCaja')->name('caja.cierre');
Route::post('/caja/cierre/save','CajaController@guardarCerrarCaja');
Route::resource('caja', 'CajaController');


/* EMPLEADO CRUD CON USUARIO */
Route::get('/empleados/ver','EmpleadoController@listar')->name('empleados.ver');
Route::get('/empleados/verCrear','EmpleadoController@verCrear')->name('empleados.verCrear');
Route::post('/empleados/nuevo','EmpleadoController@store')->name('empleados.store');
Route::get('/empleados/delete/{id}','EmpleadoController@delete')->name('empleados.delete');
Route::get('/empleados/edit/{id}','EmpleadoController@edit')->name('empleados.edit');
Route::post('/empleados/update/{id}','EmpleadoController@update')->name('empleados.update');


/* LISTAR ORDENES SEGUN PERSPECTIVAS */
Route::get('/Ordenes/Cocina','OrdenController@listarParaCocina')->name('orden.listarParaCocina');
Route::get('/Ordenes/Caja','OrdenController@listarParaCaja')->name('orden.listarParaCaja');
Route::get('/Ordenes/Mesero','OrdenController@listarParaMesero')->name('orden.listarParaMesero');

Route::get('/Salas/Mesero','MesaController@listarMesa')->name('orden.listarSalas');


// funcion para pasar al siguiente estado
Route::get ('orden/{id}/next','OrdenController@siguiente')->name('orden.next');

Route::get ('orden/{id}/finalizar','OrdenController@finalizar')->name('orden.finalizar');

//para pagar desde caja
Route::get ('orden/{id}/ventanaPago','OrdenController@ventanaPago')->name('orden.ventanaPago');

Route::post('/pagarOrden/{id}','OrdenController@pagar')->name('orden.pagar');


Route::get('/orden/mesa/{id}','OrdenController@ordenMesa');
Route::post('/listarProductosCategoria/{id}','ProductoController@listarProductosCategoria');

Route::get('/buscarProducto/{id}','ProductoController@buscarProducto');
//Route::get ('categoria/{id}/confirmar','CategoriaController@confirmar')->name('categoria.confirmar');




Route::get ('producto/{codproducto}/confirmar','ProductoController@confirmar')->name('producto.confirmar');




Route::resource('Escuela', 'EscuelaController');  // es resource pq trabajamos con varias rutas 
Route::resource('Factultad', 'FacultadController');  // es resource pq trabajamos con varias rutas 
Route::resource('Estudiante', 'EstudianteController');  // es resource pq trabajamos con varias rutas 
Route::resource('cliente', 'ClienteController');  // es resource pq trabajamos con varias rutas 
Route::resource('unidad', 'UnidadController');  // es resource pq trabajamos con varias rutas 
Route::resource('cabeceraventa', 'CabeceraVentaController');  // es resource pq trabajamos con varias rutas 


Route::get ('unidad/{id}/confirmar','UnidadController@confirmar')->name('unidad.confirmar');
Route::get ('cliente/{id}/confirmar','ClienteController@confirmar')->name('cliente.confirmar');
Route::get ('Estudiante/{id}/confirmar','EstudianteController@confirmar')->name('Estudiante.confirmar');


/* datos productos */
Route::get('EncontrarProducto/{producto_id}', 'CabeceraVentaController@ProductoCodigo');
/* datos tipos */
Route::get('EncontrarTipo/{codigo}', 'CabeceraVentaController@PorTipo');



Route::get('cancelar', function () {
    return redirect()->route('categoria.index')->with('datos','Accion cancelada');
})->name('cancelar');



Route::post('/', 'UserController@login')->name('user.login');