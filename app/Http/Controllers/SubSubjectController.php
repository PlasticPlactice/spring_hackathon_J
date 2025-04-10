<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Y_Subject;
use App\Models\Course_list;

class SubSubjectController extends Controller
{
    // 科目サブページを表示
    public function index(Request $request){

        // 指定したcourse_list_idのy_subjectsの中身を取得
        $ySubject = Y_Subject::with('Course_list')
        ->where('course_list_id', $request->course_list_id)
        ->first();

        // 科目名
        $subjectName = $ySubject->Subject->name;
        // 担当教員名
        $teacherName = $ySubject->Course_list->teacher->name;

        return view('subject/subject_sub', ['subjectName' => $subjectName, 'teacherName' => $teacherName]);
    }

    // 科目サブページの作成
    public function create(Request $request) {
        $params = [
            'course_list_id' => $request->course_list_id,
            'subject_id' => $request->subject_id,
            'detail' => $request->detail
        ];

        DB::table('y_subjects')->insert($params);

        return view('subject/');
    }
}
