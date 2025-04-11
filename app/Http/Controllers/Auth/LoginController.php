<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // ログインページを表示
    public function index(Request $request){
        return view('auth/login');
    }

    public function logout(Request $request)
{
    // 対象のガードを全てリストアップ
    $guards = ['admin', 'teacher', 'user'];

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();
        }
    }

    // セッション破棄とトークン再生成（1回でOK）
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 共通のログイン画面に戻すなど
    return redirect()->route('login');
}
}
