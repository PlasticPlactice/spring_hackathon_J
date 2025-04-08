<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

// 管理者のアクセス制御を行う
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 管理者でログインしていないならログイン画面へ遷移
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }

        Auth::shouldUse('admin');
        
        return $next($request);
    }
}
