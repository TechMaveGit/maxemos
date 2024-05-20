<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DebugModeMiddleware
{
    public function handle($request, Closure $next)
    {
        // $allowedIPs = ['180.151.27.198', ' 103.226.202.112','49.36.177.107']; // Add your allowed IP addresses
        // $clientIP = $request->ip();

        // if (in_array($clientIP, $allowedIPs)) {
        //     Config::set('app.debug', true);
        // } else {
        //     Config::set('app.debug', false);
        // }

        return $next($request);
    }
}
