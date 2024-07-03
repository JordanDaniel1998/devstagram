<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request){
        // $request -> Cada vez que se envia alguna peticion, $request contiene toda la información enviada incluido la informacion del usuario quien esta autenticado ( $request->user()->id = auth()->user()->id )
        // $user -> Es el usuario que realiza alguna acción dentro de la página

        // attach() -> agrega un nuevo registro
        $user->followers()->attach($request->user()->id);
        return back();

    }

    public function destroy(User $user, Request $request){
        // detach() -> permite borrar un registro
        $user->followers()->detach($request->user()->id);
        return back();
    }
}
