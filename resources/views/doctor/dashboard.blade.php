@extends('layouts.doctor')

@section('title', 'Dashboard - Doctor')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Citas Hoy</div>
            <div class="card-body">
                <h5 class="card-title">5</h5>
                <p class="card-text">Citas programadas para hoy.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Pacientes Atendidos</div>
            <div class="card-body">
                <h5 class="card-title">12</h5>
                <p class="card-text">Pacientes atendidos este mes.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Ingresos Mensuales</div>
            <div class="card-body">
                <h5 class="card-title">$3,456</h5>
                <p class="card-text">Total de ingresos este mes.</p>
            </div>
        </div>
    </div>
</div>
@endsection