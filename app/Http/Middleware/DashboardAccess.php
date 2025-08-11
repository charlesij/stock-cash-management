<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->access_id == 3){
            return redirect()->route('cashier.index');
        }
        return $next($request);
    }
}
