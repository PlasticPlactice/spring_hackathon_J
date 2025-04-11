<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class AdminController extends Controller
{
    // 管理者トップページ表示
    public function index(Request $request){
        return view('admin/admin_top');
    }

    // 教師データ一覧ページ表示
    public function teachersList(Request $request){
        $teachers = Teacher::all();

        return view('/admin/teachers_list', ['teachers' => $teachers]);
    }
}
