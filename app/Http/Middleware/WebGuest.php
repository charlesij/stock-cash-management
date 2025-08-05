<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            // dd(auth()->user()->access_id);
            if (auth()->user()->access_id == 3) {
                return redirect()->route('cashier.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        }

        return $next($request);
    }
}
