<!DOCTYPE html>
<html>
<head>
    <title>Pacientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            border-radius: 50%;
            background-color: #f2f2f2;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h2>Pacientes</h2>
    <table>
        <tr>
            <th>Paciente</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Teléfono</th>
        </tr>
        @foreach ($pacientes as $paciente)
        <tr>
            <td>
                <div class="icon">{{ strtoupper(substr($paciente->nombre, 0, 1)) }}</div>
                {{ $paciente->nombre }}
            </td>
            <td>{{ $paciente->edad }}</td>
            <td>
                @if ($paciente->sexo == 'M')
                    <i class="fas fa-mars"></i>
                @else
                    <i class="fas fa-venus"></i>
                @endif
            </td>
            <td>{{ $paciente->telefono }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
