<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jajal Medical - Case Manager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased bg-slate-950 text-slate-100 selection:bg-indigo-500 selection:text-white">
        <!-- Ambient Decorative Glows -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-indigo-600/20 blur-[128px]"></div>
            <div class="absolute top-1/2 -right-40 w-96 h-96 rounded-full bg-blue-500/20 blur-[128px]"></div>
            <div class="absolute -bottom-40 left-1/3 w-96 h-96 rounded-full bg-teal-500/15 blur-[128px]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff08_1px,transparent_1px)] [background-size:24px_24px] opacity-40"></div>
        </div>

        <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </body>
</html>
