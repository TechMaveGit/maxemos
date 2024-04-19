<?php

namespace App\Http\Middleware;

use Closure;

class AddContentSecurityPolicy
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' cdnjs.cloudflare.com jeremyfagis.github.io cdn.datatables.net; style-src 'self' 'unsafe-inline' cdnjs.cloudflare.com");

        return $response;
    }
}
