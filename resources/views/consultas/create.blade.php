@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Nueva Consulta</h2>
    <form action="{{ route('consultas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="talla" class="form-label">Talla</label>
            <input type="number" step="0.01" class="form-control" id="talla" name="talla" required>
        </div>
        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="number" step="0.01" class="form-control" id="peso" name="peso" required>
        </div>
        <div class="mb-3">
            <label for="temperatura" class="form-label">Temperatura</label>
            <input type="number" step="0.1" class="form-control" id="temperatura" name="temperatura" required>
        </div>
        <div class="mb-3">
            <label for="presion_arterial" class="form-label">Presión Arterial</label>
            <input type="text" class="form-control" id="presion_arterial" name="presion_arterial" required>
        </div>
        <div class="mb-3">
            <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca</label>
            <input type="number" class="form-control" id="frecuencia_cardiaca" name="frecuencia_cardiaca" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Consulta</button>
    </form>
</div>
@endsection
