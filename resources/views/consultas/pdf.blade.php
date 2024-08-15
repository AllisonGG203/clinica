<!DOCTYPE html>
<html>
<head>
    <title>Resumen de Consulta</title>
</head>
<body>
    <h1>Resumen de la Consulta</h1>

    <h3>Signos Vitales</h3>
    <p><strong>Talla:</strong> {{ $talla }}</p>
    <p><strong>Peso:</strong> {{ $peso }}</p>
    <p><strong>Temperatura:</strong> {{ $temperatura }}</p>
    <p><strong>Presión Arterial:</strong> {{ $presion_arterial }}</p>
    <p><strong>Frecuencia Cardiaca:</strong> {{ $frecuencia_cardiaca }}</p>

    <h3>Motivo de la Consulta</h3>
    <p>{{ $motivo }}</p>

    <h3>Receta</h3>
    <p><strong>Medicamento:</strong> {{ $medicamento }}</p>
    <p><strong>Cantidad:</strong> {{ $cantidad }}</p>
    <p><strong>Frecuencia:</strong> {{ $frecuencia }}</p>
    <p><strong>Duración:</strong> {{ $duracion }}</p>

    <h3>Servicio Realizado</h3>
    <p>{{ $servicio_id }}</p>
</body>
</html>
