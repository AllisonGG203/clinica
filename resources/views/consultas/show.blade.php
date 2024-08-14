@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Consulta de {{ $cita->paciente->nombre }}</h2>
    <form action="{{ route('consultas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Signos Vitales -->
        <b><h3>Signos Vitales</h3></b>
        <div class="form-group">
            <label for="talla">Talla:</label>
            <input type="text" name="talla" value="{{ $cita->signosVitales->talla ?? '' }}" class="form-control">

            <label for="peso">Peso:</label>
            <input type="text" name="peso" value="{{ $cita->signosVitales->peso ?? '' }}" class="form-control">

            <label for="temperatura">Temperatura:</label>
            <input type="text" name="temperatura" value="{{ $cita->signosVitales->temperatura ?? '' }}" class="form-control">

            <label for="presion_arterial">Presión Arterial:</label>
            <input type="text" name="presion_arterial" value="{{ $cita->signosVitales->presion_arterial ?? '' }}" class="form-control">

            <label for="frecuencia_cardiaca">Frecuencia Cardiaca:</label>
            <input type="text" name="frecuencia_cardiaca" value="{{ $cita->signosVitales->frecuencia_cardiaca ?? '' }}" class="form-control">
        </div>

        <!-- Motivo de la Consulta -->
        <b><h2>Motivo de la Consulta</h2></b>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" class="form-control" required>{{ $cita->motivo ?? '' }}</textarea>
        </div>

        <!-- Notas (Opcional) -->
        <div class="form-group">
            <label for="notas">Notas (Opcional):</label>
            <textarea name="notas" class="form-control">{{ $cita->notas ?? '' }}</textarea>
        </div>

        <!-- Receta -->
<h3>Receta</h3>
<div class="form-group">
    <label for="medicamento">Medicamento:</label>
    <select name="medicamento" id="medicamento" class="form-control">
        @foreach($medicamentos as $medicamento)
            <option value="{{ $medicamento->id }}" {{ $cita->receta && $cita->receta->medicamento_id == $medicamento->id ? 'selected' : '' }}>
                {{ $medicamento->nombre_medicamento }} <!-- Usar 'nombre_medicamento' para el campo del nombre del medicamento -->
            </option>
        @endforeach
    </select>
    
</div>
<div class="form-group">
    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" value="{{ $cita->receta->cantidad ?? '' }}" class="form-control" required>
</div>
<div class="form-group">
    <label for="frecuencia">Frecuencia:</label>
    <input type="text" name="frecuencia" value="{{ $cita->receta->frecuencia ?? '' }}" class="form-control" required>
</div>
<div class="form-group">
    <label for="duracion">Duración:</label>
    <input type="text" name="duracion" value="{{ $cita->receta->duracion ?? '' }}" class="form-control" required>
</div>

        <!-- Más campos de receta -->

        <!-- Servicio -->
<h3>Servicio</h3>
<div class="form-group">
    <label for="servicio">Seleccione el Servicio</label>
    <select name="servicio_id" id="servicio" class="form-control">
        @foreach($servicios as $servicio)
            <option value="{{ $servicio->id }}" {{ $cita->servicio_id == $servicio->id ? 'selected' : '' }}>
                {{ $servicio->tipo_servicio }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Botones de acción -->
        <div class="form-group">
            <button type="submit" name="accion" value="finalizar" class="btn btn-success">Finalizar Consulta</button>
            <button type="submit" name="accion" value="posponer" class="btn btn-warning">Posponer Consulta</button>
        </div>
    </form>
</div>
@endsection
