<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: linear-gradient(135deg,var(--bg-main) 0%,#1a2a6c 50%,var(--card-dark) 100%);">
            <div>
                <a href="/" class="flex flex-col items-center gap-2">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        TD
                    </div>
                    <span class="text-white/80 text-sm">Todo App</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 glass-effect">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
