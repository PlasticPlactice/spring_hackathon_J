<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class AdminAuthController extends Controller
{
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
        // dd($userData);

         
        // Authによる認証を行う
        if (Auth::guard('admin')->attempt($userData)) {
            return redirect()->route('admin.top');  // 認証成功時のリダイレクト先
        }

        return back()->withErrors(['id' => 'idとパスワードが一致しません'])->withInput();
    }
}
