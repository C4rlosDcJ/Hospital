@php $isEdit = isset($user); @endphp

@extends('layouts.app')

@section('content')
<div class="card shadow card-hover">
    <div class="card-header {{ $isEdit ? 'bg-warning' : 'bg-success' }} text-white">
        <h4 class="mb-0">{{ $isEdit ? 'Editar Usuario' : 'Nuevo Usuario' }}</h4>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ $isEdit ? route('users.update', $user['id']) : route('users.store') }}">
            @if($isEdit) @method('PUT') @endif
            @csrf

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label required">Nombre completo</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ old('name', $user['name'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label required">Email</label>
                    <input type="email" name="email" class="form-control" 
                           value="{{ old('email', $user['email'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label {{ !$isEdit ? 'required' : '' }}">Contraseña</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ $isEdit ? 'Dejar en blanco para no cambiar' : '' }}"
                           {{ $isEdit ? '' : 'required' }}>
                </div>

                <div class="col-md-6">
                    <label class="form-label required">Rol</label>
                    <select name="role" class="form-select" required>
                        @foreach(['admin', 'doctor', 'paciente'] as $role)
                            <option value="{{ $role }}" 
                                {{ (old('role', $user['role'] ?? '') == $role) ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn {{ $isEdit ? 'btn-warning' : 'btn-success' }}">
                    <i class="fas fa-save"></i> {{ $isEdit ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="password"]');
    
    @if($isEdit)
        passwordInput.removeAttribute('required');
    @endif
});
</script>
@endpush
@endsection