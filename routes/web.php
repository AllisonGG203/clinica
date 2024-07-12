<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CitaController;

Route::get('/agenda', [CitaController::class, 'index'])->name('agenda.index');
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');