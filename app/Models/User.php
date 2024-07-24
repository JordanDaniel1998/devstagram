<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(){
        // Un usuario puede tener muchos post
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    // Almacena los seguidores de un usuario
    public function followers(){
        // Un usuario puede tener muchos seguidores
        // Un seguidor puede seguir a muchos usuarios

        // Modelo a realacionar -> User
        // Tabla intermedia -> followers
        // Columnas de la tabla intermedia -> 'user_id', 'follower_id'
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();;
    }

    // Almacenas a los que seguimos
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')->withTimestamps();;
    }


    // Comprobar si el usuario ya sigue a un usuario
    public function checkFollower(User $user){
        return $this->followers->contains($user->id);
    }
}