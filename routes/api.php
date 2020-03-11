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

Route::middleware('auth:api')->post('/clientes', 'ClienteController@store');
Route::middleware('auth:api')->get('/clientes/{cliente}', 'ClienteController@show');
Route::middleware('auth:api')->put('/clientes/{cliente}', 'ClienteController@update');
Route::middleware('auth:api')->patch('/clientes/{cliente}', 'ClienteController@update');
Route::middleware('auth:api')->delete('/clientes/{cliente}', 'ClienteController@destroy');
