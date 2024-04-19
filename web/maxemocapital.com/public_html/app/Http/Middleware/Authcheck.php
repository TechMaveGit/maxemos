<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && isset(auth()->user()->userType) && auth()->user()->userType == 'user'){
            // return route('welcomeWeb');
            if ($request->is('admin/*')) {
                abort(200, '', ['Location' => route('welcomeWeb')]);
            }
        }elseif(auth()->check() && isset(auth()->user()->userType) && auth()->user()->userType == '1'){
            $userPermissions=session()->get('userPermissions');
            if(!$userPermissions && auth()->user()->email != 'admin@gmail.com'){
                auth()->logout();
                abort(200, '', ['Location' => route('login')]);
            }
        }
        return $next($request);
    }
}
