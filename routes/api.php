<?php

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:api')->group(function(){
//     Route::get('usuario', [UsuarioController::class, 'index']);
// });

Route::post('login', [AccessTokenController::class, 'issueToken'])
    ->middleware(['api-login', 'throttle']);

Route::post('register', [RegisterUserController::class, 'register']);

Route::resource('/usuario', UsuarioController::class)->except('index')->middleware('auth:api');

Route::resource('/dispositivo', UsuarioController::class);

Route::resource('/inmueble', UsuarioController::class);