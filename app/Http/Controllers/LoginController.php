<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;

class LoginController extends Controller
{
    public function index() {

        return view('auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Si no esta autenticado, redirecciona a la página anterior junto con el mensaje, este mensaje se guarda en una función llamada sesion
        if (!Auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);

    }
}