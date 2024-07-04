<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener usuarios a quienes seguimos

       /*  if (!Auth::check()) {
            return redirect()->route('login');
        } */

        $ids = auth()->user()->followings->pluck('id')->toArray();
        // latest() -> Permite ordenar desde ele utlimo post hacia el mas antiguo
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(6);



        return view('home', ['posts' => $posts]);
        /* return view('home'); */
    }
}
