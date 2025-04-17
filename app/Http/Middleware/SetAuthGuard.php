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
        // セッションに保存されている guard を使用
        $guard = Session::get('guard', null);
        dd($guard);
        
        if ($guard && Auth::guard($guard)->check()) {
            // 保存されている guard が認証されていれば、そのまま処理を進める
            Auth::shouldUse($guard);
        } else {
            // 新しくログインしているユーザーを検出し、guardを設定
            foreach (['admin', 'teacher', 'student'] as $guard) {
                if (Auth::guard($guard)->check()) {
                    // guard をセッションに保存
                    Session::put('guard', $guard);
                    dd("Guard '{$guard}' is authenticated.");
                    Auth::shouldUse($guard);
                    break;
                }
            }
        }

        return $next($request);
    }

}
