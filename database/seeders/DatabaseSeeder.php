<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'doctor']);
        $pacienteRole = Role::create(['name' => 'paciente']);
    
        // Crear usuario
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@hospital.com',
            'password' => bcrypt('1234567890.')
        ]);
    
        // Asignar roles al usuario (relación muchos a muchos)
        $user->roles()->attach($adminRole->id);
    }
}
