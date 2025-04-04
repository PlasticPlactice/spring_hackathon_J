<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
