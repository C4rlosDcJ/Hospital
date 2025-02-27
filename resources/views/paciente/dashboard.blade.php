@extends('layouts.paciente')

@section('title', 'Dashboard - Paciente')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Citas Programadas</div>
            <div class="card-body">
                <h5 class="card-title">2</h5>
                <p class="card-text">Citas programadas para hoy.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Historial Médico</div>
            <div class="card-body">
                <h5 class="card-title">5 Consultas</h5>
                <p class="card-text">Consultas realizadas este mes.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Próxima Cita</div>
            <div class="card-body">
                <h5 class="card-title">15/10/2023</h5>
                <p class="card-text">Con el Dr. Juan Pérez.</p>
            </div>
        </div>
    </div>
</div>
@endsection