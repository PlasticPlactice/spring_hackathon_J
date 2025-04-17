<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Y_Subject;
use App\Models\T_Comment;
use Illuminate\Support\Facades\Auth;


class SubSubjectController extends Controller
{
    // 科目サブページを表示
    public function index(Request $request){

        // 指定したcourse_list_idのy_subjectsの中身を取得
        $ySubject = Y_Subject::where('course_list_id', $request->course_list_id)
        ->with('Course_list')
        ->first();

        // y_subject_idを取得
        $ySubjectId = $ySubject->Course_list->id;
        // コメント一覧と紐づく教師データを取得
        $tComments = T_Comment::with('Teacher')
        ->where('y_subject_id', $ySubjectId)
        ->where('del_flg', false)
        ->get();

        // 科目名
        $subjectName = $ySubject->Subject->name;
        // 担当教員名
        $teacherName = $ySubject->Course_list->teacher->name;

        // Authのteacher_idをとる
        $teacher_id = Auth::guard('teacher')->id();

        return view('subject/subject_sub', ['subjectName' => $subjectName, 'teacherName' => $teacherName,'tComment' => $tComments, 'teacher_id' => $teacher_id, 'y_subject_id' => $ySubjectId]);
    }

    // 教師がサブページにコメントする
    public function createTComment(Request $request) {

        // 指定したcourse_list_idのy_subjectsの中身を取得
        $ySubject = Y_Subject::where('course_list_id', $request->y_subject_id)
        ->with('Course_list')
        ->first();

        // y_subject_idを取得
        $ySubjectId = $ySubject->Course_list->id;

        $data = [
            'y_subject_id' => $ySubjectId,
            'teacher_id' => $request->teacher_id,
            'title' => $request->title,
            'detail' => $request->detail,
            'link_flg' => $request->link_flg,
            'del_flg' => false
        ];
        T_Comment::createTComment($data);

        return redirect('/subject_sub?course_list_id='.$ySubjectId);
    }

    // コメント削除
    public function deleteTComment(Request $request) {

        // 指定したcourse_list_idのy_subjectsの中身を取得
        $ySubject = Y_Subject::where('course_list_id', $request->y_subject_id)
        ->with('Course_list')
        ->first();

        // y_subject_idを取得
        $ySubjectId = $ySubject->Course_list->id;
        // コメントを論理削除
        T_Comment::deleteTComment($request->comment_id);

        return redirect('/subject_sub?course_list_id='.$ySubjectId);
    }
}
