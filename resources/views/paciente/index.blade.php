@extends('layouts.plantillau')

@section('title','Citas')
    
@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #0b0909;">Busca tu Cita</h2>
    <p class="text-center mb-4" style="color: #0b0909;">(Por Codigo)</p>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <form class="d-flex me-auto" role="search">
                <input name="buscarpor" class="form-control me-2 bg-secondary text-white border-0" 
                    type="search" placeholder="Buscar" aria-label="Buscar" value="{{$buscarpor}}">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
    
            
            {{-- <a href="{{ route('graficas.index') }}">
                <button type="button" class="btn btn-primary">Ver Gráficas</button>  
            </a>                

            <a href="{{ route('libros.pdfTodos') }}" class="btn btn-danger mr-3">
                <i class="fas fa-file-pdf"></i> Generar PDF de Todos
            </a> --}}

        </div>
    </nav>
    
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Descripcion</th>
                <th>Codigo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lista as $index => $listaa)
                <tr>
                    <!-- Ajustar el índice de acuerdo a la página actual -->
                    <td>{{ ($lista->currentPage() - 1) * $lista->perPage() + $index + 1 }}</td>
                    <td>{{ $listaa->fecha }}</td>
                    <td>{{ $listaa->estatus }}</td>
                    <td>{{ $listaa->descripcion }}</td>
                    <td>{{ $listaa->codigo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection