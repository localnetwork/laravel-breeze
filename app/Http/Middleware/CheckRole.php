<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role_id): Response
    {
        if (auth()->check() && auth()->user()->role_id == $role_id) {
            return $next($request);
        }
    
        return abort(403, 'Access Denied.'); // or redirect to a login page or a custom error page
    }
}
