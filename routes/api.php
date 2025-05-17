<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HistorialMedicoController;

// ... other routes

Route::apiResource('historial-medico', HistorialMedicoController::class); // Añade esta línea


Route::apiResource('citas', CitaController::class);
Route::get('citas/paciente/{pacienteId}', [CitaController::class, 'getCitasByPaciente']);
Route::get('citas/pending/{date}', [CitaController::class, 'getPendingCitasByDate']);

Route::apiResource('especialidades', EspecialidadController::class);
Route::get('especialidades/{especialidad}/with-doctor-count', [EspecialidadController::class, 'getEspecialidadWithDoctorCount']);

Route::apiResource('medicos', MedicoController::class);
Route::get('medicos/especialidad/{especialidadId}', [MedicoController::class, 'getMedicosByEspecialidad']);

Route::apiResource('pacientes', PacienteController::class);
Route::get('pacientes/born-before/{date}', [PacienteController::class, 'getPatientsBornBeforeDate']);