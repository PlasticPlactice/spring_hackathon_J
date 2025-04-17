<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetAuthGuard
{
    public function handle(Request $request, Closure $next)
    {
        // ログインページにアクセスしている場合はミドルウェアをスキップ
        if ($request->is('/') || $request->is('admin_login') || $request->is('/teacher_login') || $request->is('/student_login') ) {
            return $next($request);
        }

        // セッションに保存されている guard を取得
        $guard = Session::get('guard', null);
    

        // guard がセッションに保存されていて、認証が通っている場合
        if ($guard && Auth::guard($guard)->check()) {
            // セッションに保存された guard を使用
            Auth::shouldUse($guard);
            return $next($request);
        }

          // 新しくログインしているユーザーを検出してガードを設定
          foreach (['admin', 'teacher', 'student'] as $guard) {
            if (Auth::guard($guard)->check()) {
                // guard をセッションに保存
                Session::put('guard', $guard);
                Session::save();  // セッションを明示的に保存
                Auth::shouldUse($guard);
                return $next($request);
            }
        }

        // 認証されていない場合、ログインページにリダイレクト
        return redirect()->route('login');
    }
}
