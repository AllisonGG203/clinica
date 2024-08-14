@php
    $user = Auth::user();
    $role = $user ? $user->userRole->name : null;
@endphp

<ul>
    @if($role === 'admin' || $role === 'medico' || $role === 'secretaria')
        <li><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
        <li><a href="{{ route('consultas.index') }}">Consultas</a></li>
        <li><a href="{{ route('agenda') }}">Agenda</a></li>
    @endif

    @if($role === 'admin')
        <li><a href="{{ route('medicos.index') }}">Medicos</a></li>
        <li><a href="{{ route('servicios.index') }}">Servicios</a></li>
        <li><a href="{{ route('inventarios.index') }}">Inventarios</a></li>
    @endif
</ul>
