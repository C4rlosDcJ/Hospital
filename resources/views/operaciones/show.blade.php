@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-heartbeat me-2"></i>Detalles de la Operación</h3>
                <a href="{{ route('operaciones.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Volver al Listado
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Modelo de Brazo Robótico:</strong>
                <div class="d-flex align-items-center">
                    <i class="fas fa-robot fa-lg text-primary me-2"></i>
                    <div>
                        <div class="fw-bold">{{ $operacion['brazo_robotico']['modelo'] ?? 'No disponible' }}</div>
                        <small class="text-muted">{{ $operacion['brazo_robotico']['fabricante'] ?? 'Desconocido' }}</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <strong>Paciente:</strong>
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-injured fa-lg text-success me-2"></i>
                    <div>
                        <div class="fw-bold">{{ $operacion['paciente']['nombre'] ?? 'No especificado' }}</div>
                        <small class="text-muted">ID: {{ $operacion['paciente_id'] }}</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <strong>Edad del Paciente:</strong> 
                <div class="fw-bold">{{ $operacion['paciente']['edad'] ?? 'No disponible' }} años</div>
            </div>

            <div class="mb-3">
                <strong>Tipo de Operación:</strong> 
                <div class="fw-bold">{{ ucfirst($operacion['tipo']) }}</div>
            </div>

            <div class="mb-3">
                <strong>Estado:</strong> 
                <div class="badge rounded-pill bg-{{ 
                    $operacion['estado'] == 'completada' ? 'success' : 
                    ($operacion['estado'] == 'en_proceso' ? 'primary' : 'warning') }}">
                    {{ ucfirst($operacion['estado']) }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Fecha y Hora:</strong> 
                <div class="fw-bold">{{ \Carbon\Carbon::parse($operacion['fecha_hora'])->format('d/m/Y H:i') }}</div>
            </div>

            <div class="mb-3">
                <strong>Observaciones:</strong> 
                <div class="fw-bold">{{ $operacion['observaciones'] ?? 'Ninguna' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
