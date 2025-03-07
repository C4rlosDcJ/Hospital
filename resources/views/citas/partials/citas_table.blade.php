@foreach ($citas as $listaa)
<tr>
    <td>{{ $listaa->id_cita }}</td>
    <td>{{ $listaa->fecha }}</td>
    <td>
        <span class="badge 
            @if($listaa->estatus == 'Pendiente') bg-warning
            @elseif($listaa->estatus == 'Completada') bg-success
            @elseif($listaa->estatus == 'Cancelada') bg-danger
            @else bg-secondary
            @endif">
            {{ $listaa->estatus }}
        </span>
    </td>
    <td>{{ $listaa->descripcion }}</td>
    <td>{{ $listaa->codigo }}</td>
    <td>
        <a href="{{ route('citas.show', $listaa->id_cita) }}" class="btn btn-info btn-sm">
            <i class="bi bi-eye"></i> 
        </a>
        <a href="{{ route('citas.edit', $listaa->id_cita) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="{{ route('citas.destroy', $listaa->id_cita) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach