<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class FfAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $uid = $request->session()->get('ff_user_id');
        if (!$uid) return redirect()->route('login');

        $user = User::query()->find($uid);
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Access denied');
        }
        return $next($request);
    }
}
