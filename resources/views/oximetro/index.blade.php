@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-gradient-danger text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-heartbeat me-2"></i>Monitorización en Tiempo Real
                </h3>
                <div class="badge bg-white text-primary">
                    <i class="fas fa-sync-alt me-2"></i>Actualización en tiempo real
                </div>
            </div>
        </div>

        <div class="card-body">
            @if(isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @else
                <!-- Tarjetas de los promedios al principio -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-lungs"></i> SpO2 Promedio
                                </h5>
                                <h2 class="mb-0">
                                    {{ number_format($lecturas->avg('spo2'), 1) }}%
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-heartbeat"></i> BPM Promedio
                                </h5>
                                <h2 class="mb-0">
                                    {{ number_format($lecturas->avg('bpm'), 0) }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-thermometer-half"></i> Temp. Promedio
                                </h5>
                                <h2 class="mb-0">
                                    {{ number_format($lecturas->avg('temp'), 1) }}°C
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de datos de las lecturas -->
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th><i class="fas fa-clock"></i> Fecha/Hora</th>
                                <th><i class="fas fa-lungs"></i> SpO2 (%)</th>
                                <th><i class="fas fa-heart"></i> BPM</th>
                                <th><i class="fas fa-thermometer-half"></i> Temp (°C)</th>
                                <th><i class="fas fa-microchip"></i> Dispositivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lecturas as $lectura)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($lectura['received_at'])->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="{{ $lectura['spo2_class'] }}">
                                    {{ $lectura['spo2'] }}
                                    <i class="fas fa-lungs ms-2"></i>
                                </td>
                                <td class="{{ $lectura['bpm_class'] }}">
                                    {{ $lectura['bpm'] }}
                                    <i class="fas fa-heartbeat ms-2"></i>
                                </td>
                                <td>
                                    {{ $lectura['temp'] }}
                                    <i class="fas fa-thermometer-half ms-2"></i>
                                </td>
                                <td>
                                    <span class="badge bg-dark">
                                        ID: {{ $lectura['id'] }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-heartbeat fa-2x mb-3"></i><br>
                                    No hay lecturas disponibles
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateData() {
        fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTableRows = doc.querySelector('tbody').innerHTML;
                if (document.querySelector('tbody').innerHTML !== newTableRows) {
                    document.querySelector('tbody').innerHTML = newTableRows;
                }

                // Actualiza los valores de los promedios en las tarjetas
                document.querySelectorAll('.card h2').forEach((el, index) => {
                    el.innerHTML = doc.querySelectorAll('.card h2')[index].innerHTML;
                });
            });
    }

    setInterval(updateData, 5000); // Actualiza los datos cada 5 segundos
</script>
@endpush

@push('styles')
<style>
    .spo2-normal { color: #28a745; font-weight: bold; }
    .spo2-warning { color: #ffc107; font-weight: bold; }
    .spo2-danger { color: #dc3545; font-weight: bold; }

    .bpm-normal { color: #28a745; font-weight: bold; }
    .bpm-warning { color: #ffc107; font-weight: bold; }
    .bpm-danger { color: #dc3545; font-weight: bold; }

    .table-hover tbody tr:hover {
        background-color: rgba(220, 53, 69, 0.05);
    }
</style>
@endpush

@endsection
