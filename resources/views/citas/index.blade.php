@php
    if (auth()->user()->hasRole('admin')) {
        $layout = 'layouts.app';
    } elseif (auth()->user()->hasRole('doctor')) {
        $layout = 'layouts.doctor';
    } else {
        $layout = 'layouts.a'; 
    }
@endphp

@extends($layout) 

@section('title', 'Citas Médicas')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #2c3e50;">Citas Médicas</h2>

    <!-- Barra de búsqueda y botones -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Formulario de búsqueda en tiempo real -->
                <div class="d-flex w-75">
                    <input id="search" class="form-control me-2" 
                        type="search" placeholder="Buscar cita..." aria-label="Buscar">
                </div>

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
                <tbody id="citas-table-body">
                    @foreach ($lista as $listaa)
                        <tr>
                            <td>{{ $listaa->id_cita }}</td>
                            <td>{{ $listaa->fecha }}</td>
                            <td>
                                <span class="badge 
                                    @if($listaa->estatus == 'Pendiente') bg-warning
                                    @elseif($listaa->estatus == 'Completada') bg-success
                                    @elseif($listaa->estatus == 'Cancelada') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ $listaa->estatus }}
                                </span>
                            </td>
                            <td>{{ $listaa->descripcion }}</td>
                            <td>{{ $listaa->codigo }}</td>
                            <td>
                                <a href="{{ route('citas.show', $listaa->id_cita) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> 
                                </a>
                                <a href="{{ route('citas.edit', $listaa->id_cita) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('citas.destroy', $listaa->id_cita) }}" method="POST" style="display:inline;">
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
    <div class="d-flex justify-content-center mt-4" id="pagination-links">
        {{ $lista->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Script para la búsqueda en tiempo real y paginación -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const citasTableBody = document.getElementById('citas-table-body');
        const paginationLinks = document.getElementById('pagination-links');

        // Función para realizar la búsqueda en tiempo real
        const fetchCitas = (url) => {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Indicar que es una solicitud AJAX
                },
            })
            .then(response => response.json())
            .then(data => {
                // Actualizar la tabla con los resultados
                citasTableBody.innerHTML = data.citas;

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
            const url = `{{ route('citas.search') }}?search=${searchTerm}`;
            fetchCitas(url);
        });

        // Función para manejar la paginación
        const attachPaginationListeners = () => {
            const paginationAnchors = paginationLinks.querySelectorAll('a.page-link');
            paginationAnchors.forEach(anchor => {
                anchor.addEventListener('click', function (event) {
                    event.preventDefault(); // Evitar que el navegador siga el enlace
                    const url = this.getAttribute('href'); // Obtener la URL del enlace
                    fetchCitas(url); // Realizar la solicitud AJAX
                });
            });
        };

        // Asignar los event listeners a los enlaces de paginación iniciales
        attachPaginationListeners();
    });
</script>
@endsection