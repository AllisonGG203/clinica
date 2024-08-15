<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ConsultaController;


Route::get('/consultas/resumen/{id}', [ConsultaController::class, 'resumen'])->name('consultas.resumen');



// Ruta para la página principal
Route::get('/', function () {
    return redirect()->route('agenda.index');
    return redirect()->route('consultas.consultar', ['id' => $consulta->id]);

});
Route::get('/consultas/{id}/consultar', [ConsultaController::class, 'consultar'])->name('consultas.consultar');
Route::get('/consultar/{id}', [ConsultaController::class, 'consultar'])->name('consultar');
// Rutas de Agenda y Citas
Route::get('/agenda', [CitaController::class, 'index'])->name('agenda.index');
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
Route::get('/agenda', [CitaController::class, 'index'])->name('agenda');
Route::get('/consultas/resumen/{id}', [ConsultaController::class, 'resumen'])->name('consultas.resumen');

// Rutas de Consultas
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
Route::get('/consultas/create', [ConsultaController::class, 'create'])->name('consultas.create');
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
Route::get('/consultas/{consulta}', [ConsultaController::class, 'show'])->name('consultas.show');
Route::get('/consultas/resumen/{consulta}', [ConsultaController::class, 'resumen'])->name('consultas.resumen');
Route::put('/consultas/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');
Route::delete('/consultas/{consulta}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');

// Rutas de Medicos
Route::resource('medico', MedicoController::class);
