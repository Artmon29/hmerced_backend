<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\UidService;
use App\Http\Controllers\UserController;

Route::group([

'middleware' => 'api',
'prefix' => 'auth'

], function ($router) {
Route::get('user', [AuthController::class,'index']);
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('me', [AuthController::class,'me']);

//rutas pacientes

//roles y usuarios
Route::get('roles',[UserController::class,'roles']);
Route::get('usu',[UserController::class,'index']);

//Route::post('rfid',[UidService::class,'getUid']);
//Route::get('rfid',[RfidController::class,'index']);
Route::get('backup',[RfidController::class,'ultimo']);
Route::get('backup2',[RfidController::class,'ultimo2']);
Route::post('rfid/{uid}',[RfidController::class,'getPaciente']);
Route::get('rfid/getpaciente',[RfidController::class,'getDatosPaciente']);

Route::get('pacientes/ci', [PacienteController::class,'obtenerIdPaciente']);
Route::get('paciente/{ci}', [PacienteController::class, 'buscarPorCi']);
Route::get('pacientes', [PacienteController::class, 'index']);
Route::post('pacientes', [PacienteController::class, 'store']);
Route::get('pacientes/{id}', [PacienteController::class, 'show']);
Route::get('paciente2/{id}', [PacienteController::class, 'verP']);
Route::get('paciente2', [PacienteController::class, 'verP3']);
Route::get('paciente3', [PacienteController::class, 'verP2']);
Route::put('pacientes/{id}', [PacienteController::class, 'update']);
Route::delete('pacientes/{id}', [PacienteController::class, 'destroy']);
Route::get('pacientes/rfid', [PacienteController::class,'readRFID']);

//personalMedico
/* Route::resources('pacientes',PacienteController::class); */
//medico
// Route::resources('medicos',MedicoController::class);
Route::get('especialidades', [MedicoController::class, 'espe']);
Route::post('espe', [MedicoController::class, 'createEsp']);
Route::get('medico', [MedicoController::class, 'index']);
Route::get('medico/name', [MedicoController::class, 'obtenerMedico']);
Route::get('medicoId', [MedicoController::class, 'verP']);
Route::get('especialidad/name', [MedicoController::class, 'obtenerespe']);
Route::post('medico', [MedicoController::class, 'store']);
Route::get('medico/{id}', [MedicoController::class, 'show']);
Route::put('medico/{id}', [MedicoController::class, 'update']);
Route::delete('medico/{id}', [MedicoController::class, 'destroy']);
//cita
//Route::resources('citas',CitaController::class);
Route::get('/citas', [CitaController::class, 'index'])->name('view-citas');
Route::get('espeId', [CitaController::class, 'verP']);
Route::post('cita', [CitaController::class, 'store']);
Route::post('cita/datos', [CitaController::class, 'citadatos']);
Route::get('cita/datos2', [CitaController::class, 'citasM']);
Route::get('cita/datos3', [CitaController::class, 'citasM2']);
Route::get('/cita/edit/{id}', [CitaController::class,'edit']);
Route::get('cita/{id}', [CitaController::class, 'show']);
Route::put('cita/{id}', [CitaController::class, 'update']);
Route::delete('cita/{id}', [CitaController::class, 'destroy']);
});




