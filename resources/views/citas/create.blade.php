@extends('layouts.plantilla')

@section('title','Citas')
    
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center">Crear Nueva Cita</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('citas.store') }}" method="POST">
                            @csrf 
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <div class="form-floating mb-3">
                                        <input type="datetime-local" class="form-control @error('datetime') is-invalid @enderror"
                                            name="fecha" value="{{ old('datetime') }}" id="floatingdatetime" >
                                        <label for="floatingdatetime">Fecha y Hora</label>
                                    </div>
                                    <tr>
                                        <th>Estatus</th>
                                        <td>
                                            <select class="form-select" id="estatus" name="estatus" required>
                                                <option value="" selected disabled>Selecciona un estatus</option>
                                                <option value="Aceptado">Aceptado</option>
                                                <option value="Rechazado">Rechazado</option>
                                                <option value="En proceso">En proceso</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Descripcion</th>
                                        <td>
                                            <input type="text" class="form-control" id="autor" name="descripcion" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Codigo de Cita</th>
                                        <td>
                                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Guardar
                                </button>
                                <a href="{{ route('cita.index') }}" class="btn btn-primary">
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
