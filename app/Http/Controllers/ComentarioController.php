<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post){

        $request->validate([
            'comentario' => 'required',
        ]);

        $comentario = new Comentario;

        $comentario->comentario = $request->comentario;
        $comentario->user_id = auth()->user()->id;
        $comentario->post_id = $post->id;

        $comentario->save();

        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
