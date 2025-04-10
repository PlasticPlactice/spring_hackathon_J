<?php

namespace App\Http\Controllers;

use App\Models\Course_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Y_Subject;

class AdminTimeTableController extends Controller
{
    // 時間割登録ページを表示する
    public function index(Request $request){
        return view('admin/timetable_register');
    }
    // 今季履修可能科目登録ページを表示
    public function addTimeTable(Request $request){
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin/available_subject_register' , ["teachers" => $teachers, "subjects" => $subjects]);
    }

    // 今期履修可能科目登録
    // 登録した場合サブページ(y_subjects)にも自動で登録されるようにする
    // 登録画面でsubjectsの科目名を選択させてそのidをsubject_id
    // 登録された最新のcourse_listのidをcourse_list_idとしてy_subjectsに登録する
    public function createTimeTable(Request $request) {

        // Course_listに登録
        Course_list::createCourseList(
            $request->teacher_id,
            $request->title,
            $request->year,
            $request->session_flg
        );

        // 現時点で最新のCourse_list_idを取得
        $latestId = Course_list::orderBy('created_at', 'desc')->value('id');

        // y_subjects登録処理
        Y_Subject::createYSubject(
            $latestId,
            $request->subject_id,
            $request->detail
        );

        return redirect('/available_subject_register');
    }

    // 今期履修可能科目編集・削除ページを表示
    public function editTimeTable(Request $request){
        $form = DB::table('course_lists')
        ->where('id', $request->id)
        ->first();

        return view('admin/available_subject_edit', ['form' => $form]);
    }

    // 今期履修科目登録の編集処理
    public function updateOrdeleteTimeTable(Request $request) {

        if($request->action === 'update') {
            $data = [
                'teacher_id' => $request->teacher_id,
                'title' => $request->title,
                'year' => $request->year,
                'session_flg' => $request->session_flg,
            ];
    
            // モデルのメソッドを使ってデータを更新
            Course_list::updateCourseList($request->id, $data);
        } elseif($request->action === 'delete') {
            Y_Subject::deleteYSubject($request->id);
            Course_list::deleteCourseList($request->id);
        }

        return view('admin/admin_top');
    }
}
