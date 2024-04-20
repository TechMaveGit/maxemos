<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (isset(auth()->user()->userType) && auth()->user()->userType == 'user') {
                if ($request->is('admin/*')) {
                    abort(200, '', ['Location' => route('welcomeWeb')]);
                }
            } elseif (isset(auth()->user()->userType) && auth()->user()->userType == '1') {
                $userPermissions = session()->get('userPermissions');
                if (!$userPermissions) {
                    Auth::logout();
                    return redirect()->route('login');
                }
            }
        }
        return $next($request);
    }
}
