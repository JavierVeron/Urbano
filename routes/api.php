<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoClienteController;
use App\Http\Controllers\ClienteController;

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

Route::get('/grupoclientes', [GrupoClienteController::class, 'index']);
Route::get('/grupoclientes/buscar/{value}', [GrupoClienteController::class, 'buscar']);
Route::get('/grupocliente/{id}', [GrupoClienteController::class, 'show']);
Route::post('/grupocliente', [GrupoClienteController::class, 'store']);
Route::put('/grupocliente/{id}', [GrupoClienteController::class, 'update']);
Route::delete('/grupocliente/{id}', [GrupoClienteController::class, 'destroy']);
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/buscar/{value}', [ClienteController::class, 'buscar']);
Route::get('/clientes/filtrar/{id}', [ClienteController::class, 'filtrar']);
Route::get('/cliente/{id}', [ClienteController::class, 'show']);
Route::post('/cliente', [ClienteController::class, 'store']);
Route::put('/cliente/{id}', [ClienteController::class, 'update']);
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy']);