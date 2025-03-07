@extends('layouts.app')

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

    <!-- Formulario de búsqueda en tiempo real -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="search" class="form-control" placeholder="Buscar por nombre o correo...">
            </div>
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
                <tbody id="users-table-body">
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
            <div class="d-flex justify-content-center mt-4" id="pagination-links">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Script para la búsqueda en tiempo real -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const usersTableBody = document.getElementById('users-table-body');
    const paginationLinks = document.getElementById('pagination-links');

    // Función para realizar la búsqueda en tiempo real
    const fetchUsers = (url) => {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Indicar que es una solicitud AJAX
            },
        })
        .then(response => response.json())
        .then(data => {
            // Actualizar la tabla con los resultados
            usersTableBody.innerHTML = data.users;

            // Actualizar la paginación
            paginationLinks.innerHTML = data.pagination;

            // Reasignar los event listeners a los nuevos enlaces de paginación
            attachPaginationListeners();
        })
        .catch(error => console.error('Error:', error));
    };

    // Función para manejar la búsqueda en tiempo real
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();
        const url = `{{ route('admin.users.search') }}?search=${searchTerm}`;
        fetchUsers(url);
    });

    // Función para manejar la paginación
    const attachPaginationListeners = () => {
        const paginationAnchors = paginationLinks.querySelectorAll('a.page-link');
        paginationAnchors.forEach(anchor => {
            anchor.addEventListener('click', function (event) {
                event.preventDefault(); // Evitar que el navegador siga el enlace
                const url = this.getAttribute('href'); // Obtener la URL del enlace
                fetchUsers(url); // Realizar la solicitud AJAX
            });
        });
    };

    // Asignar los event listeners a los enlaces de paginación iniciales
    attachPaginationListeners();
});
</script>
@endsection