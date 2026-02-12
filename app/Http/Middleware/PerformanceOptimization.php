<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PerformanceOptimization
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Add performance headers
        if (config('performance.performance.cache_headers')) {
            $response->headers->set('Cache-Control', 'public, max-age=' . config('performance.performance.cache_ttl'));
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + config('performance.performance.cache_ttl')));
        }
        
        // Add security headers
        if (config('performance.performance.security_headers')) {
            foreach (config('performance.performance.security_headers') as $header => $value) {
                $response->headers->set($header, $value);
            }
        }
        
        // Minify HTML if enabled
        if (config('performance.performance.minify_html') && $response->headers->get('Content-Type') === 'text/html; charset=UTF-8') {
            $content = $response->getContent();
            $minified = $this->minifyHtml($content);
            $response->setContent($minified);
        }
        
        // Add compression header
        if (config('performance.performance.compression')) {
            $response->headers->set('Vary', 'Accept-Encoding');
        }
        
        return $response;
    }
    
    private function minifyHtml($content)
    {
        // Remove comments
        $content = preg_replace('/<!--(?!<!)[^\[>].*?-->/s', '', $content);
        
        // Remove whitespace
        $content = preg_replace('/\s+/', ' ', $content);
        
        // Remove newlines
        $content = str_replace(["\r\n", "\r", "\n"], ' ', $content);
        
        return trim($content);
    }
}
