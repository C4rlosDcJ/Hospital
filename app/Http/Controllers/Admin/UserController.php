<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar todos los usuarios con opción de búsqueda
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->input('search');

        // Consulta base
        $query = User::query();

        // Aplicar filtro de búsqueda si hay un término
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }

        // Paginar los resultados
        $users = $query->paginate(6);

        // Pasar el término de búsqueda a la vista
        return view('admin.users.index', compact('users', 'search'));
    }

    // Mostrar el formulario para crear un usuario
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|regex:/^[A-Za-z\s]+$/|max:255', // Solo letras y espacios
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ], [
            'name.regex' => 'El nombre solo debe contener letras y espacios.',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar el rol al usuario
        $role = Role::find($request->role);
        $user->roles()->attach($role);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar los detalles de un usuario
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Actualizar un usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Actualizar el rol del usuario
        $role = Role::find($request->role);
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar un usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    public function search(Request $request)
{
    
    $search = $request->input('search');

    $query = User::query();

    // Aplicar filtro de búsqueda si hay un término
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
    }

    $users = $query->paginate(6);

    $usersTable = view('admin.users.partials.users_table', compact('users'))->render();
    $pagination = $users->links('pagination::bootstrap-4')->toHtml();

    // Devolver una respuesta JSON
    return response()->json([
        'users' => $usersTable,
        'pagination' => $pagination,
    ]);
}
}