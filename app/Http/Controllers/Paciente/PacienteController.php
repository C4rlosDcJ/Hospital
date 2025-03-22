<?php

namespace App\Http\Controllers\Paciente; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Citas;

class PacienteController extends Controller
{
    public function dashboard()
    {
        return view('paciente.dashboard'); // Vista del panel de administrador
    }

    public function index(){
        $query = Citas::query();
        $citas = $query->paginate(10);
        return view('paciente.index', compact('citas'));
    }
}
