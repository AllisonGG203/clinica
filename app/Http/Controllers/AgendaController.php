<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        // Lógica para obtener y mostrar la agenda
        return view('agenda.index');
    }
}
