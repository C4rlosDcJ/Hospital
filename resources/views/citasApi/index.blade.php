@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-heartbeat me-2"></i>Citas con Oxímetro</h3>
                <a href="{{ route('citas.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Cita
                </a>
            </div>
        </div>

        <div class="card-body">
            <!-- Formulario de búsqueda -->
            {{-- <form method="GET" action="{{ route('citas.search') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="codigo" placeholder="Código de Cita" value="{{ request('codigo') }}">
                    <input type="number" class="form-control" name="paciente_id" placeholder="ID Paciente" value="{{ request('paciente_id') }}">
                    <input type="number" class="form-control" name="doctor_id" placeholder="ID Doctor" value="{{ request('doctor_id') }}">
                    <select class="form-select" name="estatus">
                        <option value="">Estatus</option>
                        <option value="programada" {{ request('estatus') == 'programada' ? 'selected' : '' }}>Programada</option>
                        <option value="en_proceso" {{ request('estatus') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="completada" {{ request('estatus') == 'completada' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelada" {{ request('estatus') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form> --}}
            

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Oxímetro</th>
                            <th>Lecturas</th>
                            <th>Diagnóstico</th>
                            <th>Estatus</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita['id'] }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-injured fa-lg text-primary me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $cita['paciente'] }}</div>
                                        <small class="text-muted">ID: {{ $cita['paciente_id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-md fa-lg text-success me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $cita['doctor'] }}</div>
                                        <small class="text-muted">ID: {{ $cita['doctor_id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-heartbeat fa-lg text-danger me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $cita['oximetro']['id'] ?? 'Ox  ' }}</div>
                                        <small class="text-muted">{{ $cita['codigo'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="text-center">
                                        <div class="badge bg-danger">BPM</div>
                                        <div class="fw-bold">{{ $cita['oximetro']['bpm'] ?? '--' }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="badge bg-info">SpO2</div>
                                        <div class="fw-bold">{{ $cita['oximetro']['spo2'] ?? '--' }}%</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="badge bg-warning">Temp</div>
                                        <div class="fw-bold">{{ $cita['oximetro']['temp'] ?? '--' }}°C</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $cita['diagnostico'] ?? 'No especificado' }}</div>
                            </td>
                            <td>
                                @php
                                    $badgeColor = [
                                        'programada' => 'secondary',
                                        'en_proceso' => 'primary',
                                        'completada' => 'success',
                                        'cancelada' => 'danger'
                                    ][$cita['estatus']];
                                @endphp
                                <span class="badge rounded-pill bg-{{ $badgeColor }}">
                                    {{ ucfirst($cita['estatus']) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('citas.show', $cita['id']) }}" 
                                       class="btn btn-sm btn-info"
                                       data-bs-toggle="tooltip" 
                                       title="Ver detalles">
                                        <i class="fas fa-chart-line"></i>
                                    </a>
                                    <a href="{{ route('citas.edit', $cita['id']) }}" 
                                       class="btn btn-sm btn-warning"
                                       data-bs-toggle="tooltip" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('citas.destroy', $cita['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="tooltip" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar cita?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No hay citas registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
