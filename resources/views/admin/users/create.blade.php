@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
<div class="container-fluid">
    <h1>Crear Usuario</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select class="form-control" id="role" name="role" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Guardar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Script para validar el nombre -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');

        nameInput.addEventListener('input', function () {
            const regex = /^[A-Za-z\s]*$/;
            if (!regex.test(this.value)) {
                this.value = this.value.replace(/[^A-Za-z\s]/g, '');
            }
        });
    });
</script>
@endsection