<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ConsultasCController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ReportesController;
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

    //Subir Factura
    Route::get('/factura-form', 'ValidadorController@Form')->name('factura-form');
    Route::post('/upload-bill', 'ValidadorController@Individual')->name('upload-bill');
    Route::get('/conf-factindiv', 'ValidadorController@Form')->name('conf-findiv');

    //Subir ZIP
    Route::get('/factura-zip', 'ValidadorController@FormZip')->name('factura-zip');
    Route::post('/upload-zip', 'ValidadorController@ZIP')->name('upload-zip');









});









