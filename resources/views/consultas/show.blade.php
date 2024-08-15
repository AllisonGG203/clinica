@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Consulta de {{ $cita->paciente->nombre }}</h2>
    <form action="{{ route('consultas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Signos Vitales -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Signos Vitales</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="talla">Talla:</label>
                    <input type="text" name="talla" class="form-control" value="{{ old('talla', $cita->talla) }}" required>
                </div>
                <div class="form-group">
                    <label for="peso">Peso:</label>
                    <input type="text" name="peso" class="form-control" value="{{ old('peso', $cita->peso) }}" required>
                </div>
                <div class="form-group">
                    <label for="temperatura">Temperatura:</label>
                    <input type="text" name="temperatura" class="form-control" value="{{ old('temperatura', $cita->temperatura) }}" required>
                </div>
                <div class="form-group">
                    <label for="presion_arterial">Presión Arterial:</label>
                    <input type="text" name="presion_arterial" class="form-control" value="{{ old('presion_arterial', $cita->presion_arterial) }}" required>
                </div>
                <div class="form-group">
                    <label for="frecuencia_cardiaca">Frecuencia Cardiaca:</label>
                    <input type="text" name="frecuencia_cardiaca" class="form-control" value="{{ old('frecuencia_cardiaca', $cita->frecuencia_cardiaca) }}" required>
                </div>
            </div>
        </div>

        <!-- Motivo de la Consulta -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Motivo de la Consulta</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="motivo">Motivo:</label>
                    <textarea name="motivo" class="form-control" required>{{ old('motivo', $cita->motivo) }}</textarea>
                </div>

                <!-- Notas (Opcional) -->
                <div class="form-group">
                    <label for="notas">Notas (Opcional):</label>
                    <textarea name="notas" class="form-control">{{ old('notas', $cita->notas) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Receta -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Receta</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="medicamento">Medicamento:</label>
                    <select name="medicamento" id="medicamento" class="form-control">
                        @foreach($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}" {{ $cita->receta && $cita->receta->medicamento_id == $medicamento->id ? 'selected' : '' }}>
                                {{ $medicamento->nombre_medicamento }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" value="{{ old('cantidad', $cita->receta->cantidad ?? '') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="frecuencia">Frecuencia:</label>
                    <input type="text" name="frecuencia" value="{{ old('frecuencia', $cita->receta->frecuencia ?? '') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración:</label>
                    <input type="text" name="duracion" value="{{ old('duracion', $cita->receta->duracion ?? '') }}" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Servicio -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Servicio</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="servicio_id">Seleccione el Servicio</label>
                    <select name="servicio_id" id="servicio_id" class="form-control">
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}" {{ old('servicio_id', $cita->servicio_id) == $servicio->id ? 'selected' : '' }}>
                                {{ $servicio->tipo_servicio }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-group">
            <button type="submit" name="accion" value="finalizar" class="btn btn-success">Finalizar Consulta</button>
        </div>
    </form>
</div>
@endsection
