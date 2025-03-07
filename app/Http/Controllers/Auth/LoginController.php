<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Maneja el intento de inicio de sesión.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Verificar si el usuario ha excedido el límite de intentos
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));
            return back()->withErrors([
                'email' => "Demasiados intentos de inicio de sesión. Por favor, intente nuevamente en $seconds segundos.",
            ]);
        }

        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[^@]+@[^@]+\.com$/',
            ],
            'password' => 'required|min:8',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.regex' => 'El correo debe terminar con .com.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Limpiar el contador de intentos fallidos
            RateLimiter::clear($this->throttleKey($request));

            $request->session()->regenerate();

            // Redirigir al usuario según su rol
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('doctor')) {
                return redirect()->route('doctor.dashboard');
            } elseif ($user->hasRole('paciente')) {
                return redirect()->route('paciente.dashboard');
            }
        }

        // Incrementar el contador de intentos fallidos
        RateLimiter::hit($this->throttleKey($request));

        // Si la autenticación falla, regresar con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    /**
     * Genera una clave única para el límite de intentos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}