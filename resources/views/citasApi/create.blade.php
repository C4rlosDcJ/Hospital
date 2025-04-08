@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Programar Nueva Cita</h3>
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

            <form action="{{ route('citas.store') }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <!-- Paciente -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Paciente <span class="text-danger">*</span></label>
                            <select name="paciente_id" class="form-select" required>
                                <option value="">Seleccionar Paciente</option>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente['id'] }}" {{ old('paciente_id') == $paciente['id'] ? 'selected' : '' }}>
                                        {{ $paciente['nombre'] }} ({{ $paciente['id'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Doctor <span class="text-danger">*</span></label>
                            <select name="doctor_id" class="form-select" required>
                                <option value="">Seleccionar Doctor</option>
                                @foreach($doctores as $doctor)
                                    <option value="{{ $doctor['id'] }}" {{ old('doctor_id') == $doctor['id'] ? 'selected' : '' }}>
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
                            <label class="form-label fw-bold">Seleccionar Medición</label>
                            <select name="oximetro_id" class="form-select" required>
                                <option value="">Seleccionar Medición</option>
                                @foreach($oximetros['data'] as $oximetro)
    <option value="{{ $oximetro['id'] }}">
        {{ $oximetro['bpm'] }} BPM - {{ $oximetro['spo2'] }} SpO2
    </option>
@endforeach

                            </select>
                        </div>
                        
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha y Hora <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" 
                                   name="fecha_hora" 
                                   value="{{ old('fecha_hora') }}" 
                                   required>
                        </div>
                    </div>

                    <!-- Campos Adicionales -->
                    <div class="col-12">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Estatus Inicial</label>
                                    <select name="estatus" class="form-select">
                                        @foreach(['programada', 'en_proceso'] as $estado)
                                            <option value="{{ $estado }}" {{ old('estatus') == $estado ? 'selected' : 'programada' }}>
                                                {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Código de Acceso</label>
                                    <input type="text" class="form-control" 
                                           name="codigo" 
                                           value="{{ old('codigo') }}"
                                           placeholder="Opcional">
                                </div>
                            </div> --}}

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Diagnóstico Inicial</label>
                                    <textarea class="form-control" name="diagnostico" 
                                              rows="1" placeholder="Opcional">{{ old('diagnostico') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times-circle me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-calendar-check me-2"></i>Programar Cita
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
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
</style>
@endpush
@endsection