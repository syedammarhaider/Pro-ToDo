<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application - Stay organized and productive">
    <meta name="theme-color" content="#6366f1">
    
    <title>@yield('title', config('app.name', 'PRO TODO'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        /* Modern CSS Variables */
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --primary-soft: #e0e7ff;
            --secondary: #14b8a6;
            --secondary-dark: #0d9488;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --dark: #0f172a;
            --gray: #64748b;
            --light: #f8fafc;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            --radius-sm: 0.375rem;
            --radius: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse 2s infinite;
        }

        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--primary), var(--secondary));
            border-radius: 4px;
        }

        /* Loading States */
        .loader {
            width: 40px;
            height: 40px;
            border: 3px solid var(--primary-soft);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Utilities */
        @media (max-width: 640px) {
            .container-custom {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('layouts.navigation')
        
        <!-- Page Header -->
        @isset($header)
            <header class="glass sticky top-16 z-40 animate-fade-in">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-gradient">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset
        
        <!-- Main Content -->
        <main class="animate-fade-in">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('layouts.footer')
    </div>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileToggle = document.querySelector('.mobile-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    mobileMenu.classList.toggle('hidden');
                    document.body.style.overflow = mobileMenu.classList.contains('hidden') ? '' : 'hidden';
                });
            }
            
            // Navbar scroll effect
            const navbar = document.querySelector('.neo-nav');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('shadow-lg', 'bg-white/98');
                    } else {
                        navbar.classList.remove('shadow-lg', 'bg-white/98');
                    }
                });
            }
            
            // Close mobile menu on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    if (mobileMenu) mobileMenu.classList.add('hidden');
                    if (mobileToggle) mobileToggle.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>