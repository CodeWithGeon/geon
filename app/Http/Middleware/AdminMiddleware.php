<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * handle incoming request
     *
     * @param  mixed $request
     * @param  mixed $next
     *
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return response()->json(['message' => 'You do not have admin access.'], 403);
        }
        return $next($request);
    }
}
