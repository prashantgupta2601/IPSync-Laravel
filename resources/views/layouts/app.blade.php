<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#000000]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-200 h-full flex overflow-hidden bg-[#000000] selection:bg-[#C4B5FD]/100 selection:text-white">
        
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#000000]">
            <!-- Topbar -->
            @include('layouts.topbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-auto p-4 md:p-6 lg:p-8">
                @isset($header)
                    <header class="mb-6">
                        <div class="text-2xl font-bold leading-tight text-white">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
