<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request){
        $buscarpor = $request->get('buscarpor');

        $lista = Citas::orderBy('id_cita', 'desc')->where('codigo','like','%'.$buscarpor.'%')->paginate(5);

        return view('doctor.index',compact('lista','buscarpor'));
    }
    public function show($id_cita){
        $mostrar = Citas::find($id_cita);
        return view('doctor.show', compact('mostrar'));
    }

    public function edit(Citas $editar, Request $request){
        return view('doctor.edit', compact('editar'));
    }

    public function update(Request $request, Citas $editar){
        $editar->estatus = $request->estatus;

        $editar->save();
        return redirect()->route('dcita.index', $editar);
    }

}
