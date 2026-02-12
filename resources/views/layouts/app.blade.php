<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application - Stay organized and productive">
    <meta name="theme-color" content="#6366f1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <title>@yield('title', config('app.name', 'PRO TODO'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5 (Lightweight) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS - External -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1.0.0">
    
    <!-- Dark Mode Styles -->
    <style>
        :root {
            --bs-body-bg: #fff;
            --bs-body-color: #212529;
            --bs-card-bg: #fff;
            --bs-border-color: #dee2e6;
        }
        
        [data-theme="dark"] {
            --bs-body-bg: #1a1a1a;
            --bs-body-color: #fff;
            --bs-card-bg: #2d2d2d;
            --bs-border-color: #404040;
        }
        
        [data-theme="dark"] body {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }
        
        [data-theme="dark"] .card {
            background-color: var(--bs-card-bg);
            border-color: var(--bs-border-color);
        }
        
        [data-theme="dark"] .navbar-dark {
            background-color: #0d1117 !important;
        }
        
        [data-theme="dark"] .form-control {
            background-color: var(--bs-card-bg);
            border-color: var(--bs-border-color);
            color: var(--bs-body-color);
        }
        
        [data-theme="dark"] .form-control:focus {
            background-color: var(--bs-card-bg);
            border-color: #6366f1;
            color: var(--bs-body-color);
        }
        
        [data-theme="dark"] .dropdown-menu {
            background-color: var(--bs-card-bg);
            border-color: var(--bs-border-color);
        }
        
        [data-theme="dark"] .dropdown-item {
            color: var(--bs-body-color);
        }
        
        [data-theme="dark"] .dropdown-item:hover {
            background-color: #404040;
        }
        
        [data-theme="dark"] .btn-outline-light {
            border-color: #6c757d;
            color: #6c757d;
        }
        
        [data-theme="dark"] .btn-outline-light:hover {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Theme Toggle Script -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <div class="min-vh-100">
        <!-- Navigation -->
        @include('layouts.header')
        
        <!-- Main Content -->
        <main class="container-fluid px-2 px-md-3 py-4">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('layouts.footer')
    </div>
    
    <!-- Message Container -->
    <div class="message-container" id="messageContainer" aria-live="assertive"></div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const html = document.documentElement;
            const icon = themeToggle?.querySelector('i');
            
            if (themeToggle) {
                // Set initial icon
                const currentTheme = html.getAttribute('data-theme');
                icon.className = currentTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                
                themeToggle.addEventListener('click', function() {
                    const currentTheme = html.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    html.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                    
                    // Show message
                    if (window.showMessage) {
                        window.showMessage(`${newTheme.charAt(0).toUpperCase() + newTheme.slice(1)} mode activated`, 'success', 2000);
                    }
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>