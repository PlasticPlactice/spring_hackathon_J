<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 生徒トップページ表示
    public function index(Request $request){
        return view('student/student_top');
    }
    
    // 個別時間割作成ページ表示
    public function addTimeTable(Request $request){
        return view('student/personal_timetable_register');
    }
    
    // 個別時間割編集ページ表示
    public function editTimeTable(Request $request){
        return view('student/personal_timetable_edit');
    }
    
}
