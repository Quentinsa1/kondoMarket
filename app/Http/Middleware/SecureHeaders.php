<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        return $response
            ->header('X-Frame-Options', 'SAMEORIGIN')
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('X-XSS-Protection', '1; mode=block')
            ->header('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload')
            ->header('Cross-Origin-Resource-Policy', 'same-origin')
            ->header('Cross-Origin-Opener-Policy', 'same-origin')
            ->header('Cross-Origin-Embedder-Policy', 'require-corp')
            ->header(
                'Content-Security-Policy',
                "default-src 'self'; img-src 'self' https: data:; script-src 'self' https:; style-src 'self' https: 'unsafe-inline'; object-src 'none'; frame-ancestors 'self'; base-uri 'self'; form-action 'self';"
            );
    }
}