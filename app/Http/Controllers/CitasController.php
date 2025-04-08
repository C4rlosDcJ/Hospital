<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CitasController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_URL');
    }

    public function index()
    {
        $response = Http::withOptions(['verify' => false])->get($this->baseUrl . '/citas');
        $citas = $response->json();
        return view('citasApi.index', compact('citas'));
    }

    public function search(Request $request)
    {
        $paciente_id = $request->get('paciente_id');
        $doctor_id = $request->get('doctor_id');
        $codigo = $request->get('codigo');
        $estatus = $request->get('estatus');

        $url = "{$this->baseUrl}/citas/search?";
        if ($paciente_id) $url .= "paciente_id={$paciente_id}&";
        if ($doctor_id) $url .= "doctor_id={$doctor_id}&";
        if ($codigo) $url .= "codigo={$codigo}&";
        if ($estatus) $url .= "estatus={$estatus}&";
        $url = rtrim($url, '&');

        $response = Http::withOptions(['verify' => false])->get($url);

        if ($response->successful()) {
            $citas = $response->json();
            return view('citasApi.index', compact('citas'));
        } else {
            return back()->with('error', 'Error al buscar citas');
        }
    }

    public function create()
    {
        $pacientes = Http::withOptions(['verify' => false])->get($this->baseUrl . '/pacientes')->json();
        $doctores = Http::withOptions(['verify' => false])->get($this->baseUrl . '/doctores')->json();
        $oximetros = Http::withOptions(['verify' => false])->get($this->baseUrl . '/data/all')->json();

        return view('citasApi.create', compact('pacientes', 'doctores', 'oximetros'));
    }

    public function store(Request $request)
    {
        $response = Http::withOptions(['verify' => false])->post($this->baseUrl . '/citas', $request->all());

        if ($response->successful()) {
            return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente');
        }

        return back()->withInput()->with('error', $response->json()['message'] ?? 'Error desconocido');
    }

    public function show($id)
    {
        $response = Http::withOptions(['verify' => false])->get($this->baseUrl . "/citas/{$id}");
        $cita = $response->json();
        return view('citasApi.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Http::withOptions(['verify' => false])->get($this->baseUrl . "/citas/{$id}")->json();
        $pacientes = Http::withOptions(['verify' => false])->get($this->baseUrl . '/pacientes')->json();
        $doctores = Http::withOptions(['verify' => false])->get($this->baseUrl . '/doctores')->json();
        $oximetros = Http::withOptions(['verify' => false])->get($this->baseUrl . '/data/all')->json();

        return view('citasApi.edit', compact('cita', 'pacientes', 'doctores', 'oximetros'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::withOptions(['verify' => false])->put($this->baseUrl . "/citas/{$id}", $request->all());

        if ($response->successful()) {
            return redirect()->route('citas.index')->with('success', 'Cita actualizada');
        }

        return back()->withInput()->with('error', $response->json()['message'] ?? 'Error desconocido');
    }

    public function destroy($id)
    {
        $response = Http::withOptions(['verify' => false])->delete($this->baseUrl . "/citas/{$id}");

        if ($response->successful()) {
            return redirect()->route('citas.index')->with('success', 'Cita eliminada');
        }

        return back()->with('error', 'Error al eliminar la cita');
    }
}
