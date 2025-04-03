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
}
