@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Resumen de la Consulta de {{ $cita->paciente->nombre }}</h2>

    <h3>Signos Vitales</h3>
    @if($cita->signosVitales)
        <p><strong>Talla:</strong> {{ $cita->signosVitales->talla }}</p>
        <p><strong>Peso:</strong> {{ $cita->signosVitales->peso }}</p>
        <p><strong>Temperatura:</strong> {{ $cita->signosVitales->temperatura }}</p>
        <p><strong>Presión Arterial:</strong> {{ $cita->signosVitales->presion_arterial }}</p>
        <p><strong>Frecuencia Cardiaca:</strong> {{ $cita->signosVitales->frecuencia_cardiaca }}</p>
    @else
        <p>No se han registrado signos vitales para esta consulta.</p>
    @endif

    <h3>Motivo de la Consulta</h3>
    <p>{{ $cita->motivo }}</p>

    <h3>Receta</h3>
    @if($cita->receta)
        <p><strong>Medicamento:</strong> {{ $cita->receta->medicamento }}</p>
        <p><strong>Cantidad:</strong> {{ $cita->receta->cantidad }}</p>
        <p><strong>Frecuencia:</strong> {{ $cita->receta->frecuencia }}</p>
        <p><strong>Duración:</strong> {{ $cita->receta->duracion }}</p>
    @else
        <p>No se ha registrado una receta para esta consulta.</p>
    @endif
    
    <h3>Servicio Realizado</h3>
    <p>{{ $cita->servicio->tipo_servicio ?? 'No se ha registrado un servicio para esta consulta.' }}</p>
    
    <h3>Total a Pagar</h3>
    <p><strong>Precio del Servicio:</strong> {{ $cita->servicio->precio ?? 'N/A' }}</p>
    <p><strong>Precio de los Medicamentos:</strong> {{ $cita->receta ? $cita->receta->cantidad * $cita->receta->inventario->precio : 'N/A' }}</p>
    <p><strong>Total:</strong> {{ $cita->servicio ? $cita->servicio->precio + ($cita->receta ? $cita->receta->cantidad * $cita->receta->inventario->precio : 0) : 'N/A' }}</p>
    
    <a href="{{ route('consultas.index') }}" class="btn btn-primary">Salir</a>
</div>
@endsection
    