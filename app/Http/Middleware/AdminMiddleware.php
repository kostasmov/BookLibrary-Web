<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty(auth()->user()->role)) {
            if (auth()->check() && (auth()->user()->role == 'admin')) {
                return $next($request);
            }
        }

        return redirect()->route('profile');
    }
}
