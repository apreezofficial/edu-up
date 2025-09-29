<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in AND has the 'admin' role
        if ($request->user() && $request->user()->hasRole('admin')) {
            return $next($request);
        }
        
        // If not admin, redirect or forbid access
        return abort(403, 'Unauthorized action.');
    }
}