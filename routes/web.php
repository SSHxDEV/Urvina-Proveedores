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

    //////////////////////////////////////// PROVEEDORES /////////////////////////////////////////

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

    /////////////////////////////////////// ADMINISTRACION ////////////////////////////////////////////////////////

    //Consulta de Ordenes ( FINANZAS )
    Route::get('/facturas-sup/{receptor?}', 'SupervisionController@Lista')->name('facturas-sup');
    Route::get('/proveedor-sup/{receptor?}', 'SupervisionController@proveedores')->name('proveedor-sup');
    Route::get('/user-bill-list/{IdUser?}/{receptor?}', 'SupervisionController@ShowUserListBill')->name('Billprov-sup');
    Route::get('/sup-factura-show/{factura?}', 'SupervisionController@SupShowFactura')->name('sup-factura-show');
    Route::post('/sup-upload-pdf', 'SupervisionController@UploadFaltante')->name('sup-upload-pdf');
    Route::post('/actualizar-estatus', 'SupervisionController@actualizarEstatus')->name('actualizarEstatus');
    Route::post('/eliminar-factura/{id}', 'SupervisionController@DeleteFactura')->name('eliminar-factura');

    //Administracion
    Route::get('/control-usuario', 'AdminController@ControlUsuario')->name('control-usuario');
    Route::get('/add-user', 'AdminController@AddUser')->name('add-user');
    Route::post('/add-usuario', 'AdminController@AddUsuario')->name('add-usuario');
    Route::get('/edit-user/{IdUser?}', 'AdminController@EditUser')->name('edit-user');
    Route::post('/delete-user/{IdUser?}', 'AdminController@DeleteUser')->name('delete-user');
    Route::post('/editar/form1', 'AdminController@guardar1');
    Route::post('/editar/form2', 'AdminController@guardar2');
    Route::post('/editar/form3', 'AdminController@guardar3');
    Route::post('/editar/form4', 'AdminController@guardar4');

    //////////////////////////////////// COLABORADORES ///////////////////////////////////////////////

    //Subir Factura
    Route::get('/col-factura-form', 'ColaboradorController@Form')->name('col-factura-form');
    Route::post('/col-upload-bill', 'ColaboradorController@Individual')->name('col-upload-bill');
    Route::get('/col-conf-factindiv', 'ColaboradorController@Form')->name('col-conf-findiv');

    //Subir ZIP
    Route::get('/col-factura-zip', 'ColaboradorController@FormZip')->name('col-factura-zip');
    Route::post('/col-upload-zip', 'ColaboradorController@ZIP')->name('col-upload-zip');

    //Consultar facturas
    Route::get('/col-facturas-list', 'ColaboradorController@Lista')->name('col-facturas-list');
    Route::get('/col-factura-show/{factura?}', 'ColaboradorController@ShowFactura')->name('col-factura-show');
    Route::get('/col-docs-view', 'ColaboradorController@DocsView')->name('col-docs-view');
    Route::post('/col-upload-pdf', 'ColaboradorController@UploadFaltante')->name('col-upload-pdf');



//Pruebas
Route::get('/array-comparer/{orden?}', 'PruebasController@ArrayComparer')->name('arraycomparer');

//Herramientas
Route::get('/phpinfo', function() {
    phpinfo();
});





});











