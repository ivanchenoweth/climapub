<?php

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
    return view('welcome');
});

Auth::routes([
    'register'=>false,
    'reset'=>false,
    'verify'=>false,
    'confirm'=>false
    ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cons2', 'App\Http\Controllers\admin\ClimasController@cons2');
Route::get('/cons1', 'App\Http\Controllers\admin\ClimasController@cons1');

Route::prefix('admin')->group(function () {   

    Route::post('Climasrepos/repo', 'App\Http\Controllers\admin\ClimasController@climasrepo');
    Route::post('Climas/search', 'App\Http\Controllers\admin\ClimasController@search');

    Route::get('/repo/{action}', 'App\Http\Controllers\admin\ClimasController@repo');
    Route::get('/exp/{action}', 'App\Http\Controllers\admin\ClimasController@exp');

    Route::get('/importUsuarios', 'App\Http\Controllers\admin\UsuariosController@indeximport');
    Route::post('/importUsuarios/import', 'App\Http\Controllers\admin\UsuariosController@import');

    Route::get('/importClimas', 'App\Http\Controllers\admin\ClimasController@indeximport');
    Route::post('/importClimas/import', 'App\Http\Controllers\admin\ClimasController@import');

    Route::get('/importPlantillas', 'App\Http\Controllers\admin\PlantillasController@indeximport');
    Route::post('/importPlantillas/import', 'App\Http\Controllers\admin\PlantillasController@import');

    Route::resource('/Periodos', App\Http\Controllers\admin\PeriodosController::class);
    Route::resource('/Perfilusers', App\Http\Controllers\admin\PerfilusersController::class);
    Route::resource('/Perfilclimas', App\Http\Controllers\admin\PerfilclimasController::class);
    Route::resource('/Usuarios', App\Http\Controllers\admin\UsuariosController::class);
    Route::resource('/Climas', App\Http\Controllers\admin\ClimasController::class);
    Route::resource('/Plantillas', App\Http\Controllers\admin\PlantillasController::class);
});