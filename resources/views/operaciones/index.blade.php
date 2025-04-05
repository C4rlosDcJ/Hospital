@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-robot me-2"></i>Gestión de Operaciones Quirúrgicas</h3>
                <a href="{{ route('operaciones.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Operación
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="w-15">Brazo Robótico</th>
                            <th class="w-15">Paciente</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fecha/Hora</th>
                            <th>Observaciones</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($operaciones as $operacion)
                        <tr>
                            <td>
                                @php
                                    $brazo = collect($brazos)->firstWhere('id', $operacion['brazo_robotico_id']);
                                @endphp
                                <div class="d-flex flex-column">
                                    <span class="fw-bold text-primary">{{ $brazo['modelo'] ?? 'N/A' }}</span>
                                    <small class="text-muted">{{ $brazo['fabricante'] ?? 'Fabricante no disponible' }}</small>
                                </div>
                            </td>
                            <td>
                                @php
                                    $paciente = collect($pacientes)->firstWhere('id', $operacion['paciente_id']);
                                @endphp
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-injured me-2 text-info"></i>
                                    <div>
                                        <div class="fw-bold">{{ $paciente['nombre'] ?? 'Paciente no registrado' }}</div>
                                        <small class="text-muted">ID: {{ $operacion['paciente_id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-black">
                                    <i class="fas fa-syringe me-1"></i>
                                    {{ ucfirst($operacion['tipo'] ?? 'N/A') }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $estadoColor = [
                                        'pendiente' => 'warning',
                                        'en_progreso' => 'primary',
                                        'completada' => 'success',
                                        'cancelada' => 'danger'
                                    ][$operacion['estado']] ?? 'secondary';
                                @endphp
                                <span class="badge rounded-pill bg-{{ $estadoColor }}">
                                    {{ ucfirst(str_replace('_', ' ', $operacion['estado'] ?? 'N/A')) }}
                                </span>
                            </td>
                            <td>
                                <i class="fas fa-calendar-alt me-2 text-secondary"></i>
                                {{ \Carbon\Carbon::parse($operacion['fecha_hora'])->isoFormat('DD MMM YYYY, HH:mm') }}
                            </td>
                            <td class="text-truncate" style="max-width: 250px;" title="{{ $operacion['observaciones'] ?? '' }}">
                                {{ $operacion['observaciones'] ?? 'Sin observaciones' }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('operaciones.show', $operacion['id']) }}" 
                                       class="btn btn-sm btn-info"
                                       data-bs-toggle="tooltip" 
                                       title="Detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('operaciones.edit', $operacion['id']) }}" 
                                       class="btn btn-sm btn-warning"
                                       data-bs-toggle="tooltip" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('operaciones.destroy', $operacion['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="tooltip" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Confirmar eliminación de la operación?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-robot fa-2x mb-3"></i><br>
                                No se encontraron operaciones registradas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-purple {
        background-color: #6f42c1;
        color: white;
    }
    
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
@endsection