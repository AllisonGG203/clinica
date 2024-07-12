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
        $request->validate([
            'id_pacientes' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string',
            'notas' => 'nullable|string',
        ]);

        Cita::create($request->all());

        return redirect()->route('agenda.index')->with('success', 'Cita creada con éxito');
    }
}
