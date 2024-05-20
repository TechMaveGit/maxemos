<?php
namespace App\Http\Middleware;

use Closure;

class AddContentSecurityPolicy
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
$response->header('Content-Security-Policy', "default-src 'self' data: cdnjs.cloudflare.com jeremyfagis.github.io fonts.gstatic.com media.istockphoto.com;style-src 'self' 'unsafe-inline' code.jquery.com cdnjs.cloudflare.com jeremyfagis.github.io fonts.googleapis.com fonts.gstatic.com;script-src 'self' 'unsafe-inline' 'unsafe-eval' cdn.ckeditor.com code.jquery.com cdnjs.cloudflare.com jeremyfagis.github.io ajax.googleapis.com fonts.googleapis.com; img-src 'self' data:  https://media.istockphoto.com https://i.stack.imgur.com; connect-src 'self' ajax.googleapis.com; form-action 'self';font-src 'self' data: fonts.gstatic.com cdnjs.cloudflare.com; media-src 'self' media.istockphoto.com;frame-src 'self';");
	
	return $response;
    }
}

