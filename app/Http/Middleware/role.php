<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class role
{

    public function handle(Request $request, Closure $next)
    {
                // Check if the user is authenticated
                if ($request->user() && ($request->user()->role === 'admin' || $request->user()->role === 'RRH')) {
                    return $next($request);
                }
                // If not an admin, return error response
                return response()->view('welcome'); 
}

}

