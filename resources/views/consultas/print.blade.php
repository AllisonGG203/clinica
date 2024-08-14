<!DOCTYPE html>
<html>
<head>
    <title>Consulta Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
        }
        h2 {
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h4 {
            margin-bottom: 10px;
        }
        .section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalles de la Consulta</h2>
        <div class="section">
            <h4>Paciente</h4>
            <p>{{ $consulta->paciente->nombre }}</p>
        </div>
        <div class="section">
            <h4>Signos Vitales</h4>
            <p><strong>Talla:</strong> {{ $consulta->signosVitales->talla }}</p>
            <p><strong>Peso:</strong> {{ $consulta->signosVitales->peso }}</p>
            <p><strong>Temperatura:</strong> {{ $consulta->signosVitales->temperatura }}</p>
            <p><strong>Presión Arterial:</strong> {{ $consulta->signosVitales->presion_arterial }}</p>
            <p><strong>Frecuencia Cardiaca:</strong> {{ $consulta->signosVitales->frecuencia_cardiaca }}</p>
        </div>
        <div class="section">
            <h4>Motivo de la Consulta</h4>
            <p>{{ $consulta->motivo }}</p>
        </div>
        <div class="section">
            <h4>Notas</h4>
            <p>{{ $consulta->notas }}</p>
        </div>
        <div class="section">
            <h4>Receta</h4>
            <p><strong>Medicamento:</strong> {{ $consulta->receta->medicamento }}</p>
            <p><strong>Cantidad:</strong> {{ $consulta->receta->cantidad }}</p>
            <p><strong>Frecuencia:</strong> {{ $consulta->receta->frecuencia }}</p>
            <p><strong>Duración:</strong> {{ $consulta->receta->duracion }}</p>
            <p><strong>Notas de la Receta:</strong> {{ $consulta->receta->notas }}</p>
        </div>
        <div class="section">
            <h4>Servicio Realizado</h4>
            <p>{{ $consulta->servicio->tipo_servicio }}</p>
        </div>
    </div>
</body>
</html>
