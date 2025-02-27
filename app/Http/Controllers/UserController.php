<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){

        $buscarpor = $request->get('buscarpor');

        $lista = User::orderBy('id', 'desc')->where('name','like','%'.$buscarpor.'%')->paginate(5);

        return view('usuarios.index',compact('lista','buscarpor'));
    }

    public function create(){
        return view('usuarios.create');
    }

    public function store(Request $request){
        $recuperar = new User();

        $recuperar->name = $request->name;
        $recuperar->email = $request->email;
        $recuperar->password = $request->password;
        $recuperar->role = $request->role;

        $recuperar->save();

        return redirect()->route('users.index');
    }
    



     public function show($id){
         $mostrar = User ::find($id);
         return view('usuarios.show', compact('mostrar'));
     }



     public function edit(User $editar, Request $request){
         return view('usuarios.edit', compact('editar'));
     }

     public function update(Request $request, User $editar){
        $editar->name = $request->name;
        $editar->email = $request->email;
        $editar->password = $request->password;
        $editar->role = $request->role;
        $editar->save();
        return redirect()->route('users.index', $editar);
     }
    
     public function destroy(User $eliminar){
         $eliminar->delete();
         return redirect()->route('users.index');
     }

    //  public function pdfTodos()
    // {
    //     $users = User::all(); 
    //     $pdf = Pdf::loadView('usuarios.pdfTodos', compact('users')); 

    //     return $pdf->stream("Usuarios.pdf"); 
    // }
}
