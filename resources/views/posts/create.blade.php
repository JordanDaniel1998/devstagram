@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('titulo')
    Crear una nueva Publicación
@endsection

@section('contenido')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10">
        <div>
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-full rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="w-full bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('register') }}" method="POST" novalidate class="flex flex-col gap-5">
                @csrf
                <!-- Titulo -->
                <div class="flex flex-col gap-2">
                    <div>
                        <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Título</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Título"
                            class="border p-3 w-full rounded-lg
                            @error('titulo')
                                border-red-500
                            @enderror"
                            value="{{ old('titulo') }}">
                    </div>
                    @error('titulo')
                        <span class="text-red-500 font-medium">
                            {{ str_replace('titulo', 'nombre', $message) }}
                        </span>
                    @enderror
                </div>

                <!-- Textarea -->
                <div class="flex flex-col gap-2">
                    <div>
                        <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                        <textarea name="description" id="description" rows="5" placeholder="Descripción de una publicación"
                            class="border p-3 w-full rounded-lg
                            @error('description')
                                border-red-500
                            @enderror">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <span class="text-red-500 font-medium">
                            {{ str_replace('description', 'descripción', $message) }}
                        </span>
                    @enderror
                </div>

                <!-- Button Craer -->
                <input type="submit" value="Crear Publicación"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
