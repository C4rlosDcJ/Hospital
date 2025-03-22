@extends('layouts.citas')

@section('title', 'Detalles de la Cita')

@section('content')
    <h1 class="my-4">Detalles de la Cita</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Código: {{ $cita['codigo'] }}</h5>
            <p class="card-text"><strong>Descripción:</strong> {{ $cita['descripcion'] }}</p>
            <p class="card-text"><strong>Doctor:</strong> {{ $cita['doctor'] }}</p>
            <p class="card-text"><strong>Paciente:</strong> {{ $cita['paciente'] }}</p>
            <p class="card-text"><strong>Fecha y Hora:</strong> {{ \Carbon\Carbon::parse($cita['fecha_hora'])->format('d/m/Y H:i') }}</p>
            <p class="card-text">
                <strong>Estatus:</strong>
                <span class="badge bg-{{ $cita['estatus'] === 'Activo' ? 'success' : 'warning' }}">
                    {{ $cita['estatus'] }}
                </span>
            </p>
            <p class="card-text"><strong>Creado:</strong> {{ \Carbon\Carbon::parse($cita['created_at'])->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Actualizado:</strong> {{ \Carbon\Carbon::parse($cita['updated_at'])->format('d/m/Y H:i') }}</p>
            <a href="{{ route('citas.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection