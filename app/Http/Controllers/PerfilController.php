<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil.index');
    }

    // Actualiza el perfil
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id, 'max:60'],
            'password' => 'required|min:6',
            'password_nuevo' => 'required|confirmed|min:6',
        ]);

        if (!Auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        if ($request->imagen) {
            $manager = new ImageManager(new Driver());

            $imagen = $request->file('imagen');

            //generar un id unico para las imagenes
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            //guardar la imagen al servidor
            $imagenServidor = $manager->read($imagen);
            //agregamos efecto a la imagen con intervention
            $imagenServidor->cover(1000, 1000);

            if (!File::isDirectory(public_path('perfiles'))) {
                File::makeDirectory(public_path('perfiles'), 0644);
            }

            $imagenesPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenesPath);
        }

        $usuario = User::find(auth()->user()->id);

        $usuario->name = $request->name;
        $usuario->username = Str::slug($request->username);
        $usuario->email = $request->email ?? auth()->user()->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->password = Hash::make($request->password_nuevo);


        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}