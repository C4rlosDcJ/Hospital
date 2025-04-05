<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PacienteController extends Controller
{
    protected $client;
    protected $apiUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = env('API_URL', 'http://127.0.0.1:5000');
    }

    public function index()
    {
        try {
            $response = $this->client->get($this->apiUrl.'/pacientes');
            $pacientes = json_decode($response->getBody(), true);
            return view('paciente.index', compact('pacientes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener pacientes: '.$e->getMessage());
        }
    }

    public function create()
    {
        try {
            $response = $this->client->get($this->apiUrl.'/users');
            $users = json_decode($response->getBody(), true);
            return view('paciente.create', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener usuarios: '.$e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'user_id' => 'required|numeric',
            'edad' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'grupo_sanguineo' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'contacto_emergencia' => 'nullable|string|max:20',
            'historial_medico' => 'nullable|string'
        ]);

        try {
            $this->client->post($this->apiUrl.'/pacientes', [
                'json' => $request->all()
            ]);
            return redirect()->route('pacientes.index')->with('success', 'Paciente creado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al crear paciente: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $response = $this->client->get($this->apiUrl."/pacientes/{$id}");
            $paciente = json_decode($response->getBody(), true);
            return view('paciente.show', compact('paciente'));
        } catch (\Exception $e) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pacienteResponse = $this->client->get($this->apiUrl."/pacientes/{$id}");
            $usersResponse = $this->client->get($this->apiUrl.'/users');

            $paciente = json_decode($pacienteResponse->getBody(), true);
            $users = json_decode($usersResponse->getBody(), true);

            return view('paciente.edit', compact('paciente', 'users'));
        } catch (\Exception $e) {
            return redirect()->route('pacientes.index')->with('error', 'Error al cargar datos: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'user_id' => 'required|numeric',
            'edad' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'grupo_sanguineo' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'contacto_emergencia' => 'nullable|string|max:20',
            'historial_medico' => 'nullable|string'
        ]);

        try {
            $this->client->put($this->apiUrl."/pacientes/{$id}", [
                'json' => $request->all()
            ]);
            return redirect()->route('pacientes.show', $id)->with('success', 'Paciente actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->client->delete($this->apiUrl."/pacientes/{$id}");
            return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar: '.$e->getMessage());
        }
    }
}