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
                    @livewire('like-post', ['post' => $post])
                @endauth
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
