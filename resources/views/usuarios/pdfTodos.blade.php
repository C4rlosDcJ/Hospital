<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Todos los Usuarios</title>
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
    <h1>Lista Completa de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $xd)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $xd->name }}</td>
                    <td>{{ $xd->email }}</td>
                    <td>{{ $xd->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
