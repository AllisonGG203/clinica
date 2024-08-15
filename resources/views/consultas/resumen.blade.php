@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Resumen de la Consulta de {{ $cita->paciente->nombre }}</h2>

    <h3>Signos Vitales</h3>
    @if ($cita->talla)
        <p><strong>Talla:</strong> {{ $cita->talla }}</p>
    @endif
    @if ($cita->peso)
        <p><strong>Peso:</strong> {{ $cita->peso }}</p>
    @endif
    @if ($cita->temperatura)
        <p><strong>Temperatura:</strong> {{ $cita->temperatura }}</p>
    @endif
    @if ($cita->presion_arterial)
        <p><strong>Presión Arterial:</strong> {{ $cita->presion_arterial }}</p>
    @endif
    @if ($cita->frecuencia_cardiaca)
        <p><strong>Frecuencia Cardiaca:</strong> {{ $cita->frecuencia_cardiaca }}</p>
    @endif
    
    <h3>Motivo de la Consulta</h3>
    <p>{{ $cita->motivo }}</p>

    <h3>Receta</h3>
    <p><strong>Medicamento:</strong> {{ $cita->receta->medicamento->nombre_medicamento }}</p>
    <p><strong>Cantidad:</strong> {{ $cita->receta->cantidad }}</p>
    <p><strong>Frecuencia:</strong> {{ $cita->receta->frecuencia }}</p>
    <p><strong>Duración:</strong> {{ $cita->receta->duracion }}</p>
    
    <h3>Servicio Realizado</h3>
    <p>{{ $cita->servicio->tipo_servicio }}</p>
    
    <a href="{{ route('consultas.index') }}" class="btn btn-primary">Salir</a>
</div>
@endsection
