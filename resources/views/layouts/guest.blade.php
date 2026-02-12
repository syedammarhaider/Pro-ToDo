<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application - Authentication">
    <meta name="theme-color" content="#6366f1">
    
    <title>{{ config('app.name', 'PRO TODO') }} - Authentication</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Auth Styles -->
    <style>
        /* Auth Specific Variables */
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --primary-soft: #e0e7ff;
            --secondary: #14b8a6;
            --secondary-dark: #0d9488;
        }

        /* Auth Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }

        .animate-rotate-slow {
            animation: rotate 20s linear infinite;
        }

        /* Auth Background */
        .auth-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-bg::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }

        /* Glass Card */
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Input Styles */
        .auth-input {
            transition: all 0.3s ease;
        }

        .auth-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Button Styles */
        .auth-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .auth-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .auth-btn:hover::after {
            width: 300px;
            height: 300px;
        }

        /* Floating Shapes */
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            right: -100px;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            bottom: 50px;
            left: 50px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .auth-card {
                padding: 1.5rem;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--primary-soft);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--primary), var(--secondary));
            border-radius: 3px;
        }
    </style>
    
    @stack('styles')
</head>
<body class="auth-bg antialiased min-h-screen flex items-center justify-center p-4">
    <!-- Animated Background Shapes -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="shape shape-1 animate-float"></div>
        <div class="shape shape-2 animate-float" style="animation-delay: -2s;"></div>
        <div class="shape shape-3 animate-float" style="animation-delay: -4s;"></div>
        
        <!-- Additional Decorative Elements -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-gradient-to-r from-indigo-500/10 to-teal-500/10 rounded-full blur-3xl animate-rotate-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-r from-purple-500/10 to-pink-500/10 rounded-full blur-3xl animate-rotate-slow" style="animation-direction: reverse;"></div>
    </div>
    
    <!-- Main Auth Card -->
    <div class="auth-card w-full max-w-md rounded-2xl p-8 animate-slide-up">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full blur-lg opacity-60"></div>
                    <div class="relative w-20 h-20 bg-gradient-to-r from-indigo-500 to-teal-500 rounded-full flex items-center justify-center text-white shadow-xl">
                        <i class="fas fa-tasks text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold">
                <span class="text-gray-900">PRO</span>
                <span class="text-gradient">TODO</span>
            </h1>
            
            <p class="text-gray-600 mt-2 text-sm">
                @yield('auth-subtitle', 'Welcome back! Please sign in to continue')
            </p>
        </div>
        
        <!-- Auth Content -->
        <div class="auth-content">
            {{ $slot }}
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500">
                &copy; {{ date('Y') }} PRO TODO. All rights reserved.
            </p>
            
            <!-- Trust Badges -->
            <div class="flex items-center justify-center space-x-4 mt-4 text-xs text-gray-400">
                <span class="flex items-center space-x-1">
                    <i class="fas fa-shield-alt text-indigo-500"></i>
                    <span>SSL Secure</span>
                </span>
                <span class="flex items-center space-x-1">
                    <i class="fas fa-lock text-teal-500"></i>
                    <span>Encrypted</span>
                </span>
                <span class="flex items-center space-x-1">
                    <i class="fas fa-clock text-indigo-500"></i>
                    <span>24/7 Support</span>
                </span>
            </div>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>