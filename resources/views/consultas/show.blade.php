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
        <div id="recetas-container">
            <div class="form-row align-items-end mb-2 receta-item">
                <div class="col">
                    <label for="medicamento">Medicamento:</label>
                    <select name="medicamento[]" class="form-control">
                        @foreach($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}">{{ $medicamento->nombre_medicamento }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad[]" class="form-control" required>
                </div>
                <div class="col">
                    <label for="frecuencia">Frecuencia:</label>
                    <input type="text" name="frecuencia[]" class="form-control" required>
                </div>
                <div class="col">
                    <label for="duracion">Duración:</label>
                    <input type="text" name="duracion[]" class="form-control" required>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-success add-receta">+</button>
                    <button type="button" class="btn btn-danger remove-receta">-</button>
                </div>
            </div>
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
            <button type="submit" formaction="{{ route('consultas.generarPDF') }}" class="btn btn-primary">Imprimir</button>
        </div>
    </form>
</div>
@endsection




<script>
document.addEventListener('DOMContentLoaded', function () {
    const recetasContainer = document.getElementById('recetas-container');

    // Añadir nueva línea
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-receta')) {
            const recetaItem = event.target.closest('.receta-item');
            const newRecetaItem = recetaItem.cloneNode(true);

            // Limpiar los valores de los inputs en la nueva línea
            newRecetaItem.querySelectorAll('input').forEach(input => input.value = '');
            newRecetaItem.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

            recetasContainer.appendChild(newRecetaItem);
        }

        // Eliminar línea
        if (event.target.classList.contains('remove-receta')) {
            const recetaItem = event.target.closest('.receta-item');
            if (document.querySelectorAll('.receta-item').length > 1) {
                recetaItem.remove();
            }
        }
    });
});
</script>
<style>
.receta-item {
    display: flex;
    flex-wrap: nowrap;
    gap: 10px;
}

.receta-item .form-control {
    width: auto;
}

.add-receta, .remove-receta {
    margin-left: 5px;
}
</style>

