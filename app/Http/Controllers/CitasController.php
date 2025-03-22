<?php

// app/Http/Controllers/CitaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CitasController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        // Define la URL base de tu API de Flask
        $this->apiUrl = 'http://127.0.0.1:5000';
    }

    // app/Http/Controllers/CitaController.php

    public function index(Request $request)
    {
        try {
            // Parámetros de búsqueda
            $search = $request->query('search');

            // Obtén las citas desde la API
            $response = Http::get("{$this->apiUrl}/citas", [
                'search' => $search, // Envía el término de búsqueda a la API
            ]);

            if ($response->successful()) {
                $citas = $response->json();

                // Paginación manual (si la API no soporta paginación)
                $perPage = 10; // Número de elementos por página
                $currentPage = $request->query('page', 1);
                $citasPaginated = collect($citas)->paginate($perPage, $currentPage);

                return view('citas.index', ['citas' => $citasPaginated]);
            } else {
                return back()->with('error', 'No se pudo obtener las citas.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/citas/{$id}");
    
            if ($response->successful()) {
                $cita = $response->json();
                return view('citasApi.show', ['cita' => $cita]);
            } else {
                return back()->with('error', 'No se pudo obtener la cita.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $response = Http::post("{$this->apiUrl}/citas", $request->all());

            if ($response->successful()) {
                return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
            } else {
                return back()->with('error', 'No se pudo crear la cita.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        try {
            // Obtén los datos de la cita desde la API
            $response = Http::get("{$this->apiUrl}/citas/{$id}");

            if ($response->successful()) {
                $cita = $response->json();
                return view('citasApi.edit', ['cita' => $cita]);
            } else {
                return back()->with('error', 'No se pudo obtener la cita para editar.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = Http::put("{$this->apiUrl}/citas/{$id}", $request->all());

            if ($response->successful()) {
                return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
            } else {
                return back()->with('error', 'No se pudo actualizar la cita.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete("{$this->apiUrl}/citas/{$id}");

            if ($response->successful()) {
                return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
            } else {
                return back()->with('error', 'No se pudo eliminar la cita.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al conectar con la API: ' . $e->getMessage());
        }
    }
}