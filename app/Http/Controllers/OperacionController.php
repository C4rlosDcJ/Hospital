<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OperacionController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://18.212.80.15',
            'verify' => false,
        ]);
    }

    // Obtener todas las operaciones
    public function index()
    {
        // Obtener las operaciones
        $responseOperaciones = $this->client->get('operaciones');
        $operaciones = json_decode($responseOperaciones->getBody()->getContents(), true);
    
        // Obtener los brazos robóticos
        $responseBrazos = $this->client->get('brazos-roboticos');
        $brazos = json_decode($responseBrazos->getBody()->getContents(), true);
    
        // Obtener los pacientes
        $responsePacientes = $this->client->get('pacientes');
        $pacientes = json_decode($responsePacientes->getBody()->getContents(), true);
    
        // Pasar los datos a la vista
        return view('operaciones.index', compact('operaciones', 'brazos', 'pacientes'));
    }
    

    // Obtener una operación específica
    public function show($id)
    {
        // Obtener la operación por ID
        $responseOperacion = $this->client->get("operaciones/{$id}");
        $operacion = json_decode($responseOperacion->getBody()->getContents(), true);
    
        // Obtener los brazos robóticos
        $responseBrazos = $this->client->get('brazos-roboticos');
        $brazos = json_decode($responseBrazos->getBody()->getContents(), true);
    
        // Obtener los pacientes
        $responsePacientes = $this->client->get('pacientes');
        $pacientes = json_decode($responsePacientes->getBody()->getContents(), true);
    
        // Buscar brazo robótico por ID
        $brazo = collect($brazos)->firstWhere('id', $operacion['brazo_robotico_id']);
    
        // Buscar paciente por ID
        $paciente = collect($pacientes)->firstWhere('id', $operacion['paciente_id']);
    
        // Pasar los datos a la vista
        return view('operaciones.show', compact('operacion', 'brazo', 'paciente'));
    }
    
    

    // Crear una operación
    public function create()
    {
        // Obtener los brazos robóticos
        $responseBrazos = $this->client->get('brazos-roboticos');
        $brazos = json_decode($responseBrazos->getBody()->getContents(), true);

        // Obtener los pacientes
        $responsePacientes = $this->client->get('pacientes');
        $pacientes = json_decode($responsePacientes->getBody()->getContents(), true);

        return view('operaciones.create', compact('brazos', 'pacientes'));
    }

    // Almacenar una operación
    public function store(Request $request)
    {
        $data = $request->all();

        $response = $this->client->post('operaciones', [
            'json' => $data
        ]);

        return redirect()->route('operaciones.index');
    }

    // Editar una operación
    public function edit($id)
    {
        $response = $this->client->get("operaciones/{$id}");
        $operacion = json_decode($response->getBody()->getContents(), true);

        // Obtener los brazos robóticos
        $responseBrazos = $this->client->get('brazos-roboticos');
        $brazos = json_decode($responseBrazos->getBody()->getContents(), true);

        // Obtener los pacientes
        $responsePacientes = $this->client->get('pacientes');
        $pacientes = json_decode($responsePacientes->getBody()->getContents(), true);

        return view('operaciones.edit', compact('operacion', 'brazos', 'pacientes'));
    }

    // Actualizar una operación
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $response = $this->client->put("operaciones/{$id}", [
            'json' => $data
        ]);

        return redirect()->route('operaciones.index');
    }

    // Eliminar una operación
    public function destroy($id)
    {
        $this->client->delete("operaciones/{$id}");

        return redirect()->route('operaciones.index');
    }
}
