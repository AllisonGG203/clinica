<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ConsultaController;

Route::get('/agenda', [CitaController::class, 'index'])->name('agenda.index');
Route::get('/consultas/{cita}', [ConsultaController::class, 'show'])->name('consultas.show');
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
Route::resource('consultas', ConsultaController::class);
// Rutas para la agenda y las citas
Route::get('/consultas/resumen/{id}', [ConsultaController::class, 'resumen'])->name('consultas.resumen');


Route::get('/agenda', [CitaController::class, 'index'])->name('agenda');
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

// Otras rutas
Route::resource('medico', MedicoController::class);

// Ruta principal
Route::get('/', function () {
    return redirect()->route('agenda');
});
