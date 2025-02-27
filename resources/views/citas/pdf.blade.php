<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle del Libro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff; /* Fondo suave para toda la página */
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 40px auto;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background-color: #6994e2; 
            color: #ffffff;
            padding: 20px 0;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.8;
        }
        .table-responsive {
            margin-top: 30px;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 13px;
            text-align: left;
            font-size: 16px;
        }
        .table th {
            background-color: #6994e2; 
            color: #ffffff;
            font-weight: bold;
            border-top: 2px solid #ffffff;
        }
        .table td {
            background-color: #f2f2f2; 
            border-bottom: 1px solid #ddd;
        }
        .table tr:nth-child(even) td {
            background-color: #6993e248; 
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            color: #fff;
            font-weight: bold;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #000000;
        }

        /* Reducir tamaño de la columna "ID" */
        .table th:first-child, .table td:first-child {
           width: 80px; /* Ajusta este valor según el tamaño que desees */
           padding-left: 10px; /* Reducir el espaciado de la celda */
           padding-right: 80px; /* Reducir el espaciado de la celda */
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detalle del Libro</h1>
            <p>Consulta rápida y detallada de la información</p>
        </div>
        <!-- Contenedor de la tabla con desplazamiento horizontal -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $mostrar[0]->id_libro }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $mostrar[0]->nombre }}</td>
                </tr>
                <tr>
                    <th>Autor</th>
                    <td>{{ $mostrar[0]->autor }}</td>
                </tr>
                <tr>
                    <th>Editorial</th>
                    <td>{{ $mostrar[0]->editorial }}</td>
                </tr>
                <tr>
                    <th>Categoría</th>
                    <td>{{ $mostrar[0]->categoria }}</td>
                </tr>
                <tr>
                    <th>Estatus</th>
                    <td>
                        <span class="badge {{ $mostrar[0]->estatus == 'Activo' ? 'badge-success' : 'badge-danger' }}">
                            {{ $mostrar[0]->estatus }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Generado por el sistema - {{ date('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>
