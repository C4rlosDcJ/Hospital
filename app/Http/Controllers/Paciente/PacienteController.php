<?php

namespace App\Http\Controllers\Paciente; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function dashboard()
    {
        return view('paciente.dashboard'); // Vista del panel de administrador
    }
}