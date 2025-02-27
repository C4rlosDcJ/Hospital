<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->role = 'Administrador';
        $user->password = '1234';

        $user->save();

        $user1 = new User;
        $user1->name = 'Doctor';
        $user1->email = 'doc@test.com';
        $user1->role = 'Doctor';
        $user1->password = '1234';

        $user1->save();

        $user2 = new User;
        $user2->name = 'Paciente';
        $user2->email = 'paciente@test.com';
        $user2->role = 'Paciente';
        $user2->password = '1234';

        $user2->save();
    }
}
