<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// 先生か管理者のアクセス制御を行う
class TeacherOrAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // teacher または admin でログインしていない場合、ログイン画面にリダイレクト
        // dd(Auth::guard('teacher')->check() , Auth::guard('admin')->check());
        if (Auth::guard('teacher')->check() || Auth::guard('admin')->check()) {
            // teacher または admin としてログイン
            if (Auth::guard('teacher')->check()) {
                Auth::shouldUse('teacher');
            } else {
                Auth::shouldUse('admin');
            }
            
            return $next($request);
        }else{
            return redirect()->route('login');
        }
        
       
        
    }
}
