<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;

class HandleSanctumUnauthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (AuthenticationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Token is missing, invalid or expired. Please login again.',
            ], 401);
        }
    }
}
