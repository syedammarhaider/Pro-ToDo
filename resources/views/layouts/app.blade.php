<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Professional Todo Management Application - Stay organized and productive">
    <meta name="theme-color" content="#6366f1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Performance Optimization Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <title>@yield('title', config('app.name', 'PRO TODO'))</title>
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="{{ asset('') }}">
    
    <!-- Critical CSS Inline -->
    <style>
        /* Critical Above-the-Fold CSS */
        *{box-sizing:border-box;margin:0;padding:0}body{font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;line-height:1.5;background:#f8fafc;color:#1e293b}.container{max-width:1200px;margin:0 auto;padding:0 15px}.btn{display:inline-block;padding:8px 16px;border:none;border-radius:6px;cursor:pointer;text-decoration:none;transition:all 0.2s}.btn-primary{background:#4f46e5;color:#fff}.btn-primary:hover{background:#4338ca}.form-control{width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;font-size:14px}.card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;box-shadow:0 2px 4px rgba(0,0,0,0.1)}.glass-effect{background:rgba(255,255,255,0.8);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.2)}[data-theme="dark"]{background:#0f172a;color:#f8fafc}[data-theme="dark"] .card{background:#1e293b;border-color:#334155}[data-theme="dark"] .glass-effect{background:rgba(30,41,59,0.8);border-color:rgba(51,65,85,0.2)}.loading{opacity:0.6;pointer-events:none}.fade-in{animation:fadeIn 0.3s ease-in}@keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
    </style>
    
    <!-- Fonts with font-display: swap -->
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap"></noscript>
    
    <!-- Font Awesome 6 - Optimized -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    <!-- Bootstrap 5 - Optimized -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"></noscript>

    <!-- Custom CSS - Deferred -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}" media="print" onload="this.media='all'">
    
    <!-- Theme Initialization Script (Must be in head to prevent flash) -->
    <script>
        // Initialize theme immediately to prevent flash
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
            // Set initial theme on html tag
            document.querySelector('html').setAttribute('data-theme', theme);
        })();
    </script>
    
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
        
        /* Dark Theme Variables - Ultra Professional Visibility */
        [data-theme="dark"] {
            --bs-body-bg: #0f172a;
            --bs-body-color: #f8fafc;
            --bs-card-bg: #1e293b;
            --bs-border-color: #334155;
            --bs-navbar-bg: #1e293b;
            --bs-navbar-color: #f8fafc;
            --bs-btn-primary-bg: #4f46e5;
            --bs-btn-primary-hover: #6366f1;
            --bs-input-bg: #1e293b;
            --bs-input-border: #475569;
            --bs-input-focus: #6366f1;
            --bs-dropdown-bg: #1e293b;
            --bs-dropdown-color: #f8fafc;
            --bs-dropdown-hover: #334155;
            --bs-text-muted: #cbd5e1;
            --bs-text-primary: #f8fafc;
            --bs-text-secondary: #e2e8f0;
            --bs-shadow: rgba(0, 0, 0, 0.4);
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
        
        /* Ultra Professional Dark Mode Text Visibility */
        [data-theme="dark"] {
            /* Ensure maximum text contrast */
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] body {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] h1,
        [data-theme="dark"] h2,
        [data-theme="dark"] h3,
        [data-theme="dark"] h4,
        [data-theme="dark"] h5,
        [data-theme="dark"] h6 {
            color: #f8fafc !important;
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        [data-theme="dark"] p,
        [data-theme="dark"] span,
        [data-theme="dark"] div,
        [data-theme="dark"] small,
        [data-theme="dark"] label,
        [data-theme="dark"] td,
        [data-theme="dark"] th,
        [data-theme="dark"] li,
        [data-theme="dark"] a {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .text-primary {
            color: #818cf8 !important;
        }
        
        [data-theme="dark"] .text-secondary {
            color: #cbd5e1 !important;
        }
        
        [data-theme="dark"] .text-muted {
            color: #94a3b8 !important;
        }
        
        [data-theme="dark"] .text-success {
            color: #34d399 !important;
        }
        
        [data-theme="dark"] .text-danger {
            color: #f87171 !important;
        }
        
        [data-theme="dark"] .text-warning {
            color: #fbbf24 !important;
        }
        
        [data-theme="dark"] .text-info {
            color: #60a5fa !important;
        }
        
        [data-theme="dark"] .text-dark {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .text-light {
            color: #e2e8f0 !important;
        }
        
        [data-theme="dark"] .text-white {
            color: #ffffff !important;
        }
        
        [data-theme="dark"] .lead {
            color: #e2e8f0 !important;
        }
        
        [data-theme="dark"] .fw-bold,
        [data-theme="dark"] .fw-semibold {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .card-title,
        [data-theme="dark"] .card-text {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .dropdown-item {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .nav-link {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .navbar-brand {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .btn {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .btn-outline-primary {
            color: #818cf8 !important;
        }
        
        [data-theme="dark"] .btn-outline-secondary {
            color: #cbd5e1 !important;
        }
        
        [data-theme="dark"] .btn-outline-light {
            color: #e2e8f0 !important;
        }
        
        [data-theme="dark"] .form-label {
            color: #e2e8f0 !important;
        }
        
        [data-theme="dark"] .form-text {
            color: #94a3b8 !important;
        }
        
        [data-theme="dark"] .placeholder {
            color: #64748b !important;
        }
        
        [data-theme="dark"] .table {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .table th {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .table td {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .list-group-item {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .modal-title {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .modal-body {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .toast-body {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .accordion-button {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .badge {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .alert {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .blockquote {
            color: #e2e8f0 !important;
        }
        
        [data-theme="dark"] .input-group-text {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .page-link {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .breadcrumb-item {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .breadcrumb-item.active {
            color: #cbd5e1 !important;
        }
        
        [data-theme="dark"] .progress-bar {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .spinner-border {
            border-color: #f8fafc !important;
        }
        
        [data-theme="dark"] .spinner-grow {
            background-color: #f8fafc !important;
        }
        
        [data-theme="dark"] .close,
        [data-theme="dark"] .btn-close {
            color: #f8fafc !important;
        }
        
        /* Footer specific dark mode fixes */
        [data-theme="dark"] footer {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] footer p,
        [data-theme="dark"] footer span,
        [data-theme="dark"] footer div,
        [data-theme="dark"] footer h1,
        [data-theme="dark"] footer h2,
        [data-theme="dark"] footer h3,
        [data-theme="dark"] footer h4,
        [data-theme="dark"] footer h5,
        [data-theme="dark"] footer h6,
        [data-theme="dark"] footer a,
        [data-theme="dark"] footer small,
        [data-theme="dark"] footer li {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] footer .text-muted {
            color: #94a3b8 !important;
        }
        
        [data-theme="dark"] footer .lead {
            color: #e2e8f0 !important;
        }
        
        /* Header specific dark mode fixes */
        [data-theme="dark"] header {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] header p,
        [data-theme="dark"] header span,
        [data-theme="dark"] header div,
        [data-theme="dark"] header h1,
        [data-theme="dark"] header h2,
        [data-theme="dark"] header h3,
        [data-theme="dark"] header h4,
        [data-theme="dark"] header h5,
        [data-theme="dark"] header h6,
        [data-theme="dark"] header a,
        [data-theme="dark"] header small {
            color: #f8fafc !important;
        }
        
        /* Todo specific dark mode fixes */
        [data-theme="dark"] .todo-item-micro {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .todo-item-micro p,
        [data-theme="dark"] .todo-item-micro span,
        [data-theme="dark"] .todo-item-micro div,
        [data-theme="dark"] .todo-item-micro small {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .todo-item-micro .text-muted {
            color: #94a3b8 !important;
        }
        
        /* Filter specific dark mode fixes */
        [data-theme="dark"] .filter-toggle-btn {
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .filter-toggle-btn span {
            color: #f8fafc !important;
        }
        
        /* Override any remaining text colors */
        [data-theme="dark"] * {
            color: inherit !important;
        }
        
        [data-theme="dark"] p,
        [data-theme="dark"] span,
        [data-theme="dark"] div,
        [data-theme="dark"] small,
        [data-theme="dark"] label,
        [data-theme="dark"] h1,
        [data-theme="dark"] h2,
        [data-theme="dark"] h3,
        [data-theme="dark"] h4,
        [data-theme="dark"] h5,
        [data-theme="dark"] h6,
        [data-theme="dark"] a,
        [data-theme="dark"] li,
        [data-theme="dark"] td,
        [data-theme="dark"] th {
            color: #f8fafc !important;
        }
        
        /* Form Controls Dark Mode */
        [data-theme="dark"] .form-control {
            background-color: var(--bs-input-bg) !important;
            color: var(--bs-body-color) !important;
            border-color: var(--bs-input-border) !important;
        }
        
        [data-theme="dark"] .form-control::placeholder {
            color: #94a3b8 !important;
        }
        
        [data-theme="dark"] .form-control:focus {
            background-color: var(--bs-input-bg) !important;
            color: var(--bs-body-color) !important;
            border-color: var(--bs-input-focus) !important;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25) !important;
        }
        
        /* Dropdown Dark Mode */
        [data-theme="dark"] .dropdown-menu {
            background-color: var(--bs-dropdown-bg) !important;
            border-color: var(--bs-border-color) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4) !important;
        }
        
        [data-theme="dark"] .dropdown-item {
            color: var(--bs-dropdown-color) !important;
        }
        
        [data-theme="dark"] .dropdown-item:hover {
            background-color: var(--bs-dropdown-hover) !important;
            color: var(--bs-dropdown-color) !important;
        }
        
        /* Table Dark Mode */
        [data-theme="dark"] .table {
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] .table th {
            background-color: #334155 !important;
            color: #f8fafc !important;
            border-color: var(--bs-border-color) !important;
        }
        
        [data-theme="dark"] .table td {
            border-color: var(--bs-border-color) !important;
        }
        
        /* Links Dark Mode */
        [data-theme="dark"] a {
            color: #818cf8 !important;
        }
        
        [data-theme="dark"] a:hover {
            color: #a5b4fc !important;
        }
        
        /* Badge Dark Mode */
        [data-theme="dark"] .badge {
            color: #f8fafc !important;
        }
        
        /* Alert Dark Mode */
        [data-theme="dark"] .alert {
            background-color: #1e293b !important;
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
        }
        
        /* Button Dark Mode Enhancements */
        [data-theme="dark"] .btn-outline-primary {
            border-color: #6366f1 !important;
            color: #818cf8 !important;
        }
        
        [data-theme="dark"] .btn-outline-primary:hover {
            background-color: #6366f1 !important;
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .btn-outline-secondary {
            border-color: #64748b !important;
            color: #94a3b8 !important;
        }
        
        [data-theme="dark"] .btn-outline-secondary:hover {
            background-color: #64748b !important;
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .btn-outline-light {
            border-color: #cbd5e1 !important;
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .btn-outline-light:hover {
            background-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        
        /* Modal Dark Mode */
        [data-theme="dark"] .modal-content {
            background-color: var(--bs-card-bg) !important;
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] .modal-header {
            background-color: #334155 !important;
            border-color: var(--bs-border-color) !important;
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .modal-footer {
            background-color: #1e293b !important;
            border-color: var(--bs-border-color) !important;
        }
        
        /* Pagination Dark Mode */
        [data-theme="dark"] .page-link {
            background-color: var(--bs-card-bg) !important;
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] .page-link:hover {
            background-color: var(--bs-dropdown-hover) !important;
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] .page-item.active .page-link {
            background-color: #6366f1 !important;
            border-color: #6366f1 !important;
            color: #f8fafc !important;
        }
        
        /* List Group Dark Mode */
        [data-theme="dark"] .list-group-item {
            background-color: var(--bs-card-bg) !important;
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] .list-group-item:hover {
            background-color: var(--bs-dropdown-hover) !important;
        }
        
        /* Progress Bar Dark Mode */
        [data-theme="dark"] .progress {
            background-color: #334155 !important;
        }
        
        /* Accordion Dark Mode */
        [data-theme="dark"] .accordion-button {
            background-color: var(--bs-card-bg) !important;
            color: var(--bs-body-color) !important;
            border-color: var(--bs-border-color) !important;
        }
        
        [data-theme="dark"] .accordion-button:not(.collapsed) {
            background-color: #334155 !important;
            color: #f8fafc !important;
        }
        
        [data-theme="dark"] .accordion-item {
            background-color: var(--bs-card-bg) !important;
            border-color: var(--bs-border-color) !important;
        }
        
        /* Toast Dark Mode */
        [data-theme="dark"] .toast {
            background-color: var(--bs-card-bg) !important;
            border-color: var(--bs-border-color) !important;
            color: var(--bs-body-color) !important;
        }
        
        [data-theme="dark"] .toast-header {
            background-color: #334155 !important;
            border-color: var(--bs-border-color) !important;
            color: #f8fafc !important;
        }
        
        /* Input Group Dark Mode */
        [data-theme="dark"] .input-group-text {
            background-color: #334155 !important;
            border-color: var(--bs-input-border) !important;
            color: var(--bs-body-color) !important;
        }
        
        /* Footer Dark Mode Enhancement */
        [data-theme="dark"] footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e293b 100%) !important;
        }
        
        [data-theme="dark"] footer .lead {
            color: #e2e8f0 !important;
        }
        
        [data-theme="dark"] footer .text-muted {
            color: #94a3b8 !important;
        }
        
        /* Ensure all text is visible in dark mode */
        [data-theme="dark"] * {
            text-shadow: none !important;
        }
        
        [data-theme="dark"] h1,
        [data-theme="dark"] h2,
        [data-theme="dark"] h3,
        [data-theme="dark"] h4,
        [data-theme="dark"] h5,
        [data-theme="dark"] h6 {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
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
            
            // Update theme icon based on current theme
            function updateThemeIcon(theme) {
                if (themeIcon) {
                    themeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                }
            }
            
            // Set initial icon
            const currentTheme = html.getAttribute('data-theme') || 'light';
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
    
    <!-- Bootstrap JS - Deferred for Performance -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- Performance Monitoring -->
    <script>
        // Performance optimization
        if ('requestIdleCallback' in window) {
            requestIdleCallback(() => {
                // Preload critical resources
                const criticalLinks = document.querySelectorAll('link[rel="preload"]');
                criticalLinks.forEach(link => {
                    if (link.rel === 'preload' && link.as === 'style') {
                        link.onload = null;
                        link.rel = 'stylesheet';
                    }
                });
            });
        }
        
        // Lazy load images
        const lazyImages = document.querySelectorAll('img[data-src]');
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            lazyImages.forEach(img => imageObserver.observe(img));
        }
    </script>

    @stack('scripts')
</body>
</html>
