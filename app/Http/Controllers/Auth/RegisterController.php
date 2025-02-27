<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validación
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar el rol "paciente"
        $role = Role::where('name', 'paciente')->first();
        if ($role) {
            $user->roles()->attach($role);
        } else {
            return redirect()->back()->with('error', 'Rol no encontrado.');
        }

        // Redirigir al login
        return redirect()->route('login.index')->with('success', 'Registro exitoso. Inicia sesión.');
    }
}