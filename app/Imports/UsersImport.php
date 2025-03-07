<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Busca el rol por su nombre
        $role = Role::where('name', $row['role'])->first();

        // Si el rol no existe, puedes manejarlo como desees (lanzar una excepción, asignar un rol por defecto, etc.)
        if (!$role) {
            throw new \Exception("El rol '{$row['rol']}' no existe.");
        }

        // Crea el usuario
        $user = new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']), // Encripta la contraseña
        ]);

        // Guarda el usuario en la base de datos
        $user->save();

        // Asigna el rol al usuario
        $user->roles()->attach($role->id);

        return $user;
    }
}