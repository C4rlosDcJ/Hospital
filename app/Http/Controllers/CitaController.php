<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Método para mostrar la lista de citas
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');

        // Consulta base
        $query = Citas::orderBy('id_cita', 'desc');

        // Aplicar filtro de búsqueda si hay un término
        if ($buscarpor) {
            $query->where('codigo', 'like', '%' . $buscarpor . '%')
                  ->orWhere('descripcion', 'like', '%' . $buscarpor . '%')
                  ->orWhere('estatus', 'like', '%' . $buscarpor . '%');
        }

        // Paginar los resultados
        $lista = $query->paginate(5);

        return view('citas.index', compact('lista', 'buscarpor'));
    }

    // Método para mostrar el formulario de creación de citas
    public function create()
    {
        return view('citas.create');
    }

    // Método para guardar una nueva cita
    public function store(Request $request)
    {
        $recuperar = new Citas();

        $recuperar->fecha = $request->fecha;
        $recuperar->estatus = $request->estatus;
        $recuperar->descripcion = $request->descripcion;
        $recuperar->codigo = $request->codigo;

        $recuperar->save();

        return redirect()->route('citas.show', $recuperar);
    }

    // Método para mostrar los detalles de una cita
    public function show($id_cita)
    {
        $mostrar = Citas::find($id_cita);
        return view('citas.show', compact('mostrar'));
    }

    // Método para mostrar el formulario de edición de una cita
    public function edit(Citas $editar)
    {
        return view('citas.edit', compact('editar'));
    }

    // Método para actualizar una cita
    public function update(Request $request, Citas $editar)
    {
        $editar->fecha = $request->fecha;
        $editar->estatus = $request->estatus;
        $editar->descripcion = $request->descripcion;
        $editar->codigo = $request->codigo;

        $editar->save();
        return redirect()->route('citas.index', $editar);
    }

    // Método para eliminar una cita
    public function destroy(Citas $eliminar)
    {
        $eliminar->delete();
        return redirect()->route('citas.index');
    }

    // Método para la búsqueda en tiempo real (AJAX)
    public function search(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->input('search');

        // Consulta base
        $query = Citas::orderBy('id_cita', 'desc');

        // Aplicar filtro de búsqueda si hay un término
        if ($search) {
            $query->where('codigo', 'like', '%' . $search . '%')
                  ->orWhere('descripcion', 'like', '%' . $search . '%')
                  ->orWhere('estatus', 'like', '%' . $search . '%');
        }

        // Paginar los resultados
        $citas = $query->paginate(5);

        // Renderizar la vista de la tabla y la paginación
        $citasTable = view('citas.partials.citas_table', compact('citas'))->render();
        $pagination = $citas->links('pagination::bootstrap-4')->toHtml();

        // Devolver una respuesta JSON
        return response()->json([
            'citas' => $citasTable,
            'pagination' => $pagination,
        ]);
    }
}