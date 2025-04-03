<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // 教師トップページ表示
    public function index(Request $request){
        return view('teacher/teacher_top');
    }
}
