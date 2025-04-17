<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;




class AdminAuthController extends Controller
{
    // パスワード変更ページ表示
    public function passwordChangeShow(Request $request){
        return view('auth/password_change',['url'=>'admin_password_change']);
    }
    // パスワード変更ページ表示
    public function passwordChange(ChangePasswordRequest $request){
         // 現在認証されている学生の情報を取得
        $admin = Auth::guard('admin')->user();

        // 送られてきた現在のパスワードと現在のパスワードが一致するかをチェック
        if (!Hash::check($request->current_password, $admin->pw)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

          // ここで新しいパスワードの変更処理を実行
        $admin->pw = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('login');

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
            Session::put('guard', 'admin');
            return redirect()->route('admin.top');  // 認証成功時のリダイレクト先
        }
        return back()->withErrors(['id' => 'idとパスワードが一致しません'])->withInput();
    }
}
