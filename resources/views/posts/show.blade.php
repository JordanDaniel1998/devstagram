@extends('layouts.app')


@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10">
        <div class="flex flex-col gap-2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}">

            <div class="flex justify-start items-center gap-1">
                @auth
                    @if ($post->checkLike(auth()->user()))
                        <form action="{{ route('posts.likes.destroy', $post) }}" method="POST" class="flex justify-center items-center">
                            @method('DELETE')
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('posts.likes.store', $post) }}" method="POST" class="flex justify-center items-center">
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </button>
                        </form>
                    @endif
                @endauth
                <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">likes</span></p>
            </div>

            <div class="flex flex-col gap-1">
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="">{{ $post->description }}</p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <div>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Eliminar Publicación"
                                class="bg-red-500 hover:bg-red-600 rounded text-white font-bold cursor-pointer py-2 px-5 md:duration-300">
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        <div>
            <div class="shadow bg-white p-5 flex flex-col gap-10">
                @auth
                    <div class="flex flex-col gap-5">
                        <p class="text-3xl font-bold text-center">Agrega un nuevo comentario</p>
                        @if (session('mensaje'))
                            <p class="bg-green-500 text-white font-medium text-xl py-2 px-5 rounded-lg text-center message">
                                {{ session('mensaje') }}
                            </p>
                        @endif
                        <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST"
                            class="flex flex-col gap-5">
                            @csrf
                            <!-- Textarea -->
                            <div class="flex flex-col gap-2">
                                <div>
                                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un
                                        comentario</label>
                                    <textarea name="comentario" id="comentario" rows="5" placeholder="Descripción de una publicación"
                                        class="border p-3 w-full rounded-lg
                            @error('comentario')
                                border-red-500
                            @enderror">{{ old('comentario') }}</textarea>
                                </div>
                                @error('comentario')
                                    <span class="text-red-500 font-medium">
                                        {{ str_replace('comentario', 'comentario', $message) }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Button Craer -->
                            <input type="submit" value="Guardar Comentario"
                                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                        </form>
                    </div>
                @endauth
                <div class="flex flex-col">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="flex flex-col gap-1 border-t-2 last-of-type:border-b-2 py-3">
                                <a href="{{ route('posts.index', ['user' => $comentario->user->username]) }}"
                                    class="font-bold text-xl">{{ $comentario->user->username }}</a>
                                <p class="font-normal text-lg">{{ $comentario->comentario }}</p>
                                <p class="text-gray-500 text-sm font-normal">{{ $comentario->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="font-medium text-xl">No hay comentarios aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/alert.js')
@endpush
