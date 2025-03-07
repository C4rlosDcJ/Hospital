<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * Devuelve una colección de usuarios.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * Define los encabezados de las columnas.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Email',
            'Rol',
            'Fecha de Creación',
            'Fecha de Actualización',
        ];
    }

    /**
     * Mapea los datos de cada usuario.
     *
     * @param mixed $user
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->roles->first()->name, // Obtén el nombre del primer rol del usuario
            $user->created_at,
            $user->updated_at,
        ];
    }
}