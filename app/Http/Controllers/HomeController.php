<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        // Redirigir según el rol del usuario
        if ($user->role == 'admin') {
            return view('admin.dashboard'); // Cambia a la vista correspondiente para el administrador
        } elseif ($user->role == 'medico') {
            return view('medico.dashboard'); // Cambia a la vista correspondiente para el médico
        } elseif ($user->role == 'secretaria') {
            return view('secretaria.dashboard'); // Cambia a la vista correspondiente para la secretaria
        } else {
            return view('home'); // Vista por defecto si no hay rol específico
        }
    }
}

