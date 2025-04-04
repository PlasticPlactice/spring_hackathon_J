<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDataController extends Controller
{
    // 生徒データ一覧ページ表示
    public function index(Request $request){
        return view('admin/students_list');
    }
    
    // 生徒データ登録ページ表示
    public function add(Request $request){
        return view('auth/students_register');
    }
}
