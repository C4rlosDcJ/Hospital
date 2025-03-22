@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->roles->first()->name ?? 'Sin rol' }}</td>
    <td>
        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">
            <i class="bi bi-eye"></i>
        </a>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach

