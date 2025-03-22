@extends('layouts.plantilla')

@section('title','Editar '. $editar->codigo)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center">Editar Cita</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('citas.update', $editar)}}" method="POST">
                            @csrf 
                            @method('put')
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <div class="form-floating mb-3">
                                        <input type="datetime-local" class="form-control" name="fecha" 
                                               value="{{ $editar->fecha }}" id="floatingfn" aria-describedby="fnHelp">
                                        <label for="floatingfn">Fecha y Hora de Nacimiento</label>
                                    </div>
                                    <tr>
                                        <th>Estatus</th>
                                        <td>
                                            <select class="form-select" id="estatus" name="estatus" required>
                                                <option value="Aceptado" {{$editar->estatus=='Aceptado' ? 'selected': ''}} >Aceptado</option>
                                                <option value="Rechazado" {{$editar->estatus=='Rechazado' ? 'selected': ''}} >Rechazado</option>
                                                <option value="En Proceso" {{$editar->estatus=='En Proceso' ? 'selected': ''}} >En Proceso</option>
                                            </select>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <th>DEscripcion</th>
                                        <td>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$editar->descripcion}}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Codigo</th>
                                        <td>
                                            <input type="text" class="form-control" id="codigo" name="codigo" value="{{$editar->codigo}}" required>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Actualizar 
                                </button>
                                <a href="{{ route('citas.index') }}" class="btn btn-primary">
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
