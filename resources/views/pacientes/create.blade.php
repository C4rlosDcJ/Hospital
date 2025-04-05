@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Paciente</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('pacientes.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad" required>
                    </div>

                    <div class="form-group">
                        <label for="grupo_sanguineo">Grupo Sanguíneo:</label>
                        <select class="form-control" id="grupo_sanguineo" name="grupo_sanguineo" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="peso">Peso:</label>
                        <input type="number" step="0.1" class="form-control" id="peso" name="peso">
                    </div>

                    <div class="form-group">
                        <label for="altura">Altura:</label>
                        <input type="number" step="0.1" class="form-control" id="altura" name="altura">
                    </div>

                    <div class="form-group">
                        <label for="historial_medico">Historial Médico:</label>
                        <textarea class="form-control" id="historial_medico" name="historial_medico"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="contacto_emergencia">Contacto de Emergencia:</label>
                        <input type="text" class="form-control" id="contacto_emergencia" name="contacto_emergencia">
                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>Crear Paciente
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
