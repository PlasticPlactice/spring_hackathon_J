<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course_list;
use App\Models\C_Subject;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // 生徒トップページ表示
    public function index(Request $request){
        $student_id = Auth::guard('student')->id();
        $cSubject = C_Subject::with('Course_list')->get();

        return view('student/student_top', ['cSubject' => $cSubject]);
    }
    
    // 個別時間割作成ページ表示
    public function addTimeTable(Request $request){
        $CourseLists = Course_list::with('Time_Tables')->get();
        return view('student/personal_timetable_register', ['CourseLists' => $CourseLists]);
    }

    public function createTimeTable(Request $request) {

        $student_id = Auth::guard('student')->id();
        $course_list_id = $request->course_list_id;

        C_Subject::createCSubject($student_id, $course_list_id);
        return view('student/student_top');
    }
    
    // 個別時間割編集ページ表示
    public function editTimeTable(Request $request){
        return view('student/personal_timetable_edit');
    }
    
}
