@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-heartbeat me-2"></i>Detalles de Monitoreo</h3>
                <div class="btn-group">
                    <a href="{{ route('citas.edit', $cita['id']) }}" class="btn btn-light btn-sm">
                        <i class="fas fa-edit me-2"></i>Editar
                    </a>
                    <a href="{{ route('citas.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Datos del Paciente</h5>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Nombre:</dt>
                                <dd class="col-sm-8">{{ $cita['paciente'] }}</dd>
                                
                                <dt class="col-sm-4">ID:</dt>
                                <dd class="col-sm-8">{{ $cita['paciente_id'] }}</dd>
                                
                                <dt class="col-sm-4">Historial:</dt>
                                <dd class="col-sm-8">
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        Ver registros <i class="fas fa-file-medical ms-2"></i>
                                    </a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-heartbeat me-2"></i>Datos del Oxímetro</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-danger">
                                        <h6 class="alert-heading"><i class="fas fa-heart-pulse"></i> BPM</h6>
                                        <hr>
                                        <div class="display-4 fw-bold">{{ $cita['oximetro']['bpm'] ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-info">
                                        <h6 class="alert-heading"><i class="fas fa-lungs"></i> SpO2</h6>
                                        <hr>
                                        <div class="display-4 fw-bold">{{ $cita['oximetro']['spo2'] ?? 'N/A' }}%</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <h6 class="alert-heading"><i class="fas fa-thermometer-half"></i> Temperatura</h6>
                                        <hr>
                                        <div class="display-4 fw-bold">{{ $cita['oximetro']['temp'] ?? 'N/A' }}°C</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection