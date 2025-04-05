<div class="card shadow mb-3 vital-card" id="{{ $id }}-card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5><i class="fas fa-{{ $icon }} me-2"></i> {{ $title }}</h5>
            <div class="badge bg-light text-dark" id="{{ $id }}-status">Esperando datos...</div>
        </div>
        <div class="value-display text-center my-3" id="{{ $id }}-value">--
            <span class="trend-indicator" id="{{ $id }}-trend"></span>
        </div>
        <div class="progress mb-2">
            <div id="{{ $id }}-progress" class="progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
        <small class="text-muted">{{ $range }}</small>
    </div>
</div>
