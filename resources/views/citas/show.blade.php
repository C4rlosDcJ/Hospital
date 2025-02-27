@extends('layouts.plantilla')

@section('title','Ver '. $mostrar->codigo)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h3><i class="bi bi-book-half"></i> Detalle de la Cita</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $mostrar->id_cita }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha</th>
                                    <td>{{ $mostrar->fecha }}</td>
                                </tr>
                                <tr>
                                    <th>Estatus</th>
                                    <td>
                                        <span class="badge {{ $mostrar->estatus == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $mostrar->estatus }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Descripcion</th>
                                    <td>{{ $mostrar->descripcion }}</td>
                                </tr>
                                <tr>
                                    <th>Codigo</th>
                                    <td>{{ $mostrar->codigo }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cita.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left-circle"></i> Regresar
                            </a>


                            <a href="{{ route('citas.edit', $mostrar) }}" class="btn btn-outline-warning">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            {{-- <a href="{{ route('libros.pdf', $mostrar) }}" class="btn btn-outline-warning custom-pdf-button">
                                <i class="bi bi-pencil-square"></i> PDF
                            </a>                               --}}

                            <form action="{{ route('citas.destroy', $mostrar) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este libro?');">
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
