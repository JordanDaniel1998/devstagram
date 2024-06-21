<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(1);

        return view('dashboard', ['user' => $user, 'posts' => $posts]);
    }

    public function create(Request $request)
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'description' => 'required',
            'imagen' => 'required',
        ]);

        // 1ra forma de almacenar en la BD
        /* Post::create([
            'titulo' => $request->titulo,
            'description' => $request->description,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]); */

        // 2da forma de almacenar en la BD
        /* $post = new Post;
        $post->titulo = $request->titulo;
        $post->description = $request->description;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */

        // 3ra forma de almacenar en la BD
        $request
            ->user()
            ->posts()
            ->create([
                'titulo' => $request->titulo,
                'description' => $request->description,
                'imagen' => $request->imagen,
                'user_id' => auth()->user()->id,
            ]);

        return redirect()->route('posts.error', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        if($user->id !== $post->user_id){
            return redirect()->route('posts.index', auth()->user()->username);
        }

        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){

    }
}