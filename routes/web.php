<?php

use App\Empleado;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Producto;
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
    if(Auth::id()=='')
        return redirect()->route('user.verLogin');
    else
        return redirect()->route( (new UserController())->miRutaPrincipal());

    return view('bienvenido');
})->name('indexPrincipal');



/* RUTAS SERVICIOS */
Route::get('/obtenerParametro/{id}','ParametroController@obtener')->name('parametros.obtener');

/* TESTEAR DB */
Route::get('/testeoDB', function()
{
    return Empresa::all();
});



/**CATEGORIA */
Route::resource('categoria', 'CategoriaController');  // es resource pq trabajamos con varias rutas 
Route::get('/categoria/delete/{id}','CategoriaController@delete');

/**PRODUCTO */
Route::get('/producto/verMenu/','ProductoController@verMenu')->name('producto.verMenu');;
Route::get('/producto/limpiarMenu/','ProductoController@limpiarMenu')->name('producto.limpiarMenu');;

Route::get('producto/añadirAlMenu/{id}','ProductoController@añadirAlMenu')->name('producto.añadirAlMenu');

Route::resource('producto', 'ProductoController');  // es resource pq trabajamos con varias rutas 



Route::get('/producto/delete/{id}','ProductoController@delete');

Route::get('/gagaa/',function(){
    return Empresa::getEmpresa();
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
Route::get('/Ordenes/Cocina/','OrdenController@listarParaCocina')->name('orden.listarParaCocina');
Route::get('/Ordenes/Caja/','OrdenController@listarParaCaja')->name('orden.listarParaCaja');
Route::get('/Ordenes/Mesero/','OrdenController@listarParaMesero')->name('orden.listarParaMesero');

Route::get('/Salas/Mesero','MesaController@listarMesa')->name('orden.listarSalas');

/* CRUD SALAS */
Route::get('/Sala/eliminar/{id}','SalaController@eliminar')->name('sala.eliminar');
Route::get('/Mesa/eliminar/{id}','SalaController@eliminarMesa')->name('mesa.eliminar');
Route::post('/Mesa/store/','SalaController@storeMesa')->name('mesa.store');

Route::resource('sala','SalaController');


/* CRUD MESAS */

// funcion para pasar al siguiente estado
Route::get ('orden/{id}/next','OrdenController@siguiente')->name('orden.next');


Route::get ('orden/{id}/finalizar','OrdenController@finalizar')->name('orden.finalizar');

//para pagar desde caja
Route::get ('orden/{id}/ventanaPago','OrdenController@ventanaPago')->name('orden.ventanaPago');

Route::post('/pagarOrden/{id}','OrdenController@pagar')->name('orden.pagar');
Route::get('/generarCDP/{id}','OrdenController@generarCDP');
Route::get('/visualizarRegistro','CajaController@visualizarRegistro');
Route::get('/visualizarOrdenes/{id}','CajaController@visualizarOrdenesDeRegistro');

Route::get('/orden/mesa/{id}','OrdenController@ordenMesa');
Route::get('/editarOrden/mesa/{id}','OrdenController@editarOrdenMesa');
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


/* REPORTES */
Route::get('/reportes/clientesPorOrdenes/','OrdenController@reportePorClientes')->name('orden.reportes.clientes');

Route::get('/reportes/dineroPorClientes/','OrdenController@reportePorClientesDinero')->name('orden.reportes.dineroClientes');




Route::get('cancelar', function () {
    return redirect()->route('categoria.index')->with('datos','Accion cancelada');
})->name('cancelar');



Route::post('/', 'UserController@login')->name('user.login');