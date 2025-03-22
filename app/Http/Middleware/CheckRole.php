<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $roles, $message = 'No tienes permiso para acceder a esta página.')
    {
        // Divide los roles en un array
        $roles = explode('|', $roles);

        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, $message);
        }

        // Verifica si el usuario tiene alguno de los roles especificados
        $user = Auth::user();
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Si no tiene ninguno de los roles, devuelve un error 403
        abort(403, $message);
    }
}