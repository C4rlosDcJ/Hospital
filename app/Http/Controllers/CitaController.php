<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request){
        $buscarpor = $request->get('buscarpor');

        $lista = Citas::orderBy('id_cita', 'desc')->where('codigo','like','%'.$buscarpor.'%')->paginate(5);

        return view('citas.index',compact('lista','buscarpor'));
    }
    
    public function create(){
        return view('citas.create');
    }

    public function store(Request $request){
        $recuperar = new Citas();

        $recuperar->fecha = $request->fecha;
        $recuperar->estatus = $request->estatus;
        $recuperar->descripcion = $request->descripcion;
        $recuperar->codigo = $request->codigo;

        $recuperar->save();

        return redirect()->route('citas.show', $recuperar);
 
    }

    public function show($id_cita){
        $mostrar = Citas::find($id_cita);
        return view('citas.show', compact('mostrar'));
    }

    public function edit(Citas $editar, Request $request){
        return view('citas.edit', compact('editar'));
    }

    public function update(Request $request, Citas $editar){
        $editar->fecha = $request->fecha;
        $editar->estatus = $request->estatus;
        $editar->descripcion = $request->descripcion;
        $editar->codigo = $request->codigo;

        $editar->save();
        return redirect()->route('cita.index', $editar);
    }
    
    public function destroy(Citas $eliminar){
        $eliminar->delete();

        return redirect()->route('cita.index');
    }

    public function vista(Request $request){
        $buscarpor = $request->get('buscarpor');

        $lista = Citas::orderBy('id_cita', 'desc')->where('codigo','like','%'.$buscarpor.'%')->paginate(5);

        return view('paciente.index',compact('lista','buscarpor'));
    }

    
}
