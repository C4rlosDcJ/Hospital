<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\DoctorController;
// use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\OximetroController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\Admin\UsersController;




/*
|--------------------------------------------------------------------------
| Rutas Públicas (Accesibles sin autenticación)
|--------------------------------------------------------------------------
*/

// Ruta de inicio (formulario de login)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.index');

// Ruta para procesar el login
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:3,1') // Permite solo 3 intentos por minuto
    ->name('login.store');

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
    // Importar Excel
    Route::post('/import-users', [UserImportController::class, 'import'])->name('import.users');
    // Exportar Excel
    Route::get('/export-users', [UserExportController::class, 'export'])->name('export.users');

    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    // Oximetro
    Route::get('/oximetro', [OximetroController::class, 'index'])->name('oximetro');

    Route::get('citas/search', [CitasController::class, 'search'])->name('citas.search');
    Route::resource('citas', CitasController::class);

    Route::resource('operaciones', OperacionController::class);
    
    // Route::resource('pacientes', PacienteController::class);
    Route::resource('pacientes', PacienteController::class);

    // Route::resource('users', UsersController::class);

    Route::resource('users', UsersController::class);
Route::get('/users/statistics', [UsersController::class, 'statistics'])->name('users.statistics');
Route::get('/users/export', [UsersController::class, 'export'])->name('users.export');
    


});

// Acceso para doctor
Route::middleware(['auth', 'role:doctor'])->group(function () {

    // Oximetro
    // Route::get('/oximetro', [OximetroController::class, 'index'])->name('oximetro');
});

// Route::group(['middleware' => ['auth', 'role:admin|doctor']], function () {
//     // Rutas Citas Medicas
//     Route::get('citas', [CitaController::class, 'index'])->name('citas.index');
//     Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
//     Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
//     Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
//     Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
//     Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
//     Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
//     Route::get('/citas/search', [CitaController::class, 'search'])->name('citas.search');
// });


// Grupo de rutas para el rol de paciente
Route::middleware(['auth', 'role:paciente'])->group(function () {
    // Ruta principal del paciente
    Route::get('paciente', [PacienteController::class, 'index'])->name('paciente.index');

});

// Route::get('/oximetro', [OximetroController::class, 'index'])->name('oximetro');
Route::get('/oximetro', [OximetroController::class, 'index'])->name('oximetro.index');  




        // // Rutas Citas Medicas
        // Route::get('citas', [CitaController::class, 'index'])->name('citas.index');
        // Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
        // Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
        // Route::get('citas/{mostrar}', [CitaController::class, 'show'])->name('citas.show');
        // Route::get('citas/{editar}/edit', [CitaController::class, 'edit'])->name('citas.edit');
        // Route::put('citas/{editar}', [CitaController::class, 'update'])->name('citas.update');
        // Route::delete('citas/{eliminar}', [CitaController::class, 'destroy'])->name('citas.destroy');
        // Route::get('/citas/search', [CitaController::class, 'search'])->name('citas.search');



        // Route::post('servos', [CitasController::class, 'servo'])->name('servos.view');

        // Ruta para la vista de control (GET)
Route::get('/control', function () {
    return view('servos.control');
})->name('control');

// Ruta para enviar comandos (POST)
Route::post('/servos', function (Request $request) {
    // Aquí iría la lógica para comunicarse con la API Python
    return response()->json(['status' => 'success']);
})->name('servos.command');
