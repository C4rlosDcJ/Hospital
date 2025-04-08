@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Cita #{{ $cita['id'] }}</h3>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Errores encontrados:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('citas.update', $cita['id']) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <!-- Paciente -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Paciente <span class="text-danger">*</span></label>
                            <select name="paciente_id" class="form-select" required>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente['id'] }}" 
                                        {{ $cita['paciente_id'] == $paciente['id'] ? 'selected' : '' }}>
                                        {{ $paciente['nombre'] }} ({{ $paciente['id'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-select" required>
                                @foreach($doctores as $doctor)
                                    <option value="{{ $doctor['id'] }}" 
                                        {{ $cita['doctor_id'] == $doctor['id'] ? 'selected' : '' }}>
                                        {{ $doctor['nombre'] }} ({{ $doctor['especialidad'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <!-- Oxímetro -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Oxímetro <span class="text-danger">*</span></label>
                            <select name="oximetro_id" class="form-select" required>
                                @foreach($oximetros['data'] as $oximetro)
    <option value="{{ $oximetro['id'] }}">
        {{ $oximetro['bpm'] }} BPM - {{ $oximetro['spo2'] }} SpO2
    </option>
@endforeach

                            </select>
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha y Hora <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" 
                                   name="fecha_hora" 
                                   value="{{ \Carbon\Carbon::parse($cita['fecha_hora'])->format('Y-m-d\TH:i') }}" 
                                   required>
                        </div>
                    </div>

                    <!-- Estado y Campos Adicionales -->
                    <div class="col-12">
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Estatus</label>
                                    <select name="estatus" class="form-select">
                                        @foreach(['programada', 'en_proceso', 'completada', 'cancelada'] as $estado)
                                            <option value="{{ $estado }}" 
                                                {{ $cita['estatus'] == $estado ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Diagnóstico</label>
                                    <textarea class="form-control" name="diagnostico" 
                                              rows="2">{{ $cita['diagnostico'] ?? '' }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Código de Acceso</label>
                                    <input type="text" class="form-control" 
                                           name="codigo" 
                                           value="{{ $cita['codigo'] ?? '' }}">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times-circle me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-select:focus, .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
</style>
@endpush
@endsection