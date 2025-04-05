@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
            <h1 class="text-3xl font-bold">{{ $paciente['nombre'] }}</h1>
            <p class="mt-2">ID: {{ $paciente['id'] }}</p>
        </div>

        <div class="p-6">
            <!-- Pestañas -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <button @click="openTab = 1" :class="openTab === 1 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-4 px-1 border-b-2 font-medium">
                        Información General
                    </button>
                    <button @click="openTab = 2" :class="openTab === 2 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-4 px-1 border-b-2 font-medium">
                        Historial Médico
                    </button>
                    <button @click="openTab = 3" :class="openTab === 3 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-4 px-1 border-b-2 font-medium">
                        Operaciones
                    </button>
                </nav>
            </div>

            <!-- Contenido de pestañas -->
            <div x-data="{ openTab: 1 }">
                <!-- Pestaña 1 -->
                <div x-show="openTab === 1" class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-gray-600">Edad:</label>
                            <p class="font-medium">{{ $paciente['edad'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600">Grupo Sanguíneo:</label>
                            <p class="font-medium">{{ $paciente['grupo_sanguineo'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600">Peso:</label>
                            <p class="font-medium">{{ $paciente['peso'] ? $paciente['peso'].' kg' : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600">Altura:</label>
                            <p class="font-medium">{{ $paciente['altura'] ? $paciente['altura'].' cm' : 'N/A' }}</p>
                        </div>
                        <!-- Nuevos campos agregados -->
                        <div>
                            <label class="text-gray-600">Contacto de Emergencia:</label>
                            <p class="font-medium">{{ $paciente['contacto_emergencia'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-gray-600">Usuario Asociado:</label>
                            <p class="font-medium">
                                @if(isset($paciente['user']))
                                    {{ $paciente['user']['name'] }} (ID: {{ $paciente['user_id'] }})
                                @else
                                    {{ $paciente['user_id'] ?? 'N/A' }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Pestaña 2 -->
                <div x-show="openTab === 2" class="p-4">
                    <p class="text-gray-700">{{ $paciente['historial_medico'] ?? 'Sin historial médico registrado' }}</p>
                </div>

                <!-- Pestaña 3 -->
                <div x-show="openTab === 3" class="p-4">
                    @foreach($paciente['operaciones'] as $operacion)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold text-blue-600">{{ $operacion['tipo'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $operacion['fecha_hora'] }}</p>
                        <p class="mt-2">{{ $operacion['observaciones'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('pacientes.index') }}" class="text-blue-500 hover:text-blue-600 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver al listado
        </a>
    </div>
</div>
@endsection