<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class directeurs
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'directeur'||$request->user() && $request->user()->role === 'DG') {
            return $next($request);
        }
        // If not an admin, return error response
        return response()->view('welcome');
    }
}
