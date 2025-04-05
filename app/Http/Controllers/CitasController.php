<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CitasController extends Controller
{
    
    public function index()
    {
        $response = Http::get(env('API_URL').'/citas');
        $citas = $response->json();
        return view('citasApi.index', compact('citas'));
    }

    public function search(Request $request)
{
    // Obtener parámetros de búsqueda desde la solicitud
    $paciente_id = $request->get('paciente_id');
    $doctor_id = $request->get('doctor_id');
    $codigo = $request->get('codigo');
    $estatus = $request->get('estatus');

    // Construir la URL de la búsqueda con los parámetros
    $url = "{$this->baseUrl}/citas/search?";
    
    if ($paciente_id) {
        $url .= "paciente_id={$paciente_id}&";
    }
    if ($doctor_id) {
        $url .= "doctor_id={$doctor_id}&";
    }
    if ($codigo) {
        $url .= "codigo={$codigo}&";
    }
    if ($estatus) {
        $url .= "estatus={$estatus}&";
    }

    // Eliminar el último '&' si existe
    $url = rtrim($url, '&');

    // Hacer la solicitud GET a la API Flask
    $response = Http::get($url);

    if ($response->successful()) {
        $citas = $response->json();
        return view('citas.index', compact('citas'));
    } else {
        return back()->with('error', 'Error al buscar citas');
    }
}


    public function create()
    {
        $pacientes = Http::get(env('API_URL').'/pacientes')->json();
        $doctores = Http::get(env('API_URL').'/doctores')->json();
        $oximetros = Http::get(env('API_URL').'/data/all')->json();
        
        return view('citasApi.create', compact('pacientes', 'doctores', 'oximetros'));
    }

    public function store(Request $request)
    {   
        $response = Http::post(env('API_URL').'/citas', $request->all());
        
        if ($response->successful()) {
            return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente');
        }
        
        return back()->withInput()->with('error', $response->json()['message']);
    }

    public function show($id)
    {
        $response = Http::get(env('API_URL')."/citas/{$id}");
        $cita = $response->json();
        return view('citasApi.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Http::get(env('API_URL')."/citas/{$id}")->json();
        $pacientes = Http::get(env('API_URL').'/pacientes')->json();
        $doctores = Http::get(env('API_URL').'/doctores')->json();
        $oximetros = Http::get(env('API_URL').'/data/all')->json();
        
        return view('citasApi.edit', compact('cita', 'pacientes', 'doctores', 'oximetros'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put(env('API_URL')."/citas/{$id}", $request->all());
        
        if ($response->successful()) {
            return redirect()->route('citas.index')->with('success', 'Cita actualizada');
        }
        
        return back()->withInput()->with('error', $response->json()['message']);
    }

    public function destroy($id)
    {
        $response = Http::delete(env('API_URL')."/citas/{$id}");
        
        if ($response->successful()) {
            return redirect()->route('citas.index')->with('success', 'Cita eliminada');
        }
        
        return back()->with('error', 'Error al eliminar la cita');
    }
}