<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class ConsultaController extends Controller
{
    public function index()
    {
        // Obtener las citas ordenadas por fecha descendente
        $citas = Cita::with('paciente')->orderBy('fecha', 'desc')->get();
        return view('consulta.index', compact('citas'));
    }

    public function show($id)
    {
        $cita = Cita::with('paciente')->findOrFail($id);
        return view('consulta.show', compact('cita'));
    }
}
