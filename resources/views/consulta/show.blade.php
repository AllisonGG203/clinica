@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Consulta de {{ $cita->paciente->nombre }}</h2>
    <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
    <p><strong>Motivo:</strong> {{ $cita->motivo }}</p>
    <p><strong>Notas:</strong> {{ $cita->notas }}</p>
</div>
@endsection
