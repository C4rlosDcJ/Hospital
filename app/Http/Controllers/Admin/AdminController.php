<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Llamar al método getCitasData para obtener los datos de citas
        $data = $this->getCitasData();

        return view('admin.dashboard', compact('data')); // Pasar los datos a la vista
    }

    public function getCitasData()
    {
        try {
            // Crear un cliente Guzzle
            $client = new Client();

            // Hacer la solicitud GET a la API Flask, deshabilitando la verificación SSL
            $response = $client->get('http://192.168.0.23:5000/citas', [
                'verify' => false // Deshabilita la verificación SSL
            ]);

            // Obtener el cuerpo de la respuesta y convertirlo a un array
            $data = json_decode($response->getBody(), true);

            // Regresar los datos al dashboard
            return $data;
        } catch (RequestException $e) {
            // Si hay un error en la solicitud, capturamos el mensaje y lo mostramos
            return ['error' => 'No se pudo obtener los datos de la API: ' . $e->getMessage()];
        }
    }
}
