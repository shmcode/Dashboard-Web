<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte Diario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        h2 {
            color: #2c3e50;
        }
        .city-group {
            margin-bottom: 20px;
        }
        .city-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <h1>Reporte Diario</h1>

    <h2>Ciudades ({{ count($cities) }})</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->description ?? 'No hay descripción disponible' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Ciudadanos Agrupados por Ciudad</h2>
    @foreach ($cities as $city)
        <div class="city-group">
            <div class="city-name">{{ $city->name }} ({{ $city->citizens->count() }} ciudadano(s))</div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Numero</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($city->citizens as $citizen)
                        <tr>
                            <td>{{ $citizen->id }}</td>
                            <td>{{ $citizen->name }}</td>
                            <td>{{ $citizen->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</body>
</html>
