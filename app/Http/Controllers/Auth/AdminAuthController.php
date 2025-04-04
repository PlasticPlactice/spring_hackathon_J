<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // パスワード変更ページ表示
    public function passwordChange(Request $request){
        return view('auth/password_change');
    }
}
