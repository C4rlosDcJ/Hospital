@extends('layouts.citas')

@section('title', 'Crear Nueva Cita')

@section('content')
    <h1 class="my-4">Crear Nueva Cita</h1>

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="doctor_id" class="form-label">ID del Doctor</label>
            <input type="number" class="form-control" id="doctor_id" name="doctor_id" required>
        </div>
        <div class="mb-3">
            <label for="paciente_id" class="form-label">ID del Paciente</label>
            <input type="number" class="form-control" id="paciente_id" name="paciente_id" required>
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
        </div>
        <div class="mb-3">
            <label for="estatus" class="form-label">Estatus</label>
            <select class="form-select" id="estatus" name="estatus" required>
                <option value="Activo">Activo</option>
                <option value="En proceso">En proceso</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Cita</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection