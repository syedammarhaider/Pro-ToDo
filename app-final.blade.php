<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ToDo App</title>
        
        @routes
        
        <!-- Load Inertia React from CDN -->
        <script src="https://unpkg.com/@inertiajs/react@1.0.0/dist/inertia-react.prod.min.js"></script>
        
        <script>
            // The CDN exposes window.InertiaReact
            // Check what's available and assign accordingly
            if (typeof InertiaReact !== 'undefined') {
                // Different versions expose differently
                if (InertiaReact.Inertia) {
                    window.Inertia = InertiaReact.Inertia;
                } else {
                    window.Inertia = InertiaReact;
                }
            }
        </script>
        
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
