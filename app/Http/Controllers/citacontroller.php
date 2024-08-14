<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Pacientes;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('paciente')->get();
        return view('agenda.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $pacientes = Pacientes::all();
        $fecha = $request->input('fecha', '');
        return view('citas.create', compact('pacientes', 'fecha'));
    }

    public function store(Request $request)
    {
        $cita = new Cita();
    $cita->id_pacientes = $request->input('id_pacientes');
    $cita->fecha = $request->input('fecha');
    $cita->hora = $request->input('hora');
    $cita->motivo = $request->input('motivo');
    $cita->notas = $request->input('notas');
    $cita->save();

        return redirect()->route('agenda.index')->with('success', 'Cita creada exitosamente');
    }
}