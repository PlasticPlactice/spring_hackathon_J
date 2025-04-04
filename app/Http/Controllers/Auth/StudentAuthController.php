<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    // 生徒データ編集・削除ページ表示
    public function edit(Request $request){
        return view('auth/students_edit');
    }

    // パスワード変更ページ表示
    public function passwordChange(Request $request){
        return view('auth/password_change');
    }

    
}
