@extends('layouts.admin')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="container-fluid">
    <h1>Lista de Usuarios</h1>

    <!-- Contenedor flexible para los botones -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <!-- Botón para crear usuario -->
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Usuario
        </a>

        <!-- Botón para exportar usuarios -->
        <a href="{{ route('export.users') }}" class="btn btn-success">
            <i class="bi bi-download me-2"></i>Exportar Usuarios
        </a>

        <!-- Formulario de importación de usuarios -->
        <div class="card shadow-sm flex-grow-1" style="max-width: 400px;">
            <div class="card-body p-2">
                <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                    @csrf
                    <div class="flex-grow-1">
                        <input type="file" class="form-control form-control-sm" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="bi bi-upload me-1"></i>Importar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Formulario de búsqueda -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex align-items-center gap-2">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o correo..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Limpiar</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->first()->name ?? 'Sin rol' }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection