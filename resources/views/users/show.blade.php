@extends('layouts.admin')

@section('content')
<div class="card shadow">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0">Detalles del Usuario</h4>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <dl class="row">
                    <dt class="col-sm-3">Nombre:</dt>
                    <dd class="col-sm-9">{{ $user['name'] }}</dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">{{ $user['email'] }}</dd>

                    <dt class="col-sm-3">Rol:</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-{{ $user['role'] == 'admin' ? 'danger' : 'info' }}">
                            {{ ucfirst($user['role']) }}
                        </span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Regresar
        </a>
        <div>
            <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>
</div>
@endsection