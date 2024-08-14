<?php

namespace App\Http\Controllers;

use App\Models\MoonshineUser;
use App\Models\MoonshineUserRole;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = MoonshineUser::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = MoonshineUserRole::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:moonshine_users,email',
            'password' => 'required|string|min:8',
            'moonshine_user_role_id' => 'required|exists:moonshine_user_roles,id',
        ]);

        MoonshineUser::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }
}
