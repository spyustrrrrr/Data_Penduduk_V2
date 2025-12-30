<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanEditMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->canEdit()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit data');
        }

        return $next($request);
    }
}
