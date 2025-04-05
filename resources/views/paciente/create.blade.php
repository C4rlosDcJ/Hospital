@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Nuevo Paciente</h2>
        
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pacientes.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna Izquierda -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre completo</label>
                        <input type="text" name="nombre" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('nombre') }}">
                    </div>
                    
                    <!-- Select de Usuarios Actualizado -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Usuario Asociado</label>
                        <select name="user_id" required 
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user['id'] }}" 
                                    @selected(old('user_id') == $user['id'])>
                                    {{ $user['name'] }} - {{ $user['email'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Edad</label>
                        <input type="number" name="edad" value="{{ old('edad') }}"
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Grupo Sanguíneo</label>
                        <select name="grupo_sanguineo" 
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccione...</option>
                            <option value="A+" @selected(old('grupo_sanguineo') == 'A+')>A+</option>
                            <option value="A-" @selected(old('grupo_sanguineo') == 'A-')>A-</option>
                            <option value="B+" @selected(old('grupo_sanguineo') == 'B+')>B+</option>
                            <option value="B-" @selected(old('grupo_sanguineo') == 'B-')>B-</option>
                            <option value="AB+" @selected(old('grupo_sanguineo') == 'AB+')>AB+</option>
                            <option value="AB-" @selected(old('grupo_sanguineo') == 'AB-')>AB-</option>
                            <option value="O+" @selected(old('grupo_sanguineo') == 'O+')>O+</option>
                            <option value="O-" @selected(old('grupo_sanguineo') == 'O-')>O-</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Peso (kg)</label>
                        <input type="number" step="0.1" name="peso" value="{{ old('peso') }}"
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Altura (cm)</label>
                        <input type="number" step="0.1" name="altura" value="{{ old('altura') }}"
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Campos Full Width -->
            <div class="mt-6 space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Contacto de Emergencia</label>
                    <input type="text" name="contacto_emergencia" value="{{ old('contacto_emergencia') }}"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Historial Médico</label>
                    <textarea name="historial_medico"
                              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 h-32">{{ old('historial_medico') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('pacientes.index') }}" class="text-gray-600 hover:text-blue-600">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar Paciente
                </button>
            </div>
        </form>
    </div>
</div>
@endsection