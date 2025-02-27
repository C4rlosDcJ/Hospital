<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Todos los Libros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #7d012b;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Lista Completa de Libros</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Autor</th>
                <th>Categoría</th>
                <th>Editorial</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $index => $libro)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $libro->nombre }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $libro->categoria }}</td>
                    <td>{{ $libro->editorial }}</td>
                    <td>{{ $libro->estatus }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
