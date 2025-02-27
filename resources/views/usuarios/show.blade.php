@extends('layouts.plantilla')

@section('title','Usuarios'. $mostrar->name)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3><i class="bi bi-book-half"></i> Detalle del Usuario</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>ID</th>
                                <td>{{ $mostrar->id }}</td>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $mostrar->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $mostrar->email }}</td>
                            </tr>
                            <tr>
                                <th>Editorial</th>
                                <td>{{ $mostrar->role }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left-circle"></i> Regresar
                        </a>
                        <a href="{{ route('users.edit', $mostrar) }}" class="btn btn-outline-warning">
                            <i class="bi bi-pencil-square"></i> Editar Usuario
                        </a>
                        <form action="{{ route('users.destroy', $mostrar) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este libro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
