<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application - Authentication">
    
    <title>{{ config('app.name', 'PRO TODO') }} - Authentication</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    
    @stack('styles')
</head>
<body class="auth-minimal">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gradient-radial from-primary/10 to-transparent"></div>
    </div>
    
    <!-- Auth Card -->
    <div class="auth-card">
        <div class="text-center mb-8">
            <a href="/" class="neo-logo inline-flex justify-center mb-4">
                <i class="fas fa-tasks text-5xl"></i>
                <span class="text-3xl font-bold">PRO<span class="text-gradient">TODO</span></span>
            </a>
            <p class="text-gray-600 mt-2">
                Welcome back! Please sign in to continue
            </p>
        </div>
        
        {{ $slot }}
        
        <!-- Footer Links -->
        <div class="mt-8 text-center text-sm text-gray-600">
            &copy; {{ date('Y') }} PRO TODO. All rights reserved.
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>