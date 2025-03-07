<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Maneja el registro de un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z\s]+$/',
            'email' => [
                'required',
                'email',
                'regex:/^[^@]+@[^@]+\.com$/',
                'unique:users,email',
            ],
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'El campo nombre completo es obligatorio.',
            'name.regex' => 'El nombre solo debe contener letras y espacios.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.regex' => 'El correo debe terminar con .com.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
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

        // Redirigir al login con un mensaje de éxito
        return redirect()->route('login.index')->with('success', 'Registro exitoso. Inicia sesión.');
    }
}