<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'description', 'imagen', 'user_id'];

    public function user(){
        // Un post solo le pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios(){
        // Un post tiene muchos comentarios
        return $this->hasMany(Comentario::class)->orderBy('created_at', 'desc');
    }

    public function likes(){
        // likes() -> Hace referencia al modelo como tal
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        // likes -> Hace referencia a la información del modelo asociado
        return $this->likes->contains('user_id', $user->id);
       /* return $this->likes()->where('user_id', $user->id)->exists(); */
    }
}
