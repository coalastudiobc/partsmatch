<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCacheHistoryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $response = $next($request);

        // // Set headers to prevent caching
        // $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
        // $response->headers->set('Pragma', 'no-cache');
        // $response->headers->set('Expires', '0');
        // $response = $next($request);
        $response = $next($request);

        $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        $response->header('Cache-Control', 'no-cache, must-revalidate, no-store, max-age=0, private');
        $response->header('Pragma','no-cache');
        return $response;
    }
}
