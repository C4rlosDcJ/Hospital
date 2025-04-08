@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>Editar Operación</h3>
    <form action="{{ route('operaciones.update', $operacion['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="brazo_robotico_id" class="form-label">Brazo Robótico</label>
            <select class="form-control" name="brazo_robotico_id">
                @foreach($brazos as $brazo)
                    <option value="{{ $brazo['id'] }}" {{ $operacion['brazo_robotico_id'] == $brazo['id'] ? 'selected' : '' }}>
                        {{ $brazo['modelo'] }} ({{ $brazo['fabricante'] }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select class="form-control" name="paciente_id">
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente['id'] }}" {{ $operacion['paciente_id'] == $paciente['id'] ? 'selected' : '' }}>
                        {{ $paciente['nombre'] }} - Edad: {{ $paciente['edad'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" name="tipo">
                <option value="inyeccion" {{ $operacion['tipo'] == 'inyeccion' ? 'selected' : '' }}>Inyección</option>
                <option value="cirugia" {{ $operacion['tipo'] == 'cirugia' ? 'selected' : '' }}>Cirugía</option>
                <option value="monitoreo" {{ $operacion['tipo'] == 'monitoreo' ? 'selected' : '' }}>Monitoreo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" name="estado">
                <option value="pendiente" {{ $operacion['estado'] == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="completada" {{ $operacion['estado'] == 'completada' ? 'selected' : '' }}>Completada</option>
                <option value="fallida" {{ $operacion['estado'] == 'fallida' ? 'selected' : '' }}>Fallida</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" name="fecha_hora" value="{{ \Carbon\Carbon::parse($operacion['fecha_hora'])->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="observaciones">{{ $operacion['observaciones'] }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Operación</button>
    </form>
</div>
@endsection
