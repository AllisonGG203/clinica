@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nueva Cita</h2>
    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_pacientes">Paciente</label>
            <select class="form-control" id="id_pacientes" name="id_pacientes" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $fecha }}" required>
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo</label>
            <input type="text" class="form-control" id="motivo" name="motivo" required>
        </div>
        <div class="form-group">
            <label for="notas">Notas</label>
            <textarea class="form-control" id="notas" name="notas"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cita</button>
    </form>
</div>
@endsection
