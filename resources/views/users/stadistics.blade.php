@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Estadísticas de Usuarios</h4>
    </div>
    
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100 border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Administradores</h5>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="display-4 text-primary">{{ $stats['admin'] }}</h2>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Doctores</h5>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="display-4 text-success">{{ $stats['doctor'] }}</h2>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 border-info">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">Pacientes</h5>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="display-4 text-info">{{ $stats['patient'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection