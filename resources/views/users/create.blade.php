@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Crear Usuario</h2>
    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Nombre" required class="w-full px-4 py-2 border rounded">
        <input type="email" name="email" placeholder="Correo" required class="w-full px-4 py-2 border rounded">
        <input type="password" name="password" placeholder="Contraseña" required class="w-full px-4 py-2 border rounded">
        <select name="role" class="w-full px-4 py-2 border rounded">
            <option value="paciente">Paciente</option>
            <option value="doctor">Doctor</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">Guardar</button>
    </form>
</div>
@endsection
