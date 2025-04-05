@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-users me-2"></i>Gestión de Pacientes</h3>
                    <a href="{{ route('pacientes.create') }}" class="btn btn-light">
                        <i class="fas fa-user-plus me-2"></i>Nuevo Paciente
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Grupo Sanguíneo</th>
                                <th>Peso</th>
                                <th>Altura</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente['nombre'] }}</td>
                                    <td>{{ $paciente['edad'] }}</td>
                                    <td>{{ $paciente['grupo_sanguineo'] }}</td>
                                    <td>{{ $paciente['peso'] }}</td>
                                    <td>{{ $paciente['altura'] }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ url('pacientes/' . $paciente['id']) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pacientes.edit', $paciente['id']) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pacientes.destroy', $paciente['id']) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Confirmar eliminación del paciente?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .card-header {
            border-radius: 0.75rem 0.75rem 0 0 !important;
        }

        .text-truncate {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Inicializar tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>
@endpush
