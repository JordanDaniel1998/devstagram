@extends('layouts.app')


@section('titulo')
    Regístrate en DevStagram
@endsection


@section('contenido')
    <div class="flex flex-col md:flex-row gap-10">
        <div class="w-full flex justify-center items-center">
            <img src="{{ asset('images/registrar.jpg') }}" alt="imagen registrar">
        </div>

        <div class="w-full bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('register') }}" method="POST" novalidate class="flex flex-col gap-5">
                @csrf
                <!-- Nombres -->
                <div class="flex flex-col gap-2">
                    <div>
                        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombres completos</label>
                        <input type="text" id="name" name="name" placeholder="Nombres"
                            class="border p-3 w-full rounded-lg
                            @error('name')
                                border-red-500
                            @enderror"
                            value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="text-red-500 font-medium">
                            {{ str_replace('name', 'nombre', $message) }}
                        </span>
                    @enderror
                </div>

                <!-- Usuario -->
                <div class="flex flex-col gap-2">
                    <div>
                        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                        <input type="text" id="username" name="username" placeholder="Avatar"
                            class="border p-3 w-full rounded-lg
                            @error('username')
                                border-red-500
                            @enderror"
                            value="{{ old('username') }}">
                    </div>
                    @error('username')
                        <span class="text-red-500 font-medium">
                            {{ str_replace('username', 'username', $message) }}
                        </span>
                    @enderror
                </div>

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

                <!-- Repeat Password -->
                <div class="flex flex-col gap-2">
                    <div>
                        <label for="password_confirmation"
                            class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Repetir contraseña"
                            class="border p-3 w-full rounded-lg
                            @error('password_confirmation')
                                border-red-500
                            @enderror">
                        @error('password_confirmation')
                            <span class="text-red-500 font-medium">
                                {{ str_replace('password_confirmation', 'repetir password', $message) }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Button Enviar -->
                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
