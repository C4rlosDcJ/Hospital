<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Accesibles sin autenticación)
|--------------------------------------------------------------------------
*/

// Ruta de inicio (formulario de login)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.index');

// Ruta para procesar el login
Route::post('login', [LoginController::class, 'login'])->name('login.store');

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Ruta para procesar el registro
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas para dashboards
|--------------------------------------------------------------------------
*/

// Ruta para el panel de administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación y Roles
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Grupo de rutas para el rol de doctor
Route::middleware(['auth', 'role:doctor'])->group(function () {
    // Rutas de citas para el doctor
    Route::get('dcitas', [DoctorController::class, 'index'])->name('dcita.index');
    Route::post('dcitas', [DoctorController::class, 'store'])->name('dcitas.store');
    Route::get('dcitas/{mostrar}', [DoctorController::class, 'show'])->name('dcitas.show');
    Route::get('dcitas/{editar}/edit', [DoctorController::class, 'edit'])->name('dcitas.edit');
    Route::put('dcitas/{editar}', [DoctorController::class, 'update'])->name('dcitas.update');
});

// Grupo de rutas para el rol de paciente
Route::middleware(['auth', 'role:paciente'])->group(function () {
    // Ruta principal del paciente
    Route::get('paciente', [CitaController::class, 'vista'])->name('paciente.index');

    // Rutas de citas para el paciente
    Route::get('citas', [CitaController::class, 'index'])->name('cita.index');
    Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
    Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
    Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
});