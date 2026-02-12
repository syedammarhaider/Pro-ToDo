<?php

return [
    // Performance Optimization Settings
    'performance' => [
        // Enable HTTP caching headers
        'cache_headers' => true,
        
        // Cache TTL in seconds
        'cache_ttl' => 3600,
        
        // Enable compression
        'compression' => true,
        
        // Minify HTML output
        'minify_html' => true,
        
        // Enable lazy loading
        'lazy_loading' => true,
        
        // Preload critical resources
        'preload_critical' => true,
        
        // Optimize images
        'optimize_images' => true,
        
        // Enable CDN
        'cdn_enabled' => env('CDN_ENABLED', false),
        'cdn_url' => env('CDN_URL', ''),
        
        // Database query optimization
        'query_cache' => true,
        'eager_loading' => true,
        
        // Session optimization
        'session_driver' => env('SESSION_DRIVER', 'file'),
        'session_lifetime' => 120,
        
        // View optimization
        'view_cache' => true,
        'template_cache' => true,
        
        // Asset optimization
        'asset_versioning' => true,
        'asset_minification' => true,
        
        // API optimization
        'api_cache' => true,
        'api_rate_limiting' => true,
        
        // Security headers
        'security_headers' => [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
            'Content-Security-Policy' => "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; font-src 'self' https://fonts.bunny.net; img-src 'self' data: https:; connect-src 'self'; frame-ancestors 'none';",
        ],
    ],
];
