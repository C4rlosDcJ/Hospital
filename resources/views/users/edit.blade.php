@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Editar Usuario</h2>
    <form action="{{ route('users.update', $user['id']) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $user['name'] }}" class="w-full px-4 py-2 border rounded">
        <input type="email" name="email" value="{{ $user['email'] }}" class="w-full px-4 py-2 border rounded">
        <input type="password" name="password" placeholder="Nueva contraseña" class="w-full px-4 py-2 border rounded">
        <select name="role" class="w-full px-4 py-2 border rounded">
            <option value="paciente" {{ $user['role'] == 'paciente' ? 'selected' : '' }}>Paciente</option>
            <option value="doctor" {{ $user['role'] == 'doctor' ? 'selected' : '' }}>Doctor</option>
            <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">Actualizar</button>
    </form>
</div>
@endsection
