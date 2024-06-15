@extends('layouts.app')


@section('titulo')
    Inicia Sesión en DevStagram
@endsection


@section('contenido')
    <div class="flex flex-col md:flex-row gap-10">
        <div class="w-full flex justify-center items-center">
            <img src="{{ asset('images/login.jpg') }}" alt="imagen login">
        </div>

        <div class="w-full flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg p-8 w-full">
                <form action="{{ route('login') }}" method="POST" novalidate class="flex flex-col gap-5">
                    @csrf

                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-medium">
                            {{ session('mensaje') }}
                        </p>
                    @endif

                    <!-- Email -->
                    <div class="flex flex-col gap-2">
                        <div>
                            <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                            <input type="email" id="email" name="email" placeholder="Correo electrónico"
                                class="border p-3 w-full rounded-lg
                                @error('email')
                                    border-red-500
                                @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-red-500 font-medium">
                                    {{ str_replace('email', 'email', $message) }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-2">
                        <div>
                            <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                            <input type="password" id="password" name="password" placeholder="Contraseña"
                                class="border p-3 w-full rounded-lg
                                @error('password')
                                    border-red-500
                                @enderror">
                            @error('password')
                                <span class="text-red-500 font-medium">
                                    {{ str_replace('password', 'password', $message) }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- input -->
                    <div class="flex justify-start items-center gap-2">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="blocktext-gray-500 font-normal">Mantener mi sesión abierta</label>
                    </div>

                    <!-- Button Enviar -->
                    <input type="submit" value="Iniciar Sesión"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
        </div>
    </div>
@endsection
