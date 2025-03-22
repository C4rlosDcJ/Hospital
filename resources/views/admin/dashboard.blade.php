@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Usuarios Registrados</div>
            <div class="card-body">
                <h5 class="card-title">1,234</h5>
                <p class="card-text">Total de usuarios registrados.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Citas Programadas</div>
            <div class="card-body">
                <h5 class="card-title">56</h5>
                <p class="card-text">Citas para hoy.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Ingresos Mensuales</div>
            <div class="card-body">
                <h5 class="card-title">$12,345</h5>
                <p class="card-text">Total de ingresos este mes.</p>
            </div>
        </div>
    </div>
</div>
@endsection