<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\estadisticasController;
use App\Http\Controllers\proveedoresController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function() {
    return view('home');
});

Auth::routes();

// CONTROLADOR CON MIDDLEWARE AUTH
// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/faq', function(){
    return view('faq');
});
Route::get('/contact', function(){
    return view('contact');
});

Route::get('/proveedores', 'proveedoresController@listarProveedores');
Route::get('/proveedores/alta', 'rubroController@listarRubro');
Route::post('/proveedores/alta','proveedoresController@create')->name('proveedores.create');
Route::post('proveedores/delete/{id}', 'proveedoresController@delete')->name('proveedores.delete');
Route::get('/proveedores/edit/{id}','proveedoresController@edit');
Route::post('/proveedores/edit/{id}','proveedoresController@editPost')->name('proveedores.actualizar');

Route::get('/sucursales', 'sucursalesController@listarSucursales');
Route::get('/sucursales/alta', 'sucursalesController@index');
Route::post('/sucursales/alta','sucursalesController@create')->name('sucursales.create');
Route::post('sucursales/delete/{id}', 'sucursalesController@delete')->name('sucursales.delete');
Route::get('/sucursales/edit/{id}','sucursalesController@edit');
Route::post('/sucursales/edit/{id}','sucursalesController@editPost')->name('sucursales.actualizar');

Route::get('/articulos', 'articuloController@listarArticulos');
Route::get('/articulos/alta', 'articuloController@index');
Route::post('/articulos/alta','articuloController@create')->name('articulo.create');
Route::post('articulos/delete/{id}', 'articuloController@delete')->name('articulo.delete');
Route::get('/articulos/edit/{id}','articuloController@edit');
Route::get('/articulo/{id}','articuloController@articuloId');
Route::post('/articulos/edit/{id}','articuloController@editPost')->name('articulo.actualizar');


Route::get('/cuentas', 'usuariosController@listarUsuarios');
Route::get('/empleados', 'usuariosController@listarEmpleados');
Route::post('cuentas/delete/{id}', 'usuariosController@delete');
Route::get('/cuentas/edit/{id}','usuariosController@edit');
Route::post('/cuentas/edit/{id}','usuariosController@editPost');

Route::get('/product/list', 'articuloController@listarArticulosVta')->middleware('auth');
Route::get('/store/{id}', 'articuloController@storeFiltrado');

// Route::get('/cart/show', 'cartController@show');
// Route::get('/cart/add/{product}', 'cartController@add');

// Productos agregados al carrito
Route::get('/carrito', 'cartController@index')->middleware('auth');

//Vaciar carrito
Route::get('/cart/empty', 'cartController@cartEmpty');


// Agregar productos al carrito
Route::post('/carrito/{id}', 'preferencesController@stored');

// Confirmar la compra
// Route::get('/carrito/confirm', 'cartController@confirm');
Route::post('/cartOK', 'cartController@confirm');


//Respuesta MP 
Route::get('/mp/success', 'mercadoPagoController@success');
Route::get('/mp/failure', 'mercadoPagoController@failure');
Route::get('/mp/pending', 'mercadoPagoController@pending');

//Reportes
Route::get('/reportes', function(){
    return view('r_reportes');
});
Route::get('/reportes/facturacion', 'facturacionController@index');
Route::post('/reportes/facturacion', 'facturacionController@facturacionFiltrado');
Route::get('/reporte/facturacionDiaria', 'facturacionController@facturacionDiaria');
Route::get('/reporte/facturacionAnx', 'facturacionController@facturacionAnx');
Route::post('/reporte/facturacionPorFecha', 'facturacionController@facturacionPorFecha');
Route::post('/reportes/facturacion/verDetalle/{id}', 'facturacionController@detalleFactura');

Route::get('/reportes/estadisticas', 'estadisticasController@index');
Route::post('/reportes/estadisticas', 'estadisticasController@indexGrafica');





