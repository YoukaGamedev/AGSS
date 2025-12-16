<?php
namespace App\Http\Middleware;

use Closure;

class AddGameHeaders
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if (str_starts_with($request->path(), 'games/')) {
            $response->headers->set('Cross-Origin-Embedder-Policy', 'require-corp');
            $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        }
        
        return $response;
    }
}