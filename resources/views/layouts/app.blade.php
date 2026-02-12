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
        /* Light Theme Variables */
        :root {
            --bs-body-bg: #f8fafc;
            --bs-body-color: #1e293b;
            --bs-card-bg: #ffffff;
            --bs-border-color: #e2e8f0;
            --bs-navbar-bg: #4f46e5;
            --bs-navbar-color: #ffffff;
            --bs-btn-primary-bg: #4f46e5;
            --bs-btn-primary-hover: #4338ca;
            --bs-input-bg: #ffffff;
            --bs-input-border: #d1d5db;
            --bs-input-focus: #4f46e5;
            --bs-dropdown-bg: #ffffff;
            --bs-dropdown-color: #374151;
            --bs-dropdown-hover: #f3f4f6;
            --bs-text-muted: #6b7280;
            --bs-shadow: rgba(0, 0, 0, 0.1);
            --bs-gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bs-gradient-warning: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --bs-gradient-danger: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        }
        
        /* Dark Theme Variables */
        [data-theme="dark"] {
            --bs-body-bg: #0f172a;
            --bs-body-color: #f1f5f9;
            --bs-card-bg: #1e293b;
            --bs-border-color: #334155;
            --bs-navbar-bg: #1e293b;
            --bs-navbar-color: #f1f5f9;
            --bs-btn-primary-bg: #4f46e5;
            --bs-btn-primary-hover: #6366f1;
            --bs-input-bg: #1e293b;
            --bs-input-border: #475569;
            --bs-input-focus: #6366f1;
            --bs-dropdown-bg: #1e293b;
            --bs-dropdown-color: #f1f5f9;
            --bs-dropdown-hover: #334155;
            --bs-text-muted: #94a3b8;
            --bs-shadow: rgba(0, 0, 0, 0.3);
            --bs-gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --bs-gradient-warning: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            --bs-gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        /* Base Styles */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        
        body {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Card Styles */
        .card {
            background-color: var(--bs-card-bg);
            border: 1px solid var(--bs-border-color);
            box-shadow: 0 4px 6px var(--bs-shadow);
            border-radius: 12px;
        }
        
        .card-header {
            background: var(--bs-gradient-primary);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
        }
        
        /* Navbar Styles */
        .navbar-dark {
            background-color: var(--bs-navbar-bg) !important;
            box-shadow: 0 2px 4px var(--bs-shadow);
        }
        
        .navbar-brand {
            color: var(--bs-navbar-color) !important;
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .nav-link {
            color: var(--bs-navbar-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }
        
        /* Form Styles */
        .form-control {
            background-color: var(--bs-input-bg);
            border: 2px solid var(--bs-input-border);
            color: var(--bs-body-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: var(--bs-input-bg);
            border-color: var(--bs-input-focus);
            color: var(--bs-body-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-1px);
        }
        
        .form-label {
            color: var(--bs-body-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        /* Button Styles */
        .btn-primary {
            background: var(--bs-gradient-primary);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
        }
        
        .btn-primary:hover {
            background: var(--bs-btn-primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.3);
        }
        
        .btn-warning {
            background: var(--bs-gradient-warning);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);
        }
        
        .btn-danger {
            background: var(--bs-gradient-danger);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
        }
        
        .btn-outline-light {
            border: 2px solid var(--bs-navbar-color);
            color: var(--bs-navbar-color);
            background: transparent;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-light:hover {
            background-color: var(--bs-navbar-color);
            color: var(--bs-navbar-bg);
            transform: translateY(-1px);
        }
        
        /* Dropdown Styles */
        .dropdown-menu {
            background-color: var(--bs-dropdown-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px var(--bs-shadow);
            padding: 0.5rem 0;
        }
        
        .dropdown-item {
            color: var(--bs-dropdown-color);
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 0;
        }
        
        .dropdown-item:hover {
            background-color: var(--bs-dropdown-hover);
            color: var(--bs-body-color);
            transform: translateX(4px);
        }
        
        /* Text Colors */
        .text-muted {
            color: var(--bs-text-muted) !important;
        }
        
        .text-primary {
            color: var(--bs-btn-primary-bg) !important;
        }
        
        .text-success {
            color: #10b981 !important;
        }
        
        .text-warning {
            color: #f59e0b !important;
        }
        
        .text-danger {
            color: #ef4444 !important;
        }
        
        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        
        /* Modal Styles */
        .modal-content {
            background-color: var(--bs-card-bg);
            border: 1px solid var(--bs-border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px var(--bs-shadow);
        }
        
        .modal-header {
            background: var(--bs-gradient-danger);
            border: none;
            border-radius: 12px 12px 0 0;
            color: white;
        }
        
        .modal-footer {
            background-color: var(--bs-card-bg);
            border-top: 1px solid var(--bs-border-color);
            border-radius: 0 0 12px 12px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .btn {
                padding: 0.625rem 1.25rem;
                font-size: 0.875rem;
            }
            
            .form-control {
                padding: 0.625rem 0.875rem;
                font-size: 0.875rem;
            }
            
            .nav-link {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.125rem;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .card-header {
                padding: 1rem;
                text-align: center;
            }
            
            .text-center h4 {
                font-size: 1.125rem;
            }
        }
        
        /* Accessibility */
        .form-control:focus,
        .btn:focus,
        .nav-link:focus {
            outline: 2px solid var(--bs-input-focus);
            outline-offset: 2px;
        }
        
        /* Smooth Transitions */
        .fade {
            transition: opacity 0.3s ease;
        }
        
        .collapse {
            transition: height 0.3s ease;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const html = document.documentElement;
            
            // Set initial theme
            const currentTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-theme', currentTheme);
            updateThemeIcon(currentTheme);
            
            // Theme toggle functionality
            if (themeToggle && themeIcon) {
                themeToggle.addEventListener('click', function() {
                    const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                    html.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateThemeIcon(newTheme);

                    // Show success message
                    if (window.showMessage) {
                        window.showMessage(`${newTheme.charAt(0).toUpperCase() + newTheme.slice(1)} mode activated`, 'success', 2000);
                    }
                });
            }
            
            function updateThemeIcon(theme) {
                if (themeIcon) {
                    themeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                }
            }
        });
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
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
