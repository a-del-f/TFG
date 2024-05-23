<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    @if(!request()->routeIs('login'))
        <x-nav-link :href="route('dashboard')">
            <img src="{{ asset('img/volver.png') }}" style="display: block;" width="50px"  alt="Descripción de la imagen">
        </x-nav-link>
    @endif
    <div>
        <a href="/">
            <!-- Este es el logo predeterminado de la aplicación -->
            <img id="app-logo" class="w-20 h-20 fill-current text-gray-500" src="{{ asset('img/default-logo.png') }}" alt="Descripción de la imagen">
        </a>
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>

<!-- Aquí añadimos un script para cambiar el logo si existe un valor en localStorage -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var $logoImg = $('#app-logo');

        // Cargar el logo desde localStorage
        if (localStorage.getItem('logoSrc')) {
            $logoImg.attr('src', localStorage.getItem('logoSrc'));
        }
    });
</script>
</body>
</html>
