<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('id') || !session()->has('level')) {

            if (!$request->expectsJson()) {
                return response()->json(['message' => 'session habis'], 401);
            }
            
            return redirect()->route('login')->with('error', 'Session anda telah habis, silahkan login kembali.');
        }
        return $next($request);
    }
}
