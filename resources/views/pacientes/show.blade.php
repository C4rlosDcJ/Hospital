@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <h3 class="mb-0"><i class="fas fa-user-injured me-2"></i>Detalles del Paciente</h3>
            </div>

            <div class="card-body">
                <div class="d-flex flex-column">
                    <h5 class="fw-bold text-primary">{{ $paciente['nombre'] }}</h5>
                    <p><strong>Edad:</strong> {{ $paciente['edad'] }} años</p>
                    <p><strong>Grupo Sanguíneo:</strong> {{ $paciente['grupo_sanguineo'] }}</p>
                    <p><strong>Peso:</strong> {{ $paciente['peso'] }} kg</p>
                    <p><strong>Altura:</strong> {{ $paciente['altura'] }} cm</p>
                    <p><strong>Historial Médico:</strong> {{ $paciente['historial_medico'] ?? 'No disponible' }}</p>
                    <p><strong>Contacto de Emergencia:</strong> {{ $paciente['contacto_emergencia'] ?? 'No disponible' }}</p>

                    <a href="{{ route('pacientes.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i>Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
