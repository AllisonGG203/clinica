@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Consultas</h2>
    @if($citas->isEmpty())
        <p>No hay citas disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    @php
                        $estado = $cita->fecha < now()->toDateString() ? 'Finalizada' : 'En curso';
                        $estadoColor = $cita->fecha < now()->toDateString() ? 'red' : 'green';
                    @endphp
                    <tr>
                        <td>{{ $cita->paciente->nombre }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->motivo }}</td>
                        <td>
                            <span style="color: {{ $estadoColor }};">{{ $estado }}</span>
                        </td>
                        <td>
                            <a href="{{ route('consultas.show', $cita->id) }}" class="btn btn-primary">Consultar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
