<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
{
    return $this->belongsToMany(Role::class);
}


    public function hasRole($role)
{
    $this->loadMissing('roles'); // Carga la relación si no está cargada
    return $this->roles->contains('name', $role);
}

}