@extends('layouts.plantilla')

@section('title', 'Register')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Crear Usuario</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nombre</th>
                                    <td>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contraseña</th>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Confirmar Contraseña</th>
                                    <td>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rol</th>
                                    <td>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="" selected disabled>Selecciona un rol</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Paciente">Paciente</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Registrar
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-left"></i> Regresar
                            </a>
                        </div>
                    </form>
                   </div>
            </div>
        </div>
    </div>
</div>

@endsection
