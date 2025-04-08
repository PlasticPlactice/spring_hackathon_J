<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class TeacherAuthController extends Controller
{
    // 教師データ登録ページ表示
    public function add(Request $request){
        return view('auth/teachers_register');
    }

    // 教師データ編集・削除ページ表示
    public function edit(Request $request){
        return view('auth/teachers_edit');
    }

    // パスワード変更ページ表示
    public function passwordChange(Request $request){
        return view('auth/password_change');
    }

    // ログイン処理
    public function login(LoginRequest $request){

        // idとパスワードを取得
        $userData = $request->only('id', 'pw');
        $userData['password'] = $userData['pw'];
        unset($userData['pw']);

         
        // Authによる認証を行う
        if (Auth::guard('teacher')->attempt($userData)) {
            return redirect()->route('teacher.top');  // 認証成功時のリダイレクト先
        }

        return back()->withErrors(['id' => 'idとパスワードが一致しません'])->withInput();
    }
}
