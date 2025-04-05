@if(count($paciente['operaciones']) > 0)
    <div class="timeline">
        @foreach($paciente['operaciones'] as $operacion)
        <div class="timeline-item">
            <div class="timeline-badge {{ $operacion['estado'] == 'completada' ? 'bg-success' : 'bg-warning' }}"></div>
            <div class="timeline-card card mb-3">
                <div class="card-body">
                    <h6 class="card-title">{{ $operacion['tipo'] }}</h6>
                    <p class="card-text text-muted small">
                        {{ \Carbon\Carbon::parse($operacion['fecha_hora'])->isoFormat('LLL') }}
                    </p>
                    <p class="card-text">{{ $operacion['observaciones'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">No hay operaciones registradas</div>
@endif