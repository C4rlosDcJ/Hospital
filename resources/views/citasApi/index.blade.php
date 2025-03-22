@extends('layouts.citas')

@section('title', 'Citas Médicas')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #2c3e50;">Citas Médicas</h2>

    <!-- Barra de búsqueda y botones -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Formulario de búsqueda -->
                <form action="{{ route('citas.index') }}" method="GET" class="d-flex w-75">
                    <input type="text" name="search" class="form-control me-2" 
                        placeholder="Buscar cita..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    @if(request('search'))
                        <a href="{{ route('citas.index') }}" class="btn btn-secondary ms-2">Limpiar</a>
                    @endif
                </form>

                <!-- Botón para crear cita -->
                <a href="{{ route('citas.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Crear Cita
                </a>
            </div>
        </div>
    </div>

    <!-- Tabla de citas -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th>Descripción</th>
                        <th>Código</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                    <tr>
                        <td>{{ $cita['id'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita['fecha_hora'])->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge 
                                @if($cita['estatus'] == 'Pendiente') bg-warning
                                @elseif($cita['estatus'] == 'Completada') bg-success
                                @elseif($cita['estatus'] == 'Cancelada') bg-danger
                                @else bg-secondary
                                @endif">
                                {{ $cita['estatus'] }}
                            </span>
                        </td>
                        <td>{{ $cita['descripcion'] }}</td>
                        <td>{{ $cita['codigo'] }}</td>
                        <td>
                            <a href="{{ route('citas.show', $cita['id']) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> 
                            </a>
                            <a href="{{ route('citas.edit', $cita['id']) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('citas.destroy', $cita['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $citas->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection