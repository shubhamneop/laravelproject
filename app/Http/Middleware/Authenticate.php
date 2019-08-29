<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Session;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            Session::put('oldUrl', $request->url());
            return route('loginuser');
        }
    }
}
