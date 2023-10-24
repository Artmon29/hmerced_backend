<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
Route::group([

'middleware' => 'api',
'prefix' => 'auth'

], function ($router) {
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('me', [AuthController::class,'me']);

//rutas pacientes
Route::get('pacientes', [PacienteController::class, 'index']);
Route::post('pacientes', [PacienteController::class, 'store']);
Route::get('pacientes/{id}', [PacienteController::class, 'show']);
Route::put('pacientes/{id}', [PacienteController::class, 'update']);
Route::delete('pacientes/{id}', [PacienteController::class, 'destroy']);
Route::get('pacientes/rfid', [PacienteController::class,'readRFID']);

//personalMedico
/* Route::resources('pacientes',PacienteController::class); */
//medico
// Route::resources('medicos',MedicoController::class);
Route::get('medico', [MedicoController::class, 'index']);
Route::post('medico', [MedicoController::class, 'store']);
Route::get('medico/{id}', [MedicoController::class, 'show']);
Route::put('medico/{id}', [MedicoController::class, 'update']);
Route::delete('medico/{id}', [MedicoController::class, 'destroy']);
//cita
//Route::resources('citas',CitaController::class);
Route::get('cita', [CitaController::class, 'index']);
Route::post('cita', [CitaController::class, 'store']);
Route::get('cita/{id}', [CitaController::class, 'show']);
Route::put('cita/{id}', [CitaController::class, 'update']);
Route::delete('cita/{id}', [CitaController::class, 'destroy']);
});




