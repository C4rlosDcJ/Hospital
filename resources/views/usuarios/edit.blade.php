@extends('layouts.plantilla')

@section('title','Usuarios'. $editar->nombre)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Editar Usuario</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $editar)}}" method="POST">
                        @csrf 
                        @method('put')
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nombre</th>
                                    <td>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$editar->name}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <input type="text" class="form-control" id="email" name="email" value="{{$editar->email}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contraseña</th>
                                    <td>
                                        <input type="text" class="form-control" id="password" name="password" value="{{$editar->password}}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="Doctor" {{ $editar->role == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                                            <option value="Administrador" {{ $editar->role == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Actualizar Usuario
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
