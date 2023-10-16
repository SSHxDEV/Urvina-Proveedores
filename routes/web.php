<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;


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
Route::redirect('/', 'es/inicio');
Route::prefix('{language}')->group(function () {

    Route::get('/', function () {
        return view('login');
    });

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    // Login
    Route::post('/validar-registro', 'LoginController@login')->name('validar-registro');
    // Logout
    Route::get('/salir', 'LoginController@logout')->name('salir');
    // Inicio
    Route::get('/inicio', 'InicioController@Home')->name('home');

    //Perfil
    Route::get('/perfil', 'UserController@UpdateUser')->name('updateuser');
    Route::post('/update-perfil', 'UserController@UpdateInfoUser')->name('updateinfouser');

    //Subir Factura
    Route::get('/factura-form', 'ValidadorController@Form')->name('factura-form');
    Route::post('/upload-bill', 'ValidadorController@Individual')->name('upload-bill');
    Route::get('/conf-factindiv', 'ValidadorController@Form')->name('conf-findiv');

    //Subir ZIP
    Route::get('/factura-zip', 'ValidadorController@FormZip')->name('factura-zip');
    Route::post('/upload-zip', 'ValidadorController@ZIP')->name('upload-zip');

    //Consultar facturas
    Route::get('/facturas-list', 'CheckBillController@Lista')->name('facturas-list');
    Route::get('/factura-show/{factura?}', 'CheckBillController@ShowFactura')->name('factura-show');
    Route::get('/docs-view', 'CheckBillController@DocsView')->name('docs-view');
    Route::post('/upload-pdf', 'CheckBillController@UploadFaltante')->name('upload-pdf');

    //Agregar Orden Compra
    Route::post('/zip-voc', 'ValidadorController@VerifyUSIOrder')->name('zip-voc');
    Route::post('/add-order', 'CheckBillControlleR@AddBuyOrder')->name('add-order');

    //Consulta de Ordenes ( FINANZAS )
    Route::get('/facturas-sup/{receptor?}', 'SupervisionController@Lista')->name('facturas-sup');
    Route::get('/proveedor-sup/{receptor?}', 'SupervisionController@proveedores')->name('proveedor-sup');
    Route::get('/user-bill-list/{IdUser?}', 'SupervisionController@ShowUserListBill')->name('Billprov-sup');
    Route::get('/sup-factura-show/{factura?}', 'SupervisionController@SupShowFactura')->name('sup-factura-show');
    Route::post('/sup-upload-pdf', 'SupervisionController@UploadFaltante')->name('sup-upload-pdf');
    Route::post('/actualizar-estatus', 'SupervisionController@actualizarEstatus')->name('actualizarEstatus');
    Route::post('/eliminar-factura/{id}', 'SupervisionController@DeleteFactura')->name('eliminar-factura');






//Pruebas
Route::get('/array-comparer/{orden?}', 'PruebasController@ArrayComparer')->name('arraycomparer');

//Herramientas
Route::get('/phpinfo', function() {
    phpinfo();
});





});











