<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|string
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->name != 'admin') {
            return route('login');
        }

        return $next($request);
    }
}
