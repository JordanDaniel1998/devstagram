<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Request -> no esta disponible en componentes livewires
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post){
        $this->post = $post;
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like(){

        if($this->post->checkLike(auth()->user())){
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
                'post_id' => $this->post->id,
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}