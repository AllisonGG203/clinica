<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MoonshineUser;
use App\Models\MoonshineUserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Middleware para redirigir usuarios autenticados
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Muestra el formulario de registro
    public function showRegistrationForm()
    {
        // Obtener todos los roles disponibles para mostrarlos en un dropdown
        $roles = MoonshineUserRole::all();
        return view('auth.register', compact('roles'));
    }

    // Maneja el registro de un nuevo usuario
    public function register(Request $request)
    {
        // Validación de datos de entrada
        $this->validator($request->all())->validate();

        // Crear el nuevo usuario
        $user = $this->create($request->all());

        // Evento de registro de usuario (opcional)
        event(new Registered($user));

        // Iniciar sesión automáticamente al usuario registrado
        Auth::login($user);

        // Redirigir al dashboard o a la página deseada
        return redirect()->route('dashboard');
    }

    // Valida los datos de entrada del formulario de registro
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:moonshine_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:moonshine_user_roles,id'],
        ]);
    }

    // Crea un nuevo usuario después de pasar la validación
    protected function create(array $data)
    {
        return MoonshineUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'moonshine_user_role_id' => $data['role_id'],
            'role' => MoonshineUserRole::find($data['role_id'])->name, // Asigna el nombre del rol
        ]);
    }
}
