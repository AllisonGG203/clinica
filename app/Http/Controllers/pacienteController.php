<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;

class pacienteController extends Controller
{
    public function index()
    {
        $pacientes = Pacientes::all();
        return view('pacientes.index', compact('pacientes'));
    }
}
