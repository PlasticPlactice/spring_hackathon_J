<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// 生徒のアクセス制御を行う
class StudentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 生徒でログインしていないならログイン画面へ遷移
        if (!Auth::guard('student')->check()) {
            return redirect()->route('login');
        }

        Auth::shouldUse('student');
        
        return $next($request);
    }
}
