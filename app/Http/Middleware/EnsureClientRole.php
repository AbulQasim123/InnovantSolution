<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClientRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $client = auth('client_api')->user();

        if (!$client || $client->role !== $role) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Role does not match.',
            ], 403);
        }

        return $next($request);
    }
}
