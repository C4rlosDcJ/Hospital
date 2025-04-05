<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ $paciente['nombre'] ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Edad</label>
    <input type="number" name="edad" class="form-control" value="{{ $paciente['edad'] ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Peso (kg)</label>
    <input type="number" step="0.1" name="peso" class="form-control" value="{{ $paciente['peso'] ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Altura (cm)</label>
    <input type="number" step="0.1" name="altura" class="form-control" value="{{ $paciente['altura'] ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Grupo Sanguíneo</label>
    <select name="grupo_sanguineo" class="form-control">
        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $grupo)
            <option value="{{ $grupo }}" @if(($paciente['grupo_sanguineo'] ?? '') == $grupo) selected @endif>{{ $grupo }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Contacto de Emergencia</label>
    <input type="text" name="contacto_emergencia" class="form-control" value="{{ $paciente['contacto_emergencia'] ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Historial Médico</label>
    <textarea name="historial_medico" class="form-control">{{ $paciente['historial_medico'] ?? '' }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">ID del Usuario Asociado</label>
    <input type="number" name="user_id" class="form-control" value="{{ $paciente['user_id'] ?? '' }}" required>
</div>
