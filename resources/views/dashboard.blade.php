@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <section class="flex justify-center">
        <div class="w-full flex flex-col md:flex-row gap-10">
            <div class="w-full flex justify-center md:justify-end items-center">
                <img src="{{ asset('svg/usuario.svg') }}" alt="user" class="w-44 md:w-96">
            </div>

            <div class="w-full flex flex-col gap-2 justify-center items-center md:items-start">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm font-bold">0 <span class="font-normal">Seguidores</span> </p>

                <p class="text-gray-800 text-sm font-bold">0 <span class="font-normal">Siguiendo</span> </p>

                <p class="text-gray-800 text-sm font-bold">0 <span class="font-normal">Post</span> </p>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}"><img
                                src="{{ asset('uploads') . '/' . $post->imagen }}"
                                alt="Imagen del post {{ $post->titulo }}"></a>
                    </div>
                @endforeach
            </div>
            <div>
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section>
@endsection
