<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application - Stay organized and productive">
    <meta name="theme-color" content="#6366f1">
    
    <title>@yield('title', config('app.name', 'PRO TODO'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome 6 (Latest) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        @include('layouts.neo-navigation')
        
        <!-- Page Header with Glass Effect -->
        @isset($header)
            <header class="glass sticky top-16 z-40 animate-fade-in">
                <div class="neo-nav-container">
                    <div class="py-4">
                        <h1 class="text-2xl md:text-3xl font-bold text-gradient">
                            {{ $header }}
                        </h1>
                    </div>
                </div>
            </header>
        @endisset
        
        <!-- Page Content -->
        <main class="animate-fade-in">
            @yield('content')
        </main>
        
        @include('layouts.neo-footer')
    </div>
    
    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileToggle = document.querySelector('.neo-mobile-toggle');
            const navLinks = document.querySelector('.neo-nav-links');
            
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    navLinks.classList.toggle('active');
                    document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
                });
            }
            
            // Navbar scroll effect
            const navbar = document.querySelector('.neo-nav');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
            
            // Close mobile menu on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    if (navLinks) navLinks.classList.remove('active');
                    if (mobileToggle) mobileToggle.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
