@extends('layouts.plantilla')

@section('title','Usuarios')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #ffffff;">Lista de Usuarios</h2>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <form class="d-flex me-auto" role="search">
                <input name="buscarpor" class="form-control me-2 bg-secondary text-white border-0" 
                    type="search" placeholder="Buscar" aria-label="Buscar" value="{{$buscarpor}}">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
    
            <a href="{{ route('users.create') }}">
                <button type="button" class="btn btn-primary">Nuevo Usuario</button>  
            </a>                
             {{-- <a href="{{route('usuarios.pdfTodos')}}">
                <button class="btn btn-primary mr-4">PDF</button>
            </a>  --}}
            {{-- <a href="{{ route('#') }}">
                <button type="button" class="btn btn-primary">Ver Gráficas</button>  
            </a>                 --}}

        </div>
    </nav>
    
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lista as $index => $listaa)
                <tr>
                    <!-- Ajustar el índice de acuerdo a la página actual -->
                    <td>{{ ($lista->currentPage() - 1) * $lista->perPage() + $index + 1 }}</td>
                    <td>{{ $listaa->name }}</td>
                    <td>{{ $listaa->email }}</td>
                    <td>{{ $listaa->role }}</td>
                    <td>
                        <a href="{{ route('users.show', $listaa->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('users.edit', $listaa->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('users.destroy', $listaa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="pagination">
        {{ $lista->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
