<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());

        $imagen = $request->file('file');

        //generar un id unico para las imagenes
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();










        //guardar la imagen al servidor
        $imagenServidor = $manager->read($imagen);
        //agregamos efecto a la imagen con intervention
        $imagenServidor->cover(1000, 1000);

        if (!File::isDirectory(public_path('uploads'))) {
            File::makeDirectory(public_path('uploads'), 0777, true);
        }

        $imagenesPath = public_path('uploads') . '/' . $nombreImagen;

        $imagenServidor->save($imagenesPath);

        return response()->json([
            'imagen' => $nombreImagen,
        ]);
    }
}