@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Resumen de la Consulta</h2>

    <!-- Información del paciente -->
    <p><strong>Paciente:</strong> {{ $consulta->paciente->nombre }}</p>

    <!-- Signos Vitales -->
    <h3>Signos Vitales</h3>
    <p><strong>Talla:</strong> {{ $consulta->signosVitales->talla }}</p>
    <p><strong>Peso:</strong> {{ $consulta->signosVitales->peso }}</p>
    <p><strong>Temperatura:</strong> {{ $consulta->signosVitales->temperatura }}</p>
    <p><strong>Presión Arterial:</strong> {{ $consulta->signosVitales->presion_arterial }}</p>
    <p><strong>Frecuencia Cardiaca:</strong> {{ $consulta->signosVitales->frecuencia_cardiaca }}</p>

    <!-- Receta -->
    <h3>Receta</h3>
    <p><strong>Medicamento:</strong> {{ $consulta->receta->inventario->nombre_medicamento }}</p>
    <p><strong>Cantidad:</strong> {{ $consulta->receta->cantidad }}</p>
    <p><strong>Frecuencia:</strong> {{ $consulta->receta->frecuencia }}</p>
    <p><strong>Duración:</strong> {{ $consulta->receta->duracion }}</p>
    <p><strong>Total Medicamentos:</strong> ${{ number_format($totalMedicamentos, 2) }}</p>

    <!-- Servicio -->
    <h3>Servicio</h3>
    <p><strong>Servicio Realizado:</strong> {{ $consulta->servicio->tipo_servicio }}</p>
    <p><strong>Total Servicio:</strong> ${{ number_format($totalServicio, 2) }}</p>

    <!-- Botón de salir -->
    <form action="{{ route('consultas.index') }}" method="GET">
        <button type="submit" class="btn btn-primary">Salir</button>
    </form>
</div>
@endsection
