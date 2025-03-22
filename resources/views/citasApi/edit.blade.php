// resources/views/citasApi/edit.blade.php

@extends('layouts.citas')

@section('title', 'Editar Cita')

@section('content')
    <h1 class="my-4">Editar Cita</h1>

    <form action="{{ route('citas.update', $cita['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $cita['codigo'] }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $cita['descripcion'] }}</textarea>
        </div>
        <div class="mb-3">
            <label for="doctor_id" class="form-label">ID del Doctor</label>
            <input type="number" class="form-control" id="doctor_id" name="doctor_id" value="{{ $cita['doctor_id'] }}" required>
        </div>
        <div class="mb-3">
            <label for="paciente_id" class="form-label">ID del Paciente</label>
            <input type="number" class="form-control" id="paciente_id" name="paciente_id" value="{{ $cita['paciente_id'] }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" value="{{ \Carbon\Carbon::parse($cita['fecha_hora'])->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-3">
            <label for="estatus" class="form-label">Estatus</label>
            <select class="form-select" id="estatus" name="estatus" required>
                <option value="Activo" {{ $cita['estatus'] === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="En proceso" {{ $cita['estatus'] === 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Cancelado" {{ $cita['estatus'] === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Cita</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection