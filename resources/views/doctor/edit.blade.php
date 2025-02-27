@extends('layouts.plantilla')

@section('title','Editar '. $editar->codigo)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center">Editar Estatus del Paciente</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dcitas.update', $editar)}}" method="POST">
                            @csrf 
                            @method('put')
                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                                    
                                </table>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Actualizar
                                </button>
                                <a href="{{ route('dcita.index') }}" class="btn btn-primary">
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
