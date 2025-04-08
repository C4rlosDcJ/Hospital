<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function index()
    {
        try {
            $response = Http::withoutVerifying()->get($this->apiUrl . '/users');
            $users = $response->json();
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener usuarios');
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|min:8',
            'role'     => 'required|in:admin,doctor,paciente',
        ]);
    
        try {
            // Excluir el token para no enviarlo a la API
            $data = $request->except('_token');
    
            $response = Http::withoutVerifying()->post($this->apiUrl . '/users', $data);
    

            if ($response->successful()) {
                return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
            } else {
                return back()->withInput()->with('error', 'Error al crear usuario: ' . $response->body());
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Excepción: ' . $e->getMessage());
        }
    }
    

    public function edit($id)
    {
        try {
            $response = Http::withoutVerifying()->get($this->apiUrl . "/users/{$id}");
            $user = $response->json();
            return view('users.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'nullable|min:8',
            'role'     => 'required|in:admin,doctor,paciente',
        ]);

        try {
            $data = $request->except('_token');

            $response = Http::withoutVerifying()->put($this->apiUrl . "/users/{$id}", $data);

            if ($response->successful()) {
                return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
            } else {
                return back()->withInput()->with('error', 'Error al actualizar usuario: ' . $response->body());
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Excepción: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::withoutVerifying()->delete($this->apiUrl . "/users/{$id}");

            if ($response->successful()) {
                return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
            } else {
                return redirect()->back()->with('error', 'Error al eliminar usuario: ' . $response->body());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Excepción: ' . $e->getMessage());
        }
    }
}
