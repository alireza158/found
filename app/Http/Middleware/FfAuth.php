<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FfAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->get('ff_user_id')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
