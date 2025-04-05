@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Crear Nueva Operación</h3>
    <form action="{{ route('operaciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="brazo_robotico_id" class="form-label">Brazo Robótico</label>
            <select class="form-control" name="brazo_robotico_id" required>
                @foreach($brazos as $brazo)
                    <option value="{{ $brazo['id'] }}">{{ $brazo['modelo'] }} ({{ $brazo['fabricante'] }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select class="form-control" name="paciente_id" required>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente['id'] }}">{{ $paciente['nombre'] }} - Edad: {{ $paciente['edad'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" name="tipo">
                <option value="inyeccion">Inyección</option>
                <option value="cirugia">Cirugía</option>
                <option value="monitoreo">Monitoreo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" name="estado">
                <option value="pendiente">Pendiente</option>
                <option value="completada">Completada</option>
                <option value="fallida">Fallida</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" name="fecha_hora" required>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="observaciones"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear Operación</button>
    </form>
</div>
@endsection
