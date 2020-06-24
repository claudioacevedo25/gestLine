<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role != 'ADMIN_ROLE'){
            return response(view('403'));
            }
            return $next($request);
    }
}

// return response(view('No tienes autorizacion')->with('role', 'ADMIN_ROLE'));