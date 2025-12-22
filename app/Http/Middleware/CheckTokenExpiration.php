<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        // 1. Check if token exists
        if (! $token) {
            // Let standard auth handle missing tokens, or return 400 here if preferred
            return $next($request); 
        }

        // 2. Find the token in the database
        // findToken() automatically hashes the plain text token to look it up
        $accessToken = PersonalAccessToken::findToken($token);

        // 3. Check if token was found and if it has expired
        if (
            $accessToken && 
            $accessToken->expires_at && 
            $accessToken->expires_at->isPast()
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token has expired.',
            ], 400); // <--- Your custom 400 Code
        }

        // 4. If valid (or invalid but not expired), proceed
        return $next($request);
    }
}
