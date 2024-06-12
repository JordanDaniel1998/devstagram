<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DevStagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <header class="border-b bg-white shadow">
        <div class="w-11/12 mx-auto flex justify-between items-center py-5">
            <h1 class="text-3xl font-black">DevStagram</h1>
            <nav class="flex gap-2 items-center">
                <a href="" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">Crear Cuenta</a>
            </nav>
        </div>
    </header>

    <main class="w-11/12 mx-auto">
        <h2 class="font-black text-center text-3xl py-10">@yield('titulo')</h2>
        @yield('contenido')
    </main>

    <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
       <p>DevStagram - Todos los derechos reservados {{ now()->year }} </p>
    </footer>

</body>

</html>
