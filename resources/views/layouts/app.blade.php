<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application">
    <meta name="theme-color" content="#6366f1">
    
    <title>@yield('title', 'PRO TODO')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite Assets - ONLY THIS, NO OTHER CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    
    @stack('styles')
</head>
<body class="antialiased bg-gray-50">
    <!-- Theme Toggle Script -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('layouts.navigation')
        
        <!-- Page Header -->
        @isset($header)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-20">
                <div class="page-header flex justify-between items-center">
                    <h1 class="welcome-text">{{ $header }}</h1>
                    @auth
                        <button id="themeToggle" class="theme-toggle">
                            <i class="fas fa-moon"></i>
                        </button>
                    @endauth
                </div>
            </div>
        @endisset
        
        <!-- Main Content -->
        <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-6">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('layouts.footer')
    </div>
    
    <!-- Message Container -->
    <div class="message-container fixed top-4 right-4 z-50 max-w-md" id="messageContainer"></div>
    
    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            
            if (themeToggle) {
                const html = document.documentElement;
                const icon = themeToggle.querySelector('i');
                
                // Set initial icon
                const currentTheme = html.getAttribute('data-theme');
                icon.className = currentTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                
                themeToggle.addEventListener('click', function() {
                    const currentTheme = html.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    html.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>