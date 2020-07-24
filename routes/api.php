<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/home', 'HomeController@index')->name('home');

/**
 * RUTAS PARA RECURSO ROLES DEL SISTEMA
 */
Route::resource('roles','RoleController',['except'=>[
    'create','edit'
]]);

/**
 * RUTAS PARA RECURSO USUARIO DEL SISTEMA (ADMINISTRADORES POR AHORA)
 */
Route::resource('users','UserController',['except'=>[
    'create','edit'
]]);

/**
 * RUTAS PARA EL RECURSO CLIENTES O PROPIETARIOS
 */
Route::resource('clients','ClientController',['except'=>[
    'create','edit'
]]);

/**
 * RUTAS PARA RECURSO MARCAS DE VEHICULOS
 */
Route::resource('brands','BrandController',['except'=>[
    'create','edit'
]]);

/**
 * RUTAS PARA RECURSO VEHICULO
 */
Route::resource('vehicles','VehicleController',['except'=>[
    'create','edit'
]]);


