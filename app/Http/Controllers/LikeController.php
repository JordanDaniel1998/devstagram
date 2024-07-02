<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post, Request $request){
        $post->likes()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request){
        // Identifica que usuario esta dando click
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
