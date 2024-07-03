@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div>
        @if (session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-medium message">
                {{ session('mensaje') }}
            </p>
        @endif
        <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" novalidate
            class="flex flex-col gap-5">
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
                        value="{{ auth()->user()->name }}">
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
                        value="{{ auth()->user()->username }}">
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
                        value="{{ auth()->user()->email }}">
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
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual</label>
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

            <!-- Password Nuevo-->
            <div class="flex flex-col gap-2">
                <div>
                    <label for="password_nuevo" class="mb-2 block uppercase text-gray-500 font-bold">Password Nuevo</label>
                    <input type="password" id="password_nuevo" name="password_nuevo" placeholder="Contraseña Nueva"
                        class="border p-3 w-full rounded-lg
                        @error('password_nuevo')
                            border-red-500
                        @enderror">
                    @error('password_nuevo')
                        <span class="text-red-500 font-medium">
                            {{ str_replace('password_nuevo', 'password', $message) }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Repetir Password Nuevo-->
            <div class="flex flex-col gap-2">
                <div>
                    <label for="password_nuevo_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Password Nuevo</label>
                    <input type="password" id="password_nuevo_confirmation" name="password_nuevo_confirmation" placeholder="Contraseña Nueva"
                        class="border p-3 w-full rounded-lg
                        @error('password_nuevo_confirmation')
                            border-red-500
                        @enderror">
                    @error('password_nuevo_confirmation')
                        <span class="text-red-500 font-medium">
                            {{ str_replace('password_nuevo_confirmation', 'password', $message) }}
                        </span>
                    @enderror
                </div>
            </div>



            <!-- Imagen -->
            <div class="flex flex-col gap-2">
                <div>
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Foto de perfil</label>
                    <input type="file" id="imagen" name="imagen" accept=".jpg, .jeg, .png"
                        class="border p-3 w-full rounded-lg" value="">
                </div>
            </div>

            <!-- Button Enviar -->
            <input type="submit" value="Guardar cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/alert.js')
@endpush
