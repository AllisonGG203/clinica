@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Nueva Consulta</h2>
    <form action="{{ route('consulta.store') }}" method="POST">
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
            <input type="number" step="0.01" class="form-control" id="temperatura" name="temperatura" required>
        </div>
        <div class="mb-3">
            <label for="presion_arterial" class="form-label">Presión Arterial</label>
            <input type="text" class="form-control" id="presion_arterial" name="presion_arterial" required>
        </div>
        <div class="mb-3">
            <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca</label>
            <input type="number" class="form-control" id="frecuencia_cardiaca" name="frecuencia_cardiaca" required>
        </div>
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo de la Consulta</label>
            <textarea class="form-control" id="motivo" name="motivo" required></textarea>
        </div>
        <div class="mb-3">
            <label for="notas" class="form-label">Notas</label>
            <textarea class="form-control" id="notas" name="notas"></textarea>
        </div>
        <div class="mb-3">
            <label for="medicamento" class="form-label">Medicamento</label>
            <input type="text" class="form-control" id="medicamento" name="medicamento" required>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="mb-3">
            <label for="frecuencia" class="form-label">Frecuencia</label>
            <input type="text" class="form-control" id="frecuencia" name="frecuencia" required>
        </div>
        <div class="mb-3">
            <label for="duracion" class="form-label">Duración</label>
            <input type="text" class="form-control" id="duracion" name="duracion" required>
        </div>
        <div class="mb-3">
            <label for="notas_receta" class="form-label">Notas de la Receta</label>
            <textarea class="form-control" id="notas_receta" name="notas_receta"></textarea>
        </div>
        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio</label>
            <select class="form-control" id="servicio" name="servicio">
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}">{{ $servicio->tipo_servicio }}</option>
                @endforeach
            </select>
        </div>
```blade
        <button type="submit" class="btn btn-primary">Guardar Consulta</button>
    </form>
</div>
@endsection
