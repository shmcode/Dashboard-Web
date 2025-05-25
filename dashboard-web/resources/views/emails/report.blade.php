<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de ciudadanos agrupados por ciudad</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { color: #2a4365; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Ciudadanos Agrupados por Ciudad</h1>
    @foreach ($reportData as $city)
        <h2>{{ $city->name }}</h2>
        @if ($city->citizens->count())
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($city->citizens as $citizen)
                        <tr>
                            <td>{{ $citizen->getFullName() }}</td>
                            <td>{{ $citizen->birth_date }}</td>
                            <td>{{ $citizen->address }}</td>
                            <td>{{ $citizen->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay ciudadanos en esta ciudad.</p>
        @endif
    @endforeach
</body>
</html>
