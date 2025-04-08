<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear los roles
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'doctor']);
        $pacienteRole = Role::create(['name' => 'paciente']);

        // Crear un usuario y asignarle el rol de 'Administrador'
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hospital.com',
            'password' => Hash::make('1234567890.'),  // Contraseña cifrada
            'role_id' => $adminRole->id,  // Asignar el rol
        ]);
    }
}
