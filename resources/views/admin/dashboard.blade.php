@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Card de Usuarios Registrados -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Usuarios Registrados</div>
            <div class="card-body">
                <h5 class="card-title">1,234</h5>
                <p class="card-text">Total de usuarios registrados.</p>
            </div>
        </div>
    </div>

    <!-- Card de Citas Programadas -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Citas Programadas</div>
            <div class="card-body">
                <h5 class="card-title">56</h5>
                <p class="card-text">Citas para hoy.</p>
            </div>
        </div>
    </div>

    <!-- Card de Ingresos Mensuales -->
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos de las citas recibidos desde el controlador
    const citasData = @json($data); // Pasamos los datos de citas desde Laravel al frontend

    // Preprocesamos los datos para el gráfico
    const citasLabels = citasData.map(cita => cita.fecha_hora); // Usamos la fecha de la cita como etiquetas
    const citasCount = citasData.map(cita => cita.id); // Usamos el ID de la cita para contar las citas (puedes modificarlo)

    // Configuración del gráfico
    new Chart(document.getElementById('appointmentsChart'), {
        type: 'bar',
        data: {
            labels: citasLabels, // Fechas de las citas
            datasets: [{
                label: 'Citas Programadas',
                data: citasCount, // Contador de citas (ajustar según necesidad)
                backgroundColor: '#36b9cc',
                borderColor: '#36b9cc',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
