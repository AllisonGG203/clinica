<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ConsultaController;




Route::post('/consultas/generar-pdf', [ConsultaController::class, 'generarPDF'])->name('consultas.generarPDF');



// Ruta para mostrar el resumen de la consulta
Route::get('/consultas/resumen/{id}', [ConsultaController::class, 'resumen'])->name('consultas.resumen');

// Ruta para mostrar el formulario de la consulta
Route::get('/consultas/{id}/consultar', [ConsultaController::class, 'consultar'])->name('consultas.consultar');

// Ruta para mostrar una consulta específica
Route::get('/consultas/{consulta}', [ConsultaController::class, 'show'])->name('consultas.show');

// Ruta para actualizar una consulta específica
Route::put('/consultas/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');

// Ruta para mostrar la página principal de la agenda
Route::get('/agenda', [CitaController::class, 'index'])->name('agenda.index');
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
// Rutas adicionales de citas y médicos
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

Route::resource('medico', MedicoController::class);
