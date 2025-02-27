<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        if(auth()->attempt(request(['email','password'])) == false){
            return back()->withErrors([
                'message' => 'contra o algo mal :v',
            ]);
        }else {

            if(auth()->user()->role == 'Administrador'){
                return redirect()->route('cita.index');
            }            
            else{
                 if(auth()->user()->role == 'Doctor'){
                     return redirect()->route('dcita.index');
                 }else{
                    if(auth()->user()->role == 'Paciente'){
                        return redirect()->route('paciente.index');
                    }
                 } 
                
            }
        }
       
    }
}
