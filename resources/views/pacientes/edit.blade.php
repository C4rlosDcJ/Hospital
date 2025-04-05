@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Paciente</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('pacientes.update', $paciente['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $paciente['nombre'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad" value="{{ $paciente['edad'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="grupo_sanguineo">Grupo Sanguíneo:</label>
                        <select class="form-control" id="grupo_sanguineo" name="grupo_sanguineo" required>
                            <option value="A+" {{ $paciente['grupo_sanguineo'] == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ $paciente['grupo_sanguineo'] == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ $paciente['grupo_sanguineo'] == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ $paciente['grupo_sanguineo'] == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ $paciente['grupo_sanguineo'] == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ $paciente['grupo_sanguineo'] == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ $paciente['grupo_sanguineo'] == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ $paciente['grupo_sanguineo'] == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="peso">Peso:</label>
                        <input type="number" step="0.1" class="form-control" id="peso" name="peso" value="{{ $paciente['peso'] }}">
                    </div>

                    <div class="form-group">
                        <label for="altura">Altura:</label>
                        <input type="number" step="0.1" class="form-control" id="altura" name="altura" value="{{ $paciente['altura'] }}">
                    </div>

                    <div class="form-group">
                        <label for="historial_medico">Historial Médico:</label>
                        <textarea class="form-control" id="historial_medico" name="historial_medico">{{ $paciente['historial_medico'] }}</textarea>
                    </
