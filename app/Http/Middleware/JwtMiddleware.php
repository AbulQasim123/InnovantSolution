<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class JwtMiddleware
{
    // public function handle($request, Closure $next)
    // {
    //     try {
    //         $user = JWTAuth::parseToken()->authenticate();
    //     } catch (JWTException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Token not valid'
    //         ], 401);
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has expired'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is invalid'
            ], 401);
        } catch (TokenBlacklistedException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token has been blacklisted'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided'
            ], 401);
        }

        return $next($request);
    }
}
