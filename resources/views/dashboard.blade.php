@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
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
    </div>
@endsection
