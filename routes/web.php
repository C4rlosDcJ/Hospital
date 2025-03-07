<?php

use App\Http\Controllers\CitaController;
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\UserExportController;



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

// Ruta para el panel de Administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
// Ruta para el panel de Doctor
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
});

// Ruta para el panel de Paciente
Route::middleware(['auth', 'role:paciente'])->group(function () {
    Route::get('/paciente/dashboard', [PacienteController::class, 'dashboard'])->name('paciente.dashboard');
});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas por Autenticación y Roles
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    // Rutas de citas para el Admin

    Route::get('/citas/search', [CitaController::class, 'search'])->name('citas.search');

    Route::get('citas', [CitaController::class, 'index'])->name('cita.index');
    Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
    Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
    Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

// Grupo de rutas para el rol de doctor
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/citas/search', [CitaController::class, 'search'])->name('citas.search');

    Route::get('citas', [CitaController::class, 'index'])->name('cita.index');
    Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
    Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
    Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

// Grupo de rutas para el rol de paciente
Route::middleware(['auth', 'role:paciente'])->group(function () {
    // Ruta principal del paciente
    Route::get('paciente', [CitaController::class, 'vista'])->name('paciente.index');

    // // Rutas de citas para el paciente
    // Route::get('citas', [CitaController::class, 'index'])->name('cita.index');
    // Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
    // Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
    // Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
    // Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    // Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
    // Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

// Importar Exel
Route::post('/import-users', [UserImportController::class, 'import'])->name('import.users');
// Exportar Exel
Route::get('/export-users', [UserExportController::class, 'export'])->name('export.users');