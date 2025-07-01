<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
  public function handle(Request $request, Closure $next)
{
    // Nếu người dùng đã đăng nhập và truy cập /login (không chặn /register)
    if (Auth::check() && $request->routeIs('login')) {
        return redirect()->route('dashboard');
    }

    return $next($request);
}


}