<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


// 生徒か先生のアクセス制御を行う
class StudentOrTeacherAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 生徒又は教師でログインしていないならログイン画面へ遷移
        if (Auth::guard('student')->check() || Auth::guard('teacher')->check()) {
            if (Auth::guard('student')->check()) {
                Auth::shouldUse('student');
            } else {
                Auth::shouldUse('teacher');
            }
            return $next($request);
        }else{

            return redirect()->route('login');
        }
        
       
       
        
    }
}
