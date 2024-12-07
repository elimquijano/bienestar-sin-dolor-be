<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\EnfermedadController;
use App\Http\Controllers\EnfermedadSintomaController;
use App\Http\Controllers\InteraccionController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\PrivilegioController;
use App\Http\Controllers\RadiografiaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPrivilegioController;
use App\Http\Controllers\RolUserController;
use App\Http\Controllers\SintomaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'users']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'search']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::post('/userupdate/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
Route::put('/user/{id}/change-password', [UserController::class, 'changePassword']);

Route::get('/rol', [RolController::class, 'search']);
Route::get('/rol/{id}', [RolController::class, 'show']);
Route::post('/rol', [RolController::class, 'store']);
Route::put('/rol/{id}', [RolController::class, 'update']);
Route::delete('/rol/{id}', [RolController::class, 'destroy']);

Route::get('/modulo', [ModuloController::class, 'search']);
Route::get('/modulo/{id}', [ModuloController::class, 'show']);
Route::post('/modulo', [ModuloController::class, 'store']);
Route::put('/modulo/{id}', [ModuloController::class, 'update']);
Route::delete('/modulo/{id}', [ModuloController::class, 'destroy']);

Route::get('/privilegio', [PrivilegioController::class, 'search']);
Route::get('/privilegio/{id}', [PrivilegioController::class, 'show']);
Route::post('/privilegio', [PrivilegioController::class, 'store']);
Route::put('/privilegio/{id}', [PrivilegioController::class, 'update']);
Route::delete('/privilegio/{id}', [PrivilegioController::class, 'destroy']);
Route::get('/privilegiotipo', [PrivilegioController::class, 'tipePrivilegio']);

Route::get('/rolprivilegio', [RolPrivilegioController::class, 'search']);
Route::get('/rolprivilegio/{id}', [RolPrivilegioController::class, 'show']);
Route::post('/rolprivilegio', [RolPrivilegioController::class, 'store']);
Route::put('/rolprivilegio/{id}', [RolPrivilegioController::class, 'update']);
Route::delete('/rolprivilegio/{id}', [RolPrivilegioController::class, 'destroy']);

Route::get('/roluser', [RolUserController::class, 'search']);
Route::get('/roluser/{id}', [RolUserController::class, 'show']);
Route::post('/roluser', [RolUserController::class, 'store']);
Route::put('/roluser/{id}', [RolUserController::class, 'update']);
Route::delete('/roluser/{id}', [RolUserController::class, 'destroy']);

Route::get('/conversation', [ConversationController::class, 'search']);
/* Route::get('/conversation/{id}', [ConversationController::class, 'show']);
Route::get('/conversationall', [ConversationController::class, 'index']); */
Route::post('/conversation', [ConversationController::class, 'store']);
/* Route::put('/conversation/{id}', [ConversationController::class, 'update']);
Route::delete('/conversation/{id}', [ConversationController::class, 'destroy']); */

Route::get('/interaccion', [InteraccionController::class, 'search']);
/* Route::get('/interaccionall', [InteraccionController::class, 'index']);
Route::get('/interaccion/{id}', [InteraccionController::class, 'show']); */
Route::post('/interaccion', [InteraccionController::class, 'store']);
/* Route::put('/interaccion/{id}', [InteraccionController::class, 'update']);
Route::delete('/interaccion/{id}', [InteraccionController::class, 'destroy']); */

Route::get('/especialista', [EspecialistaController::class, 'search']);
Route::get('/especialistaall', [EspecialistaController::class, 'index']);
Route::get('/especialista/{id}', [EspecialistaController::class, 'show']);
Route::post('/especialista', [EspecialistaController::class, 'store']);
Route::put('/especialista/{id}', [EspecialistaController::class, 'update']);
Route::delete('/especialista/{id}', [EspecialistaController::class, 'destroy']);

Route::get('/categoria', [CategoriaController::class, 'search']);
Route::get('/categoriaall', [CategoriaController::class, 'index']);
Route::get('/categoria/{id}', [CategoriaController::class, 'show']);
Route::post('/categoria', [CategoriaController::class, 'store']);
Route::put('/categoria/{id}', [CategoriaController::class, 'update']);
Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy']);

Route::get('/enfermedad', [EnfermedadController::class, 'search']);
Route::get('/enfermedadall', [EnfermedadController::class, 'index']);
Route::get('/enfermedadwithsintoma', [EnfermedadController::class, 'withSintoma']);
Route::get('/enfermedad/{id}', [EnfermedadController::class, 'show']);
Route::post('/enfermedad', [EnfermedadController::class, 'store']);
Route::put('/enfermedad/{id}', [EnfermedadController::class, 'update']);
Route::delete('/enfermedad/{id}', [EnfermedadController::class, 'destroy']);

Route::get('/sintoma', [SintomaController::class, 'search']);
Route::get('/sintomaall', [SintomaController::class, 'index']);
Route::get('/sintoma/{id}', [SintomaController::class, 'show']);
Route::post('/sintoma', [SintomaController::class, 'store']);
Route::put('/sintoma/{id}', [SintomaController::class, 'update']);
Route::delete('/sintoma/{id}', [SintomaController::class, 'destroy']);

Route::get('/enfermedadsintoma', [EnfermedadSintomaController::class, 'search']);
Route::get('/enfermedadsintomaall', [EnfermedadSintomaController::class, 'index']);
Route::get('/enfermedadsintoma/{id}', [EnfermedadSintomaController::class, 'show']);
Route::post('/enfermedadsintoma', [EnfermedadSintomaController::class, 'store']);
Route::put('/enfermedadsintoma/{id}', [EnfermedadSintomaController::class, 'update']);
Route::delete('/enfermedadsintoma/{id}', [EnfermedadSintomaController::class, 'destroy']);

Route::get('/radiografia', [RadiografiaController::class, 'search']);
Route::post('/radiografia', [RadiografiaController::class, 'store']);
