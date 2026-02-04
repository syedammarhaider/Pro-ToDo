<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ToDo App</title>
        
        @routes
        
        <!-- Load React first -->
        <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
        
        <!-- Then load Inertia React with correct version -->
        <script src="https://unpkg.com/@inertiajs/react@2.3.13/dist/inertia-react.production.min.js"></script>
        
        <script>
            // Initialize Inertia properly
            if (typeof InertiaReact !== 'undefined') {
                window.Inertia = InertiaReact.Inertia || InertiaReact;
                console.log('Inertia initialized:', window.Inertia);
            } else {
                console.error('InertiaReact not loaded');
            }
        </script>
        
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
